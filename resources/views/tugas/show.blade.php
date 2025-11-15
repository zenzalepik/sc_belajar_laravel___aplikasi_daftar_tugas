<!-- D:\Github\sc_belajar_laravel___aplikasi_daftar_tugas\resources\views\tugas\show.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tugas - Aplikasi Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Header -->
        <h1 class="text-3xl font-bold text-gray-800 mb-8 font-sans bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
            Detail Tugas
        </h1>

        <!-- Detail Card dengan Gradient -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-8 shadow-lg border border-gray-200/50 max-w-2xl">
            <ul class="space-y-6">
                <li class="flex items-center border-b border-gray-100 pb-4">
                    <strong class="text-gray-500 font-medium w-28 flex-shrink-0">ID:</strong>
                    <span class="text-gray-800 font-semibold">{{ $tugas->id }}</span>
                </li>
                <li class="flex items-center border-b border-gray-100 pb-4">
                    <strong class="text-gray-500 font-medium w-28 flex-shrink-0">Judul:</strong>
                    <span class="text-gray-800 text-xl font-bold">{{ $tugas->judul }}</span>
                </li>
                <li class="flex items-start border-b border-gray-100 pb-4">
                    <strong class="text-gray-500 font-medium w-28 flex-shrink-0 mt-1">Deskripsi:</strong>
                    <p class="text-gray-700 leading-relaxed text-lg">{{ $tugas->deskripsi }}</p>
                </li>
                <li class="flex items-center border-b border-gray-100 pb-4">
                    <strong class="text-gray-500 font-medium w-28 flex-shrink-0">Status:</strong>
                    <span class="px-4 py-2 rounded-full font-semibold {{ $tugas->selesai ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg' }}">
                        {{ $tugas->selesai ? '✅ Selesai' : '⏳ Aktif' }}
                    </span>
                </li>
                <li class="flex items-center">
                    <strong class="text-gray-500 font-medium w-28 flex-shrink-0">Deadline:</strong>
                    <span class="text-lg font-medium {{ !$tugas->deadline ? 'text-gray-400 italic' : 'text-gray-800' }}">
                        {{ $tugas->deadline ?? 'Tidak ada deadline' }}
                    </span>
                </li>
            </ul>
        </div>

        <!-- Back Button dengan Animasi -->
        <div class="mt-8">
            <a href="{{ route('tugas.index') }}" 
               class="group inline-flex items-center gap-3 text-blue-600 hover:text-blue-700 font-semibold transition duration-300 hover:translate-x-1">
                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke daftar tugas
            </a>
        </div>
    </div>
</body>
</html>