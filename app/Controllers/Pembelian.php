<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Barang;
use App\Models\DetailPembelian;
use App\Models\KategoriBarang;
use App\Models\Pembelian as ModelsPembelian;
use App\Models\Supplier;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Hermawan\DataTables\DataTable;

class Pembelian extends BaseController
{
    protected $barangModel, $kategoriBarangModel, $supplierModel, $pembelianModel, $detailPembelianModel;

    public function __construct()
    {
        $this->barangModel = new Barang();
        $this->kategoriBarangModel = new KategoriBarang();
        $this->supplierModel = new Supplier();
        $this->pembelianModel = new ModelsPembelian();
        $this->detailPembelianModel = new DetailPembelian();
    }

    public function getIndex()
    {
        /*
        * To-Do
        * Menghitung total stok barang yang normal, sedikit dan kosong
        */

        $countDraft = count($this->pembelianModel->where('status', 'Menunggu Persetujuan')->find());
        $date = Carbon::now('Asia/Jakarta')->format('Ymd');
        $barang = $this->barangModel->with('supplier')->findAll();
        $getLast = count($this->pembelianModel->like('created_at', Carbon::now('Asia/Jakarta')->format('Y-m-d'))->find()) + 1;
        $kode = $date . $getLast;
        $kategoriBarang = $this->kategoriBarangModel->findAll();
        $supplier = $this->supplierModel->findAll();
        $data = [
            'date' => new DateTime(Carbon::now('Asia/Jakarta')->format('Ymd')),
            'kode' => $kode,
            'barang' => $barang,
            'kategori_barang' => $kategoriBarang,
            'supplier' => $supplier,
            'countDraft' => $countDraft
        ];
        return view('pages/pembelian/index', $data);
    }

    public function getJsonDataBarang($id = null)
    {

        if ($id != null) {
            $barang = $this->barangModel->select('barang.id, nama, jumlah_stok, id_kategori_barang, supplier.nama_supplier')->join('supplier', 'supplier.id = barang.id_supplier', 'inner')->where('id_supplier', $id);
        } else {
            $barang = $this->barangModel->select('barang.id, nama, jumlah_stok, id_kategori_barang, supplier.nama_supplier')->join('supplier', 'supplier.id = barang.id_supplier', 'inner');
        }
        // dd($barang);
        return DataTable::of($barang)->addNumbering("no")->hide('id')->hide('id_kategori_barang')->add('aksi', function ($row) {
            return "<a href='#' class='btn btn-info btn-sm' id='tambahItem' data-id='" . $row->id . "'><i class='fas fa-plus-square'></i></a>";
        })->toJson(true);
    }

    public function getReadItem($id = null)
    {
        $find = $this->barangModel->find($id);
        if ($id == null || $find == null) {
            return response()->setJSON(['message' => 'Data tidak ditemukan!']);
        }
        return response()->setJSON($find);
    }

    public function getJsonDataItemKeranjang()
    {
        $keranjang = session('keranjang');
        $no = 0;
        $dataKeranjang = [];
        $data = [];
        if (isset($keranjang)) {
            if (count($keranjang) > 0) {
                foreach ($keranjang as $item) {
                    $dataKeranjang[] = [
                        'no' => $no + 1,
                        'nama_barang' => $item['nama_barang'],
                        'qty' => $item['qty'],

                        'harga' => $item['harga'],
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
        $keranjang = session('keranjang');
        $data = [];
        $total_harga = 0;
        $total_qty = 0;
        $total_barang = 0;
        $id_supplier = '';
        if (isset($keranjang)) {
            $total_barang = count($keranjang);
            foreach ($keranjang as $index => $item) {
                $id_supplier = $keranjang[$index]['id_supplier'];
                $total_qty += $keranjang[$index]['qty'];
                $total_harga += $keranjang[$index]['harga'];
            }
            $data = [
                'supplier' => $id_supplier,
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
        //
        $id_barang = $this->request->getVar('id_barang');
        $nama_barang = $this->request->getVar('nama_barang');
        $qty = $this->request->getVar('qty');
        $harga = $this->request->getVar('harga');
        $row_id = md5($nama_barang . serialize($qty));
        $id_supplier = $this->request->getVar('supplier');

        $data = [
            $row_id => [
                'id_supplier' => $id_supplier,
                'id_barang' => $id_barang,
                'nama_barang' => $nama_barang,
                'qty' => (int)$qty,
                'harga' => (int)$harga,
                'row_id' => $row_id
            ]
        ];

        if (!session()->has('keranjang')) {
            session()->set('keranjang', $data);
        } else {
            $exist = 0;
            $keranjang = session('keranjang');

            foreach ($keranjang as $index => $item) {
                if ($keranjang[$index]['nama_barang'] == $nama_barang) {
                    $keranjang[$index]['qty'] += $qty;
                    $keranjang[$index]['harga'] += $harga;
                    $exist++;
                }
            }

            if ($exist == 0) {
                $keranjang_baru = array_merge_recursive($keranjang, $data);
                session()->set('keranjang', $keranjang_baru);
            } else {
                session()->set('keranjang', $keranjang);
            }
        }
        $keranjang = session('keranjang');
        // return response()->setJSON(['data' => $keranjang]);
        return response()->setJSON(['status' => 200, 'message' => 'Item berhasil di tambahkan!']);
    }

    // Fungsi untuk menghapus item dari keranjang
    public function getHapusItemKeranjang($row_id = null)
    {
        $keranjang_baru = session('keranjang');

        foreach ($keranjang_baru as $index => $item) {
            if ($keranjang_baru[$index]['row_id'] == $row_id) {
                unset($keranjang_baru[$index]);
            }
        }

        if (count($keranjang_baru) == 0) {
            session()->remove('keranjang');
            return response()->setJSON(['status' => 200, 'message' => 'Item berhasil di hapus dari keranjang!']);
        } else {
            session()->set('keranjang', $keranjang_baru);
            return response()->setJSON(['status' => 200, 'message' => 'Item berhasil di hapus dari keranjang!']);
        }
    }

    // Fungsi untuk menghapus keseluruhan item keranjang
    public function getHapusKeranjang()
    {
        session()->remove('keranjang');
        return response()->setJSON(['status' => 200, 'message' => 'Keranjang berhasil di kosongkan!']);
    }

    public function postSimpanDraft()
    {
        //
        $keranjang = session('keranjang');
        $kode_pembelian = $this->request->getVar('kode_pembelian');
        $total_barang = count($keranjang);
        $total_harga = 0;
        $total_order = 0;
        $id_supplier = "";
        $data = [];
        if (isset($keranjang)) {
            foreach ($keranjang as $index => $item) {
                $id_supplier = $item['id_supplier'];
                $total_harga += $item['harga'];
                $total_order += $item['qty'];
                $data[] = [
                    'kode_pembelian' => $kode_pembelian,
                    'id_barang' => $item['id_barang'],
                    'jumlah' => $item['qty'],
                    'total_harga' => $item['harga']
                ];
            }
            $this->pembelianModel->save([
                'kode_pembelian' => $kode_pembelian,
                'id_supplier' => $id_supplier,
                'jumlah_order' => $total_barang,
                'total_harga' => $total_harga
            ]);
            foreach ($data as $item) {
                $this->detailPembelianModel->insert($item);
            }
            session()->remove('keranjang');
            session()->setFlashdata('success', 'Draft berhasil di simpan!');
            return response()->setJSON(['message' => 'Draft berhasil di simpan!']);
        }
        return response()->setJSON(['message' => 'Draft gagal di simpan, keranjang kosong!']);
        //
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
