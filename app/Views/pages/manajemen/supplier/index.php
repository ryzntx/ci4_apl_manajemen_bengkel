<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Manajemen Barang<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Manajemen Suplier</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item active"><a href="">Manajemen</a></div>
            <div class="breadcrumb-item"><a href="">Suplier</a></div>
        </div>
    </div>
    <div class="section-body">
        <a href="<?= base_url('manajemen/supplier/create') ?>" class="mb-4 btn btn-primary has-icon"><i class="fas fa-plus"></i> Input Data</a>
        <div class="card">
            <div class="card-header">
                <h4>Data Suplier</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">#</th>
                                <th>Kode Suplier</th>
                                <th>Nama Suplier</th>
                                <th>No Telepon</th>
                                <!-- <th>Email</th> -->
                                <th>Aksi</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('addon-script') ?>
<script>
    $(function() {
        let dataTable = $('.datatable').DataTable({
            responsive: true,
            // processing: true,
            serverSide: true,
            ajax: '<?= base_url('manajemen/supplier/jsondatatable') ?>',
            column: [{
                    data: 'kode_supplier',
                    name: 'kode_supplier'
                },
                {
                    data: 'nama_supplier',
                    name: 'nama_supplier'
                },
                {
                    data: 'no_telp',
                    name: 'no_telp'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $(document).on('click', '#delete', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Peringatan',
                text: 'Anda yakin untuk menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Yakin!',
                cancelButtonText: 'Tidak',
                confirmButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: "<?= base_url('manajemen/supplier/delete/') ?>" + id,
                    }).done(function(response) {
                        Swal.fire({
                            title: 'Sukses!',
                            text: 'Data berhasil di hapus!',
                            icon: 'success',
                            timer: 3500
                        })
                        dataTable.ajax.reload();
                    }).fail(function(res) {
                        console.error(res);
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data gagal di hapus!',
                            icon: 'error',
                            timer: 3500
                        })
                    });
                }
            })
        })
    });
</script>
<?= $this->endSection() ?>