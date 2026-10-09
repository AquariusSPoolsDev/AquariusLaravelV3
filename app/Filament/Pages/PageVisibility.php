<?php

namespace App\Filament\Pages;

use App\Enums\SitePage;
use BackedEnum;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Actions\Action;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Callout;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;
use UnitEnum;

/**
 * Switches public pages on and off. A hidden page returns 404 and drops out of sitemap.xml.
 */
class PageVisibility extends Page
{
    use HasPageShield;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEye;

    protected static string|UnitEnum|null $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 5;

    protected static ?string $title = 'Page visibility';

    /**
     * @var array<string, bool> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(collect(SitePage::cases())
            ->mapWithKeys(fn (SitePage $page): array => [$page->value => $page->isVisible()])
            ->all());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components(collect(SitePage::cases())
                ->groupBy(fn (SitePage $page): string => $page->group())
                ->map(fn (Collection $pages, string $group): Section => Section::make($group)
                    ->columns(['default' => 1, 'md' => 2])
                    ->schema($pages
                        ->map(fn (SitePage $page): Toggle => Toggle::make($page->value)
                            ->label($page->label())
                            ->helperText($page->description())
                            ->onIcon(Heroicon::Eye)
                            ->offIcon(Heroicon::EyeSlash))
                        ->all()))
                ->values()
                ->all());
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Callout::make('Heads up: changes go live immediately')
                    ->description('Saving updates the public website for every visitor straight away. Switching off a page that is already live also drops it from Google, and it can take weeks to rank again after you switch it back on. Take extra care with Homepage, Contact Us and Privacy Policy.')
                    ->warning(),
                Section::make('Public pages')
                    ->description('Turn a page off while its content is unfinished. It shows "page not found" in both languages and Google stops listing it. Links to it stay on the website and lead to "page not found". Turn it back on when it is ready.')
                    ->schema([
                        Form::make([EmbeddedSchema::make('form')])
                            ->id('form')
                            ->livewireSubmitHandler('save')
                            ->footer([
                                Actions::make([
                                    Action::make('save')
                                        ->label('Save')
                                        ->submit('save'),
                                ])->key('form-actions'),
                            ]),
                    ]),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach (SitePage::cases() as $page) {
            $page->setVisible((bool) ($data[$page->value] ?? false));
        }

        Notification::make()
            ->success()
            ->title('Page visibility saved')
            ->body('The website updates straight away.')
            ->send();
    }
}
