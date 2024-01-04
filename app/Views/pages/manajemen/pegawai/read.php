<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Detail Pegawai<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Manajemen Pegawai</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item active"><a href="">Manajemen</a></div>
            <div class="breadcrumb-item"><a href="">Pegawai</a></div>
            <div class="breadcrumb-item"><a href="">Detail Data</a></div>
        </div>
    </div>
    <div class="section-body">
        <a href="<?= base_url('manajemen/pegawai') ?>" class="btn btn-secondary mb-4"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card">
            <div class="card-header">
                <h4>Detail Data Pegawai</h4>
            </div>

            <div class="card-body">

                <div class="form-group">
                    <label for="" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" id="nama_lengkap" class="form-control" required autofocus autocomplete="name" value="<?= $data->name ?>" readonly>

                </div>
                <div class="form-group">
                    <label for="" class="form-label">Nama Pengguna (username)</label>
                    <input type="text" name="username" id="username" class="form-control " required autofocus autocomplete="username" value="<?= $data->username ?>" readonly>

                </div>
                <div class="form-group">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required autofocus autocomplete="email" value="<?= $data->email ?>" readonly>

                </div>

                <div class="form-group">
                    <label for="" class="form-label">No Telp</label>
                    <input type="text" name="no_telp" id="no-telp" class="form-control " required autofocus autocomplete="tel" value="<?= $data->no_telp ?>" readonly>

                </div>
                <div class="form-group">
                    <label for="" class="form-label">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control " autofocus autocomplete="street-address" value="<?= $data->alamat ?>" readonly>

                </div>
                <div class="form-group">
                    <label for="" class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" class="form-control" value="<?= $group->getForUser($data)[0] ?>" readonly>

                </div>
            </div>
            <?php if (!auth()->user()->inGroup('pemilik')) : ?>
                <div class="card-footer">
                    <a href="<?= base_url('manajemen/pegawai/edit/' . $data->id) ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                    <a href="" class="btn btn-danger" id="delete"><i class="fas fa-trash"></i> Hapus</a>
                </div>
            <?php endif ?>

        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('addon-script') ?>
<script src="<?= base_url('vendor/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js') ?>"></script>
<script>
    $(function() {
        $('#delete').click(function(e) {
            e.preventDefault()
            Swal.fire({
                title: "Peringatan",
                text: 'Anda yakin untuk menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Yakin!',
                cancelButtonText: 'Tidak',
                confirmButtonColor: '#d33',

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "<?= base_url('manajemen/pegawai/delete/' . $data->id) ?>"
                }
            })
        })
    });
</script>
<?= $this->endSection() ?>