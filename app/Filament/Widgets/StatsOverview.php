<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\User;
use Carbon\Carbon;


class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Card::make('Total Users', User::count()),
            Card::make('Users Registered This Month', User::whereBetween('created_at',
            [
                Carbon::now()->startOfMonth()->format('Y-m-d'),
                Carbon::now()->endOfMonth()->format('Y-m-d')
            ]
        )->count()),
           // Card::make('Teachers Created Today', Task::whereDate('created_at', today())->count()),
        ];
    }

 //   public static function canView(): bool
  //  {
  //       return auth()->user()->is_admin(0);

 //   }

}
