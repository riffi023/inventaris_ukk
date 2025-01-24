<div class="info-group">
    <strong class="info-label">
        <i class="fas fa-barcode"></i>
        Kode Pengadaan
    </strong>
    <p class="info-value">{{ $pengadaan->kode_pengadaan }}</p>
</div>

<div class="info-group">
    <strong class="info-label">
        <i class="fas fa-box"></i>
        Barang
    </strong>
    <p class="info-value">{{ $pengadaan->masterBarang->nama_barang }}</p>
</div>

<div class="info-group">
    <strong class="info-label">
        <i class="fas fa-chart-line"></i>
        Depresiasi
    </strong>
    <p class="info-value">{{ $pengadaan->depresiasi->lama_depresiasi }} Bulan</p>
</div>

<div class="info-group">
    <strong class="info-label">
        <i class="fas fa-trademark"></i>
        Merk
    </strong>
    <p class="info-value">{{ $pengadaan->merk->merk }}</p>
</div>

<div class="info-group">
    <strong class="info-label">
        <i class="fas fa-balance-scale"></i>
        Satuan
    </strong>
    <p class="info-value">{{ $pengadaan->satuan->satuan }}</p>
</div>

<div class="info-group">
    <strong class="info-label">
        <i class="fas fa-tags"></i>
        Sub Kategori Asset
    </strong>
    <p class="info-value">{{ $pengadaan->subKategoriAsset->sub_kategori_asset }}</p>
</div>

<div class="info-group">
    <strong class="info-label">
        <i class="fas fa-truck"></i>
        Distributor
    </strong>
    <p class="info-value">{{ $pengadaan->distributor->nama_distributor }}</p>
</div>
