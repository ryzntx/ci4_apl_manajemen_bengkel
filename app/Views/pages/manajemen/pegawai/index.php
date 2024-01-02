<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Manajemen Pegawai<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Manajemen Pegawai</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item active"><a href="">Manajemen</a></div>
            <div class="breadcrumb-item"><a href="">Pegawai</a></div>
        </div>
    </div>
    <div class="section-body">
        <a href="<?= base_url('manajemen/pegawai/create') ?>" class="btn btn-primary mb-4"><i class="fas fa-plus"></i> Tambah Pegawai</a>
        <div class="card">
            <div class="card-header">
                <h4>Data Pegawai</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pegawai</th>
                                <th>Username</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $id => $item) : ?>
                                <tr>
                                    <td><?= ++$no ?></td>
                                    <td><?= $item->name ?></td>
                                    <td><?= $item->username ?></td>
                                    <td><?= $group->getForUser($item)[0] ?></td>
                                    <td>
                                        <a href="<?= base_url('manajemen/pegawai/read/' . $item->id) ?>" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="#" type="button" class="btn btn-danger btn-sm" id="delete" data-id="<?= $item->id ?>"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('addon-script') ?>
<script src="<?= base_url('vendor/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js') ?>"></script>
<script>
    $(function() {
        let dataTable = $('.datatable').DataTable({
            "responsive": true,
        })

        $(document).on('click', '#delete', function(e) {
            e.preventDefault()
            var id = $(this).data('id');
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
                    window.location = "<?= base_url('manajemen/pegawai/delete/') ?>" + id
                }
            })
        })

    });
</script>
<?= $this->endSection() ?>