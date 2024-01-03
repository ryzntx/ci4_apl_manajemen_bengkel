<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Cetak Struk</title>
    <!-- <style>
            * {
                border: 1px solid red;
            }
        </style> -->
</head>

<body>
    <div class="card">
        <div class="card-body mx-4">
            <div class="container-sm">
                <div class="my-4 text-center" style="font-size: 30px;">
                    <h1>DS MOTOR</h1>
                    <h6>Jalan Cinangsi, Kec. Cibogo, Kabupaten Subang, Jawa Barat 41285</h6>
                    <hr style="border: 1px solid black;">
                </div>
                <div class="row">
                    <ul class="list-unstyled">
                        <li class="text-black mt-1">Customer &nbsp;: <?= ($data->customer == null) ? "Tunai" : $data->customer->nama_pemilik ?></li>
                        <li class="text-black mt-1">No Plat &nbsp;: <?= ($data->customer == null) ? "-" : $data->customer->no_plat ?></li>
                        <li class="text-black mt-1">Model Kendaraan &nbsp;: <?= ($data->customer == null) ? "-" : $data->customer->model_kendaraan ?></li>
                        <li class="text-black mt-1">Tanggal Transaksi &nbsp;: <?= date_format(date_create($data->created_at), "d-m-Y") ?></li>
                    </ul>
                    <hr style="border: 1px solid black;">
                    <div class="d-flex flex-column">
                        <?php foreach ($keranjang as $item) : ?>
                            <div class="d-flex justify-content-between">
                                <div class="col">
                                    <p><?= ($item->id_barang == null) ? $item->layanan_servis->nama : $item->barang->nama ?></p>
                                    <p><?= $item->qty ?> X <?= ($item->id_barang == null) ? "Rp" . number_format($item->layanan_servis->harga, 2, ",", ".") : "Rp" . number_format($item->barang->harga_jual, 2, ",", ".") ?></p>
                                </div>
                                <div class="col text-end">
                                    <p class="float-end">
                                    <p>&nbsp;</p>
                                    <p><?= "Rp" . number_format($item->total_harga, 2, ",", ".") ?></p>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <hr style="border: 1px solid black;">
                </div>
                <div class="row">
                    <div class="col-xl-10">
                        <p class="fw-bold">Total Harga</p>
                    </div>
                    <div class="col-xl-2">
                        <p class="float-end fw-bold"><?= "Rp" . number_format($data->total_dibayar, 2, ",", ".") ?>
                        </p>
                    </div>
                    <hr style="border: 1px solid black;">
                </div>
                <div class="row">
                    <div class="col-xl-10">
                        <p>Uang Tunai</p>
                    </div>
                    <div class="col-xl-2">
                        <p class="float-end"><?= "Rp" . number_format($data->total_uang, 2, ",", ".") ?>
                        </p>
                    </div>
                    <hr style="border: 1px solid black;">
                </div>
                <div class="row text-black">

                    <div class="col-xl-12">
                        <p class="float-end fw-bold">Kembalian: <?= "Rp" . number_format($data->total_uang - $data->total_dibayar, 2, ",", ".") ?>
                        </p>
                    </div>
                    <hr style="border: 1px solid black;">
                </div>
                <div class="text-center">
                    <p><?= strftime("%H:%M:%S", (int)$data->created_at) ?>/<?= $data->user->name ?>/<?= $data->kode_transaksi ?></p>
                    <p>Terima Kasih Atas Kunjungan Anda</p>
                    <p>Barang yang sudah di beli tidak dapat ditukar/dikembalikan</p>
                </div>

            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script>
    window.print()
</script>

</html>