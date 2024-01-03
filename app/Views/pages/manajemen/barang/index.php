<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Manajemen Barang<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Manajemen Barang</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item active"><a href="#">Manajemen</a></div>
            <div class="breadcrumb-item"><a href="#">Barang</a></div>
        </div>
    </div>
    <div class="section-body">
        <a href="<?= base_url('manajemen/barang/create') ?>" class="mb-4 btn btn-primary has-icon"><i class="fas fa-plus"></i> Tambah Data Barang</a>
        <div class="card">
            <div class="card-header">
                <h4>Data Barang</h4>
            </div>
            <div class="card-body">

                <table class="table table-bordered datatable display responsive nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="spinner-border">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

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
            serverSide: true,
            ajax: '<?= base_url('manajemen/barang/jsondatatable') ?>'
        });

        $(document).on('click', '#delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
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
                        url: "<?= base_url('manajemen/barang/delete/') ?>" + id,
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