<?php

namespace App\Filament\Lecturer\Resources;

use App\Filament\Lecturer\Resources\PresensiResource\Pages;
use App\Filament\Lecturer\Resources\PresensiResource\RelationManagers;
use App\Models\Presensi;
use App\Models\ScheduleWeek;
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
        // Override query untuk memfilter berdasarkan lecturer_id yang sedang login
        return parent::getEloquentQuery()
            ->whereHas('schedule', function ($query) {
                $query->where('lecturer_id', auth()->id());
            });
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
                    ->label('Mata Kuliah'),
                Tables\Columns\TextColumn::make('week.name')
                    ->label('Minggu')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => "Minggu ke-{$state}"),
                Tables\Columns\TextColumn::make('schedule.group.name')
                    ->searchable()
                    ->sortable()
                    ->label('Kelas'),
                BadgeColumn::make('status')
                    ->sortable()
                    ->colors([
                        'primary' => 'closed',
                        'success' => 'opened',
                    ])
                    ->label('Status'),
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
                    ->disabled(fn (Model $record) => $record->status == 'opened')
                    ->button(),
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
            // 'create' => Pages\CreatePresensi::route('/create'),
            // 'edit' => Pages\EditPresensi::route('edit'),
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