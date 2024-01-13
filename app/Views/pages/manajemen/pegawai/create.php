<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Tambah Pegawai<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Manajemen Pegawai</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item active"><a href="">Manajemen</a></div>
            <div class="breadcrumb-item"><a href="">Pegawai</a></div>
            <div class="breadcrumb-item"><a href="">Tambah Data</a></div>
        </div>
    </div>
    <div class="section-body">
        <a href="<?= base_url('manajemen/pegawai') ?>" class="btn btn-secondary mb-4"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card">
            <div class="card-header">
                <h4>Tambah Data Pegawai</h4>
            </div>
            <form action="<?= base_url('manajemen/pegawai/save') ?>" method="post" class="needs-validation" novalidate>
                <div class="card-body">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="" class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" id="nama_lengkap" class="form-control <?= (isset(session()->getFlashdata('errors')['name'])) ? 'is-invalid' : '' ?>" required autofocus autocomplete="name" value="<?= old('name') ?>">
                        <div class="invalid-feedback">
                            <?= (isset(session()->getFlashdata('errors')['name'])) ? session()->getFlashdata('errors')['name'] : 'Nama lengkap tidak boleh kosong!' ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Nama Pengguna (username)</label>
                        <input type="text" name="username" id="username" class="form-control <?= (isset(session()->getFlashdata('errors')['username'])) ? 'is-invalid' : '' ?>" required autofocus autocomplete="username" value="<?= old('username') ?>">
                        <div class="invalid-feedback">
                            <?= (isset(session()->getFlashdata('errors')['username'])) ? session()->getFlashdata('errors')['username'] : 'Nama pengguna tidak boleh kosong!' ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control <?= (isset(session()->getFlashdata('errors')['email'])) ? 'is-invalid' : '' ?>" required autofocus autocomplete="email" value="<?= old('email') ?>">
                        <div class="invalid-feedback">
                            <?= (isset(session()->getFlashdata('errors')['email'])) ? session()->getFlashdata('errors')['email'] : 'Email tidak boleh kosong!' ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group" id="pwd-container">
                            <label for="" class="form-label">Sandi</label>
                            <input type="password" name="password" id="sandi" class="form-control pwstrength <?= (isset(session()->getFlashdata('errors')['password'])) ? 'is-invalid' : '' ?>" required autofocus autocomplete="new-password">
                            <div class="mt-2">
                                <div class="pwstrength_viewport_progress"></div>
                            </div>
                            <div class="invalid-feedback">
                                <?= (isset(session()->getFlashdata('errors')['password'])) ? session()->getFlashdata('errors')['password'] : 'Sandi tidak boleh kosong!' ?>
                            </div>
                        </div>
                        <div class="col-6 form-group">
                            <label for="" class="form-label">Konfirmasi Sandi</label>
                            <input type="password" name="password_confirm" id="konfirmasi-sandi" class="form-control" required autofocus autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">No Telp</label>
                        <input type="text" name="no_telp" id="no-telp" class="form-control <?= (isset(session()->getFlashdata('errors')['no_telp'])) ? 'is-invalid' : '' ?>" required autofocus autocomplete="tel" value="<?= old('no_telp') ?>">
                        <div class="invalid-feedback">
                            <?= (isset(session()->getFlashdata('errors')['no_telp'])) ? session()->getFlashdata('errors')['no_telp'] : 'No. Telepon tidak boleh kosong!' ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control <?= (isset(session()->getFlashdata('errors')['alamat'])) ? 'is-invalid' : '' ?>" autofocus autocomplete="street-address" value="<?= old('alamat') ?>">
                        <div class="invalid-feedback">
                            <?= (isset(session()->getFlashdata('errors')['alamat'])) ? session()->getFlashdata('errors')['alamat'] : 'Alamat tidak boleh kosong!' ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-control select2 <?= (isset(session()->getFlashdata('errors')['jabatan'])) ? 'is-invalid' : '' ?>" required>
                            <option value="">Harap pilih</option>
                            <option value="admin" <?= (old('jabatan') == 'admin') ? 'selected' : '' ?>>Admin</option>
                            <option value="manajer" <?= (old('jabatan') == 'manajer') ? 'selected' : '' ?>>Manajer</option>
                            <option value="kasir" <?= (old('jabatan') == 'kasir') ? 'selected' : '' ?>>Kasir</option>
                            <option value="pemilik" <?= (old('jabatan') == 'pemilik') ? 'selected' : '' ?>>Pemilik</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= (isset(session()->getFlashdata('errors')['jabatan'])) ? session()->getFlashdata('errors')['jabatan'] : 'Jabatan harus di pilih!' ?>
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
<?= $this->section('addon-script') ?>
<script src="<?= base_url('vendor/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js') ?>"></script>
<script>
    $(function() {
        $(".pwstrength").pwstrength({
            ui: {
                container: "#pwd-container",
                viewports: {
                    progress: ".pwstrength_viewport_progress"
                },
                showVerdictsInsideProgressBar: true,
            }
        });
    });
</script>
<?= $this->endSection() ?>