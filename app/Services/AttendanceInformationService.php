<?php

namespace App\Services;

use App\Contracts\AttendanceInformationContract;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class AttendanceInformationService implements AttendanceInformationContract
{
    public function getAttendanceInformation()
    {
        try {
            $user = Auth::guard('api')->user();

            // Ambil semua attendance
            $attendances = Attendance::where('student_id', $user->id)->get();
            
            // Inisialisasi variabel jumlah sakit, izin, alpha
            $totalSakit = $attendances->sum('sakit');
            $totalIzin = $attendances->sum('izin');
            $totalAlpha = $attendances->sum('alpha');

            // Menghitung total courseTime
            $courseTime = DB::table('attendances')
                ->join('schedule_weeks', 'attendances.schedule_week_id', '=', 'schedule_weeks.id')
                ->join('schedules', 'schedule_weeks.schedule_id', '=', 'schedules.id')
                ->join('courses', 'schedules.course_id', '=', 'courses.id')
                ->where('attendances.student_id', $user->id)
                ->sum('courses.time');

            // Hitung persentase kehadiran
            $totalAbsent = $totalSakit + $totalIzin + $totalAlpha;
            $percentageAttendance = (($courseTime - $totalAbsent) / $courseTime) * 100;

            // Hitung kompen
            $kompen = $totalAlpha * 2;

            // Deskripsi default
            $description = null;

            // Deskripsi berdasarkan kondisi izin dan ketidakhadiran
            if ($totalIzin >= 76) {
                $description = "Putus Studi";
            } elseif ($totalAbsent >= 152) {
                $description = "SP 3";
            } elseif ($totalAbsent >= 114) {
                $description = "SP 2";
            } elseif ($totalAbsent >= 52) {
                $description = "SP 1";
            }

            // Membuat respons JSON
            $response = [
                'percentage_attendance' => round($percentageAttendance, 0),
                'sakit' => $totalSakit,
                'izin' => $totalIzin,
                'alpha' => $totalAlpha,
                'kompen' => $kompen,
                'description' => $description
            ];

            return $response;
        } catch (Exception $exception) {
            return $exception;
        }
    }
}