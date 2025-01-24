<div class="info-group">
    <strong class="info-label">
        <i class="fas fa-file-invoice"></i>
        Nomor Invoice
    </strong>
    <p class="info-value">{{ $pengadaan->no_invoice }}</p>
</div>

<div class="info-group">
    <strong class="info-label">
        <i class="fas fa-fingerprint"></i>
        Nomor Seri Barang
    </strong>
    <p class="info-value">{{ $pengadaan->no_seri_barang }}</p>
</div>

<div class="info-group">
    <strong class="info-label">
        <i class="fas fa-calendar"></i>
        Tahun Produksi
    </strong>
    <p class="info-value">{{ $pengadaan->tahun_produksi }}</p>
</div>

<div class="info-group">
    <strong class="info-label">
        <i class="fas fa-calendar-alt"></i>
        Tanggal Pengadaan
    </strong>
    <p class="info-value">{{ $pengadaan->tgl_pengadaan->format('d F Y') }}</p>
</div>

<div class="info-group">
    <strong class="info-label">
        <i class="fas fa-money-bill"></i>
        Harga Barang
    </strong>
    <p class="info-value">{{ $pengadaan->formatted_harga_barang }}</p>
</div>

<div class="info-group">
    <strong class="info-label">
        <i class="fas fa-coins"></i>
        Nilai Barang
    </strong>
    <p class="info-value">{{ $pengadaan->formatted_nilai_barang }}</p>
</div>

<div class="info-group">
    <strong class="info-label">
        <i class="fas fa-calculator"></i>
        Depresiasi per Bulan
    </strong>
    <p class="info-value">{{ $pengadaan->formatted_depresiasi_barang }}/bulan</p>
</div>

<div class="info-group">
    <strong class="info-label">
        <i class="fas fa-check-circle"></i>
        Status
    </strong>
    <p class="info-value">
        @if($pengadaan->status_login == '1')
            <span class="badge bg-success">Aktif</span>
        @else
            <span class="badge bg-danger">Tidak Aktif</span>
        @endif
    </p>
</div>
