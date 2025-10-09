<h1 style="font-family: sans-serif; color: #333; margin-bottom: 24px;">
    {{ $tugas->exists ? '✏️ Edit Tugas' : '➕ Tambah Tugas' }}
</h1>

<form action="{{ $tugas->exists ? route('tugas.update', $tugas) : route('tugas.store') }}" method="POST" style="max-width: 600px;">
    @csrf
    @if($tugas->exists)
        @method('PUT')
    @endif

    <div style="margin-bottom: 16px;">
        <label for="judul" style="display: block; font-weight: bold; margin-bottom: 6px;">Judul:</label>
        <input type="text" id="judul" name="judul" value="{{ old('judul', $tugas->judul) }}" required
            style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 16px;">
        <label for="deskripsi" style="display: block; font-weight: bold; margin-bottom: 6px;">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi"
            style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; min-height: 100px;">{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
    </div>

    @if($tugas->exists)
        <input type="hidden" name="selesai" value="0">
        <div style="margin-bottom: 16px;">
            <label style="font-weight: bold;">
                <input type="checkbox" name="selesai" value="1" {{ $tugas->selesai ? 'checked' : '' }}>
                Tandai sebagai selesai ✅
            </label>
        </div>
    @endif

    <button type="submit"
        style="padding: 10px 16px; background-color: #28a745; color: white; border: none; border-radius: 4px; font-weight: bold;">
        {{ $tugas->exists ? '💾 Perbarui' : '📥 Simpan' }}
    </button>
</form>



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
