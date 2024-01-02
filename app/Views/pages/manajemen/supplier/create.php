<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Tambah Data Supplier<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Manajemen Supplier</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item active"><a href="">Manajemen</a></div>
            <div class="breadcrumb-item"><a href="">Supplier</a></div>
            <div class="breadcrumb-item"><a href="">Tambah Data</a></div>
        </div>
    </div>
    <div class="section-body">
        <a href="<?= base_url('manajemen/supplier') ?>" class="mb-4 btn btn-secondary has-icon"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card">
            <div class="card-header">
                <h4>Tambah Data Suplier</h4>
            </div>
            <form action="<?= base_url('manajemen/supplier/save') ?>" method="post" class="needs-validation">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="kode_supplier" class="form-label">Kode Supplier</label>
                        <input type="text" name="kode_supplier" id="kode_supplier" class="form-control <?= (isset(session()->getFlashdata('errors')['kode_supplier'])) ? 'is-invalid' : '' ?>" required autofocus value="<?= old('kode_supplier') ?>">
                        <?php if (isset(session()->getFlashdata('errors')['kode_supplier'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errors')['kode_supplier'] ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="nama_supplier" class="form-label">Nama Supplier</label>
                        <input type="text" name="nama_supplier" id="nama_supplier" class="form-control <?= (isset(session()->getFlashdata('errors')['nama_supplier'])) ? 'is-invalid' : '' ?>" required autofocus value="<?= old('nama_supplier') ?>">
                        <?php if (isset(session()->getFlashdata('errors')['nama_supplier'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errors')['nama_supplier'] ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <label for="no_telp" class="form-label">No Telepon</label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control <?= (isset(session()->getFlashdata('errors')['no_telp'])) ? 'is-invalid' : '' ?>" required autofocus value="<?= old('no_telp') ?>">
                            <?php if (isset(session()->getFlashdata('errors')['no_telp'])) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors')['no_telp'] ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <!-- <div class="col-6 form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" class="form-control" required autofocus value="<?= old('email') ?>">
                        </div> -->
                    </div>
                    <!-- <div class="row">
                        <div class="col-6 form-group">
                            <label for="nama_pic" class="form-label">Nama PIC</label>
                            <input type="text" name="nama_pic" id="nama_pic" class="form-control" required autofocus value="<?= old('nama_pic') ?>">
                        </div>
                        <div class="col-6 form-group">
                            <label for="telp_pic" class="form-label">No Telp PIC</label>
                            <input type="text" name="telp_pic" id="telp_pic" class="form-control" required autofocus value="<?= old('telp_pic') ?>">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control <?= (isset(session()->getFlashdata('errors')['alamat'])) ? 'is-invalid' : '' ?>" value="<?= old('alamat') ?>">
                        <?php if (isset(session()->getFlashdata('errors')['alamat'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errors')['alamat'] ?>
                            </div>
                        <?php endif ?>
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