@extends('layouts.app')

@section('judul', 'Edit Pemesanan')

@section('konten')
    <section>
        <h2>Edit Pemesanan</h2>

        @if ($errors->any())
            <p class="pesan-error">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('pemesanan.update', $pemesanan->id_pemesanan) }}">
            @csrf
            @method('PUT')

            <label for="nama_pelanggan">Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" id="nama_pelanggan" maxlength="100"
                   value="{{ old('nama_pelanggan', $pemesanan->nama_pelanggan) }}" required>

            <label for="no_hp">Nomor HP</label>
            <input type="tel" name="no_hp" id="no_hp" maxlength="20"
                   value="{{ old('no_hp', $pemesanan->no_hp) }}" required>

            <label for="paket_rental">Paket Rental</label>
            <select name="paket_rental" id="paket_rental" required>
                @foreach ($hargaPaket as $paket => $harga)
                    <option value="{{ $paket }}"
                        {{ old('paket_rental', $pemesanan->paket_rental) === $paket ? 'selected' : '' }}>
                        {{ $paket }}
                    </option>
                @endforeach
            </select>

            <label for="tanggal_sewa">Tanggal Mulai Sewa</label>
            <input type="date" name="tanggal_sewa" id="tanggal_sewa"
                   value="{{ old('tanggal_sewa', $pemesanan->tanggal_sewa) }}" required>

            <label for="jam_mulai">Jam Mulai Sewa</label>
            <input type="time" name="jam_mulai" id="jam_mulai"
                   value="{{ old('jam_mulai', substr($pemesanan->jam_mulai, 0, 5)) }}" required>

            <label for="tanggal_selesai">Tanggal Selesai Sewa</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                   value="{{ old('tanggal_selesai', $pemesanan->tanggal_selesai) }}" required>

            <label for="jam_selesai">Jam Selesai Sewa</label>
            <input type="time" name="jam_selesai" id="jam_selesai"
                   value="{{ old('jam_selesai', substr($pemesanan->jam_selesai, 0, 5)) }}" required>

            <label for="total_harga">Total Harga Rental</label>
            <input type="text" id="total_harga" placeholder="Rp0" readonly>

            <p class="info-harga" id="info_durasi">Pilih paket, tanggal, dan jam sewa.</p>

            <button type="submit">Simpan Perubahan</button>
        </form>

        <a href="{{ route('pemesanan.index') }}" class="btn-kembali" title="Kembali">←</a>
    </section>
@endsection