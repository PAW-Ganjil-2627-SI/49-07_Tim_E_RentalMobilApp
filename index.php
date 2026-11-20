<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul Armada Kendaraan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Pengelolaan Data Mobil Rental</h1>
            <p>Periksa detail kendaraan, tambahkan data baru, dan perbarui informasi agar selalu sesuai dengan kondisi terkini.</p>
        </header>

        <nav>
            <a href="DetailUnitKendaraan.html">
                Lihat Detail Data Kendaraan &rarr;
            </a>
        </nav>

        <div class="section">
            <h2>Input Data Kendaraan</h2>

            <form action="#" method="get">
                <div class="form-group">
                    <label for="nomor_plat">Nomor Plat:</label>
                    <input type="text" id="nomor_plat"
                        name="nomor_plat" required>
                </div>

                <div class="form-group">
                    <label for="merk">Merk Kendaraan:</label>
                    <input type="text" id="merk"
                        name="merk" required>
                </div>

                <div class="form-group">
                    <label for="tahun_pembuatan">Tahun Pembuatan:</label>
                    <input type="number" id="tahun_pembuatan"
                        name="tahun_pembuatan"
                        min="1900" max="2099" required>
                </div>

                <div class="form-group">
                    <label for="tipe_transmisi">Tipe Transmisi:</label>
                    <select id="tipe_transmisi"
                        name="tipe_transmisi" required>
                        <option value="">-- Pilih Transmisi --</option>
                        <option value="Manual">Manual</option>
                        <option value="Otomatis">Otomatis</option>
                    </select>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-primary">
                        Simpan Data
                    </button>
                    <button type="reset">Batal / Reset</button>
                </div>
            </form>
        </div>

        <div class="section">
            <h2>Daftar Unit Kendaraan</h2>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Plat</th>
                        <th>Merk</th>
                        <th>Tahun</th>
                        <th>Transmisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>B 1234 ABC</td>
                        <td>Toyota Avanza</td>
                        <td>2022</td>
                        <td>Otomatis</td>
                        <td>
                            <button type="button">Edit</button>
                            <button type="button">Hapus</button>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>D 5678 XYZ</td>
                        <td>Honda Innova</td>
                        <td>2021</td>
                        <td>Manual</td>
                        <td>
                            <button type="button">Edit</button>
                            <button type="button">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>