<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judul') - ZR Rent Car</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<header>
    <div class="brand">
        <div class="logo">ZR</div>
        <h1>Rent Car</h1>
    </div>
    <p>Pemesanan paket rental mobil</p>
</header>

<nav style="position: relative;">
    <a href="{{ route('pemesanan.index') }}">Pemesanan</a>

    @auth
        <span style="position: absolute; right: 24px;">
            <a style="pointer-events: none;">{{ ucfirst(auth()->user()->role) }}</a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">Logout</a>
        </span>
        <form id="form-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endauth
</nav>

<main>
    @yield('konten')
</main>

<footer>
    <p>ZR Rent Car</p>
    <p>Zulfa Lathifa Haya | 102022500068 | SI 49-07 | Individu B - Paket Rental</p>
</footer>

<script>
// Hitung total harga otomatis di form (tampilan saja, harga final tetap dihitung Controller)
const hargaPaket = @json(\App\Models\Pemesanan::HARGA_PAKET);

const paketInput = document.getElementById('paket_rental');
const mulaiInput = document.getElementById('tanggal_sewa');
const jamMulaiInput = document.getElementById('jam_mulai');
const selesaiInput = document.getElementById('tanggal_selesai');
const jamSelesaiInput = document.getElementById('jam_selesai');
const totalInput = document.getElementById('total_harga');
const infoDurasi = document.getElementById('info_durasi');

const formatRupiah = new Intl.NumberFormat('id-ID', {
    style: 'currency', currency: 'IDR', maximumFractionDigits: 0
});

function hitungHarga() {
    if (!paketInput) return;

    totalInput.value = '';
    infoDurasi.textContent = 'Pilih paket, tanggal, dan jam sewa.';
    selesaiInput.min = mulaiInput.value || '';

    if (!paketInput.value || !mulaiInput.value || !selesaiInput.value ||
        !jamMulaiInput.value || !jamSelesaiInput.value) {
        return;
    }

    const mulai = Date.parse(mulaiInput.value + 'T' + jamMulaiInput.value + ':00Z');
    const selesai = Date.parse(selesaiInput.value + 'T' + jamSelesaiInput.value + ':00Z');

    if (!Number.isFinite(mulai) || !Number.isFinite(selesai) || selesai <= mulai) {
        infoDurasi.textContent = 'Waktu selesai harus setelah waktu mulai.';
        return;
    }

    const periode = Math.ceil((selesai - mulai) / 86400000);
    const total = hargaPaket[paketInput.value] * periode;

    totalInput.value = formatRupiah.format(total);
    infoDurasi.textContent = periode + ' periode × ' +
        formatRupiah.format(hargaPaket[paketInput.value]) + ' per 24 jam';
}

if (paketInput) {
    [paketInput, mulaiInput, jamMulaiInput, selesaiInput, jamSelesaiInput]
        .forEach(function (el) { el.addEventListener('change', hitungHarga); });
    hitungHarga();
}
</script>

</body>
</html>