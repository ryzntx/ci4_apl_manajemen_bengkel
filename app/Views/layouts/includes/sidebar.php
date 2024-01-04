<div class="main-sidebar sidebar-style-2 shadow-sm">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">DS Motor</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">DS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Beranda</li>
            <li class="<?= (url_is('beranda')) ? 'active' : '' ?>">
                <a href="<?= base_url('beranda') ?>" class="nav-link"><i class="fa-solid fa-columns"></i><span>Beranda</span></a>
            </li>
            <?php if (auth()->user()->inGroup('admin') || auth()->user()->inGroup('developer')) : ?>
                <li class="<?= (url_is('editor')) ? 'active' : '' ?>">
                    <a href="<?= base_url('editor') ?>" class="nav-link"><i class="fa-solid fa-columns"></i><span>Editor</span></a>
                </li>
            <?php endif ?>
            <?php if (auth()->user()->inGroup('manajer') || auth()->user()->inGroup('pemilik') || auth()->user()->inGroup('developer')) : ?>
                <li class="menu-header">Data Master</li>
            <?php endif ?>
            <?php if (auth()->user()->inGroup('manajer') || auth()->user()->inGroup('developer')) : ?>
                <li class="<?= (url_is('manajemen/barang') || url_is('manajemen/kategoriBarang') || url_is('manajemen/layananJasa')) ? 'active' : '' ?> dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa-solid fa-box-open"></i>
                        <span>Data Barang</span></a>
                    <ul class="dropdown-menu">
                        <li class="<?= (url_is('manajemen/barang') || url_is('manajemen/barang/*')) ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('manajemen/barang') ?>">Data Barang</a></li>
                        <li class="<?= (url_is('manajemen/kategoriBarang') || url_is('manajemen/kategoriBarang/*')) ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('manajemen/kategoriBarang') ?>">Data Kategori Barang</a></li>
                        <li class="<?= (url_is('manajemen/layananJasa') || url_is('manajemen/layananJasa/*')) ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('manajemen/layananJasa') ?>">Data Layanan Service</a></li>
                    </ul>
                </li>

                <li class="<?= (url_is('manajemen/supplier') || url_is('manajemen/supplier/*')) ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('manajemen/supplier') ?>"><i class="fa-solid fa-truck"></i>
                        <span>Data Supplier</span></a>
                </li>
            <?php endif ?>
            <?php if (auth()->user()->inGroup('manajer') || auth()->user()->inGroup('pemilik') || auth()->user()->inGroup('developer')) : ?>
                <li class="<?= (url_is('manajemen/pegawai') || url_is('manajemen/pegawai/*')) ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('manajemen/pegawai') ?>"><i class="fa-solid fa-users"></i>
                        <span>Data Pegawai</span></a>
                </li>
            <?php endif ?>
            <?php if (auth()->user()->inGroup('manajer') || auth()->user()->inGroup('pemilik') || auth()->user()->inGroup('developer')) : ?>
                <li class="menu-header">
                    Pembelian
                </li>
            <?php endif ?>
            <?php if (auth()->user()->inGroup('manajer') || auth()->user()->inGroup('developer')) : ?>
                <li class="<?= (url_is('pembelian') || url_is('pembelian/*')) ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('pembelian') ?>"><i class="fa-solid fa-boxes"></i>
                        <span>Input Pembelian</span></a>
                </li>
            <?php endif ?>
            <?php if (auth()->user()->inGroup('manajer') || auth()->user()->inGroup('pemilik') || auth()->user()->inGroup('developer')) : ?>
                <li class="<?= (url_is('draftPembelian') || url_is('draftPembelian/*')) ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('draftPembelian') ?>"><i class="fa-solid fa-mail-bulk"></i>
                        <span>Draft Pembelian</span></a>
                </li>
            <?php endif ?>

            <?php if (auth()->user()->inGroup('kasir') || auth()->user()->inGroup('developer')) : ?>
                <li class="menu-header">
                    Penjualan
                </li>
                <li class="<?= (url_is('transaksi') || url_is('transaksi/*')) ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('transaksi') ?>"><i class="fa-solid fa-cash-register"></i>
                        <span>Input Transaksi</span></a>
                </li>
                <li class="<?= (url_is('riwayatTransaksi') || url_is('riwayatTransaksi/*')) ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('riwayatTransaksi') ?>"><i class="fa-solid fa-book-open"></i>
                        <span>Riwayat Transaksi</span></a>
                </li>
            <?php endif ?>
            <?php if (auth()->user()->inGroup('pemilik') || auth()->user()->inGroup('manajer') || auth()->user()->inGroup('developer')) : ?>
                <li class="menu-header">
                    Laporan
                </li>
                <li class="<?= (url_is('laporan') || url_is('laporan/*')) ? 'active' : '' ?> dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa-solid fa-file-export"></i>
                        <span>Cetak Laporan</span></a>
                    <ul class="dropdown-menu">
                        <li class="<?= (url_is('laporan/transaksi') || url_is('laporan/transaksi/*')) ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('laporan/transaksi') ?>">Laporan Transaksi</a></li>
                    </ul>
                </li>
            <?php endif ?>
        </ul>
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini justify-content-center d-flex">
        </div>
    </aside>
</div>