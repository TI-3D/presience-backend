<?php

namespace App\Filament\Lecturer\Resources;

use App\Filament\Lecturer\Resources\PresensiResource\Pages;
use App\Filament\Lecturer\Resources\PresensiResource\RelationManagers;
use App\Models\Presensi;
use App\Models\ScheduleWeek;
use Filament\Actions\Action;
use App\Models\Week;
use Filament\Forms;
use Filament\Support\Colors\Color;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PresensiResource extends Resource
{
    protected static ?string $model = ScheduleWeek::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function getEloquentQuery(): Builder
    {

        // Get the current week's ID (or calculate based on your business logic)
        $currentWeek = Week::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();
        $currentWeekId = $currentWeek?->id;
        // dd($currentWeekId);

        // Ensure that we have a valid week ID before applying the filter
        if (!$currentWeekId) {
            // Handle cases where the current week is not found (optional)
            return parent::getEloquentQuery();
        }

        // Query to filter by lecturer_id and limit to current or previous weeks
        $data = parent::getEloquentQuery()
            ->where('week_id', '<=', $currentWeekId) // Filter ScheduleWeek by week_id
            ->whereHas('schedule', function ($query) { // Ensure schedule's lecturer_id matches the authenticated user
                $query->where('lecturer_id', auth()->id());
            });

        // dd($data->get());
        return $data;
    }

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
            ->columns([
                Tables\Columns\TextColumn::make('schedule.course.name')
                    ->searchable()
                    ->sortable()
                    ->label('Mata Kuliah')
                    ->url(fn(Model $record) => route('filament.lecturer.resources.presensis.view', ['scheduleWeekId' == 1])),
                Tables\Columns\TextColumn::make('week.name')
                    ->label('Minggu')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn(string $state): string => "Minggu ke-{$state}"),
                Tables\Columns\TextColumn::make('schedule.group.name')
                    ->searchable()
                    ->sortable()
                    ->label('Kelas'),
                BadgeColumn::make('status')
                    ->sortable()
                    ->colors([
                        'gray' => 'closed',
                        'success' => 'opened',
                    ])
                    ->label('Status')
                    ->formatStateUsing(function ($state) {
                        if ($state === 'closed') {
                            return 'Belum Dibuka';
                        } else if ($state === 'opened') {
                            return 'Aktif';
                        }
                        // Customize badge text based on the 'status' value
                        return $state;
                    })
                    ,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('buka')
                    ->label('Buka')
                    ->color(Color::Blue)
                    ->modalWidth('md')
                    ->modalHeading('Jenis Kelas')
                    ->modalSubheading('Pilih Jenis Kelas Offline atau Online')
                    ->modalActions([
                        Tables\Actions\Action::make('offline')
                            ->label('Offline')
                            ->after(function () {
                                // Tutup modal setelah aksi selesai
                                return redirect(request()->header('Referer'));
                            })
                            ->action(function (Model $record, $action) {
                                // Update status dan is_online untuk offline
                                $record->update(['status' => 'opened', 'opened_at' => now(), 'is_online' => false]);

                                Notification::make()
                                    ->title('Berhasil membuka kelas offline')
                                    ->success()
                                    ->send();
                            })
                            ->color(Color::Blue),
                        Tables\Actions\Action::make('online')
                            ->label('Online')
                            ->after(function () {
                                // Tutup modal setelah aksi selesai
                                return redirect(request()->header('Referer'));
                            })
                            ->action(function (Model $record) {
                                // Update status dan is_online untuk online
                                $record->update(['status' => 'opened', 'opened_at' => now(), 'is_online' => true]);

                                Notification::make()
                                    ->title('Berhasil membuka kelas online')
                                    ->success()
                                    ->send();
                            })
                            ->color(Color::Gray),
                    ])
                    ->disabled(fn(Model $record) => $record->status == 'opened')
                    ->button(),

                // Action::make('viewDetails')
                // ->label('View Details')
                // ->url(fn($record) => route('filament.resources.presensi.detail', ['scheduleWeekId' => $record->id]))
                // ->button(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPresensis::route('/'),
            'view' => Pages\ViewPresensi::route('/view/{scheduleWeekId}')
        ];
    }

    public static function getLabel(): ?string
    {
        return 'Presensi';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Presensi';
    }
}
