<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;


class FeeStudent extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.fee-student';

    protected static ?string $title = 'Yuran Pelajar';

    protected static ?int $navigationSort = 2;

    //protected static ?string $navigationGroup = 'Setting';


    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('view_any_fee_student');
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->can('view_any_fee_student'), 403);
    }


    public static function table(Table $table): Table
{
    return $table
        ->emptyStateIcon('heroicon-o-bookmark');

}

public static function getNavigationLabel(): string
{
    return __('Yuran Pelajar');
}

public function getHeading(): string
{
    return __('Yuran Pelajar');
}


}
