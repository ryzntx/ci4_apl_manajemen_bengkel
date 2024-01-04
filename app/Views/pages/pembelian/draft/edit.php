<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Detail Pembelian Barang<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Detail Draft Pembelian Barang</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item"><a href="">Pembelian</a></div>
            <div class="breadcrumb-item active">Detail Draft Pembelian</div>
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
        <div class="alert alert-warning alert-dismissible fade show">
            <i class="fas fa-info-circle"></i> <strong>Melakukan draft pembelian barang hanya dapat dilakukan untuk 1 supplier saja!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <a href="<?= base_url('draftpembelian') ?>" class="btn btn-secondary mb-4"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
        <div class="card">
            <div class="card-header">
                <h4>Data Pembelian</h4>
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
        <div class="d-flex flex-row px-1 gap-2 justify-content-center">
            <div class="card col-6">
                <div class="card-header">
                    <h4>Keranjang</h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered datatable display responsive nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Barang</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Aksi</th>
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
                    <a href="#" class="btn btn-warning" id="update-draft" data-id="<?= $pembelian->id ?>"><i class="fa-solid fa-save"></i> Perbarui Draft</a>
                    <a href="#" class="btn btn-danger" id="hapus-draft"><i class="fa-solid fa-trash"></i> Hapus Draft</a>
                </div>
            </div>
            <div class="card col-6">
                <div class="card-header">
                    <h4>Barang</h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered datatable2 display responsive nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Barang</th>
                                <th>Stok</th>
                                <th>Supplier</th>
                                <th>Aksi</th>
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
            </div>
        </div>
    </div>
</section>
<!-- Modal Item Barang -->
<div class="modal fade" id="modalItem" tabindex="-1" aria-labelledby="modalItemLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalItemLabel">Tambahkan ke Keranjang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="post" id="formTambahItemKeranjang">
                <div class="modal-body">
                    <div class="visually-hidden d-flex justify-content-center" id="spinner">
                        <div class="spinner-border">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="d-none" id="form-input">
                        <input type="hidden" name="id_barang" id="id_barang" readonly required>
                        <div class="form-group">
                            <label for="" class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Qty</label>
                            <input type="number" name="qty" id="qty" class="form-control" min="1" required value="1" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary visually-hidden" id="submitTambah"><i class="fa-solid fa-plus"></i> Tambahkan!</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('addon-script') ?>
<script src="<?= base_url('vendor/angka-rupiah-js/index.min.js') ?>"></script>
<script>
    $(function() {
        var total_barang = 0;
        var total_harga = 0;
        var kode_pembelian = $('#kode-pembelian').val();
        var id_supplier = $('#supplier').data('id');

        let dataTableKeranjang = $('.datatable').DataTable({
            responsive: true,
            serverSide: true,
            ajax: '<?= base_url('draftpembelian/jsonkeranjang/') ?>' + kode_pembelian,
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
                {
                    data: 'aksi',


                },
            ]
        })

        let dataTableBarang = $('.datatable2').DataTable({
            responsive: true,
            serverSide: true,
            ajax: '<?= base_url('pembelian/jsondatabarang/') ?>' + id_supplier,
            order: [],
            columns: [{
                    data: 'no',
                    orderable: false
                },
                {
                    data: "nama"
                }, {
                    data: "jumlah_stok"
                }, {
                    data: "nama_supplier"
                }, {
                    data: "aksi",
                    // visible: false
                }
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

        $(document).on('click', '#tambahItem', function(e) {
            e.preventDefault()
            var id = $(this).data('id')
            $('#form-input').addClass('d-none')
            $('#spinner').removeClass('visually-hidden')
            $('#submitTambah').addClass('visually-hidden');
            $('#modalItem').modal('show')
            $.ajax({
                type: 'get',
                url: '<?= base_url('pembelian/readitem/') ?>' + id,
            }).done(function(res) {
                harga_barang = res.harga_beli
                $('#id_barang').val(res.id)
                $('#nama_barang').val(res.nama)
                $('#harga').val(res.harga_beli)
                $('#spinner').addClass('visually-hidden');
                $('#form-input').removeClass('d-none');
                $('#submitTambah').removeClass('visually-hidden')
            }).fail(function(error) {
                console.error(error);
            })
        })

        $(document).on('hide.bs.modal', '#modalItem', function() {
            $('#qty').val('1')
        })

        $('#qty').change(function(e) {
            e.preventDefault();
            var qty = $(this).val()
            var res = harga_barang * qty;
            $('#harga').val(res)
        });

        $(document).on('submit', '#formTambahItemKeranjang', function(e) {
            e.preventDefault()
            let formData = new FormData(this)
            formData.append('kode_pembelian', $('#kode-pembelian').val());
            formData.append('id_barang', $('#id_barang').val());
            $.ajax({
                type: 'post',
                url: '<?= base_url('draftpembelian/tambahitemkeranjang') ?>',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
            }).done(function(res) {
                console.log(res);
                // $('#supplier').attr('disabled', '')
                $('#modalItem').modal('hide')
                toastSuccess("Item berhasil di tambahkan ke keranjang!")
                dataTableKeranjang.ajax.reload()
            }).fail(function(err) {
                console.error(err);
            })
        })

        $(document).on('click', '#delete-item', function(e) {
            e.preventDefault()
            var id = $(this).data('row-id')
            Swal.fire({
                title: 'Hapus item',
                text: "Anda yakin ingin menghapus barang ini dari keranjang belanja?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'get',
                        url: '<?= base_url('draftpembelian/hapusitemkeranjang/') ?>' + id,
                    }).done(function(res) {
                        toastSuccess("Item berhasil di hapus!")
                        dataTableKeranjang.ajax.reload()
                    })
                }
            })
        })

        $(document).on('click', '#update-draft', function(e) {
            e.preventDefault()
            var id = $(this).data('id')
            Swal.fire({
                title: 'Peringatan!',
                text: 'Anda yakin untuk memperbaharui draft ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Ya`,
                cancelButtonText: `Tidak`

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        url: '<?= base_url('draftPembelian/updateDraft/') ?>' + id,
                        data: {
                            'total_order': total_barang,
                            'total_harga': total_harga
                        }
                    }).done(function(res) {
                        window.location = '<?= base_url('draftPembelian') ?>'
                    })
                }
            })
        })

        $('#hapus-draft').click(function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Peringatan!',
                text: 'Anda yakin untuk menghapus draft pembelian ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: `Ya, Hapus`,
                cancelButtonText: `Tidak`

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = '<?= base_url('draftpembelian/hapusdraft/') ?>' + kode_pembelian
                }
            })
        });

    });
</script>
<?= $this->endSection() ?>