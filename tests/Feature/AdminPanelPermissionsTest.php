<?php

namespace Tests\Feature;

use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource;
use App\Filament\Resources\CustReviews\CustReviewResource;
use App\Filament\Resources\ImageGalleryResource;
use App\Filament\Resources\Projects\ProjectResource;
use App\Filament\Resources\PromotionResource;
use App\Filament\Resources\UserResource;
use App\Models\User;
use BezhanSalleh\FilamentShield\Resources\Roles\RoleResource;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * phpunit.xml points at the development MySQL database, so these must never use RefreshDatabase.
 * The only write is a throwaway Staff user, rolled back with the test's transaction.
 */
class AdminPanelPermissionsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel('admin');
    }

    /**
     * @return array<string, array{class-string}>
     */
    public static function contentResources(): array
    {
        return [
            'contact submissions' => [ContactSubmissionResource::class],
            'customer reviews' => [CustReviewResource::class],
            'projects' => [ProjectResource::class],
            'image gallery' => [ImageGalleryResource::class],
            'promotions' => [PromotionResource::class],
        ];
    }

    /**
     * @return array<string, array{class-string}>
     */
    public static function userManagementResources(): array
    {
        return [
            'users' => [UserResource::class],
            'roles' => [RoleResource::class],
        ];
    }

    private function actingAsExistingUser(string $email): void
    {
        $user = User::query()->where('email', $email)->first();

        if (! $user) {
            $this->markTestSkipped("{$email} is not in this database.");
        }

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
     * @param  class-string  $resource
     */
    #[DataProvider('contentResources')]
    public function test_user_without_a_role_is_blocked_from_content_resources(string $resource): void
    {
        $this->actingAs(User::factory()->make(['email' => 'no-role@aquariusswimmingpools.com']));

        $this->get($resource::getUrl('index'))->assertForbidden();
    }

    /**
     * @param  class-string  $resource
     */
    #[DataProvider('contentResources')]
    public function test_staff_can_open_content_resources(string $resource): void
    {
        $this->actingAsStaff();

        $this->get($resource::getUrl('index'))->assertOk();
    }

    /**
     * @param  class-string  $resource
     */
    #[DataProvider('userManagementResources')]
    public function test_staff_cannot_open_user_management(string $resource): void
    {
        $this->actingAsStaff();

        $this->get($resource::getUrl('index'))->assertForbidden();
    }

    /**
     * @param  class-string  $resource
     */
    #[DataProvider('userManagementResources')]
    public function test_admin_can_open_user_management(string $resource): void
    {
        $this->actingAsExistingUser('admin@aquariusswimmingpools.com');

        $this->get($resource::getUrl('index'))->assertOk();
    }

    public function test_staff_cannot_force_delete_content(): void
    {
        $this->actingAsStaff();

        $this->assertFalse(ContactSubmissionResource::canForceDeleteAny());
        $this->assertTrue(ContactSubmissionResource::canDeleteAny());
    }
}
