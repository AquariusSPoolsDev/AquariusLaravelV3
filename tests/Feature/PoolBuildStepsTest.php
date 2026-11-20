<?php

namespace Tests\Feature;

use App\Enums\SitePage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Each pool page shows its build steps once: number, title, description and photo together,
 * in an ordered list, instead of a title list, a description list and a captioned photo grid.
 */
class PoolBuildStepsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        foreach ([SitePage::ConcretePools, SitePage::VinylPools, SitePage::FibreglassPools] as $page) {
            $page->setVisible(true);
        }
    }

    /**
     * @return array<string, array{string, string, int}>
     */
    public static function pools(): array
    {
        return [
            'concrete' => ['/en/concrete-pools', 'concrete', 5],
            'vinyl' => ['/en/vinyl-pools', 'vinyl', 5],
            'fibreglass' => ['/en/fibreglass-pools', 'fibreglass', 4],
        ];
    }

    #[DataProvider('pools')]
    public function test_build_steps_appear_once_as_an_ordered_list(string $path, string $pool, int $stepCount): void
    {
        $html = $this->get($path)->assertOk()->getContent();

        $this->assertSame(1, substr_count($html, '<ol class="pool-process">'));
        $this->assertSame($stepCount, substr_count($html, '<li class="pool-process-step"'));

        for ($step = 1; $step <= $stepCount; $step++) {
            $description = e(__("strings.{$pool}_pool_step_{$step}_description"));
            $this->assertSame(1, substr_count($html, $description), "{$pool} step {$step} description should appear once");
        }
    }

    public function test_steps_without_a_photo_show_text_only(): void
    {
        $html = $this->get('/en/fibreglass-pools')->assertOk()->getContent();

        if (glob(public_path('assets/images/fibreglass/steps/*.jpg')) === []) {
            $this->assertStringNotContainsString('pool-process-photo', $html);
        }

        $this->assertStringContainsString(e(__('strings.fibreglass_pool_step_1_title')), $html);
    }
}
