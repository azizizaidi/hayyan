<?php

namespace App\Filament\Resources\ReportClassResource\Pages;

use App\Filament\Resources\ReportClassResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReportClasses extends ListRecords
{
    protected static string $resource = ReportClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
