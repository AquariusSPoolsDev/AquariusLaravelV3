<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Read-only tests — phpunit.xml points at the development MySQL database,
 * so these must never use RefreshDatabase or write records.
 */
class PageContentIntegrityTest extends TestCase
{
    private const PAGES = [
        '', '/about-us', '/our-pools', '/concrete-pools', '/vinyl-pools', '/fibreglass-pools',
        '/our-pool-services', '/pool-items-equipments', '/showcase', '/projects', '/reviews',
        '/contact-us', '/faq', '/promotions', '/terms', '/privacy', '/sitemap',
    ];

    /**
     * @return array<string, array{string}>
     */
    public static function publicPages(): array
    {
        $pages = [];

        foreach (['en', 'ms'] as $locale) {
            foreach (self::PAGES as $page) {
                $pages["/{$locale}{$page}"] = ["/{$locale}{$page}"];
            }
        }

        return $pages;
    }

    #[DataProvider('publicPages')]
    public function test_page_shows_no_untranslated_keys(string $url): void
    {
        $text = strip_tags($this->get($url)->assertOk()->getContent());

        $this->assertDoesNotMatchRegularExpression('/\bstrings\.[a-z0-9_]+/', $text, "{$url} shows a raw translation key.");
    }

    #[DataProvider('publicPages')]
    public function test_share_image_exists(string $url): void
    {
        $html = $this->get($url)->assertOk()->getContent();

        $this->assertMatchesRegularExpression('/<meta property="og:image" content="([^"]+)"/', $html, "{$url} has no og:image.");
        preg_match('/<meta property="og:image" content="([^"]+)"/', $html, $match);

        $path = parse_url($match[1], PHP_URL_PATH);

        $this->assertFileExists(public_path(ltrim($path, '/')), "{$url} shares an image that does not exist: {$path}");
    }

    public function test_malay_homepage_has_a_malay_description(): void
    {
        $this->get('/ms')
            ->assertOk()
            ->assertSee('<meta name="description" content="'.__('strings.homepage_meta_description', [], 'ms_MY').'"', false);
    }
}
