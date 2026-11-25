<?php

namespace Tests\Feature;

use App\Models\User;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * The live site uses the database cache store. Filament (4.17+) locks that cache whenever it
 * reads or writes notifications, so the `cache_locks` table must exist. phpunit.xml uses the
 * array cache, so these tests switch to the database store on purpose.
 *
 * phpunit.xml points at the development MySQL database. Every test runs inside a transaction
 * that is rolled back afterwards.
 */
class DatabaseCacheLocksTest extends TestCase
{
    use DatabaseTransactions;

    public function test_the_cache_locks_table_exists(): void
    {
        $this->assertTrue(Schema::hasTable('cache_locks'));
    }

    public function test_the_database_cache_store_can_take_and_release_a_lock(): void
    {
        $lock = Cache::store('database')->lock('cache-locks-test', 10);

        $this->assertTrue($lock->get());
        $this->assertFalse(Cache::store('database')->lock('cache-locks-test', 10)->get());
        $this->assertTrue($lock->release());
    }

    public function test_admin_notifications_work_with_the_database_cache(): void
    {
        $admin = User::query()->where('email', 'admin@aquariusswimmingpools.com')->first();

        if (! $admin) {
            $this->markTestSkipped('The seeded admin user is not in this database.');
        }

        config(['cache.default' => 'database']);
        Filament::setCurrentPanel('admin');
        $this->actingAs($admin);

        Notification::make()->title('Cache lock test')->success()->send();

        $this->get(route('filament.admin.pages.dashboard'))->assertOk();
    }
}
