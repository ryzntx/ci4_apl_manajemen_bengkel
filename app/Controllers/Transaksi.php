<?php

namespace App\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Barang;
use App\Models\DetailTransaksi;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use App\Models\Customer;
use App\Models\KategoriBarang;
use App\Models\LayananJasa;
use App\Models\Transaksi as ModelsTransaksi;

class Transaksi extends BaseController
{
    protected $transaksiModel, $detailTransaksi, $barangModel, $jasaModel, $customerModel;

    public function __construct()
    {
        $this->transaksiModel = new ModelsTransaksi();
        $this->detailTransaksi = new DetailTransaksi();
        $this->barangModel = new Barang();
        $this->jasaModel = new LayananJasa();
        $this->customerModel = new Customer();
    }

    public function getIndex()
    {
        $kategoriBarang = model(KategoriBarang::class)->findAll();
        $date = Carbon::now('Asia/Jakarta')->format('Ymd');
        $getLast = count($this->transaksiModel->like('created_at', Carbon::now('Asia/Jakarta')->format('Y-m-d'))->find()) + 1;
        $kode = $date . $getLast;
        $data = [
            'date' => new DateTime(Carbon::now('Asia/Jakarta')->format('Ymd')),
            'kode' => $kode,
            'kategori_barang' => $kategoriBarang
        ];
        return view('pages/transaksi/index', $data);
    }

    public function getJsonDataBarang($id = null)
    {

        if ($id != null) {
            // $barang = $this->barangModel->select('id, nama, jumlah_stok, id_kategori_barang, harga_jual')->where('id_kategori_barang', $id);
            $barang = $this->barangModel->getUnionTable(($id == 'null') ? null : $id);
        } else {
            // $barang = $this->barangModel->select('id, nama, jumlah_stok, id_kategori_barang, harga_jual');
            $barang = $this->barangModel->getUnionTable();
        }
        // dd($barang);
        return DataTable::of($barang)->addNumbering("no")->hide('id')->hide('id_kategori_barang')->add('harga', function ($row) {
            return ($row->harga_jasa == null) ? $row->harga_jual : $row->harga_jasa;
        })->add('jumlah_stok', function ($row) {
            return ($row->jumlah_stok == null) ? "Jasa" : $row->jumlah_stok;
        })->add('harga_jual', function ($row) {
            return "Rp" . number_format(($row->harga_jasa == null) ? $row->harga_jual : $row->harga_jasa, 2, ",", ".");
        })->add('aksi', function ($row) {
            if ($row->jumlah_stok == null) {
                $btn = "<a href='#' class='btn btn-info btn-sm' id='tambahItem' data-tipe='jasa'  data-id='" . $row->id . "'><i class='fas fa-plus-square'></i></a>";
            } else {
                $btn = "<a href='#' class='btn btn-info btn-sm' id='tambahItem' data-tipe='barang'  data-id='" . $row->id . "'><i class='fas fa-plus-square'></i></a>";
            }
            return $btn;
        })->toJson(true);
        // return DataTable::of($barang)->addNumbering("no")->hide('id')->hide('id_kategori_barang')->add('harga_jual', function ($row) {
        //     return "Rp" . number_format($row->harga_jual, 2, ",", ".");
        // })->add('aksi', function ($row) {
        //     return "<a href='#' class='btn btn-info btn-sm' id='tambahItem' data-id='" . $row->id . "'><i class='fas fa-plus-square'></i></a>";
        // })->toJson(true);
    }

    public function getReadItemBarang($id = null)
    {
        $find = $this->barangModel->find($id);
        if ($id == null || $find == null) {
            return response()->setJSON(['message' => 'Data tidak ditemukan!']);
        }
        return response()->setJSON($find);
    }

    public function getReadItemJasa($id = null)
    {
        $find = $this->jasaModel->find($id);
        if ($id == null || $find == null) {
            return response()->setJSON(['message' => 'Data tidak ditemukan!']);
        }
        return response()->setJSON($find);
    }

