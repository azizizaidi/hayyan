<?php

namespace App\Livewire;

use App\Models\ReportClass;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Blade;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\IconColumn;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Model;





class ListFee extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;



    public function table(Table $table): Table



    {

        return $table
            ->striped()
            ->groups([


            ])
            ->query(ReportClass::query())
            ->paginated([5,10, 25, 50, 100])
            ->columns([

                    TextColumn::make('id'),


                    TextColumn::make('created_by.name')
                    ->label('Nama Guru')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(isIndividual: true),

                    TextColumn::make('registrar.name')
                    ->label('Nama Pendaftar')
                    ->toggleable()
                    ->searchable(isIndividual: true),

                    TextColumn::make('registrar.code')
                    ->label('Kod Pendaftar')
                    ->searchable()
                    ->toggleable(),
                     TextColumn::make('registrar.phone')
                    ->label('No. Telefon')
                    ->toggleable(isToggledHiddenByDefault: true),
                    TextColumn::make('month')
                    ->label('Bulan')
                    ->toggleable()
                    ->searchable(),

                    TextColumn::make('fee_student')
                    ->label('Yuran')
                    ->currency('MYR')
                    ->toggleable(),
                    TextColumn::make('note')
                    ->label('Nota')
                    ->toggleable(isToggledHiddenByDefault: true),
                    SelectColumn::make('status')
                    ->options([
                        0 => 'Belum Bayar',

                        1 => 'Dah Bayar',

                        2 => 'Dalam Proses',

                        3 => 'Gagal Bayar',

                     ])

                    // ->tooltip(fn (Model $record): string => " {$record->options}")

                   //  ->selectablePlaceholder(false)
                     ->disabled()
                     ->toggleable(),

                     ImageColumn::make('receipt')
                     ->label('Resit')
                     ->toggleable(isToggledHiddenByDefault: true)
                     ->disk('public')
                     ->circular()
                    // ->defaultImageUrl(url('images/placeholder.png'))
                     ->visibility('public'),








            ])
            ->filters([
                SelectFilter::make('status')
                ->options([
                    0 => 'Belum Bayar',

                    1 => 'Dah Bayar',

                    2 => 'Dalam Proses',

                    3 => 'Gagal Bayar',

                ]),

            ])
            ->actions([
                Action::make('invois')
                       ->icon('heroicon-s-eye')
                       ->url(fn (ReportClass $record): string => route('filament.admin.pages.invoices', ['id' => $record])),
               Action::make('bayar')
                       ->icon('heroicon-m-credit-card')
                       ->color('danger')
                       ->visible(fn(): bool => auth()->user()->can('create_report::class'))
                       ->url(fn (ReportClass $pay): string => route('toyyibpay.createBill',$pay)),
              Action::make('sunting')
                    ->icon('heroicon-o-pencil-square')
                    ->fillForm(fn (ReportClass $record): array => [
                   'status' => $record->status,
                   'receipt' => $record->receipt,
                   'note' => $record->note,
                   //'receipt' => $record->receipt,
                      ])
                       ->form([
                           Select::make('status')
                               ->label('Status')
                               ->options([
                                0 => 'Belum Bayar',

                                1 => 'Dah Bayar',

                                2 => 'Dalam Proses',

                                3 => 'Gagal Bayar',

                            ])
                               ->required(),
                               FileUpload::make('receipt')
                               ->image()
                               ->label('Resit')
                               ->required()

                               ->disk('public')
                               ->directory('livewire-tmp')
                               ->visibility('public')
                               //->storeFiles(false)
                                ->downloadable()
                                ->loadingIndicatorPosition('left')
                                ->panelAspectRatio('2:1')
                                ->panelLayout('integrated')
                                ->removeUploadedFileButtonPosition('right')
                                ->uploadButtonPosition('left')
                                ->uploadProgressIndicatorPosition('left'),
                                TextInput::make('note')
                                ->label('Nota')

                       ])
                       ->action(function (array $data, ReportClass $record): void {
                        $record->status = $data['status'];
                        $record->receipt = $data['receipt'];
                        $record->note = $data['note'];


                        $record->save();
                       })
            ])
            ->groupedBulkActions([

                    ExportBulkAction::make()
                    ->label('Eksport'),
                    //Tables\Actions\DeleteBulkAction::make(),
                    BulkAction::make('delete')
                    ->requiresConfirmation()
                    ->label('Padam')
                    ->action(fn (Collection $records) => $records->each->delete())
                    ->icon('heroicon-s-trash'),


            ]);
    }

    public function render(): View
    {
        return view('livewire.list-fee');
    }


}
