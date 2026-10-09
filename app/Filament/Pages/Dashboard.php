<?php

namespace App\Filament\Pages;

class Dashboard extends \Filament\Pages\Dashboard
{
    /**
     * @return array<string, int>
     */
    public function getColumns(): int|array
    {
        return [
            'default' => 1,
            'lg' => 2,
        ];
    }
}
