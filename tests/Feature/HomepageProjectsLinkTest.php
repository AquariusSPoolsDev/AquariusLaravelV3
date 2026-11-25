<?php

namespace Tests\Feature;

use App\Enums\SitePage;
use App\Models\Project;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * The homepage Showcase section always links to Notable Projects next to the gallery button,
 * even while that page is switched off or has no published projects.
 */
class HomepageProjectsLinkTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        SitePage::Homepage->setVisible(true);
        SitePage::Showcase->setVisible(true);
        Project::query()->update(['is_published' => false]);
    }

    public function test_link_shows_when_the_page_is_on_and_a_project_is_published(): void
    {
        SitePage::Projects->setVisible(true);
        Project::factory()->published()->create();

        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertStringContainsString('data-homepage-projects-link', $html);
        $this->assertStringContainsString('href="'.route('projects-page').'"', $html);
        $this->assertStringContainsString(e(__('strings.showcase_link_projects')), $html);
    }

    public function test_link_is_in_malay_on_the_malay_homepage(): void
    {
        $this->get('/ms')->assertOk()
            ->assertSee('Lihat projek terkemuka')
            ->assertSee('/ms/projects', false);
    }

    public function test_link_still_shows_when_the_projects_page_is_off(): void
    {
        SitePage::Projects->setVisible(false);

        $this->get('/en')->assertOk()->assertSee('data-homepage-projects-link', false);
    }

    public function test_link_still_shows_when_no_project_is_published(): void
    {
        SitePage::Projects->setVisible(true);
        Project::factory()->create();

        $this->get('/en')->assertOk()->assertSee('data-homepage-projects-link', false);
    }
}
