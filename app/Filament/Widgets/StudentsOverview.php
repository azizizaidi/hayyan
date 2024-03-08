<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StudentsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //Stat::make('Unique views', '192.1k'),
           // Stat::make('Bounce rate', '21%'),
           // Stat::make('Average time on page', '3:12'),
        ];
    }

  //  public static function canView(): bool
   // {
   //      return auth()->user()->is_admin(0);

  //  }
}
