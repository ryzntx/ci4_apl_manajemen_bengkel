<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Laporan Transaksi<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Laporan Transaksi</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item"><a href="">Laporan</a></div>
            <div class="breadcrumb-item"><a href="">Transaksi</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success text-center">
                        <i class="fa-solid fa-chart-line fa-2xl"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah Transaksi</h4>
                        </div>
                        <div class="card-body">
                            <?= $jumlah_transaksi ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fa-solid fa-money-bill fa-2xl"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Tagihan</h4>
                        </div>
                        <div class="card-body">
                            <?= "Rp" . number_format($tagihan, 2, ",", ".") ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fa-solid fa-money-bill fa-2xl"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pembayaran</h4>
                        </div>
                        <div class="card-body">
                            <?= "Rp" . number_format($sudah_bayar, 2, ",", ".") ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fa-solid fa-money-bill fa-2xl"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Kekurangan</h4>
                        </div>
                        <div class="card-body">
                            <?= "Rp" . number_format($selisih, 2, ",", ".")  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Filter Laporan</h4>
            </div>
            <form action="<?= base_url('laporan/transaksi/jsondatatransaksi') ?>" method="get" id="filterTransaksi">
                <div class="card-body">
                    <div class="form-group">
                        <label for="" class="form-label">Tanggal</label>
                        <input type="text" name="" id="range" class="form-control">
                    </div>
                    <div class="form-group row g-3">
                        <div class="col">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select class="form-control select2" name="bulan" id="bulan">
                                <option value="">:: Bulan ::</option>
                                <?php foreach ($kalendar as $item) : ?>
                                    <option value="<?= $item->bulan ?>"><?= $item->nama_bulan ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select class="form-control select2" name="tahun" id="tahun">
                                <option value="">:: Tahun ::</option>
                                <?php foreach ($kalendar as $item) : ?>
                                    <option value="<?= $item->tahun ?>"><?= $item->tahun ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Jenis Transaksi</label>
                        <select name="" id="jenis-transaksi" class="form-control select2">
                            <option value="">Semua Jenis Transaksi</option>
                            <option value="Penjualan">Penjualan</option>
                            <option value="Servis">Servis</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Tampilkan Data</button>
                    <button type="reset" class="btn btn-danger"><i class="fa-solid fa-xmark-circle"></i> Reset Pencarian</button>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="card-header">
                <h6>Laporan Transaksi Keseluruhan</h6>
            </div>

            <div class="card-body ">
                <table class="table table-striped display responsive nowrap" style="width: 100%;" id="tableTransaksi">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Transaksi</th>
                            <th class="">Waktu Transaksi</th>
                            <th class="">Jenis Transaksi</th>
                            <th class="">No Plat</th>
                            <th class="">Jumlah Pembayaran</th>
                        </tr>
                    </thead>
                </table>

            </div>
            <!-- <div class="card-footer">
                <button class="btn btn-success"><i class="fa-solid fa-file-excel"></i> Excel</button>
                <button class="btn btn-danger"><i class="fa-solid fa-file-pdf"></i> PDF</button>
            </div> -->
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('addon-script') ?>
<script>
    $(function() {
        var tglAwal
        var tglAkhir
        const timeElapsed = Date.now();
        const today = new Date(timeElapsed);

        $('#range').daterangepicker({
            "autoApply": true,
            "startDate": today.toLocaleDateString(),
            "endDate": today.toLocaleDateString(),
            "opens": "center",
            "drops": "auto"
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            tglAwal = start.format('YYYY-MM-DD')
            tglAkhir = end.format('YYYY-MM-DD')
        })

        $('#filterTransaksi').on('submit', function(e) {
            e.preventDefault()
            var url = $(this).attr('action')
            var bulan = $('#bulan').val()
            var tahun = $('#tahun').val()
            var jenis = $('#jenis-transaksi').val()
            console.log(`tglAwal: ${tglAwal} ke tglAkhir: ${tglAkhir}`);
            console.log(bulan + tahun);
            console.log(url + `?bulan=${bulan}&tahun=${tahun}&jenis=${jenis}`);
            console.log(url + `?tglAwal=${tglAwal}&tglAkhir=${tglAkhir}&jenis=${jenis}`);
            if (tglAwal != undefined && tglAkhir != undefined) {
                dataTableTransaksi.ajax.url(url + `?tglAwal=${tglAwal}&tglAkhir=${tglAkhir}&jenis=${jenis}`).load()
                console.log("tanggal");
            } else {
                dataTableTransaksi.ajax.url(url + `?bulan=${bulan}&tahun=${tahun}&jenis=${jenis}`).load()
                console.log("bulan");
            }
        })

        $('#filterTransaksi').on('reset', function(e) {
            var url = $(this).attr('action')
            dataTableTransaksi.ajax.url(url).load()
        })

        var dataTableTransaksi = $('#tableTransaksi').DataTable({
            serverSide: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
            },
            ajax: '<?= base_url('laporan/transaksi/jsonDataTransaksi') ?>',
            buttons: [
                'excel', 'pdf',
            ],
            dom: 'Bflrtip',
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'kode_transaksi',
                },
                {
                    data: 'created_at',
                },
                {
                    data: 'jenis_layanan',
                },
                {
                    data: 'no_plat',
                },
                {
                    data: 'total_dibayar',
                },

            ]
        })
    });
</script>
<?= $this->endSection() ?>