<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportClassResource\Pages;
use App\Filament\Resources\ReportClassResource\RelationManagers;
use App\Models\AssignClassTeacher;
use App\Models\ReportClass;
use App\Models\ClassName;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Get;
use Coolsam\FilamentFlatpickr\Forms\Components\Flatpickr;
use Filament\Forms\Components\Section;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\Action;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\SelectFilter;
//use Filament\Pages\Actions\Action;



class ReportClassResource extends Resource
{
    protected static ?string $model = ReportClass::class;

    protected static ?string $navigationIcon = 'heroicon-s-pencil-square';

   // protected static ?string $report =



    public static function form(Form $form): Form
    {



        return $form
        ->schema([
            Select::make('registrar_id')
            ->label('Pendaftar')
            ->options(function (Get $get) {
                $options = AssignClassTeacher::whereRelation('teacher', 'teacher_id', 'LIKE', Auth::user()->id)
                    ->orderBy('assign_class_code', 'ASC')
                    ->join('users', 'assign_class_teachers.registrar_id', '=', 'users.id')
                    ->select(DB::raw("CONCAT(users.name,' ',users.code) AS full_name"), 'assign_class_teachers.id')
                    ->pluck('full_name', 'assign_class_teachers.id')
                    ->toArray();


                 //  ->select(DB::raw("CONCAT(users.name,' ',users.code) AS full_name"), 'users.id as user_id') // Alias the users.id column as user_id
                 //  ->pluck('full_name', 'user_id'); // Use user_id as the key for options


                return $options;
            })
            ->preload()
            ->searchable()
            ->live(),

            Hidden::make('month'),

            Hidden::make('allowance')
            ->default(10),

            Hidden::make('fee_student')
            ->default(10),

            Select::make('class_names_id')
                ->label('Nama Kelas')
                ->options(function (Get $get) {
                    $registrarId = $get('registrar_id');

                    if ($registrarId) {
                        $classNamesOptions = ClassName::with('assignclass')
                            ->whereRelation('assignclass', 'assign_class_teacher_id', 'LIKE', $registrarId)
                            ->pluck('class_names.name', 'class_names.id')
                            ->toArray();

                        // Get the first key and value from the array
                        $firstKey = key($classNamesOptions);
                        $firstValue = reset($classNamesOptions);

                        return [$firstKey => $firstValue];
                    }

                    // Return an empty array if no registrar_id is selected
                    return [];
                })
                ->live(),

                Flatpickr::make('date')
                ->label('Tarikh Kelas Sebulan(Pilih Semua Tarikh Yang Berkenaan)')
                ->dateFormat('d-m-Y')
                ->conjunction('/')
                ->animate()

                //->theme(\Coolsam\FilamentFlatpickr\Enums\FlatpickrTheme::AIRBNB)
                ->multiple(),


                Select::make('total_hour')
                ->label('Jumlah Jam Kelas Sebulan')
                 ->options([
                    '0' => '0 jam',
                    '0.5' => '30 minit',
                    '1' => '1 jam',
                    '1.5' => '1 jam 30 minit',
                    '2' => '2 jam',
                    '2.5' => '2 jam 30 minit',
                    '3' => '3 jam',
                    '3.5' => '3 jam 30 minit',
                    '4' => '4 jam',
                    '4.5' => '4 jam 30 minit',
                    '5' => '5 jam',
                    '5.5' => '5 jam 30 minit',
                    '6' => '6 jam',
                    '6.5' => '6 jam 30 minit',
                    '7' => '7 jam',
                    '7.5' => '7 jam 30 minit',
                    '8' => '8 jam',
                    '8.5' => '8 jam 30 minit',
                    '9' => '9 jam',
                    '9.5' => '9 jam 30 minit',
                    '10' => '10 jam',
                    '10.5' => '10 jam 30 minit',
                    '11' => '11 jam',
                    '11.5' => '11 jam 30 minit',
                    '12' => '12 jam',
                    '12.5' => '12 jam 30 minit',
                    '13' => '13 jam',
                    '13.5' => '13 jam 30 minit',
                    '14' => '14 jam',
                    '14.5' => '14 jam 30 minit',
                    '15' => '15 jam',
                    '15.5' => '15 jam 30 minit',
                    '16' => '16 jam',
                    '16.5' => '16 jam 30 minit',
                    '17' => '17 jam',
                    '17.5' => '17 jam 30 minit',
                    '18' => '18 jam',
                ])

                ->native(false)
                ->searchable(),

                Section::make('Untuk Kelas Combo Sahaja')
                ->description('Jika pelajar tersebut tiada kelas kedua,sila abaikan ruangan ini.')
                ->hidden(fn (Callable $get) => empty($get('registrar_id')) )
                ->columns(2)
                ->schema([

                    Select::make('class_names_id_2')
                    ->label('Nama Kelas Kedua')
                    ->options(function (Get $get) {
                        $registrarId = $get('registrar_id');

                        if ($registrarId) {
                            $classNamesOptions = ClassName::with('assignclass')
                                ->whereRelation('assignclass', 'assign_class_teacher_id', 'LIKE', $registrarId)
                                ->pluck('class_names.name', 'class_names.id')
                                ->toArray();

                            // Check if the array has only one item
                            if (count($classNamesOptions) === 1) {
                                return [];
                            }

                            // Get the last key and value from the array
                            $lastKey = key(array_slice($classNamesOptions, -1, 1, true));
                            $lastValue = end($classNamesOptions);

                            return [$lastKey => $lastValue];
                        }

                        // Return an empty array if no registrar_id is selected
                        return [];
                    })
                    ->hidden(fn (Callable $get) => empty($get('registrar_id')) )
                    ->live()
                    ,

                    Flatpickr::make('date_2')
                    ->label('Tarikh Kelas Kedua Sebulan(Pilih Semua Tarikh Yang Berkenaan)')
                    ->dateFormat('d-m-Y')
                    ->conjunction('/')
                    ->animate()
                    //->theme(\Coolsam\FilamentFlatpickr\Enums\FlatpickrTheme::AIRBNB)
                    ->multiple()
                   // ->hidden(fn (Callable $get) => empty($get('registrar_id'))),

                   ->hidden(fn (Get $get) => empty($get('class_names_id_2')) || empty($get('registrar_id'))),


                    Select::make('total_hour_2')
                    ->label('Jumlah Jam Kelas Kedua Sebulan')
                     ->options([
                        '0' => '0 jam',
                        '0.5' => '30 minit',
                        '1' => '1 jam',
                        '1.5' => '1 jam 30 minit',
                        '2' => '2 jam',
                        '2.5' => '2 jam 30 minit',
                        '3' => '3 jam',
                        '3.5' => '3 jam 30 minit',
                        '4' => '4 jam',
                        '4.5' => '4 jam 30 minit',
                        '5' => '5 jam',
                        '5.5' => '5 jam 30 minit',
                        '6' => '6 jam',
                        '6.5' => '6 jam 30 minit',
                        '7' => '7 jam',
                        '7.5' => '7 jam 30 minit',
                        '8' => '8 jam',
                        '8.5' => '8 jam 30 minit',
                        '9' => '9 jam',
                        '9.5' => '9 jam 30 minit',
                        '10' => '10 jam',
                        '10.5' => '10 jam 30 minit',
                        '11' => '11 jam',
                        '11.5' => '11 jam 30 minit',
                        '12' => '12 jam',
                        '12.5' => '12 jam 30 minit',
                        '13' => '13 jam',
                        '13.5' => '13 jam 30 minit',
                        '14' => '14 jam',
                        '14.5' => '14 jam 30 minit',
                        '15' => '15 jam',
                        '15.5' => '15 jam 30 minit',
                        '16' => '16 jam',
                        '16.5' => '16 jam 30 minit',
                        '17' => '17 jam',
                        '17.5' => '17 jam 30 minit',
                        '18' => '18 jam',
                    ])

                    ->native(false)
                    ->searchable()
                 //   ->hidden(fn (Callable $get) => empty($get('registrar_id'))),
                 ->hidden(fn (Get $get) => empty($get('class_names_id_2')) || empty($get('registrar_id'))),


                ])


        ]);


    }

