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
            <form action="<?= base_url('manajemen/pegawai/save') ?>" method="post" class="needs-validation">
                <div class="card-body">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="" class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" id="nama_lengkap" class="form-control <?= (isset(session()->getFlashdata('errors')['name'])) ? 'is-invalid' : '' ?>" required autofocus autocomplete="name" value="<?= old('name') ?>">
                        <?php if (isset(session()->getFlashdata('errors')['name'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errors')['name'] ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Nama Pengguna (username)</label>
                        <input type="text" name="username" id="username" class="form-control <?= (isset(session()->getFlashdata('errors')['username'])) ? 'is-invalid' : '' ?>" required autofocus autocomplete="username" value="<?= old('username') ?>">
                        <?php if (isset(session()->getFlashdata('errors')['username'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errors')['username'] ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control <?= (isset(session()->getFlashdata('errors')['email'])) ? 'is-invalid' : '' ?>" required autofocus autocomplete="email" value="<?= old('email') ?>">
                        <?php if (isset(session()->getFlashdata('errors')['email'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errors')['email'] ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group" id="pwd-container">
                            <label for="" class="form-label">Sandi</label>
                            <input type="password" name="password" id="sandi" class="form-control pwstrength <?= (isset(session()->getFlashdata('errors')['password'])) ? 'is-invalid' : '' ?>" required autofocus autocomplete="new-password">
                            <div class="mt-2">
                                <div class="pwstrength_viewport_progress"></div>
                            </div>
                            <?php if (isset(session()->getFlashdata('errors')['password'])) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('errors')['password'] ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="col-6 form-group">
                            <label for="" class="form-label">Konfirmasi Sandi</label>
                            <input type="password" name="password_confirm" id="konfirmasi-sandi" class="form-control" required autofocus autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">No Telp</label>
                        <input type="text" name="no_telp" id="no-telp" class="form-control <?= (isset(session()->getFlashdata('errors')['no_telp'])) ? 'is-invalid' : '' ?>" required autofocus autocomplete="tel" value="<?= old('no_telp') ?>">
                        <?php if (isset(session()->getFlashdata('errors')['no_telp'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errors')['no_telp'] ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control <?= (isset(session()->getFlashdata('errors')['alamat'])) ? 'is-invalid' : '' ?>" autofocus autocomplete="street-address" value="<?= old('alamat') ?>">
                        <?php if (isset(session()->getFlashdata('errors')['alamat'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errors')['alamat'] ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-control select2 <?= (isset(session()->getFlashdata('errors')['jabatan'])) ? 'is-invalid' : '' ?>">
                            <option value="">Harap pilih</option>
                            <option value="admin" <?= (old('jabatan') == 'admin') ? 'selected' : '' ?>>Admin</option>
                            <option value="manajer" <?= (old('jabatan') == 'manajer') ? 'selected' : '' ?>>Manajer</option>
                            <option value="kasir" <?= (old('jabatan') == 'kasir') ? 'selected' : '' ?>>Kasir</option>
                            <option value="pemilik" <?= (old('jabatan') == 'pemilik') ? 'selected' : '' ?>>Pemilik</option>
                        </select>
                        <?php if (isset(session()->getFlashdata('errors')['jabatan'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('errors')['jabatan'] ?>
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