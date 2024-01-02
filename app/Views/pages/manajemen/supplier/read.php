<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Detail Supplier<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Manajemen Supplier</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item active"><a href="">Manajemen</a></div>
            <div class="breadcrumb-item"><a href="">Supplier</a></div>
            <div class="breadcrumb-item"><a href="">Detail Data</a></div>
        </div>
    </div>
    <div class="section-body">
        <a href="<?= base_url('manajemen/supplier') ?>" class="mb-4 btn btn-secondary has-icon"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card">
            <div class="card-header">
                <h4>Detail Data Suplier</h4>
            </div>


            <div class="card-body">
                <div class="form-group">
                    <label for="kode_supplier" class="form-label">Kode Supplier</label>
                    <input type="text" name="kode_supplier" id="kode_supplier" class="form-control " required autofocus value="<?= $data->kode_supplier ?>" readonly>

                </div>
                <div class="form-group">
                    <label for="nama_supplier" class="form-label">Nama Supplier</label>
                    <input type="text" name="nama_supplier" id="nama_supplier" class="form-control " required autofocus value="<?= $data->nama_supplier ?>" readonly>

                </div>
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="no_telp" class="form-label">No Telepon</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control " required autofocus value="<?= $data->no_telp ?>" readonly>

                    </div>
                    <!-- <div class="col-6 form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" class="form-control" required autofocus value="" readonly>
                        </div> -->
                </div>
                <!-- <div class="row">
                        <div class="col-6 form-group">
                            <label for="nama_pic" class="form-label">Nama PIC</label>
                            <input type="text" name="nama_pic" id="nama_pic" class="form-control" required autofocus value="" readonly>
                        </div>
                        <div class="col-6 form-group">
                            <label for="telp_pic" class="form-label">No Telp PIC</label>
                            <input type="text" name="telp_pic" id="telp_pic" class="form-control" required autofocus value="" readonly>
                        </div>
                    </div> -->
                <div class="form-group">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control " value="<?= $data->alamat ?>" readonly>

                </div>
            </div>
            <div class="card-footer">
                <a href="<?= base_url('manajemen/supplier/edit/' . $data->id) ?>" class="btn btn-warning"><i class="fa-solid fa-edit"></i> Edit</a>
                <a href="#" id="delete" data-id="<?= $data->id ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Hapus</a>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('addon-script') ?>
<script>
    $(function() {
        $(document).on('click', '#delete', function() {
            let id = $(this).data('id');
            console.log(id);
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
                        window.location = "<?= base_url('manajemen/supplier') ?>"
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