    public static function table(Table $table): Table
    {
        return $table

            ->striped()
            ->paginatedWhileReordering()
            ->deferLoading()
            ->groups([

                'created_by.name',
                'registrar.name',
                'month'
            ])
            ->paginated([5,10, 25, 50, 100])
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('created_by.id'),
                TextColumn::make('created_by.name')
                ->label('Nama Guru')
                ->toggleable()
                ->searchable(),
                TextColumn::make('registrar.name')
                ->toggleable()
                ->label('Nama Pendaftar'),
                TextColumn::make('registrar.code')
                ->toggleable()
                ->label('Kod Pendaftar'),
                TextColumn::make('month')
                ->toggleable()
                ->label('Bulan'),

            ])
            ->filters([
                TernaryFilter::make('deleted_at')
                ->nullable(),
                SelectFilter::make('month')
                ->options([
                     '03-2022' => 'Mac 2022',
                     '04-2022' => 'April 2022',
                     '05-2022' => 'Mei 2022',
    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),



            ])
            ->recordUrl(fn (ReportClass $record) => $record ? null : self::getUrl('view', ['record' => $record]))
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
            'index' => Pages\ListReportClasses::route('/'),
            'create' => Pages\CreateReportClass::route('/create'),
            'edit' => Pages\EditReportClass::route('/{record}/edit'),

        ];
    }

    public static function getLabel(): ?string
    {
        $locale = app()->getLocale();

        if($locale == 'ms'){
            return "Laporan Kelas";
        }
        else
           return "Report Class";
    }



}
