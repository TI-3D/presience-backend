<?php

namespace App\Filament\Lecturer\Resources;

use App\Filament\Lecturer\Resources\PermitDetailResource\Pages;
use App\Filament\Lecturer\Resources\PermitDetailResource\RelationManagers;
use App\Models\PermitDetail;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Colors\Color;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;


class PermitDetailResource extends Resource
{
    protected static ?string $model = PermitDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\TextInput::make('permit_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('schedule_week_id')
                    ->relationship('scheduleWeek', 'id')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('permit.student.name')
                    ->label('Nama Mahasiswa')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('scheduleWeek.schedule.course.name')
                    ->label('Mata Kuliah')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('scheduleWeek.week.name')
                    ->label('Minggu ke')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn(string $state): string => "Minggu ke-{$state}"),
                Tables\Columns\TextColumn::make('scheduleWeek.schedule.group.name')
                    ->label('Kelas')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('permit.type_permit')
                    ->label('Jenis Izin')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Tanggal Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('buka')
                    ->label('Lihat')
                    ->color(Color::Blue)
                    ->modalWidth("Medium")
                    ->modalHeading('Jenis Kelas')
                    ->modalSubheading('Pilih Jenis Kelas Offline atau Online')
                    ->modalContent(function (Model $record) {
                        return new HtmlString(
                            <<<HTML
        <div>
            <p><strong>NIM:</strong> {$record->permit->student->nim}</p>
            <p><strong>Nama:</strong> {$record->permit->student->name}</p>
            <p><strong>Kelas:</strong> {$record->scheduleWeek->schedule->group->name}</p>
            <p><strong>Mata Kuliah:</strong> {$record->scheduleWeek->schedule->course->name}</p>
            <p><strong>Minggu ke:</strong> Minggu ke-{$record->scheduleWeek->week->name}</p>
            <p><strong>Jenis Izin:</strong> {$record->permit->type_permit}</p>
            <p><strong>Deskripsi:</strong> {$record->permit->description}</p>
            <p><strong>Status:</strong> {$record->status}</p>
        </div>
        HTML
                        );
                    })
                    ->modalActions([
                        Tables\Actions\Action::make('confirm')
                            ->label('Konfirmasi')
                            ->after(function () {
                                // Tutup modal setelah aksi selesai
                                return redirect(request()->header('Referer'));
                            })
                            ->action(function (Model $record, $action) {
                                $record->update(['status' => 'confirm']);

                                Notification::make()
                                    ->title('Berhasil konfirmasi')
                                    ->success()
                                    ->send();
                            })
                            ->color(Color::Blue),
                        Tables\Actions\Action::make('decline')
                            ->label('Tolak')
                            ->after(function () {
                                return redirect(request()->header('Referer'));
                            })
                            ->action(function (Model $record) {
                                $record->update(['status' => 'decline']);

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
            'index' => Pages\ListPermitDetails::route('/'),
            'create' => Pages\CreatePermitDetail::route('/create'),
            'edit' => Pages\EditPermitDetail::route('/{record}/edit'),
        ];
    }
    public static function getPluralLabel(): ?string
    {
        return 'Perizinan';
    }
}
