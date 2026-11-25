<?php

namespace Tests\Feature;

use App\Enums\SitePage;
use App\Filament\Pages\PageVisibility;
use App\Models\SiteSetting;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * phpunit.xml points at the development MySQL database. Every test runs inside a transaction
 * that is rolled back afterwards, so switching pages on or off here is never kept.
 */
class PageVisibilityTest extends TestCase
{
    use DatabaseTransactions;

    private function hideAllPages(): void
    {
        foreach (SitePage::cases() as $page) {
            $page->setVisible(false);
        }
    }

    private function hideProjects(): void
    {
        $this->showAllPages();
        SitePage::Projects->setVisible(false);
    }

    private function showAllPages(): void
    {
        foreach (SitePage::cases() as $page) {
            $page->setVisible(true);
        }
    }

    private function actingAsExistingUser(string $email): void
    {
        $user = User::query()->where('email', $email)->first();

        if (! $user) {
            $this->markTestSkipped("{$email} is not in this database.");
        }

        Filament::setCurrentPanel('admin');
        $this->actingAs($user);
    }

    /**
     * Signs in as a throwaway Staff user. It is created inside the test's transaction and rolled back.
     */
    private function actingAsStaff(): void
    {
        $staff = User::query()->create([
            'name' => 'Test Staff',
            'email' => 'test-staff-'.Str::random(10).'@aquariusswimmingpools.com',
            'password' => Str::password(),
        ]);
        $staff->assignRole('Staff');

        Filament::setCurrentPanel('admin');
        $this->actingAs($staff);
    }

    /**
     * @return array<string, array{SitePage}>
     */
    public static function sitePages(): array
    {
        return collect(SitePage::cases())
            ->mapWithKeys(fn (SitePage $page): array => [$page->label() => [$page]])
            ->all();
    }

    #[DataProvider('sitePages')]
    public function test_each_page_can_be_switched_off_and_on(SitePage $page): void
    {
        $this->showAllPages();
        $page->setVisible(false);

        foreach ($page->routeNames() as $routeName) {
            foreach (['en', 'ms'] as $locale) {
                $url = route($routeName, ['locale' => $locale, 'slug' => 'any-project']);

                $this->get($url)->assertNotFound();
            }
        }

        $page->setVisible(true);

        $this->get(route($page->routeNames()[0], ['locale' => 'en']))->assertOk();
    }

    public function test_only_unfinished_pages_start_hidden(): void
    {
        SiteSetting::query()->where('key', 'like', 'page_visibility.%')->delete();

        foreach (SitePage::cases() as $page) {
            $this->assertSame(
                $page !== SitePage::Projects,
                $page->isVisible(),
                "{$page->label()} has the wrong default.",
            );
        }
    }

    public function test_every_public_page_has_a_switch(): void
    {
        $unmanagedRoutes = collect(Route::getRoutes()->getRoutes())
            ->filter(fn ($route): bool => str_starts_with($route->uri(), '{locale}'))
            ->map(fn ($route): ?string => $route->getName())
            ->reject(fn (?string $routeName): bool => SitePage::forRoute($routeName) !== null)
            ->values()
            ->all();

        $this->assertSame([], $unmanagedRoutes, 'Add these pages to App\Enums\SitePage.');
    }

    public function test_hidden_pages_return_not_found_in_both_languages(): void
    {
        $this->hideAllPages();

        foreach (['en', 'ms'] as $locale) {
            $this->get("/{$locale}/projects")->assertNotFound();
            $this->get("/{$locale}/projects/any-project")->assertNotFound();
        }
    }

    public function test_visible_pages_load(): void
    {
        $this->showAllPages();

        $this->get('/en/faq')->assertOk();
        $this->get('/ms/projects')->assertOk();
    }

    public function test_links_to_hidden_pages_are_removed(): void
    {
        $this->hideProjects();

        $projectsLink = 'href="'.url('/en/projects').'"';

        // The homepage Showcase link to Projects always shows (user's choice); the menu and footer links still go.
        $homepage = $this->get('/en')->assertOk()->getContent();
        $this->assertSame(1, substr_count($homepage, $projectsLink));
        $this->assertStringContainsString('data-homepage-projects-link', $homepage);
        $this->get('/en/faq')->assertOk()->assertDontSee($projectsLink, false);
    }

    public function test_links_to_visible_pages_are_shown(): void
    {
        $this->showAllPages();

        $this->get('/en')
            ->assertOk()
            ->assertSee('href="'.url('/en/projects').'"', false);
    }

    public function test_hidden_pages_are_left_out_of_the_sitemap(): void
    {
        $this->hideProjects();

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertDontSee(url('/en/projects'), false)
            ->assertSee(url('/en/faq'), false);

        $this->showAllPages();

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertSee(url('/ms/projects'), false);
    }

    public function test_admin_can_switch_pages_on_from_the_panel(): void
    {
        $this->hideAllPages();
        $this->actingAsExistingUser('admin@aquariusswimmingpools.com');

        Livewire::test(PageVisibility::class)
            ->assertSchemaStateSet(['promotions' => false, 'projects' => false, 'faq' => false])
            ->fillForm(['promotions' => true, 'projects' => false, 'faq' => true])
            ->call('save')
            ->assertNotified('Page visibility saved');

        $this->assertTrue(SitePage::Promotions->isVisible());
        $this->assertFalse(SitePage::Projects->isVisible());
        $this->assertTrue(SitePage::Faq->isVisible());
        $this->assertFalse(SitePage::Terms->isVisible());

        $this->get('/en/promotions')->assertOk();
        $this->get('/en/terms')->assertNotFound();
    }

    public function test_the_dropped_about_us_page_is_gone(): void
    {
        $this->showAllPages();
        SiteSetting::setValue('page_visibility.about_us', true);

        $this->assertNull(SitePage::tryFrom('about_us'));
        $this->assertFalse(Route::has('about-page'));

        foreach (['', '/en', '/ms'] as $prefix) {
            $this->get("{$prefix}/about-us")->assertNotFound();
        }

        $this->get('/sitemap.xml')->assertOk()->assertDontSee('about-us', false);

        foreach (['/en', '/en/contact-us', '/ms/faq'] as $url) {
            $this->get($url)->assertOk()->assertDontSee('about-us', false);
        }
    }

    public function test_staff_can_open_the_page_visibility_screen(): void
    {
        $this->actingAsStaff();

        $this->get(PageVisibility::getUrl())
            ->assertOk()
            ->assertSee('Heads up: changes go live immediately');
    }

    public function test_user_without_a_role_cannot_open_the_page_visibility_screen(): void
    {
        Filament::setCurrentPanel('admin');
        $this->actingAs(User::factory()->make(['email' => 'no-role@aquariusswimmingpools.com']));

        $this->get(PageVisibility::getUrl())->assertForbidden();
    }
}
