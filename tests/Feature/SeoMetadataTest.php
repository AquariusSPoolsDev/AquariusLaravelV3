<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Concerns\ShowsAllPages;
use Tests\TestCase;

/**
 * Search-result titles, descriptions and structured data. Runs against the development MySQL
 * database inside a rolled-back transaction (every page is switched on for the test).
 */
class SeoMetadataTest extends TestCase
{
    use DatabaseTransactions;
    use ShowsAllPages;

    /**
     * @return array<string, array{string}>
     */
    public static function indexablePages(): array
    {
        $pages = [];

        foreach (['en', 'ms'] as $locale) {
            foreach (['', '/our-pools', '/concrete-pools', '/vinyl-pools', '/fibreglass-pools', '/our-pool-services',
                '/pool-items-equipments', '/showcase', '/reviews', '/contact-us', '/faq', '/promotions'] as $page) {
                $pages["/{$locale}{$page}"] = ["/{$locale}{$page}"];
            }
        }

        return $pages;
    }

    #[DataProvider('indexablePages')]
    public function test_title_ends_with_the_brand_once_and_is_not_double_escaped(string $url): void
    {
        $html = $this->get($url)->assertOk()->getContent();

        preg_match('/<title>(.*?)<\/title>/s', $html, $match);
        $title = html_entity_decode($match[1], ENT_QUOTES | ENT_HTML5);

        $this->assertStringEndsWith('Aquarius Swimming Pools', $title);
        $this->assertSame(1, substr_count($title, 'Aquarius'), "{$url} repeats the brand: {$title}");
        $this->assertLessThanOrEqual(80, mb_strlen($title), "{$url} title is too long: {$title}");
        $this->assertStringNotContainsString('&amp;amp;', $html);
        $this->assertStringNotContainsString('&amp;#039;', $html);
    }

    #[DataProvider('indexablePages')]
    public function test_meta_description_fits_in_search_results(string $url): void
    {
        $html = $this->get($url)->assertOk()->getContent();

        preg_match('/<meta name="description" content="([^"]*)"/', $html, $match);
        $description = html_entity_decode($match[1], ENT_QUOTES | ENT_HTML5);

        $this->assertNotSame('', $description, "{$url} has no meta description.");
        $this->assertLessThanOrEqual(160, mb_strlen($description), "{$url} description is too long: {$description}");
    }

    public function test_malay_homepage_title_is_in_malay(): void
    {
        $this->get('/ms')
            ->assertOk()
            ->assertSee('<title>'.e(__('strings.homepage_seo_title', [], 'ms_MY')).'</title>', false);
    }

    public function test_website_schema_has_no_search_action_for_a_missing_search_page(): void
    {
        $this->get('/en')->assertOk()->assertDontSee('SearchAction');
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function faqLocales(): array
    {
        return ['english' => ['en', 'en_MY'], 'malay' => ['ms', 'ms_MY']];
    }

    #[DataProvider('faqLocales')]
    public function test_faq_schema_only_contains_text_shown_on_the_page(string $locale, string $appLocale): void
    {
        $html = $this->get("/{$locale}/faq")->assertOk()->getContent();

        $faqSchema = collect($this->jsonLdBlocks($html))->firstWhere('@type', 'FAQPage');
        $this->assertNotNull($faqSchema, 'FAQ page has no FAQPage schema.');
        $this->assertSame(str_replace('_', '-', $appLocale), $faqSchema['inLanguage']);
        $this->assertCount(6, $faqSchema['mainEntity']);
        $this->assertSame(__('strings.faq_choose_concrete', [], $appLocale), $faqSchema['mainEntity'][0]['name']);

        $visibleText = $this->visibleText($html);

        foreach ($faqSchema['mainEntity'] as $question) {
            $this->assertStringContainsString($question['name'], $visibleText);

            foreach (preg_split('/(?<=[.!?])\s+/', $question['acceptedAnswer']['text']) as $sentence) {
                $this->assertStringContainsString($sentence, $visibleText, "FAQ schema sentence not on the page: {$sentence}");
            }
        }
    }

    public function test_sitemap_gives_every_url_a_lastmod(): void
    {
        $xml = $this->get('/sitemap.xml')->assertOk()->getContent();

        $urlCount = substr_count($xml, '<url>');

        $this->assertGreaterThan(0, $urlCount);
        $this->assertSame($urlCount, substr_count($xml, '<lastmod>'));
        $this->assertMatchesRegularExpression('/<lastmod>\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}[+-]\d{2}:\d{2}<\/lastmod>/', $xml);
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function jsonLdBlocks(string $html): array
    {
        preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $matches);

        return array_map(fn (string $json): array => json_decode($json, true, flags: JSON_THROW_ON_ERROR), $matches[1]);
    }

    private function visibleText(string $html): string
    {
        $withoutScripts = preg_replace('/<script\b.*?<\/script>/s', '', $html);

        return trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags(str_replace('<', ' <', $withoutScripts)), ENT_QUOTES | ENT_HTML5)));
    }
}
