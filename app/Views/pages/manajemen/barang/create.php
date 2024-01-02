<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Tambah Barang Baru<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Manajemen Barang</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item active"><a href="#">Manajemen</a></div>
            <div class="breadcrumb-item"><a href="#">Barang</a></div>
            <div class="breadcrumb-item"><a href="#">Tambah Data</a></div>
        </div>
    </div>
    <div class="section-body">
        <a href="<?= base_url('manajemen/barang') ?>" class="mb-4 btn btn-secondary has-icon"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card">
            <div class="card-header">
                <h4>Tambah Data Barang</h4>
            </div>
            <form action="<?= base_url('manajemen/barang/save') ?>" method="post" class="needs-validation" novalidate="">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="form-group">
                        <div>
                            <label for="kode_barang" class="form-label">Kode Produk</label>
                            <input type="text" name="kode_barang" id="kode_barang" class="form-control <?= (isset(session()->getFlashdata('errors')['kode_barang'])) ? 'is-invalid' : '' ?>" required autofocus readonly value="<?= $kode_barang ?>">
                            <?php if (isset(session()->getFlashdata('errors')['kode_barang'])) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors')['kode_barang'] ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="form-group row g-3">
                        <div class="col">
                            <label for="nama_barang" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control <?= (isset(session()->getFlashdata('errors')['nama_barang'])) ? 'is-invalid' : '' ?>" name="nama_barang" id="nama_barang" required autofocus value="<?= old('nama_barang') ?>">
                            <?php if (isset(session()->getFlashdata('errors')['nama_barang'])) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors')['nama_barang'] ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="col">
                            <label for="merek_barang" class="form-label">Merek Produk</label>
                            <input type="text" class="form-control <?= (isset(session()->getFlashdata('errors')['merek_barang'])) ? 'is-invalid' : '' ?>" name="merek_barang" id="merek_barang" required autofocus value="<?= old('merek_barang') ?>">
                            <?php if (isset(session()->getFlashdata('errors')['merek_barang'])) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors')['merek_barang'] ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="form-group row g-3">
                        <div class="col">
                            <label for="kategori_barang" class="form-label">Kategori Produk</label>
                            <select id="kategori_barang" class="form-control select2" name="kategori_barang" required autofocus>
                                <option selected>Harap pilih!</option>
                                <?php foreach ($kategori as $item) : ?>
                                    <option value="<?= $item->id ?>" <?= (old('kategori_barang') == $item->id) ? 'selected' : '' ?>><?= $item->kategori_barang ?></option>
                                <?php endforeach ?>
                            </select>
                            <?php if (isset(session()->getFlashdata('errors')['kategori_barang'])) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors')['kategori_barang'] ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="col">
                            <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                            <input type="text" class="form-control <?= (isset(session()->getFlashdata('errors')['jumlah_stok'])) ? 'is-invalid' : '' ?>" name="jumlah_stok" id="jumlah_stok" required autofocus value="<?= old('jumlah_stok') ?>">
                            <?php if (isset(session()->getFlashdata('errors')['jumlah_stok'])) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors')['jumlah_stok'] ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="form-group row g-3">
                        <div class="col">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="text" class="form-control <?= (isset(session()->getFlashdata('errors')['harga_beli'])) ? 'is-invalid' : '' ?>" name="harga_beli" id="harga_beli" required autofocus value="<?= old('harga_beli') ?>">
                            <?php if (isset(session()->getFlashdata('errors')['harga_beli'])) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors')['harga_beli'] ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="col">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="text" class="form-control <?= (isset(session()->getFlashdata('errors')['harga_jual'])) ? 'is-invalid' : '' ?>" name="harga_jual" id="harga_jual" required autofocus value="<?= old('harga_jual') ?>">
                            <?php if (isset(session()->getFlashdata('errors')['harga_jual'])) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors')['harga_jual'] ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <label for="select" class="form-label">Supplier</label>
                            <select name="supplier" id="select" class="form-control select2">
                                <option value="null" selected>Harap pilih!</option>
                                <?php foreach ($supplier as $item) : ?>
                                    <option value="<?= $item->id ?>" <?= (old('supplier') == $item->id) ? 'selected' : '' ?>><?= $item->nama_supplier ?></option>
                                <?php endforeach ?>

                            </select>
                            <?php if (isset(session()->getFlashdata('errors')['supplier'])) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors')['supplier'] ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>