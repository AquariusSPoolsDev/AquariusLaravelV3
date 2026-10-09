<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Actions\Action;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use SensitiveParameter;

class EditProfile extends BaseEditProfile
{
    /**
     * @var array<string, mixed> | null
     */
    public ?array $passwordData = [];

    public function getTitle(): string|Htmlable
    {
        return 'My profile';
    }

    public function mount(): void
    {
        parent::mount();

        $this->passwordForm->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->inlineLabel(false)
            ->components([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getCurrentPasswordFormComponent(),
            ]);
    }

    public function passwordForm(Schema $schema): Schema
    {
        return $schema
            ->statePath('passwordData')
            ->components([
                TextInput::make('currentPassword')
                    ->label('Current password')
                    ->password()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->autocomplete('current-password')
                    ->currentPassword(guard: Filament::getAuthGuard())
                    ->required(),
                TextInput::make('password')
                    ->label('New password')
                    ->password()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->autocomplete('new-password')
                    ->rule(Password::default())
                    ->showAllValidationMessages()
                    ->same('passwordConfirmation')
                    ->required(),
                TextInput::make('passwordConfirmation')
                    ->label('Confirm new password')
                    ->password()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->autocomplete('new-password')
                    ->required(),
            ]);
    }

    /**
     * The email must stay on a company domain, otherwise the user would lock themselves out of the panel.
     */
    protected function getEmailFormComponent(): Component
    {
        return parent::getEmailFormComponent()
            ->endsWith(User::PANEL_EMAIL_DOMAINS)
            ->validationMessages([
                'ends_with' => 'Use your company email ('.implode(' or ', User::PANEL_EMAIL_DOMAINS).'), or you will lose access to the admin panel.',
            ]);
    }

