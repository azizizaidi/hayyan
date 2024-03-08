<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\User;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings';

    public static function shouldRegisterNavigation(): bool
{
    return auth()->user()->can('page_Settings');
}

public function mount(): void
{
    abort_unless(auth()->user()->can('page_Settings'), 403);
}
}
