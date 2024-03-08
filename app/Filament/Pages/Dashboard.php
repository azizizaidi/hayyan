<?php

namespace App\Filament\Pages;
use App\Models\User;
use Filament\Pages\Dashboard as BasePage;

class Dashboard extends BasePage
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    public static function shouldRegisterNavigation(): bool
{
    return auth()->user()->can('view_dashboard');
}



public function mount(): void
{
    abort_unless(auth()->user()->can('view_dashboard'), 403);
}


}
