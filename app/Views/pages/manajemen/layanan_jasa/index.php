<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Manajemen Layanan Servis<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Manajemen Layanan Servis</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item active"><a href="">Manajemen</a></div>
            <div class="breadcrumb-item"><a href="">Layanan Servis</a></div>
        </div>
    </div>
    <div class="section-body">
        <a href="" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#inputModal"><i class="fas fa-plus"></i> Tambah Layanan Layanan Servis</a>
        <div class="card">
            <div class="card-header">
                <h4>Data Layanan Servis</h4>
            </div>
            <div class="card-body">

                <table class="table table-bordered datatable display responsive nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Layanan</th>
                            <th>Harga Layanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">
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
<div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="inputModalLabel">Tambah Layanan Service</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" class="needs-validation" id="inputForm" novalidate="">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="form-label">Nama Layanan</label>
                        <input type="text" name="nama_layanan" id="nama_layanan" class="form-control" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Harga Layanan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga_layanan" id="harga_layanan" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Ubah Layanan Service</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" class="needs-validation" id="editForm" novalidate="">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_edit" required readonly>
                    <div class="form-group">
                        <label for="" class="form-label">Nama Layanan</label>
                        <input type="text" name="nama_layanan" id="nama_layanan_edit" class="form-control" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Harga Layanan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga_layanan" id="harga_layanan_edit" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi_edit" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Perbaharui</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Tutup</button>
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
            responsive: true,
            serverSide: true,
            ajax: '<?= base_url('manajemen/layananjasa/jsondatatable') ?>'
        })

        $('#inputForm').on('submit', function(e) {
            $.ajax({
                type: "post",
                url: "<?= base_url('manajemen/layananjasa/save') ?>",
                data: {
                    nama_layanan: $('#nama_layanan').val(),
                    harga_layanan: $('#harga_layanan').val(),
                    deskripsi: $('#deskripsi').val(),
                },
            }).done(function(res) {
                $('#inputModal').modal('hide')
                $('#nama_layanan').val("")
                $('#harga_layanan').val("")
                $('#deskripsi').val("")
                Swal.fire({
                    title: "Sukses",
                    text: 'Data berhasil di simpan!',
                    icon: 'success',
                    timer: 3500
                })
                dataTable.ajax.reload()
            });
            e.preventDefault()
        })

        $(document).on('click', '#edit', function(e) {
            e.preventDefault()
            const id = $(this).data('id');
            $.ajax({
                type: "get",
                url: "<?= base_url('manajemen/layananjasa/read/') ?>" + id,
                success: function(response) {
                    $('#id_edit').val(response['id'])
                    $('#nama_layanan_edit').val(response['nama_layanan'])
                    $('#harga_layanan_edit').val(response['harga'])
                    $('#deskripsi_edit').val(response['deskripsi'])
                    $('#editModal').modal('show')
                }
            });
        })

        $('#editForm').on('submit', function(e) {
            const id = $('#id_edit').val()
            $.ajax({
                type: "post",
                url: "<?= base_url('manajemen/layananjasa/update/') ?>" + id,
                data: {
                    nama_layanan: $('#nama_layanan_edit').val(),
                    harga_layanan: $('#harga_layanan_edit').val(),
                    deskripsi: $('#deskripsi_edit').val(),
                },
            }).done(function(res) {
                $('#editModal').modal('hide')
                $('#nama_layanan_edit').val("")
                $('#harga_layanan_edit').val("")
                $('#deskripsi_edit').val("")
                Swal.fire({
                    title: "Sukses",
                    text: 'Data berhasil di perbaharui!',
                    icon: 'success',
                    timer: 3500
                })
                dataTable.ajax.reload()
            });
            e.preventDefault()
        })

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
                        url: "<?= base_url('manajemen/layananjasa/delete/') ?>" + id,
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
                        dataTable.ajax.reload();
                    });
                }
            })
        })

        setInterval(function() {
            dataTable.ajax.reload();
        }, 5000);
    });
</script>
<?= $this->endSection() ?>