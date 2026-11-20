
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kendaraan</title>
</head>
<body>
    <h1>Edit Kendaraan</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nomor Plat:</label>
        <input type="text" name="nomor_plat"
               value="{{ old('nomor_plat', $kendaraan->nomor_plat) }}" required>
        <br><br>

        <label>Merk:</label>
        <input type="text" name="merk"
               value="{{ old('merk', $kendaraan->merk) }}" required>
        <br><br>

        <label>Tahun Pembuatan:</label>
        <input type="number" name="tahun_pembuatan"
               value="{{ old('tahun_pembuatan', $kendaraan->tahun_pembuatan) }}" required>
        <br><br>

        <label>Tipe Transmisi:</label>
        <select name="tipe_transmisi" required>
            <option value="Manual"
                {{ old('tipe_transmisi', $kendaraan->tipe_transmisi) == 'Manual' ? 'selected' : '' }}>
                Manual
            </option>
            <option value="Otomatis"
                {{ old('tipe_transmisi', $kendaraan->tipe_transmisi) == 'Otomatis' ? 'selected' : '' }}>
                Otomatis
            </option>
        </select>
        <br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <br>
    <a href="{{ route('kendaraan.index') }}">Kembali</a>
</body>
</html>