    /**
     * Only asks for the current password when the email is being changed — passwords have their own section.
     */
    protected function getCurrentPasswordFormComponent(): Component
    {
        return parent::getCurrentPasswordFormComponent()
            ->belowContent('Required to change your email address.')
            ->visible(fn (): bool => ($this->data['email'] ?? null) !== $this->getUser()->getAttributeValue('email'));
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                View::make('filament.pages.profile.header')
                    ->viewData(fn (): array => $this->getHeaderViewData()),
                Grid::make(['default' => 1, 'lg' => 2])
                    ->schema([
                        Section::make('Account details')
                            ->description('Your name and sign-in email.')
                            ->schema([$this->getFormContentComponent()]),
                        Section::make('Your activity')
                            ->description('Content you have added to the website.')
                            ->schema([
                                View::make('filament.pages.profile.activity')
                                    ->viewData(fn (): array => $this->getActivityViewData()),
                            ]),
                        Section::make('Change password')
                            ->description('Use at least 8 characters.')
                            ->schema([$this->getPasswordFormContentComponent()]),
                        Section::make('What you can access')
                            ->description('Set by your role. Ask an admin if something is missing.')
                            ->schema([
                                View::make('filament.pages.profile.access')
                                    ->viewData(fn (): array => ['resources' => $this->getAccessibleResources()]),
                            ]),
                    ]),
                Section::make('Logged-in devices')
                    ->description('Browsers currently signed in to your account.')
                    ->afterHeader([$this->logOutOtherDevicesAction])
                    ->schema([
                        View::make('filament.pages.profile.devices')
                            ->viewData(fn (): array => ['devices' => $this->getDevices()]),
                    ]),
            ]);
    }

    public function getFormContentComponent(): Component
    {
        return Form::make([EmbeddedSchema::make('form')])
            ->id('form')
            ->livewireSubmitHandler('save')
            ->footer([
                Actions::make([
                    Action::make('save')
                        ->label('Save details')
                        ->submit('save'),
                ])->key('form-actions'),
            ]);
    }

    protected function getPasswordFormContentComponent(): Component
    {
        return Form::make([EmbeddedSchema::make('passwordForm')])
            ->id('passwordForm')
            ->livewireSubmitHandler('updatePassword')
            ->footer([
                Actions::make([
                    Action::make('updatePassword')
                        ->label('Update password')
                        ->submit('updatePassword'),
                ])->key('password-form-actions'),
            ]);
    }

    public function updatePassword(): void
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return;
        }

        $data = $this->passwordForm->getState();

        $this->getUser()->update(['password' => Hash::make($data['password'])]);

        if (request()->hasSession()) {
            request()->session()->put([
                'password_hash_'.Filament::getAuthGuard() => $this->getUser()->getAuthPassword(),
            ]);
        }

        $this->passwordForm->fill();

        Notification::make()
            ->success()
            ->title('Password updated')
            ->send();
    }

    public function logOutOtherDevicesAction(): Action
    {
        return Action::make('logOutOtherDevices')
            ->label('Log out other devices')
            ->icon(Heroicon::OutlinedArrowRightStartOnRectangle)
            ->color('gray')
            ->size('sm')
            ->visible(fn (): bool => $this->getDevices()->contains('isCurrentDevice', false))
            ->modalHeading('Log out other devices')
            ->modalDescription('Every other browser signed in to your account will be logged out. Enter your password to confirm.')
            ->modalSubmitActionLabel('Log out other devices')
            ->schema([
                TextInput::make('currentPassword')
                    ->label('Current password')
                    ->password()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->currentPassword(guard: Filament::getAuthGuard())
                    ->required(),
            ])
            ->action(function (#[SensitiveParameter] array $data): void {
                Filament::auth()->logoutOtherDevices($data['currentPassword']);

                if (config('session.driver') === 'database') {
                    DB::connection(config('session.connection'))
                        ->table(config('session.table', 'sessions'))
                        ->where('user_id', $this->getUser()->getAuthIdentifier())
                        ->when($this->getCurrentSessionId(), fn ($query, string $sessionId) => $query->where('id', '!=', $sessionId))
                        ->delete();
                }

                Notification::make()
                    ->success()
                    ->title('Other devices logged out')
                    ->send();
            });
    }

    /**
     * @return array{initials: string, name: string, email: string, roles: Collection<int, string>, memberSince: ?string}
     */
    protected function getHeaderViewData(): array
    {
        /** @var User $user */
        $user = $this->getUser();

        return [
            'initials' => Str::of($user->name)->explode(' ')->filter()->take(2)->map(fn (string $word): string => Str::upper(Str::substr($word, 0, 1)))->implode(''),
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $user->getRoleNames(),
            'memberSince' => $user->created_at?->timezone('Asia/Kuala_Lumpur')->format('d M Y'),
        ];
    }

    /**
     * @return array{imageCount: int, promotionCount: int}
     */
    protected function getActivityViewData(): array
    {
        /** @var User $user */
        $user = $this->getUser();

        return [
            'imageCount' => $user->imageGalleries()->count(),
            'promotionCount' => $user->promotions()->count(),
        ];
    }

    /**
     * Every resource in the panel, and whether this user's role lets them open it.
     *
     * @return Collection<int, array{label: string, canAccess: bool}>
     */
    protected function getAccessibleResources(): Collection
    {
        return collect(Filament::getCurrentPanel()->getResources())
            ->map(fn (string $resource): array => [
                'label' => $resource::getNavigationLabel(),
                'canAccess' => $resource::canViewAny(),
            ])
            ->sortByDesc('canAccess')
            ->values();
    }

    /**
     * Sessions for this user, newest first. Only available with the database session driver.
     *
     * @return Collection<int, array{browser: string, platform: string, ipAddress: ?string, lastActive: string, isCurrentDevice: bool}>
     */
    protected function getDevices(): Collection
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return DB::connection(config('session.connection'))
            ->table(config('session.table', 'sessions'))
            ->where('user_id', $this->getUser()->getAuthIdentifier())
            ->orderByDesc('last_activity')
            ->get(['id', 'ip_address', 'user_agent', 'last_activity'])
            ->map(fn (object $session): array => [
                'browser' => $this->detectBrowser((string) $session->user_agent),
                'platform' => $this->detectPlatform((string) $session->user_agent),
                'ipAddress' => $session->ip_address,
                'lastActive' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                'isCurrentDevice' => $session->id === $this->getCurrentSessionId(),
            ]);
    }

    private function getCurrentSessionId(): ?string
    {
        return request()->hasSession() ? request()->session()->getId() : null;
    }

    private function detectBrowser(string $userAgent): string
    {
        return match (true) {
            Str::contains($userAgent, 'Edg/') => 'Edge',
            Str::contains($userAgent, ['OPR/', 'Opera']) => 'Opera',
            Str::contains($userAgent, ['Chrome/', 'CriOS/']) => 'Chrome',
            Str::contains($userAgent, ['Firefox/', 'FxiOS/']) => 'Firefox',
            Str::contains($userAgent, 'Safari/') => 'Safari',
            default => 'Unknown browser',
        };
    }

    private function detectPlatform(string $userAgent): string
    {
        return match (true) {
            Str::contains($userAgent, ['iPhone', 'iPad']) => 'iOS',
            Str::contains($userAgent, 'Android') => 'Android',
            Str::contains($userAgent, 'Windows') => 'Windows',
            Str::contains($userAgent, 'Mac OS') => 'macOS',
            Str::contains($userAgent, 'Linux') => 'Linux',
            default => 'Unknown device',
        };
    }
}
