<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Tugas - Aplikasi Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Header -->
        <h1 class="text-3xl font-bold text-gray-800 mb-8 font-sans bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
            📊 Statistik Tugas
        </h1>

        <!-- Statistik Card -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl p-8 shadow-lg border border-gray-200/50 max-w-md">
            <ul class="space-y-4">
                <li class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <strong class="text-gray-600 font-medium">Total Tugas:</strong>
                    <span class="text-xl font-bold text-gray-800 bg-blue-100 px-3 py-1 rounded-full">
                        {{ $jumlahTotal }}
                    </span>
                </li>
                <li class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <strong class="text-gray-600 font-medium">✅ Selesai:</strong>
                    <span class="text-xl font-bold text-green-700 bg-green-100 px-3 py-1 rounded-full">
                        {{ $jumlahSelesai }}
                    </span>
                </li>
                <li class="flex items-center justify-between">
                    <strong class="text-gray-600 font-medium">⏳ Belum Selesai:</strong>
                    <span class="text-xl font-bold text-orange-700 bg-orange-100 px-3 py-1 rounded-full">
                        {{ $jumlahAktif }}
                    </span>
                </li>
            </ul>

            <!-- Progress Bar -->
            @if($jumlahTotal > 0)
            <div class="mt-6">
                <div class="flex justify-between text-sm text-gray-600 mb-2">
                    <span>Progress Penyelesaian</span>
                    <span>{{ number_format(($jumlahSelesai / $jumlahTotal) * 100, 1) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 h-3 rounded-full transition-all duration-500" 
                         style="width: {{ ($jumlahSelesai / $jumlahTotal) * 100 }}%">
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Back Button -->
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