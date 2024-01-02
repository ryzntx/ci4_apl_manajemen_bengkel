<?= $this->extend('layouts/base') ?>
<?= $this->section('title') ?>Input Transaksi<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Input Transaksi</h1>
        <div class="breadcrumb section-header-breadcrumb my-sm-auto">
            <div class="breadcrumb-item"><a href="">Transaksi</a></div>
            <div class="breadcrumb-item"><a href="">Input Transaksi</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Data Transaksi</h4>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col">
                        <label for="jenis-transaksi" class="form-label">Jenis Transaksi</label>
                        <select id="jenis-transaksi" class="form-control select2" name="jenis_transaksi" required>
                            <option value="Penjualan" selected>Penjualan</option>
                            <option value="Servis">Layanan Servis</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="kode-transaksi" class="form-label">Kode Transaksi</label>
                        <input type="text" id="kode-transaksi" class="form-control" name="kode_transaksi" readonly value="INV<?= $kode ?>">
                    </div>
                    <div class="col">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" id="tanggal" class="form-control" name="tanggal" readonly value="<?= $date->format('Y-m-d') ?>">
                    </div>
                </div>
                <div class="d-none" id="servisInput">
                    <form action="" method="post" class="needs-validation" id="servisForm" novalidate>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="no-plat" class="form-label">No Plat <small class="text-danger">* Wajib di isi!</small></label>
                                <input type="text" id="no-plat" class="form-control" name="no_plat" required autofocus placeholder="contoh: T 1234 ABC">
                                <div class="invalid-feedback">
                                    Harap masukan Plat Nomor
                                </div>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="model-kendaraan" class="form-label">Model Kendaraan <small class="text-danger">* Wajib di isi!</small></label>
                                <input type="text" id="model-kendaraan" class="form-control" name="model_kendaraan" required autofocus placeholder="contoh: Yamaha Mio">
                                <div class="invalid-feedback">
                                    Harap masukan Model Kendaraan
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nama-pemilik" class="form-label">Nama Pemilik</label>
                                <input type="text" id="nama-pemilik" class="form-control" name="nama_pemilik">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="no-telp" class="form-label">No Telepon</label>
                                <input type="text" id="no-telp" class="form-control" name="no_telp">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex flex-row gap-3 px-2 justify-content-center">
            <div class="card col-6">
                <div class="card-header">
                    <h4>Keranjang</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a href="" class="btn btn-danger btn-sm mb-4 d-none" id="hapus-keranjang"><i class="fa-solid fa-trash"></i> Kosongkan Keranjang</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tableKeranjang">
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
                    </div>
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
                    <button class="btn btn-primary d-none" id="simpan"><i class="fa-solid fa-save"></i> Simpan</button>
                    <button class="btn btn-success" id="bayar"><i class="fa-solid fa-money-bill-wave"></i> Bayar</button>
                </div>
            </div>
            <div class="card col-6">
                <div class="card-header">
                    <h4>Barang</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row g-3">
                        <div class="col">
                            <label for="kategori-barang" class="form-label">Kategori Barang</label>
                            <select id="kategori-barang" class="form-control select2" name="kategori_barang">
                                <option value="0">Pilih Kategori Barang</option>
                                <option value="null">Jasa Servis</option>
                                <?php foreach ($kategori_barang as $item) : ?>
                                    <option value="<?= $item->id ?>"><?= $item->kategori_barang ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="tableBarang">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Produk</th>
                                        <th>Stok</th>
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
                        </div>
                    </div>
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
<!-- Modal Bayar -->
<div class="modal fade" id="modalBayar" tabindex="-1" aria-labelledby="modalBayarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalBayarLabel">Transaksi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="post" id="formBayar">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="form-label">Total yang harus dibayar</label>
                        <input type="text" name="yang_dibayar" id="yang-dibayar" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Uang yang diterima</label>
                        <input type="text" name="uang_diterima" id="uang-diterima" class="form-control" required>
                    </div>
                    <h6>Kembalian</h6>
                    <h4 id="kembalian">Rp.</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="simpanCetak"><i class="fa-solid fa-print"></i> Bayar dan Cetak</button>
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
    var harga_barang = 0;
    var total_barang = 0;
    var total_qty = 0;
    var total_harga = 0;
    var jenis_transaksi = $('#jenis-transaksi').val();
    var tipe = '';
    $(function() {

        $('#kategori-barang').change(function(e) {
            e.preventDefault();
            id_kategori_barang = $(this).val();
            (id_kategori_barang == 0) ? id_kategori_barang = "": id_kategori_barang;
            dataTableBarang.ajax.url('<?= base_url('transaksi/jsondatabarang/') ?>' + id_kategori_barang).load();
            dataTableBarang.ajax.reload()
        });

        $('#jenis-transaksi').change(function(e) {
            e.preventDefault()
            jenis_transaksi = $(this).val()
            if ($(this).val() == 'Penjualan') {
                $('#servisInput').attr('class', 'd-none')
                $('#simpan').addClass('d-none')
            } else {
                $('#servisInput').attr('class', 'd-block')
                $('#simpan').removeClass('d-none')
            }
        })

        var dataTableKeranjang = $('#tableKeranjang').DataTable({
            serverSide: true,
            ajax: '<?= base_url('transaksi/jsondataitemkeranjang') ?>',
            error: function(error) {
                console.error(error);
            },
            columns: [{
                    data: 'no',
                },
                {
                    data: 'nama_barang',
                },
                {
                    data: 'qty',
                },
                {
                    data: 'harga',
                },
                {
                    data: 'aksi',
                },
            ]
        })


        var dataTableBarang = $('#tableBarang').DataTable({
            serverSide: true,
            ajax: '<?= base_url('transaksi/jsondatabarang/') ?>',
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
                    data: "harga_jual"
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
                        url: '<?= base_url('transaksi/jsondatakeranjang') ?>'
                    }).done(function(res) {
                        total_barang = res.data.total_barang
                        total_harga = res.data.total_harga
                        total_qty = res.data.total_qty
                        $('#total-barang').text(total_barang);
                        $('#total-qty').text(total_qty);
                        $('#total-harga').text(toRupiah(total_harga));
                        $('#data-keranjang').attr('class', 'd-block');
                    })
                    $('#hapus-keranjang').attr('class', 'btn btn-danger btn-sm mb-4 d-inline-block')
                    $('#simpanTransaksi').attr('class', 'card-footer d-block');

                }
            } else {
                $('#data-keranjang').attr('class', 'd-none');
                $('#hapus-keranjang').attr('class', 'd-none');
                $('#simpanTransaksi').attr('class', 'd-none');
            }
        })

        $(document).on('click', '#tambahItem', function(e) {
            e.preventDefault()
            var id = $(this).data('id')
            tipe = $(this).data('tipe')
            $('#form-input').addClass('d-none')
            $('#submitTambah').addClass('visually-hidden');
            $('#spinner').removeClass('visually-hidden')
            $('#modalItem').modal('show')
            if (tipe == 'jasa') {
                $.ajax({
                    type: 'get',
                    url: '<?= base_url('transaksi/readitemjasa/') ?>' + id,
                }).done(function(res) {
                    harga_barang = res.harga_jual
                    $('#id_barang').val(res.id)
                    $('#nama_barang').val(res.nama)
                    $('#harga').val(res.harga)
                    $('#spinner').addClass('visually-hidden');
                    $('#form-input').removeClass('d-none');
                    $('#submitTambah').removeClass('visually-hidden')
                }).fail(function(error) {
                    console.error(error);
                })
            } else {
                $.ajax({
                    type: 'get',
                    url: '<?= base_url('transaksi/readitembarang/') ?>' + id,
                }).done(function(res) {
                    harga_barang = res.harga_jual
                    $('#id_barang').val(res.id)
                    $('#nama_barang').val(res.nama)
                    $('#harga').val(res.harga_jual)
                    $('#spinner').addClass('visually-hidden');
                    $('#form-input').removeClass('d-none');
                    $('#submitTambah').removeClass('visually-hidden')
                }).fail(function(error) {
                    console.error(error);
                })
            }

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
            formData.append('jenis_transaksi', jenis_transaksi);
            formData.append('id_barang', $('#id_barang').val());
            formData.append('tipe', tipe);
            $.ajax({
                type: 'post',
                url: '<?= base_url('transaksi/tambahitemkeranjang') ?>',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
            }).done(function(res) {
                console.log(res);
                $('#modalItem').modal('hide')
                toastSuccess("Item berhasil di tambahkan ke keranjang!")
                dataTableKeranjang.ajax.reload()
            }).fail(function(err) {
                console.error(err);
            })
        })

        $('#hapus-keranjang').click(function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Hapus semua isi keranjang?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: `Ya`,
                cancelButtonText: `Batal`

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'get',
                        url: '<?= base_url('transaksi/hapuskeranjang') ?>',
                    }).done(function(res) {
                        toastSuccess("Keranjang berhasil di kosongkan!")
                        dataTableKeranjang.ajax.reload()
                    })
                }
            })
        });

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
                        url: '<?= base_url('transaksi/hapusitemkeranjang/') ?>' + id,
                    }).done(function(res) {
                        toastSuccess("Item berhasil di hapus!")
                        dataTableKeranjang.ajax.reload()
                    })
                }
            })
        })

        $('#simpan').click(function(e) {
            e.preventDefault();

            var form = $('#servisForm');
            if (form[0].checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                $('#servisForm #no-plat').trigger('focus')
                $('#servisForm #model-kendaraan').trigger('focus')
            } else {
                Swal.fire({
                    title: 'Simpan Transaksi?',
                    text: 'Anda yakin untuk menyimpan transaksi ini??',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: `Ya`,
                    cancelButtonText: `Tidak`
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'post',
                            url: '<?= base_url('transaksi/simpantransaksi') ?>',
                            data: {
                                'kode_transaksi': $('#kode-transaksi').val(),
                                'jenis_transaksi': jenis_transaksi,
                                'total_dibayar': $('#yang-dibayar').val(),
                                'total_uang': $('#uang-diterima').val(),
                                'no_plat': $('#no-plat').val(),
                                'model_kendaraan': $('#model-kendaraan').val(),
                                'nama_pemilik': $('#nama-pemilik').val(),
                                'no_telp': $('#no-telp').val(),
                            }
                        }).done((res) => {
                            console.log(res);
                            $('#servisForm').trigger('reset')
                            dataTableKeranjang.ajax.reload()
                            dataTableBarang.ajax.reload()
                            window.location.reload()
                        }).fail((err) => {
                            console.error(err);
                        })
                    }
                })
            }
            form.addClass("was-validated");
        })

        $('#modalBayar').on('hide.bs.modal', function() {
            $("#formBayar").trigger('reset');
        })

        $('#bayar').click(function(e) {
            e.preventDefault()
            $('#modalBayar').modal('show')
            $('#yang-dibayar').val(toRupiah(total_harga))
        });

        $('#uang-diterima').change(function(e) {
            e.preventDefault();
            var res = $(this).val() - total_harga
            $('#kembalian').text(toRupiah(res))
        });

        $('#simpanCetak').click(function(e) {
            Swal.fire({
                title: 'Simpan Transaksi?',
                text: 'Anda yakin untuk menyimpan transaksi ini??',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: `Ya`,
                cancelButtonText: `Tidak`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        url: '<?= base_url('transaksi/simpantransaksi') ?>',
                        data: {
                            'kode_transaksi': $('#kode-transaksi').val(),
                            'jenis_transaksi': jenis_transaksi,
                            'total_dibayar': total_harga,
                            'total_uang': $('#uang-diterima').val(),
                        }
                    }).done((res) => {
                        console.log(res);
                        dataTableKeranjang.ajax.reload()
                        dataTableBarang.ajax.reload()
                        $('#modalBayar').modal('hide')
                        window.location.reload()
                    }).fail((err) => {
                        console.error(err);
                    })
                }
            })
        })
    });
</script>
<?= $this->endSection() ?>