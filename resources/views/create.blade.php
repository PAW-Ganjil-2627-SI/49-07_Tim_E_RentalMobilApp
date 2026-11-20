
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kendaraan</title>
</head>
<body>
    <h1>Tambah Kendaraan</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('kendaraan.store') }}" method="POST">
        @csrf

        <label>Nomor Plat:</label>
        <input type="text" name="nomor_plat" value="{{ old('nomor_plat') }}" required>
        <br><br>

        <label>Merk:</label>
        <input type="text" name="merk" value="{{ old('merk') }}" required>
        <br><br>

        <label>Tahun Pembuatan:</label>
        <input type="number" name="tahun_pembuatan" value="{{ old('tahun_pembuatan') }}" required>
        <br><br>

        <label>Tipe Transmisi:</label>
        <select name="tipe_transmisi" required>
            <option value="">-- Pilih Transmisi --</option>
            <option value="Manual">Manual</option>
            <option value="Otomatis">Otomatis</option>
        </select>
        <br><br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('kendaraan.index') }}">Kembali</a>
</body>
</html>