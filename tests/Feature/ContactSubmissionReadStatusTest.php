<?php

namespace Tests\Feature;

use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource;
use App\Filament\Resources\ContactSubmissions\Pages\ListContactSubmissions;
use App\Models\ContactSubmission;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * phpunit.xml points at the development MySQL database. These tests must change enquiry statuses,
 * so every test runs inside a transaction that is rolled back afterwards — nothing is kept.
 */
class ContactSubmissionReadStatusTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel('admin');

        $admin = User::query()->where('email', 'admin@aquariusswimmingpools.com')->first();

        if (! $admin) {
            $this->markTestSkipped('The seeded admin user is not in this database.');
        }

        $this->actingAs($admin);
    }

    private function createSubmission(string $status): ContactSubmission
    {
        return ContactSubmission::query()->create([
            'name' => 'Test Enquirer',
            'email' => 'enquirer@example.com',
            'country_code' => '+60',
            'phone' => '123456789',
            'interest' => 'Concrete Pool',
            'query' => 'Test enquiry',
            'agreed' => true,
            'status' => $status,
        ]);
    }

    public function test_mark_as_read_only_changes_new_enquiries(): void
    {
        $newSubmission = $this->createSubmission('new');
        $spamSubmission = $this->createSubmission('spam');

        $newSubmission->markAsRead();
        $spamSubmission->markAsRead();

        $this->assertSame('read', $newSubmission->fresh()->status);
        $this->assertSame('spam', $spamSubmission->fresh()->status);
    }

    public function test_opening_the_edit_page_marks_the_enquiry_as_read(): void
    {
        $submission = $this->createSubmission('new');

        $this->get(ContactSubmissionResource::getUrl('edit', ['record' => $submission]))->assertOk();

        $this->assertSame('read', $submission->fresh()->status);
    }

    public function test_opening_the_view_modal_marks_the_enquiry_as_read(): void
    {
        $submission = $this->createSubmission('new');

        Livewire::test(ListContactSubmissions::class)
            ->mountAction(TestAction::make('view')->table($submission));

        $this->assertSame('read', $submission->fresh()->status);
    }

    public function test_navigation_badge_counts_only_new_enquiries(): void
    {
        ContactSubmission::query()->update(['status' => 'read']);

        $this->assertNull(ContactSubmissionResource::getNavigationBadge());

        $this->createSubmission('new');
        $this->createSubmission('new');
        $this->createSubmission('spam');

        $this->assertSame('2', (string) ContactSubmissionResource::getNavigationBadge());
    }

    public function test_user_menu_links_to_the_website(): void
    {
        $this->get('/admin')
            ->assertOk()
            ->assertSee('View website')
            ->assertSee(route('homepage', ['locale' => 'en']), false);
    }
}