    public function getJsonDataItemKeranjang()
    {
        $keranjang = session('keranjang_transaksi');
        $no = 0;
        $dataKeranjang = [];
        $data = [];
        if (isset($keranjang)) {
            if (count($keranjang) > 0) {
                foreach ($keranjang as $item) {
                    $dataKeranjang[] = [
                        'no' => $no + 1,
                        'nama_barang' => ($item['nama_barang'] == '') ? $item['nama_servis'] : $item['nama_barang'],
                        'qty' => $item['qty'],
                        'harga' => "Rp" . number_format($item['harga'], 2, ",", "."),
                        'aksi' => "<a href='#' class='btn btn-danger btn-sm' id='delete-item' data-row-id='" . $item['row_id'] . "'><i class='fa fa-trash'></i></a>"
                    ];
                    $no++;
                }
            }
            array_multisort($dataKeranjang, SORT_ASC, $keranjang);
            $data['recordsTotal'] = count($dataKeranjang);
            $data['recordsFiltered'] = count($dataKeranjang);
            $page = !empty($_GET['start']) ? (int) $_GET['start'] : 1;
            $total = count($dataKeranjang);
            $limit = $_GET['length'];
            $totalPages = ceil($total / $limit);
            $page = max($page, 1);
            $page = min($page, $totalPages);
            $offset = ($page - 1) * $limit;
            if ($offset < 0) $offset = 0;
            $dataKeranjang = array_slice($dataKeranjang, $offset, $limit);
            if ($_GET['search']['value']) {
                $dataKeranjang = $this->searchData($_GET['search']['value'], $dataKeranjang);
            }

            $data['data'] =  $dataKeranjang;
        }
        return json_encode($data);
    }

    public function getJsonDataKeranjang()
    {
        $keranjang = session('keranjang_transaksi');
        $data = [];
        $total_harga = 0;
        $total_qty = 0;
        $total_barang = 0;
        // $id_supplier = '';
        if (isset($keranjang)) {
            $total_barang = count($keranjang);
            foreach ($keranjang as $index => $item) {
                // $id_supplier = $keranjang[$index]['id_supplier'];
                $total_qty += $keranjang[$index]['qty'];
                $total_harga += $keranjang[$index]['harga'];
            }
            $data = [
                // 'supplier' => $id_supplier,
                'total_harga' => $total_harga,
                'total_qty' => $total_qty,
                'total_barang' => $total_barang
            ];
            return response()->setJSON(['data' => $data]);
        }
        return response()->setJSON(['data' => 'null']);
    }

    //Fungsi untuk menambahkan item ke keranjang
    public function postTambahItemKeranjang()
    {
        $id_barang = $this->request->getVar('id_barang');
        $nama_barang = $this->request->getVar('nama_barang');
        $qty = $this->request->getVar('qty');
        $harga = $this->request->getVar('harga');
        $row_id = md5($nama_barang . serialize($qty));
        $jenis_transaksi = $this->request->getVar('jenis_transaksi');
        $tipe = $this->request->getVar('tipe');

        if ($tipe == 'barang') {
            $data = [
                $row_id => [
                    'tipe' => $tipe,
                    'jenis_transaksi' => $jenis_transaksi,
                    'id_barang' => $id_barang,
                    'nama_barang' => $nama_barang,
                    'id_layanan_servis' => '',
                    'nama_servis' => '',
                    'qty' => (int)$qty,
                    'harga' => (int)$harga,
                    'row_id' => $row_id
                ]
            ];
        } else {
            $data = [
                $row_id => [
                    'tipe' => $tipe,
                    'jenis_transaksi' => $jenis_transaksi,
                    'id_barang' => '',
                    'nama_barang' => '',
                    'id_layanan_servis' => $id_barang,
                    'nama_servis' => $nama_barang,
                    'qty' => (int)$qty,
                    'harga' => (int)$harga,
                    'row_id' => $row_id
                ]
            ];
        }

        if (!session()->has('keranjang_transaksi')) {
            session()->set('keranjang_transaksi', $data);
        } else {
            $exist = 0;
            $keranjang = session('keranjang_transaksi');

            foreach ($keranjang as $index => $item) {
                if ($keranjang[$index]['nama_barang'] == $nama_barang) {
                    $keranjang[$index]['qty'] += $qty;
                    $keranjang[$index]['harga'] += $harga;
                    $exist++;
                }
            }

            if ($exist == 0) {
                $keranjang_baru = array_merge_recursive($keranjang, $data);
                session()->set('keranjang_transaksi', $keranjang_baru);
            } else {
                session()->set('keranjang_transaksi', $keranjang);
            }
        }
        $keranjang = session('keranjang_transaksi');
        return response()->setJSON(['data' => $keranjang]);
        // return response()->setJSON(['status' => 200, 'message' => 'Item berhasil di tambahkan!']);
    }

