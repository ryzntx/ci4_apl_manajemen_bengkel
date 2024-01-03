<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Kategori Barang<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Kategori Barang</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item active"><a href="#">Manajemen</a></div>
            <div class="breadcrumb-item"><a href="#">Barang</a></div>
            <div class="breadcrumb-item"><a href="#">Kategori Barang</a></div>
        </div>
    </div>
    <div class="section-body">
        <a href="" class="mb-4 btn btn-primary has-icon" data-bs-toggle="modal" data-bs-target="#modalInput"><i class="fas fa-plus"></i> Tambah Kategori Barang</a>
        <div class="card">
            <div class="card-header">
                <h4>Data Kategori Barang</h4>
            </div>
            <div class="card-body">

                <table class="table table-bordered datatable display responsive nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3" class="text-center">
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

<!-- Modal -->
<div class="modal fade" id="modalInput" tabindex="-1" aria-labelledby="modalInputLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalInputLabel">Tambah Kategori Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="save" method="post" class="needs-validation">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditLabel">Edit Kategori Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" class="needs-validation" id="update">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" id="idKategori" name="id" required readonly>
                    <div class="form-group">
                        <label for="nama_kategori_edit" class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori_edit" class="form-control" required autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitUpdate" class="btn btn-primary"><i class="fa-solid fa-save"></i> Perbaharui</button>
                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('addon-script') ?>
<script>
    $(function() {
        let dataTable = $('.datatable').DataTable({
            serverSide: true,
            responsive: true,
            ajax: '<?= base_url('manajemen/kategoribarang/jsondatatable') ?>',
            column: [{
                data: "no",
            }, {
                data: "kategori_barang"
            }, {
                data: 'aksi',
                orderable: false,
                searchable: false
            }]
        })

        $('#save').on('submit', function(e) {
            var namaKategori = $('#nama_kategori').val()

            $.ajax({
                type: "post",
                url: "<?= base_url('manajemen/kategoribarang/save') ?>",
                data: {
                    nama_kategori: namaKategori
                },
            }).done(function() {
                $('#modalInput').modal('hide');
                $('#nama_kategori').val("");
                dataTable.ajax.reload()
            });
            e.preventDefault();
        })

        $(document).on('click', '#edit', function(e) {
            e.preventDefault()
            let id = $(this).data("id");
            $.ajax({
                type: "get",
                url: `<?= base_url('manajemen/kategoribarang/jsonread/') ?>` + id,
            }).done((response) => {
                $('#modalEdit').modal('show')
                $('#nama_kategori_edit').val(response['kategori_barang'])
                $('#idKategori').val(response['id'])
            });
        });

        $(document).on('click', '#delete', function(e) {
            e.preventDefault()
            let id = $(this).data('id');
            Swal.fire({
                title: 'Peringatan!',
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
                        url: "<?= base_url('manajemen/kategoribarang/delete/') ?>" + id,
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

        $('#modalEdit').on('hidden.bs.modal', function() {
            $('#nama_kategori_edit').val("")
            $('#idKategori').val("")
            $('#update').attr('action', '');
        })

        $('#update').on("submit", function(e) {
            var id = $('#idKategori').val();
            var namaKategoriEdit = $('#nama_kategori_edit').val();

            $.ajax({
                type: "post",
                url: "<?= base_url('manajemen/kategoribarang/update/') ?>" + id,
                data: {
                    id: id,
                    nama_kategori: namaKategoriEdit
                },
            }).done(function() {
                $('#modalEdit').modal('hide');
                dataTable.ajax.reload()
            });
            e.preventDefault();

        });

    });
</script>
<?= $this->endSection() ?>