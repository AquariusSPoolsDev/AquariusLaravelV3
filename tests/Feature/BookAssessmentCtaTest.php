<?php

namespace Tests\Feature;

use App\Enums\SitePage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * The main call to action has one name everywhere ("Book a Free Assessment"), and the homepage hero
 * leads with it: features are a plain line of text, not pills that look tappable.
 */
class BookAssessmentCtaTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        foreach (SitePage::cases() as $page) {
            $page->setVisible(true);
        }
    }

    /**
     * @return array<string, array{string}>
     */
    public static function pages(): array
    {
        return [
            'homepage' => ['/en'],
            'concrete pools' => ['/en/concrete-pools'],
            'showcase' => ['/en/showcase'],
        ];
    }

    #[DataProvider('pages')]
    public function test_no_page_offers_a_quote_instead_of_the_free_assessment(string $path): void
    {
        $this->get($path)->assertOk()
            ->assertDontSee('Get a Quote')
            ->assertSee('Book a Free Assessment');
    }

    public function test_navbar_button_has_a_short_label_for_narrower_screens(): void
    {
        $this->get('/en')->assertOk()
            ->assertSee('<span class="xl:hidden">Free Assessment</span>', false)
            ->assertSee('<span class="hidden xl:inline">Book a Free Assessment</span>', false);

        $this->get('/ms')->assertOk()
            ->assertSee('<span class="xl:hidden">Penilaian Percuma</span>', false)
            ->assertSee('<span class="hidden xl:inline">Tempah Penilaian Percuma</span>', false)
            ->assertDontSee('Sebut Harga');
    }

    public function test_pool_page_banner_keeps_its_pool_interest(): void
    {
        $this->get('/en/concrete-pools')->assertOk()
            ->assertSee('href="'.url('/en/contact-us').'?interest=Tiled+Concrete+Pools" class="cta-strip-btn', false);
    }

    public function test_default_banner_books_the_free_assessment_and_is_tracked(): void
    {
        $this->get('/en/showcase')->assertOk()
            ->assertSee('href="'.url('/en/contact-us').'?interest=Free+Pool+Assessment" class="cta-strip-btn', false)
            ->assertSee("location:'cta_banner'", false);
    }

    public function test_hero_features_are_a_plain_line_not_pills(): void
    {
        $this->get('/en')->assertOk()
            ->assertSee('class="aquarius-feature-line"', false)
            ->assertDontSee('aquarius-feature-pill', false)
            ->assertSeeInOrder(['Concrete, Fibreglass &amp; Vinyl Pools', 'Water Features', 'Chemicals', 'Book a Free Assessment'], false);
    }
}
