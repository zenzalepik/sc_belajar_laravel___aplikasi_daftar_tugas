<!-- resources/views/tugas/form.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tugas->exists ? 'Edit Tugas' : 'Tambah Tugas' }} - Aplikasi Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-4 py-8">
        <!-- Header -->
        <h1 class="text-3xl font-bold text-gray-800 mb-8 font-sans bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
            {{ $tugas->exists ? '✏️ Edit Tugas' : '➕ Tambah Tugas' }}
        </h1>

        <!-- Form -->
        <form action="{{ $tugas->exists ? route('tugas.update', $tugas) : route('tugas.store') }}" method="POST" 
              class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
            @csrf
            @if($tugas->exists)
                @method('PUT')
            @endif

            <!-- Judul Input -->
            <div class="mb-6">
                <label for="judul" class="block text-gray-700 font-semibold mb-3">Judul:</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul', $tugas->judul) }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50">
            </div>

            <!-- Deskripsi Textarea -->
            <div class="mb-6">
                <label for="deskripsi" class="block text-gray-700 font-semibold mb-3">Deskripsi:</label>
                <textarea id="deskripsi" name="deskripsi" rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 resize-none">{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
            </div>

            <!-- Status Checkbox (hanya untuk edit) -->
            @if($tugas->exists)
                <input type="hidden" name="selesai" value="0">
                <div class="mb-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="selesai" value="1" {{ $tugas->selesai ? 'checked' : '' }}
                            class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                        <span class="text-gray-700 font-semibold">Tandai sebagai selesai ✅</span>
                    </label>
                </div>
            @endif

            <!-- Deadline Input -->
            <div class="mb-8">
                <label for="deadline" class="block text-gray-700 font-semibold mb-3">Deadline:</label>
                <input type="datetime-local" id="deadline" name="deadline"
                    value="{{ old('deadline', $tugas->deadline ? \Carbon\Carbon::parse($tugas->deadline)->format('Y-m-d\TH:i') : '') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50">
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('tugas.index') }}" 
                   class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 font-medium transition duration-200 hover:underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
                <button type="submit"
                    class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-8 py-3 rounded-xl font-semibold transition duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    {{ $tugas->exists ? '💾 Perbarui Tugas' : '📥 Simpan Tugas' }}
                </button>
            </div>
        </form>
    </div>
</body>
</html>



<!-- <h1>{{ $tugas->exists ? 'Edit Tugas' : 'Tambah Tugas' }}</h1>

<form action="{{ $tugas->exists ? route('tugas.update', $tugas) : route('tugas.store') }}" method="POST">
    @csrf
    @if($tugas->exists)
        @method('PUT')
    @endif

    <label>Judul:</label>
    <input type="text" name="judul" value="{{ old('judul', $tugas->judul) }}" required>

    <label>Deskripsi:</label>
    <textarea name="deskripsi">{{ old('deskripsi', $tugas->deskripsi) }}</textarea>

    @if($tugas->exists)
        <input type="hidden" name="selesai" value="0">
        <label>
            <input type="checkbox" name="selesai" value="1" {{ $tugas->selesai ? 'checked' : '' }}>
            Selesai
        </label>
    @endif


    <button type="submit">{{ $tugas->exists ? 'Perbarui' : 'Simpan' }}</button>
</form> -->
