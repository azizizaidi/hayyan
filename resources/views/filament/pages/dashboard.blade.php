<x-filament-panels::page>
@can('widget_StatsOverview')
@livewire(\App\Filament\Widgets\StatsOverview::class)
@livewire(\App\Filament\Widgets\StudentsOverview::class)
@livewire('chart-sale')
@endcan
@livewire('database-notifications')



</x-filament-panels::page>
