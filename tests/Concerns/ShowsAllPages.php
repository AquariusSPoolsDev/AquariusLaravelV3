<?php

namespace Tests\Concerns;

use App\Enums\SitePage;

/**
 * Switches every page on (admin Page Visibility) before each test, so a page hidden in the local
 * database doesn't turn a test into a 404. Laravel runs setUpShowsAllPages() automatically, after
 * DatabaseTransactions has opened its transaction, so the change is rolled back afterwards.
 */
trait ShowsAllPages
{
    protected function setUpShowsAllPages(): void
    {
        foreach (SitePage::cases() as $page) {
            $page->setVisible(true);
        }
    }
}
