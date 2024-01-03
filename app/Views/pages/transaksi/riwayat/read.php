<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Detail Transaksi<?= $this->endSection() ?>
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
        <a href="<?= base_url('riwayatTransaksi') ?>" class="btn btn-secondary mb-4"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
        <div class="card">
            <div class="card-header">
                <h4>Data Transaksi</h4>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col">
                        <label for="jenis-transaksi" class="form-label">Jenis Transaksi</label>
                        <input type="text" name="jenis_transaksi" id="jenis-transaksi" class="form-control" required readonly value="<?= $transaksi->jenis_layanan ?>">
                    </div>
                    <div class="col">
                        <label for="kode-transaksi" class="form-label">Kode Transaksi</label>
                        <input type="text" id="kode-transaksi" class="form-control" name="kode_transaksi" readonly value="<?= $transaksi->kode_transaksi ?>">
                    </div>
                    <div class="col">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" id="tanggal" class="form-control" name="tanggal" readonly value="<?= date_format(date_create($transaksi->created_at), "Y-m-d") ?>">
                    </div>
                </div>
                <?php if ($transaksi->jenis_layanan == 'Servis') : ?>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="no-plat" class="form-label">No Plat</label>
                            <input type="text" id="no-plat" class="form-control" name="no_plat" readonly autofocus placeholder="contoh: T 1234 ABC" value="<?= $transaksi->customer->no_plat ?>">
                            <div class="invalid-feedback">
                                Harap masukan Plat Nomor
                            </div>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="model-kendaraan" class="form-label">Model Kendaraan</label>
                            <input type="text" id="model-kendaraan" class="form-control" name="model_kendaraan" readonly autofocus placeholder="contoh: Yamaha Mio" value="<?= $transaksi->customer->model_kendaraan ?>">
                            <div class="invalid-feedback">
                                Harap masukan Model Kendaraan
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nama-pemilik" class="form-label">Nama Pemilik</label>
                            <input type="text" id="nama-pemilik" class="form-control" name="nama_pemilik" readonly value="<?= $transaksi->customer->nama_pemilik ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="no-telp" class="form-label">No Telepon</label>
                            <input type="text" id="no-telp" class="form-control" name="no_telp" readonly value="<?= $transaksi->customer->no_telp ?>">
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Keranjang</h4>
            </div>
            <div class="card-body">

                <table class="table table-bordered display responsive nowrap" style="width: 100%;" id=" tableKeranjang">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Barang</th>
                            <th>Qty</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <!-- <tbody>
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="spinner-border">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </td>
                        </tr>
                    </tbody> -->
                </table>

                <div class="d-none" id="data-keranjang">
                    <div class="d-flex flex-row align-items-center justify-content-between align-content-center border-bottom py-2 border-top">
                        <div class="fs-6">Total Barang: </div>
                        <div class="fs-6" id="total-barang"></div>
                    </div>
                    <div class="d-flex flex-row align-items-center justify-content-between align-content-center border-bottom border-top py-2">
                        <div class="fs-6">Total Jumlah Barang: </div>
                        <div class="fs-6" id="total-qty"></div>
                    </div>
                    <div class="d-flex flex-row align-items-center justify-content-between align-content-center border-bottom border-top py-2">
                        <div class="fs-6">Total Harga: </div>
                        <div class="fs-6" id="total-harga"></div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-none" id="simpanTransaksi">
                <button class="btn btn-success" id="bayar"><i class="fa-solid fa-print"></i> Cetak</button>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->section('addon-script') ?>
<script src="<?= base_url('vendor/angka-rupiah-js/index.min.js') ?>"></script>
<script>
    var kode_transaksi = $('#kode-transaksi').val();
    $(function() {
        $('#tableKeranjang').DataTable()
        var dataTableKeranjang = $('#tableKeranjang').DataTable({
            // responsive: true,
            // processing: true,
            serverSide: true,
            ajax: '<?= base_url('riwayatTransaksi/jsondataitemkeranjang/') ?>' + kode_transaksi,
            error: function(error) {
                console.error(error);
            },
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: 'nama',
                },
                {
                    data: 'qty',
                },
                {
                    data: 'total_harga',
                },

            ]
        })
        dataTableKeranjang.on('xhr.dt', function(e, settings, json, xhr) {
            if (json.length != 0) {
                if (json.data.length != 0) {
                    $.ajax({
                        type: 'get',
                        url: '<?= base_url('riwayatTransaksi/jsondatakeranjang/') ?>' + kode_transaksi
                    }).done(function(res) {
                        total_barang = res.data.total_barang
                        total_harga = res.data.total_harga
                        total_qty = res.data.total_qty
                        $('#total-barang').text(total_barang);
                        $('#total-qty').text(total_qty);
                        $('#total-harga').text(toRupiah(total_harga));
                        $('#data-keranjang').attr('class', 'd-block');
                    }).fail(function(err) {
                        console.error(err);
                    })
                    $('#simpanTransaksi').attr('class', 'card-footer d-block');

                }
            } else {
                $('#data-keranjang').attr('class', 'd-none');
                $('#simpanTransaksi').attr('class', 'd-none');
            }
        })
    });
</script>
<?= $this->endSection() ?>