<div class="overflow-x-auto">
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100 border-b border-gray-300">
                <th class="px-4 py-2 text-left font-semibold text-gray-600">NIM</th>
                <th class="px-4 py-2 text-left font-semibold text-gray-600">Nama</th>
                <th class="px-4 py-2 text-left font-semibold text-gray-600">Waktu Presensi</th>
                <th class="px-4 py-2 text-left font-semibold text-gray-600">Aksi</th> <!-- New column for actions -->
            </tr>
        </thead>
        <tbody>
            @forelse ($attendances as $attendance)
                <tr class="border-b border-gray-300 hover:bg-gray-50">
                    <td class="px-4 py-2 text-gray-700">{{ $attendance->student->nim }}</td>
                    <td class="px-4 py-2 text-gray-700">{{ $attendance->student->name }}</td>
                    <td class="px-4 py-2 text-gray-700">{{ $attendance->created_at->format('H:i') }}</td>
                    <td class="px-4 py-2 text-gray-700">
                        <!-- Delete button with trash icon -->
                        <form action=>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <!-- Trash Icon -->
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">No attendance records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
