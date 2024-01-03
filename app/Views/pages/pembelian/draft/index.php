<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Draft Pembelian Barang<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Draft Pembelian Barang</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item"><a href="">Pembelian</a></div>
            <div class="breadcrumb-item active">Draft Pembelian</div>
        </div>
    </div>
    <div class="section-body">
        <div class="d-flex flex-row px-2 justify-content-center gap-2">
            <div class="card bg-primary p-2 d-flex flex-row col-3">
                <div class="col-2 text-center">
                    <h1 class="fs-1"><?= $countDraft ?></h1>
                </div>
                <div class="col-10">
                    <h6>Draft</h6>
                    <p>Menunggu Persetujuan</p>
                </div>
            </div>
            <div class="card bg-success p-2 d-flex flex-row col-3">
                <div class="col-2 text-center">
                    <h2>24</h2>
                </div>
                <div class="col-10">
                    <h6>Stok</h6>
                    <p>Barang Normal</p>
                </div>
            </div>
            <div class="card bg-warning p-2 d-flex flex-row col-3">
                <div class="col-2 text-center">
                    <h2>13</h2>
                </div>
                <div class="col-10">
                    <h6>Stok</h6>
                    <p>Barang Menipis</p>
                </div>
            </div>
            <div class="card bg-danger p-2 d-flex flex-row col-3">
                <div class="col-2 text-center">
                    <h2>6</h2>
                </div>
                <div class="col-10">
                    <h6>Stok</h6>
                    <p>Barang Habis</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Draft Pengajuan Pembelian Barang</h4>
            </div>
            <div class="card-body">

                <table class="table table-striped display responsive nowrap" style="width: 100%;" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Pembelian</th>
                            <th>Supplier</th>
                            <th>Total Barang</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="8" class="text-center">
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
        let dataTable = $('#datatable').DataTable({
            responsive: true,
            serverSide: true,
            ajax: '<?= base_url('draftpembelian/jsondatapembelian') ?>',
            error: function(error) {
                console.error(error);
            },
            order: [],
            columns: [{
                data: 'no'
            }, {
                data: 'kode_pembelian'
            }, {
                data: 'nama_supplier'
            }, {
                data: 'jumlah_order'
            }, {
                data: 'total_harga'
            }, {
                data: 'status'
            }, {
                data: 'tanggal'
            }, {
                data: 'aksi'
            }]
        })
    });
</script>
<?= $this->endSection() ?>