<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Purchase Order</title>
</head>

<body>
    <div class="container my-5">
        <hr class="border border-dark border-3">
        <h2>PURCHASE ORDER</h2>
        <hr class="border border-dark border-3">
    </div>
    <div class="container my-2">
        <div class="row mb-1">
            <label class="col-sm-2">Nama</label>:
            <div class="col-4">
                DS Motor
            </div>
            <label class="col-sm-2">Pengiriman</label>:
            <div class="col-3">
                Barang
            </div>
        </div>
        <div class="row mb-1">
            <label class="col-sm-2">Tanggal</label>:
            <div class="col-4">
                <?= date_format(date_create($data->created_at), "d-m-Y") ?>
            </div>
            <label class="col-sm-2">Nomor PO</label>:
            <div class="col-3">
                <?= $data->kode_pembelian ?>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-2">Kepada</label>:
            <div class="col-4">
                <?= $data->supplier->nama_supplier ?>
            </div>
        </div>
        <div class="row mb-1">
        </div>
        <div class="row mb-1">
            <label class="col-sm-2">Alamat</label>:
            <div class="col-3">
                <?= $data->supplier->alamat ?>
            </div>
        </div>
    </div>
    </div>
    <div class="container my-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($keranjang as $item) : ?>
                    <tr>
                        <td><?= ++$no ?></td>
                        <td><?= $item->barang->nama ?></td>
                        <td><?= $item->jumlah ?></td>
                        <td><?= "Rp" . number_format($item->barang->harga_beli, 2, ",", ".")  ?></td>
                        <td><?= "Rp" . number_format($item->total_harga, 2, ",", ".")  ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="container my-2">
        <div class="row">
            <div class="row mb-1">
                <div class="col-6 col-sm-7"></div>
                <div class="col-6 col-sm-3 d-inline-flex">
                    Qty/Item &nbsp;
                    <p><?= $total_item ?> / <?= count($keranjang) ?></p>
                </div>
            </div>
            <!-- <div class="row mb-1">
                <div class="col-6 col-sm-7"></div>
                <div class="col-6 col-sm-3 d-inline-flex">
                    Sub Total &nbsp;
                    <p>Test</p>
                </div>
            </div> -->
            <div class="row mb-1">
                <div class="col-6 col-sm-7"></div>
                <div class="col-6 col-sm-3 d-inline-flex">
                    Total &nbsp;
                    <p><?= "Rp" . number_format($data->total_harga, 2, ",", ".")  ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="row mb-1">
                <div class="col-6 col-sm-7">&nbsp;&nbsp;(PENERIMA)</div>
                <div class="col-6 col-sm-3">
                    &nbsp;(PERUSAHAAN ANDA)
                </div>
            </div>
        </div>
        <div class="row">
            <div class="row mt-5">
                <div class="col-6 col-sm-7">
                    <input type="text" class="col-sm-2 border-0 border-bottom border-black">
                </div>
                <div class="col-6 col-sm-3">
                    <input type="text" class="col-sm-8 border-0 border-bottom border-black">
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script>
    window.print()
</script>

</html>