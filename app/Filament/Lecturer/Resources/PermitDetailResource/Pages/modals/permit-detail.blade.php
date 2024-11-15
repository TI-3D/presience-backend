<!-- resources/views/filament/modals/permit-detail.blade.php -->
<div>
    <h2 class="text-lg font-bold">Detail Perizinan</h2>
    <ul class="mt-4">
        <li><strong>NIM:</strong> {{ $permitDetail->permit->student->nim }}</li>
        <li><strong>Nama:</strong> {{ $permitDetail->permit->student->name }}</li>
        <li><strong>Kelas:</strong> {{ $permitDetail->scheduleWeek->schedule->group->name }}</li>
        <li><strong>Mata Kuliah:</strong> {{ $permitDetail->scheduleWeek->schedule->course->name }}</li>
        <li><strong>Minggu ke:</strong> {{ $permitDetail->scheduleWeek->week->name }}</li>
        <li><strong>Jenis Izin:</strong> {{ $permitDetail->permit->type_permit }}</li>
        <li><strong>Status:</strong> {{ $permitDetail->status }}</li>
        <li><strong>Deskripsi:</strong> {{ $permitDetail->permit->description }}</li>
        <li><strong>Dokumen:</strong>
           <h1>ini dokumen</h1>
        </li>
    </ul>
</div>
