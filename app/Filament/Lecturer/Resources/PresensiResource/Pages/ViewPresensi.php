<?php

namespace App\Filament\Lecturer\Resources\PresensiResource\Pages;

use App\Filament\Lecturer\Resources\PresensiResource;
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

class ViewPresensi extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = PresensiResource::class;

    protected static string $view = 'filament.lecturer-resource.view';

    public $scheduleWeekId;

    public function mount()
    {
        $this->scheduleWeekId = request()->query('scheduleWeekId');
    }

    protected static ?string $title = "Daftar Presensi";

    public function getActions(): array
    {
        return [
            Action::make('confirmAllPresensi')
                ->label('Tutup Presensi')
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


    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.nim')
                    ->label('NIM')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('entry_time')
                    ->label('Waktu Presensi')
                    ->dateTime('H:i:s')
                    ->sortable(),
            ])
            ->query(fn() => Attendance::where('schedule_week_id', $this->scheduleWeekId)->with('student'));
    }


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
