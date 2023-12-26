<div class="main-sidebar sidebar-style-2 shadow-sm">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Beranda</li>
            <li class="nav-item">
                <a href="<?= base_url('beranda') ?>" class="nav-link"><i class="fas fa-columns"></i><span>Beranda</span></a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('editor') ?>" class="nav-link"><i class="fas fa-columns"></i><span>Editor</span></a>
            </li>
            <li class="menu-header">Data Master</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box-open"></i>
                    <span>Data Barang</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url('manajemen/barang') ?>">Data Barang</a></li>
                    <li><a class="nav-link" href="<?= base_url('manajemen/kategoribarang') ?>">Data Kategori Barang</a></li>
                    <li><a class="nav-link" href="<?= base_url('manajemen/layananjasa') ?>">Data Layanan Service</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('manajemen/supplier') ?>"><i class="fas fa-truck"></i>
                    <span>Data Supplier</span></a>
            </li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('manajemen/pegawai') ?>"><i class="fas fa-users"></i>
                    <span>Data Pegawai</span></a>
            </li>
            <li class="menu-header">
                Pembelian
            </li>
            <li class="nav-item"><a class="nav-link" href=""><i class="fas fa-boxes"></i>
                    <span>Input Pembelian</span></a>
            </li>
            <li class="nav-item"><a class="nav-link" href=""><i class="fas fa-mail-bulk"></i>
                    <span>Draft Pembelian</span></a>
            </li>
            <li class="menu-header">
                Penjualan
            </li>
            <li class="nav-item"><a class="nav-link" href=""><i class="fas fa-cash-register"></i>
                    <span>Input Transaksi</span></a>
            </li>
            <li class="nav-item"><a class="nav-link" href=""><i class="fas fa-book-open"></i>
                    <span>Riwayat Transaksi</span></a>
            </li>
            <li class="menu-header">
                Laporan
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-paperclip"></i>
                    <span>Cetak Laporan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="">Laporan Transaksi</a></li>
                </ul>
            </li>
        </ul>
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini justify-content-center d-flex">
        </div>
    </aside>
</div>