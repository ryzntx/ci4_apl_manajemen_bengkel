<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Riwayat Transaksi<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Riwayat Transaksi</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item"><a href="">Transaksi</a></div>
            <div class="breadcrumb-item"><a href="">Riwayat Transaksi</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Data Riwayat Transaksi</h4>
            </div>
            <div class="card-body">

                <table class="table table-striped display responsive nowrap" style="width: 100%;" id="tableTransaksi">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="">Kode Transaksi</th>
                            <th class="">Jenis</th>
                            <th class="">No Plat</th>
                            <th class="">Status</th>
                            <th class="">Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7" class="text-center">
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
        let dataTableTransaksi = $('#tableTransaksi').DataTable({
            responsive: true,
            serverSide: true,
            ajax: '<?= base_url('riwayatTransaksi/jsondatatransaksi/') ?>',
            error: function(error) {
                console.error(error);
            },
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: "kode_transaksi"
                }, {
                    data: "jenis_layanan"
                },
                {
                    data: "no_plat"
                },
                {
                    data: "status"
                },
                {
                    data: "created_at"
                },
                {
                    data: "aksi",
                    // visible: false
                }
            ]
        })
    });
</script>
<?= $this->endSection() ?>