    // Fungsi untuk menghapus item dari keranjang
    public function getHapusItemKeranjang($row_id = null)
    {
        $keranjang_baru = session('keranjang_transaksi');

        foreach ($keranjang_baru as $index => $item) {
            if ($keranjang_baru[$index]['row_id'] == $row_id) {
                unset($keranjang_baru[$index]);
            }
        }

        if (count($keranjang_baru) == 0) {
            session()->remove('keranjang_transaksi');
            return response()->setJSON(['status' => 200, 'message' => 'Item berhasil di hapus dari keranjang!']);
        } else {
            session()->set('keranjang_transaksi', $keranjang_baru);
            return response()->setJSON(['status' => 200, 'message' => 'Item berhasil di hapus dari keranjang!']);
        }
    }

    // Fungsi untuk menghapus keseluruhan item keranjang
    public function getHapusKeranjang()
    {
        session()->remove('keranjang_transaksi');
        return response()->setJSON(['status' => 200, 'message' => 'Keranjang berhasil di kosongkan!']);
    }

    public function postSimpanTransaksi()
    {
        /*
        * To-Do
        * Pengurangan kuantitas barang dari setiap penjualan (done)
        */
        $keranjang = session('keranjang_transaksi');
        $kode_transaksi = $this->request->getVar('kode_transaksi');
        $total_dibayar = $this->request->getVar('total_dibayar');
        $total_uang = $this->request->getVar('total_uang');
        $jenis_transaksi = $this->request->getVar('jenis_transaksi');
        $status = $this->request->getVar('status');
        if ($jenis_transaksi == 'Penjualan') {
            $status = 'Lunas';
        }
        if (isset($keranjang)) {
            foreach ($keranjang as $index => $item) {
                $data[] = [
                    'kode_transaksi' => $kode_transaksi,
                    'id_barang' => ($item['id_barang'] == null) ? null : $item['id_barang'],
                    'id_layanan_servis' => ($item['id_layanan_servis'] == null) ? null : $item['id_layanan_servis'],
                    'qty' => $item['qty'],
                    'total_harga' => $item['harga']
                ];
            }
            $transaksi = $this->transaksiModel->insert([
                'kode_transaksi' => $kode_transaksi,
                'jenis_layanan' => $jenis_transaksi,
                'total_dibayar' => $total_dibayar,
                'total_uang' => $total_uang,
                'status' => $status,
                'id_user' => auth()->user()->id,
            ]);
            foreach ($data as $item) {
                $this->detailTransaksi->insert($item);
                if ($item['id_barang'] != null) {
                    $barang = $this->barangModel->find($item['id_barang']);
                    $stok_awal = $barang->jumlah_stok;
                    $stok_baru = $stok_awal - (int)$item['qty'];
                    $this->barangModel->updateStok($barang->id, $stok_baru);
                }
            }
            if ($jenis_transaksi == 'Servis') {
                $this->customerModel->save([
                    'kode_transaksi' => $kode_transaksi,
                    'no_plat' => $this->request->getVar('no_plat'),
                    'model_kendaraan' => $this->request->getVar('model_kendaraan'),
                    'nama_pemilik' => $this->request->getVar('nama_pemilik'),
                    'no_telp' => $this->request->getVar('no_telp')
                ]);
            }
            session()->remove('keranjang_transaksi');
            session()->setFlashdata('success', 'Transaksi berhasil di simpan!');
            return response()->setJSON(['message' => 'Transaksi berhasil di simpan!', 'data' => $this->transaksiModel->getInsertID()]);
        }
        return response()->setJSON(['message' => 'Transaksi gagal di simpan, keranjang kosong!']);
    }

    function searchData($value, $array)
    {
        //
        foreach ($array as $index => $item) {
            if ($item['nama_barang'] === $value) {
                return array(
                    array(
                        'no' => 1,
                        'nama_barang' => $item['nama_barang'],
                        'qty' => $item['qty'],
                        'harga' => $item['harga'],
                        'aksi' => "<a href='#' class='btn btn-danger btn-sm' id='delete-item' data-row-id='" . $item['row_id'] . "'><i class='fa fa-trash'></i></a>"
                    )

                );
            }
        }
        return null;
    }
}
