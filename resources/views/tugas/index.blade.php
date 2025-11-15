<!-- D:\Github\sc_belajar_laravel___aplikasi_daftar_tugas\resources\views\tugas\index.blade.php -->


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas - Aplikasi Laravel</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between bg-gradient-to-r from-purple-600 via-blue-600 to-cyan-600 p-6 rounded-xl mb-8">
            <h1 class="text-2xl font-bold text-white uppercase">📋 Daftar Tugas</h1>
            <div class="flex flex-wrap gap-3">
                <a  href="{{ route('tugas.create') }}" 
                   class="group relative inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white backdrop-blur-sm px-6 py-3 rounded-xl font-medium transition-alloverflow-hidden border-2 border-transparent hover:border-white/50">
                    ➕ Tambah Tugas
                </a>
                <a href="{{ route('tugas.export') }}"
                   class="inline-flex items-center gap-2 bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded-lg font-medium transition duration-200 border-2 border-transparent hover:border-white/50">
                    📤 Export Data
                </a>
                <a href="{{ route('tugas.statistik') }}"
                   class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition duration-200 border-2 border-transparent hover:border-white/50">
                    📊 Statistik
                </a>
            </div>
        </div>

        <!-- Statistics Widget -->
        @php
           $statistik = app('App\Http\Controllers\TugasPengontrol')->ambilStatistikTugas();
        @endphp
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-300 shadow-sm">
                <h3 class="text-gray-600 text-sm font-medium mb-2 flex items-center gap-2">📌 Total Tugas</h3>
                <p class="text-3xl font-bold text-gray-800">{{ $statistik['total'] ?? 0 }}</p>
            </div>
            <div class="bg-green-50 p-6 rounded-xl border border-green-300 shadow-sm">
                <h3 class="text-gray-600 text-sm font-medium mb-2 flex items-center gap-2">✅ Selesai</h3>
                <p class="text-3xl font-bold text-green-600">{{ $statistik['selesai'] ?? 0 }}</p>
            </div>
            <div class="bg-yellow-50 p-6 rounded-xl border border-yellow-300 shadow-sm">
                <h3 class="text-gray-600 text-sm font-medium mb-2 flex items-center gap-2">⏳ Belum Selesai</h3>
                <p class="text-3xl font-bold text-yellow-600">{{ $statistik['belum_selesai'] ?? 0 }}</p>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border border-gray-200">
            <div class="flex flex-col lg:flex-row gap-6 items-start lg:items-center justify-between">
                <!-- Filter Buttons -->
                
<div class="flex items-center gap-4">
    <span class="text-gray-700 font-medium whitespace-nowrap">Sortir Data:</span>
    <div class="flex gap-2 flex-wrap">
        @php
            $currentSearch = request('q');
            $queryParams = $currentSearch ? ['q' => $currentSearch] : [];
        @endphp
        
        <a href="{{ route('tugas.index', $queryParams) }}" 
           class="px-4 py-2 rounded-lg font-medium transition duration-200 {{ $filter === null ? 'bg-blue-500 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            📋 Semua
        </a>
        <a href="{{ route('tugas.index', array_merge($queryParams, ['filter' => 'aktif'])) }}"
           class="px-4 py-2 rounded-lg font-medium transition duration-200 {{ $filter === 'aktif' ? 'bg-yellow-500 text-gray-800 shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            ⏳ Belum Selesai
        </a>
        <a href="{{ route('tugas.index', array_merge($queryParams, ['filter' => 'selesai'])) }}"
           class="px-4 py-2 rounded-lg font-medium transition duration-200 {{ $filter === 'selesai' ? 'bg-green-500 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
            ✅ Selesai
        </a>
    </div>
</div>

                <!-- Search Form -->
                
<form method="GET" action="{{ route('tugas.index') }}" class="flex-1 min-w-[300px]">
    @if($filter)
        <input type="hidden" name="filter" value="{{ $filter }}">
    @endif
    <div class="flex gap-3">
        <input 
            type="text" 
            name="q" 
            placeholder="🔍 Cari berdasarkan judul atau deskripsi..."
            value="{{ request('q') }}"
            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
        >
        <button 
            type="submit"
            class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-medium transition duration-200 whitespace-nowrap"
        >
            🔍 Cari
        </button>
        @if(request('q') || $filter)
            <a href="{{ route('tugas.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition duration-200 whitespace-nowrap flex items-center gap-2">
                ✖️ Reset
            </a>
        @endif
    </div>
</form>
            </div>
        </div>

        <!-- Tasks List -->
        <div class="space-y-4">
            @foreach ($semuaTugas as $tugas)
                @php
                    $now = \Carbon\Carbon::now();
                    $deadline = $tugas->deadline ? \Carbon\Carbon::parse($tugas->deadline) : null;
                    $isOverdue = $deadline && $deadline->lt($now);
                    $isUrgent = $deadline && $deadline->diffInHours($now) <= 48 && !$isOverdue;
                @endphp

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition duration-200">
                    <!-- Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $tugas->judul }}</h3>
                        <span class="px-3 py-1 rounded-full text-sm font-medium {{ $tugas->selesai ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $tugas->selesai ? '✅ Selesai' : '⏳ Belum selesai' }}
                        </span>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-600 mb-4 leading-relaxed">{{ $tugas->deskripsi }}</p>

                    <!-- Deadline -->
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 mb-2 font-medium">Deadline:</p>
                        @if($tugas->deadline)
                            <span class="inline-flex items-center gap-2 px-3 py-2 rounded-lg font-medium {{ $isOverdue ? 'bg-red-100 text-red-800 border border-red-200' : ($isUrgent ? 'bg-orange-100 text-orange-800 border border-orange-200' : 'bg-gray-100 text-gray-800 border border-gray-200') }}">
                                {{ $deadline->format('d M Y H:i') }}
                                @if($isOverdue)
                                    🔥 Lewat deadline
                                @elseif($isUrgent)
                                    ⏰ Segera jatuh tempo
                                @endif
                            </span>
                        @else
                            <span class="text-gray-400 italic">(Belum ditentukan)</span>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-100">
                        <a href="{{ route('tugas.show', $tugas->id) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition duration-200 flex items-center gap-2">
                            🚀 Lihat Detail
                        </a>
                        <a href="{{ route('tugas.edit', $tugas) }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition duration-200 flex items-center gap-2">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('tugas.destroy', $tugas) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus tugas ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition duration-200 flex items-center gap-2">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            <!-- Empty State -->
            @if($semuaTugas->count() === 0)
                <div class="text-center py-12 bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="text-6xl mb-4">📝</div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada tugas</h3>
                    <p class="text-gray-500 mb-6">Mulai dengan membuat tugas pertama Anda</p>
                    <a href="{{ route('tugas.create') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-200 inline-flex items-center gap-2">
                        ➕ Tambah Tugas Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Optional: Custom Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                    }
                }
            }
        }
    </script>
</body>
</html>