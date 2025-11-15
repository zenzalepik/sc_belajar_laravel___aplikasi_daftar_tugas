<!-- 404.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>404 - Halaman Tidak Ditemukan</title>
    <style>
        body { font-family: sans-serif; background: #1B3148FF; padding: 40px; }
        .container { max-width: 600px; margin: auto; background: #12204CFF; padding: 20px; border-radius: 8px; ; }
        h1 { color: #445076FF; margin-bottom: 10px; }
        p { margin-top: 5px; color:#445076FF}
        a { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>404 - Halaman Tidak Ditemukan</h1>
        <p>Rute yang Anda akses tidak tersedia atau sudah dihapus.</p>
        <p><a href="{{ url('/') }}">Kembali ke Beranda</a></p>
    </div>
</body>
</html>
