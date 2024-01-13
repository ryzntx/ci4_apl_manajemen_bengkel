<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Ubah Supplier<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Manajemen Supplier</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item active"><a href="">Manajemen</a></div>
            <div class="breadcrumb-item"><a href="">Supplier</a></div>
            <div class="breadcrumb-item"><a href="">Ubah Data</a></div>
        </div>
    </div>
    <div class="section-body">
        <a href="<?= base_url('manajemen/supplier') ?>" class="mb-4 btn btn-secondary has-icon"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card">
            <div class="card-header">
                <h4>Ubah Data Suplier</h4>
            </div>
            <form action="<?= base_url('manajemen/supplier/update/' . $data->id) ?>" method="post" class="needs-validation" novalidate>
                <?= csrf_field() ?>
                <div class="card-body">
                    <input type="hidden" name="id" value="<?= $data->id ?>">
                    <div class="form-group">
                        <label for="kode_supplier" class="form-label">Kode Supplier</label>
                        <input type="text" name="kode_supplier" id="kode_supplier" class="form-control <?= (isset(session()->getFlashdata('errors')['kode_supplier'])) ? 'is-invalid' : '' ?>" required autofocus value="<?= $data->kode_supplier ?>">
                        <div class="invalid-feedback">
                            <?= (isset(session()->getFlashdata('errors')['kode_supplier'])) ? session()->getFlashdata('errors')['kode_supplier'] : 'Kode Supplier tidak boleh kosong!' ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_supplier" class="form-label">Nama Supplier</label>
                        <input type="text" name="nama_supplier" id="nama_supplier" class="form-control <?= (isset(session()->getFlashdata('errors')['nama_supplier'])) ? 'is-invalid' : '' ?>" required autofocus value="<?= old('nama_supplier') ?? $data->nama_supplier ?>">
                        <div class="invalid-feedback">
                            Nama supplier tidak boleh kosong!
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <label for="no_telp" class="form-label">No Telepon</label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control <?= (isset(session()->getFlashdata('errors')['no_telp'])) ? 'is-invalid' : '' ?>" required autofocus value="<?= old('no_telp') ?? $data->no_telp ?>">
                            <div class="invalid-feedback">
                                <?= (isset(session()->getFlashdata('errors')['no_telp'])) ? session()->getFlashdata('errors')['no_telp'] : 'No. Telepon tidak boleh kosong!' ?>
                            </div>
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
                        <input type="text" name="alamat" id="alamat" class="form-control <?= (isset(session()->getFlashdata('errors')['alamat'])) ? 'is-invalid' : '' ?>" value="<?= old('alamat') ?? $data->alamat ?>">
                        <div class="invalid-feedback">
                            Alamat tidak boleh kosong!
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Perbaharui</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?= $this->endSection() ?>