<?php

namespace App\Filament\Resources\TicketResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Ticket;

class TicketStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Open Tickets', Ticket::where('status', 'Open')->count()),
            Stat::make('Resolved Tickets', Ticket::where('status', 'Resolved')->count()),
            Stat::make('Closed Tickets', Ticket::where('status', 'Closed')->count()),
        ];
    }
}
