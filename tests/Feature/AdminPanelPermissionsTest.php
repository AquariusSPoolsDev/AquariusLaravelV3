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
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Read-only tests — phpunit.xml points at the development MySQL database,
 * so these must never use RefreshDatabase or write records.
 */
class AdminPanelPermissionsTest extends TestCase
{
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
        $this->actingAsExistingUser('staff1@aquariusswimmingpools.com');

        $this->get($resource::getUrl('index'))->assertOk();
    }

    /**
     * @param  class-string  $resource
     */
    #[DataProvider('userManagementResources')]
    public function test_staff_cannot_open_user_management(string $resource): void
    {
        $this->actingAsExistingUser('staff1@aquariusswimmingpools.com');

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
        $this->actingAsExistingUser('staff1@aquariusswimmingpools.com');

        $this->assertFalse(ContactSubmissionResource::canForceDeleteAny());
        $this->assertTrue(ContactSubmissionResource::canDeleteAny());
    }
}
