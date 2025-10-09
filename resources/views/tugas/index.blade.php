<h1 style="font-family: sans-serif; color: #333; margin-bottom: 20px;">📋 Daftar Tugas</h1>
<a href="{{ route('tugas.create') }}" style="display: inline-block; padding: 8px 12px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px; margin-bottom: 20px;">➕ Tambah Tugas</a>

@foreach ($semuaTugas as $tugas)
    <div style="border: 1px solid #ddd; border-radius: 6px; padding: 16px; margin-bottom: 16px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); background-color: #f9f9f9;">
        <h3 style="margin-top: 0; color: #333;">{{ $tugas->judul }}</h3>
        <p style="margin: 8px 0;">{{ $tugas->deskripsi }}</p>
        <p style="margin: 8px 0;">
            <strong>Status:</strong>
            <span style="color: {{ $tugas->selesai ? '#28a745' : '#ffc107' }};">
                {{ $tugas->selesai ? '✅ Selesai' : '⏳ Belum selesai' }}
            </span>
        </p>

        <div style="display: flex; gap: 8px;">
            <a href="{{ route('tugas.edit', $tugas) }}" style="padding: 6px 10px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px;">✏️ Edit</a>
            <form action="{{ route('tugas.destroy', $tugas) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" style="padding: 6px 10px; background-color: #dc3545; color: white; border: none; border-radius: 4px;">🗑️ Hapus</button>
            </form>
        </div>
    </div>
@endforeach



<!-- <h1>Daftar Tugas</h1>
<a href="{{ route('tugas.create') }}">Tambah Tugas</a>

@foreach ($semuaTugas as $tugas)
    <div>
        <h3>{{ $tugas->judul }}</h3>
        <p>{{ $tugas->deskripsi }}</p>
        <p>Status: {{ $tugas->selesai ? '✅ Selesai' : '⏳ Belum' }}</p>
        <a href="{{ route('tugas.edit', $tugas) }}">Edit</a>
        <form action="{{ route('tugas.destroy', $tugas) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus</button>
        </form>
    </div>
@endforeach -->
