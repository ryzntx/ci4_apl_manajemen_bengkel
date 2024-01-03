<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Pembelian Barang<?= $this->endSection() ?>
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
                    <h2><?= $countStokNormal ?></h2>
                </div>
                <div class="col-10">
                    <h6>Stok</h6>
                    <p>Barang Normal</p>
                </div>
            </div>
            <div class="card bg-warning p-2 d-flex flex-row col-3">
                <div class="col-2 text-center">
                    <h2><?= $countStokMenipis ?></h2>
                </div>
                <div class="col-10">
                    <h6>Stok</h6>
                    <p>Barang Menipis</p>
                </div>
            </div>
            <div class="card bg-danger p-2 d-flex flex-row col-3">
                <div class="col-2 text-center">
                    <h2><?= $countStokHabis ?></h2>
                </div>
                <div class="col-10">
                    <h6>Stok</h6>
                    <p>Barang Habis</p>
                </div>
            </div>
        </div>
        <a href="<?= base_url('draftpembelian') ?>" class="btn btn-secondary mb-4"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card">
            <div class="card-header">
                <h4>Data Draft</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-4">
                        <label for="" class="form-label">Supplier</label>
                        <input type="text" name="supplier" id="supplier" class="form-control" readonly required value="<?= $pembelian->supplier->nama_supplier ?>" data-id="<?= $pembelian->supplier->id ?>">
                    </div>
                    <div class="form-group col-4">
                        <label for="" class="form-label">Kode Pembelian</label>
                        <input type="text" name="kode_pembelian" id="kode-pembelian" class="form-control" required readonly value="<?= $pembelian->kode_pembelian ?>">
                    </div>
                    <div class="form-group col-4">
                        <label for="" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" readonly value="<?= date_format(date_create($pembelian->created_at), "Y-m-d") ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Daftar PO</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable display responsive nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Barang</th>
                                <th>Qty</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="spinner-border">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-block" id="data-keranjang">
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
            <div class="card-footer d-none" id="simpanDraft">
                <?php if ($pembelian->status == 'Disetujui') : ?>
                    <a href="<?= base_url('draftPembelian/print/') . $pembelian->id ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> Cetak</a>
                <?php else : ?>
                    <a href="#" class="btn btn-success" id="setuju-draft" data-id="<?= $pembelian->id ?>" data-status="true"><i class="fa fa-check"></i> Setujui Draft</a>
                    <a href="#" class="btn btn-danger" id="tolak-draft" data-id="<?= $pembelian->id ?>" data-status="false"><i class="fa-solid fa-close"></i> Tolak Draft</a>
                <?php endif ?>
            </div>
        </div>


    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('addon-script') ?>
<script src="<?= base_url('vendor/angka-rupiah-js/index.min.js') ?>"></script>
<script>
    $(function() {
        var kode_pembelian = $('#kode-pembelian').val();
        var id_supplier = $('#supplier').data('id');

        let dataTableKeranjang = $('.datatable').DataTable({
            responsive: true,
            serverSide: true,
            ajax: '<?= base_url('draftpembelian/jsondraftkeranjang/') ?>' + kode_pembelian,
            error: function(error) {
                console.error(error);
            },
            order: [],
            columns: [{
                    data: 'no',

                },
                {
                    data: 'nama',

                },
                {
                    data: 'jumlah',

                },
                {
                    data: 'harga',

                },
            ]
        })


        dataTableKeranjang.on('xhr.dt', function(e, settings, json, xhr) {
            if (json.length != 0) {
                if (json.data.length != 0) {
                    $.ajax({
                        type: 'get',
                        url: '<?= base_url('draftpembelian/jsondatakeranjang/') ?>' + kode_pembelian
                    }).done(function(res) {
                        // $('#supplier').val(res.data.supplier).change();
                        // $('#supplier').attr('disabled', '')
                        total_barang = res.data.total_barang
                        total_harga = res.data.total_harga
                        total_qty = res.data.total_qty
                        $('#total-barang').text(total_barang);
                        $('#total-qty').text(total_qty);
                        $('#total-harga').text(toRupiah(total_harga));
                        $('#data-keranjang').attr('class', 'd-block');
                    })
                    $('#simpanDraft').attr('class', 'card-footer d-block');

                }
            } else {
                // $('#supplier').removeAttr('disabled');
                $('#data-keranjang').attr('class', 'd-none');
                $('#simpanDraft').attr('class', 'd-none');
            }
        })

        $('#setuju-draft').click(function(e) {
            e.preventDefault()
            var id = $(this).data('id')
            Swal.fire({
                title: 'Peringatan!',
                text: 'Anda yakin untuk menyetujui draft ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Ya, Setuju`,
                cancelButtonText: `Tidak`

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = '<?= base_url('draftpembelian/updatestatusdraft/') ?>' + `${id}/true`
                }
            })
        });
        $('#tolak-draft').click(function(e) {
            e.preventDefault()
            var id = $(this).data('id')
            Swal.fire({
                title: 'Peringatan!',
                text: 'Anda yakin untuk menolak draft ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Ya, Setuju`,
                cancelButtonText: `Tidak`

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = '<?= base_url('draftpembelian/updatestatusdraft/') ?>' + `${id}/false`
                }
            })
        });

    });
</script>
<?= $this->endSection() ?>