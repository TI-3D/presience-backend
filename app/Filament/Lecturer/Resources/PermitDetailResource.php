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
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\ImageEntry;

class PermitDetailResource extends Resource
{
    protected static ?string $model = PermitDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

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
                Tables\Columns\BadgeColumn::make('permit.type_permit')
                    ->sortable()
                    ->colors([
                        'warning'
                    ])
                    ->label('Jenis Izin')
                    ->formatStateUsing(function ($state) {
                        if ($state === 'izin') {
                            return 'Izin';
                        } else if ($state === 'sakit') {
                            return 'Sakit';
                        }
                        // Customize badge text based on the 'status' value
                        return $state;
                    }),
                Tables\Columns\BadgeColumn::make('status')
                    ->sortable()
                    ->colors([
                        'warning' => 'proses',
                        'gray' => 'decline'
                    ])
                    ->label('Status')
                    ->formatStateUsing(function ($state) {
                        if ($state === 'proses') {
                            return 'Menunggu';
                        } else if ($state === 'decline') {
                            return 'Ditolak';
                        } else if ($state === 'confirm') {
                            return 'Selesai';
                        }
                        // Customize badge text based on the 'status' value
                        return $state;
                    }),
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
                    ->modalHeading('Perizinan')
                    ->infolist(
                        function (Model $record) {
                            // dd($record);
                            return [
                                Section::make()
                                    ->columns([
                                        'sm' => 1,
                                        'lg' => 3,
                                    ])
                                    ->schema([
                                        TextEntry::make('nim')
                                            ->label('NIM')
                                            ->default(fn() => $record->permit->student->nim)->columnSpan([
                                                'sm' => 1,
                                                'lg' => 1,
                                            ]),

                                        TextEntry::make('name')
                                            ->label('Nama')
                                            ->default(fn() => $record->permit->student->name)->columnSpan([
                                                'sm' => 1,
                                                'lg' => 1,
                                            ]),
                                        TextEntry::make('class')
                                            ->label('Kelas')
                                            ->default(fn() => $record->scheduleWeek->schedule->group->name)->columnSpan([
                                                'sm' => 1,
                                                'lg' => 1,
                                            ]),

                                        TextEntry::make('course')
                                            ->label('Mata Kuliah')
                                            ->default(fn() => $record->scheduleWeek->schedule->course->name)->columnSpan([
                                                'sm' => 1,
                                                'lg' => 1,
                                            ]),
                                        TextEntry::make('week')
                                            ->label('Minggu')
                                            ->default(fn() => $record->scheduleWeek->week->name)->columnSpan([
                                                'sm' => 1,
                                                'lg' => 1,
                                            ]),
                                        TextEntry::make('type_permit')
                                            ->label('Jenis Izin')
                                            ->badge()
                                            ->color('warning')
                                            ->default(fn() => $record->permit->type_permit)->columnSpan([
                                                'sm' => 1,
                                                'lg' => 1,
                                            ])->formatStateUsing(function ($state) {
                                                if ($state === 'izin') {
                                                    return 'Izin';
                                                } else if ($state === 'sakit') {
                                                    return 'Sakit';
                                                }
                                                // Customize badge text based on the 'status' value
                                                return $state;
                                            }),
                                        TextEntry::make('declaration')
                                            ->label('Deskripsi')
                                            ->default(fn() => $record->permit->description)->columnSpan([
                                                'sm' => 1,
                                                'lg' => 3,
                                            ]),
                                        ImageEntry::make('header_image')->label('Dokumen')->columnSpan([
                                            'sm' => 1,
                                            'lg' => 3,
                                        ]),
                                        ImageEntry::make('header_image')
                                            ->label('Dokumen')
                                            ->default(fn() => $record->permit->evidence)
                                            ->columnSpan([
                                                'sm' => 1,
                                                'lg' => 3,
                                            ])
                                    ])
                            ];
                        }
                    )
                    ->modalContent(function (Model $record) {
                        return;
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
                    ->disabled(fn(Model $record) => $record->status != 'proses')
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
            // 'edit' => Pages\EditPermitDetail::route('/{record}/edit'),
        ];
    }
    public static function getPluralLabel(): ?string
    {
        return 'Perizinan';
    }
}
