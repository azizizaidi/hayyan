<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassNameResource\Pages;
use App\Filament\Resources\ClassNameResource\RelationManagers;
use App\Models\ClassName;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClassNameResource extends Resource
{
    protected static ?string $model = ClassName::class;

    protected static ?string $navigationIcon = 'heroicon-m-puzzle-piece';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->striped()
        ->columns([
            TextColumn::make('name')
            ->label('Nama'),
            TextColumn::make('feeperhour')
            ->label('Yuran Per Jam'),
            TextColumn::make('allowanceperhour')
            ->label('Elaun Per Jam'),
            TextColumn::make('created_at')
            ->label('Tarikh Dibuat'),
            TextColumn::make('updated_at')
            ->label('Tarikh Dikemaskini'),
            TextColumn::make('deleted_at')
            ->label('Tarikh Dipadam'),


        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->recordUrl(fn (ClassName $record) => $record ? null : self::getUrl('view', ['record' => $record]))
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClassNames::route('/'),
            'create' => Pages\CreateClassName::route('/create'),
            'edit' => Pages\EditClassName::route('/{record}/edit'),
        ];
    }
}
