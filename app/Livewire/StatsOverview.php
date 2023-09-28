<?php

namespace App\Livewire;

use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return UserList::class;
    }

    protected function getStats(): array
    {
        return [
            Stat::make(__('Users'), $this->getPageTableQuery()->count()),
        ];
    }
}
