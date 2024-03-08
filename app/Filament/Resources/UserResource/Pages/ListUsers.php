<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Carbon\Carbon;


class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'admin' => Tab::make()
                 ->badge( User::whereRelation('roles', 'id',1)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->whereRelation('roles', 'id',1)),
            'teacher' => Tab::make()
            ->badge( User::whereRelation('roles', 'id',3)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->whereRelation('roles', 'id',3)),
            'student' => Tab::make()
            ->badge( User::whereRelation('roles', 'id',4)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->whereRelation('roles', 'id',4)),
            'registrar' => Tab::make()
            ->badge( User::whereRelation('roles', 'id',5)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->whereRelation('roles', 'id',5)),
        ];
    }
}

