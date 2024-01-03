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
                            10
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
                            42
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
                            1,201
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
                            47
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Filter Laporan</h4>
            </div>
            <div class="card-body">
                <div class="form-group row g-3">
                    <div class="col">
                        <label for="inputState" class="form-label">Bulan</label>
                        <select id="inputState" class="form-control">
                            <option selected>Select Here</option>
                            <?php foreach ($kalendar as $item) : ?>
                                <option value="<?= $item->bulan ?>"><?= $item->nama_bulan ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="inputState" class="form-label">Tahun</label>
                        <select id="inputState" class="form-control">
                            <option selected>Select Here</option>
                            <?php foreach ($kalendar as $item) : ?>
                                <option value="<?= $item->tahun ?>"><?= $item->tahun ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">Tampilkan Data</button>
                <button class="btn btn-danger">Reset Pencarian</button>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h6>Laporan Transaksi Keseluruhan</h6>
            </div>

            <div class="card-body ">
                <table class="table table-striped">
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
            <div class="card-footer">
                <button class="btn btn-success">Excel</button>
                <button class="btn btn-danger">PDF</button>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('addon-script') ?>
<?= $this->endSection() ?>