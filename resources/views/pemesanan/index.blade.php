@extends('layouts.app')

@section('judul', 'Pemesanan')

@section('konten')
    <!-- ===== FORM TAMBAH PEMESANAN (CREATE) ===== -->
    <section>
        <h2>Form Pemesanan Rental Mobil</h2>

        @if (session('sukses'))
            <p class="pesan-sukses">{{ session('sukses') }}</p>
        @endif

        @if ($errors->any())
            <p class="pesan-error">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('pemesanan.store') }}">
            @csrf

            <label for="nama_pelanggan">Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" id="nama_pelanggan" maxlength="100"
                   placeholder="Masukkan nama pelanggan" value="{{ old('nama_pelanggan') }}" required>

            <label for="no_hp">Nomor HP</label>
            <input type="tel" name="no_hp" id="no_hp" maxlength="20"
                   placeholder="Contoh: 081234567890" value="{{ old('no_hp') }}" required>

            <label for="paket_rental">Paket Rental</label>
            <select name="paket_rental" id="paket_rental" required>
                <option value="">Pilih Paket Rental</option>
                @foreach ($hargaPaket as $paket => $harga)
                    <option value="{{ $paket }}"
                        {{ old('paket_rental', $paketDipilih) === $paket ? 'selected' : '' }}>
                        {{ $paket }}
                    </option>
                @endforeach
            </select>

            <label for="tanggal_sewa">Tanggal Mulai Sewa</label>
            <input type="date" name="tanggal_sewa" id="tanggal_sewa" value="{{ old('tanggal_sewa') }}" required>

            <label for="jam_mulai">Jam Mulai Sewa</label>
            <input type="time" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai') }}" required>

            <label for="tanggal_selesai">Tanggal Selesai Sewa</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>

            <label for="jam_selesai">Jam Selesai Sewa</label>
            <input type="time" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai') }}" required>

            <label for="total_harga">Total Harga Rental</label>
            <input type="text" id="total_harga" placeholder="Rp0" readonly>

            <p class="info-harga" id="info_durasi">Pilih paket, tanggal, dan jam sewa.</p>

            <button type="submit">Simpan Pemesanan</button>
        </form>
    </section>

    <!-- ===== TABEL DATA PEMESANAN (READ, UPDATE, DELETE) ===== -->
    <section>
        <h2>Data Pemesanan</h2>

        <div class="tabel-crud-wrap">
            <table class="tabel-crud">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Paket</th>
                        <th>Waktu Sewa</th>
                        <th>Total</th>
                        <th class="tengah">Status</th>
                        <th class="tengah">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftar as $item)
                        @php [$labelStatus, $kelasStatus] = $item->status(); @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->tanggal_sewa)) }}</td>
                            <td>{{ $item->nama_pelanggan }}</td>
                            <td>{{ $item->paket_rental }}</td>
                            <td>
                                {{ substr($item->jam_mulai, 0, 5) }} s.d.
                                {{ date('d/m/Y', strtotime($item->tanggal_selesai)) }}
                                {{ substr($item->jam_selesai, 0, 5) }}
                            </td>
                            <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td class="tengah">
                                <span class="badge {{ $kelasStatus }}">{{ $labelStatus }}</span>
                            </td>
                            <td class="tengah aksi-crud">
                                <a href="{{ route('pemesanan.edit', $item->id_pemesanan) }}"
                                   class="btn-kecil btn-kuning">Edit</a>

                                 @if (auth()->user()->role === 'admin')
                                    <form method="POST" action="{{ route('pemesanan.destroy', $item->id_pemesanan) }}"
                                          class="form-inline" onsubmit="return confirm('Hapus pemesanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-kecil-hapus">Hapus</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="tengah kosong">Belum ada data pemesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection