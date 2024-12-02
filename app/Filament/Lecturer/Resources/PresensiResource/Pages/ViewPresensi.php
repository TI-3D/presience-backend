<?php

namespace App\Filament\Lecturer\Resources\PresensiResource\Pages;

use App\Filament\Lecturer\Resources\PresensiResource;
use App\Models\Attendance;
use App\Models\ScheduleWeek;
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
use Illuminate\Support\Facades\DB;

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
                    // redirect()->route('filament.lecturer.resources.presensis.detail',);
                    redirect()->route('filament.lecturer.resources.presensis.detail', ['scheduleWeekId' => $this->scheduleWeekId]);
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

        try {
            DB::transaction(function () {
                // Update the schedule week status to closed
                $sw_id = $this->scheduleWeekId;
                $schedule_week = DB::table('schedule_weeks as sw')
                    ->join('schedules as s', 'sw.schedule_id', '=', 's.id')
                    ->join('courses as c', 's.course_id', '=', 'c.id')
                    ->where('sw.id', $sw_id)
                    ->select(
                        'sw.*',
                        's.*',
                        'c.*',
                        'sw.id as sw_id'
                    )
                    ->first();
                $students = DB::table('schedule_weeks as sw')
                    ->join('schedules as s', 'sw.schedule_id', '=', 's.id')
                    ->join('groups as g', 's.group_id', '=', 'g.id')
                    ->join('users as u', 'g.id', '=', 'u.group_id')
                    ->where('sw.id', $sw_id)
                    ->select('*')
                    ->get();

                $students->each(function ($student) use ($schedule_week) {
                    $count = $this->searchAttendance($student->id, $schedule_week->sw_id);
                    if ($count == 0) {
                        $this->createAlphaAttendance($schedule_week->time, $student->id, $schedule_week->sw_id);
                    }
                });

                DB::table('schedule_weeks')
                    ->where('id', $sw_id)
                    ->update([
                        'status' => 'closed',
                        'closed_at' => Carbon::now(),
                    ]);
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        Notification::make()
            ->title('Berhasil menutup presensi untuk semua mahasiswa')
            ->success()
            ->send();
    }

    public function searchAttendance($id, $sw_id)
    {
        $count = DB::table('attendances')
            ->where('student_id', $id)
            ->where('schedule_week_id', $sw_id)
            ->exists();
        return $count;
    }

    public function createAlphaAttendance($time, $id, $sw_id)
    {
        $attendanceId = DB::table('attendances')->insert([
            'alpha' => $time,
            'sakit' => 0,
            'izin' => 0,
            'student_id' => $id,
            'schedule_week_id' => $sw_id,
            'entry_time' => now(),
        ]);
    }
}
