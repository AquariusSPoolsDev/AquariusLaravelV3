<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Facts confirmed by the owner on 2026-11-20 stay consistent in both languages: over 1,000 pools,
 * a 5 to 10 year vinyl frame warranty, no unsourced safety claims, and no em dashes in site copy.
 */
class SiteCopyFactsTest extends TestCase
{
    /**
     * @return array<string, array{string}>
     */
    public static function locales(): array
    {
        return [
            'English' => ['en_MY'],
            'Malay' => ['ms_MY'],
        ];
    }

    /**
     * @return array<string, string>
     */
    private function strings(string $locale): array
    {
        return array_filter(require lang_path("{$locale}/strings.php"), 'is_string');
    }

    #[DataProvider('locales')]
    public function test_retired_claims_do_not_come_back(string $locale): void
    {
        $retired = [
            '20 to 30 year', '20 hingga 30 tahun',
            'nearly a thousand', 'hampir seribu',
            'bathtub', 'tab mandi',
            'West Malaysia', 'Semenanjung Malaysia',
        ];

        foreach ($this->strings($locale) as $key => $value) {
            foreach ($retired as $phrase) {
                $this->assertStringNotContainsStringIgnoringCase($phrase, $value, "{$locale} {$key} still says \"{$phrase}\"");
            }
        }
    }

    #[DataProvider('locales')]
    public function test_site_copy_has_no_em_dashes(string $locale): void
    {
        foreach ($this->strings($locale) as $key => $value) {
            $this->assertStringNotContainsString('—', $value, "{$locale} {$key} has an em dash");
        }
    }

    public function test_no_installed_pool_is_called_portable(): void
    {
        foreach (['table_concrete_body_7', 'table_vinyl_body_7', 'table_fibreglass_body_7'] as $key) {
            $this->assertNotSame('Portable.', $this->strings('en_MY')[$key]);
            $this->assertNotSame('Boleh dimudah alih.', $this->strings('ms_MY')[$key]);
        }
    }

    public function test_vinyl_install_time_always_excludes_ordering_time(): void
    {
        $en = $this->strings('en_MY');
        $ms = $this->strings('ms_MY');

        foreach (['pools_vinyl_desc', 'our_pools_vinyl_overview', 'table_vinyl_body_1', 'vinyl_pool_subtitle_heading', 'vinyl_pool_meta_description', 'vinyl_pool_body', 'vinyl_pool_advantage_2_desc'] as $key) {
            $this->assertStringContainsString('not including ordering time', $en[$key], "en {$key}");
            $this->assertStringContainsString('tidak termasuk masa untuk diperoleh', $ms[$key], "ms {$key}");
        }
    }

    public function test_vinyl_warranty_and_pool_count_match_in_both_languages(): void
    {
        $en = $this->strings('en_MY');
        $ms = $this->strings('ms_MY');

        $this->assertStringContainsString('5 to 10 year warranty', $en['vinyl_pool_subtitle_heading']);
        $this->assertStringContainsString('Jaminan 5 hingga 10 tahun', $ms['vinyl_pool_subtitle_heading']);
        $this->assertStringContainsString('over 1,000 pools', $en['trust_body']);
        $this->assertStringContainsString('lebih 1,000 kolam', $ms['trust_body']);
    }
}
