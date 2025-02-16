<?php

namespace App\Filament\Resources\TicketResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Ticket;

class TicketChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            'labels' => ['Open', 'In Progress', 'Resolved', 'Closed'],
            'datasets' => [
                [
                    'label' => 'Tickets',
                    'data' => [
                        Ticket::where('status', 'Open')->count(),
                        Ticket::where('status', 'In Progress')->count(),
                        Ticket::where('status', 'Resolved')->count(),
                        Ticket::where('status', 'Closed')->count(),
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }

    public function getColumnSpan(): int|string|array
    {
        return 'full';
    }
}
