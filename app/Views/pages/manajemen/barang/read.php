<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Detail Barang<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Manajemen Barang</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item active"><a href="#">Manajemen</a></div>
            <div class="breadcrumb-item"><a href="#">Barang</a></div>
            <div class="breadcrumb-item"><a href="#">Detail Data</a></div>
        </div>
    </div>
    <div class="section-body">
        <a href="<?= base_url('manajemen/barang') ?>" class="mb-4 btn btn-secondary has-icon"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card">
            <div class="card-header">
                <h4>Detail Data Barang</h4>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <div>
                        <label for="kode_barang" class="form-label">Kode Produk</label>
                        <input type="text" name="kode_barang" id="kode_barang" class="form-control" readonly autofocus value="<?= $barang->kode_barang ?>">
                    </div>
                </div>
                <div class="form-group row g-3">
                    <div class="col">
                        <label for="nama_barang" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" readonly autofocus value="<?= $barang->nama_barang ?>">

                    </div>
                    <div class="col">
                        <label for="merek_barang" class="form-label">Merek Produk</label>
                        <input type="text" class="form-control " name="merek_barang" id="merek_barang" readonly autofocus value="<?= $barang->merek_barang ?>">
                    </div>
                </div>
                <div class="form-group row g-3">
                    <div class="col">
                        <label for="kategori_barang" class="form-label">Kategori Produk</label>
                        <input type="text" name="kategori_barang" id="kategori_barang" class="form-control" readonly value="<?= $barang->kategori_barang->kategori_barang ?>">

                    </div>
                    <div class="col">
                        <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                        <input type="text" class="form-control" name="jumlah_stok" id="jumlah_stok" readonly autofocus value="<?= $barang->jumlah_stok ?>">

                    </div>
                </div>
                <div class="form-group row g-3">
                    <div class="col">
                        <label for="harga_beli" class="form-label">Harga Beli</label>
                        <input type="text" class="form-control " name="harga_beli" id="harga_beli" readonly autofocus value="<?= $barang->harga_beli ?>">

                    </div>
                    <div class="col">
                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="text" class="form-control" name="harga_jual" id="harga_jual" readonly autofocus value="<?= $barang->harga_jual ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <label for="select" class="form-label">Supplier</label>
                        <input type="text" name="supplier" id="supplier" class="form-control" readonly value="<?= $barang->supplier->nama_supplier ?>">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?= base_url('manajemen/barang/edit/' . $barang->id) ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                <a href="#" id="delete" data-id="<?= $barang->id ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>

            </div>

        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('addon-script') ?>
<script>
    $(function() {
        $(document).on('click', '#delete', function(e) {
            e.preventDefault()

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
                    window.location = "<?= base_url('manajemen/barang/delete/') ?>" + id
                }
            })
        })
    });
</script>
<?= $this->endSection() ?>