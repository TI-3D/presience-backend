<?php

namespace App\Filament\Lecturer\Resources\PresensiResource\Pages;

use App\Filament\Lecturer\Resources\PresensiResource;
use App\Filament\Lecturer\Resources\PresensiResource\Widgets\AttendanceCountWidget as WidgetsAttendanceCountWidget;
use App\Models\Attendance;
use Carbon\Carbon;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Filament\Support\Colors\Color;

use function Laravel\Prompts\confirm;

class DetailPresensiPage extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = PresensiResource::class;

    protected static string $view = 'filament.lecturer-resource.detail';

    public $scheduleWeekId;

    public function mount()
    {
        $this->scheduleWeekId = request()->query('scheduleWeekId', null); // Default ke null jika tidak ada
    }

    protected static ?string $title = "Detail Presensi Mahasiswa";

    public function getHeaderWidgets(): array
    {
        return [
            WidgetsAttendanceCountWidget::make(['scheduleWeekId' => $this->scheduleWeekId]),
        ];
    }

    protected function getHeaderWidgetsData(): array
    {
        return [
            'scheduleWeekId' => $this->scheduleWeekId, // Pastikan scheduleWeekId diambil dari query string
        ];
    }



    public function getActions(): array
    {

        return [
            Action::make('confirmAllPresensi')
                ->label('Konfirmasi Presensi')
                ->color('primary')
                ->extraAttributes(['class' => 'ml-auto']) // Align the button to the right
                ->action(function () {
                    $this->performConfirmationAction();
                    redirect()->route('filament.lecturer.resources.presensis.detail');
                    // redirect()->route('filament.lecturer.resources.presensis.detail', ['scheduleWeekId' => $this->scheduleWeekId]);
                })->requiresConfirmation()
                ->color(Color::Indigo) // Button color
            // ->disabled(fn(Model $record) => $record->status === 'closed') // Disable if already closed
        ];
    }

    // PERLU DIUBAH
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.nim')
                    ->label('NIM')
                    ->sortable(),
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('entry_time')
                    ->label('Waktu Presensi')
                    ->dateTime('H:i:s')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->getStateUsing(function (Model $record) {
                        // Assuming you have 'sakit', 'izin', and 'alpha' columns in the attendance table
                        $statuses = [];

                        if ($record->sakit > 0) {
                            $statuses[] = 'Sakit';
                        }

                        if ($record->izin > 0) {
                            $statuses[] = 'Izin';
                        }

                        if ($record->alpha > 0) {
                            $statuses[] = 'Alpha';
                        }

                        // Join the statuses to display them together, separated by commas
                        return !empty($statuses) ? implode(', ', $statuses) : 'Hadir';
                    })->colors([
                        'danger' => fn($state) => str_contains($state, 'Alpha'), // Red for Alpha
                        'warning' => fn($state) => str_contains($state, 'Sakit') || str_contains($state, 'Izin'), // Yellow for Sakit/Izin
                        'success' => fn($state) => $state === 'Hadir', // Green for Hadir
                    ]),

            ])
            ->actions([
                // You may add these actions to your table if you're using a simple
                // resource, or you just want to be able to delete records without
                // leaving the table.
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                // ...
            ])
            ->query(fn() => Attendance::where('schedule_week_id', $this->scheduleWeekId)->with('student'));
    }

    // PERLU DIUBAH
    public function performConfirmationAction()
    {
        // Get all attendance records for the given scheduleWeekId
        $attendances = Attendance::where('schedule_week_id', $this->scheduleWeekId)->with('student')->get();
        // Update the schedule week status to closed
        try {
            $scheduleWeek = $attendances->first()->scheduleWeek; // Get the schedule week from the first attendance
            $scheduleWeek->update([
                'status' => 'closed',
                'closed_at' => Carbon::now(),
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        Notification::make()
            ->title('Berhasil menutup presensi untuk semua mahasiswa')
            ->success()
            ->send();
    }
}
