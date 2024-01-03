<?php

namespace App\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Transaksi;
use App\Models\KategoriBarang;
use App\Models\DetailTransaksi;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;

class RiwayatTransaksi extends BaseController
{
    protected $transaksiModel, $detailTransaksiModel, $barangModel, $customerModel;

    public function __construct()
    {
        $this->transaksiModel = new Transaksi();
        $this->detailTransaksiModel = new DetailTransaksi();
        $this->barangModel = new Barang();
        $this->customerModel = new Customer();
    }

    public function getIndex()
    {
        return view('pages/transaksi/riwayat/index');
    }

    public function getJsonDataTransaksi()
    {
        $data = $this->transaksiModel->select('transaksi.id, transaksi.kode_transaksi, jenis_layanan, status, transaksi.created_at, customer.no_plat')->join('customer', 'customer.kode_transaksi = transaksi.kode_transaksi', 'left');
        return DataTable::of($data)->addNumbering('no')->add('status', function ($row) {
            if ($row->status == 'Belum Lunas')
                return '<span class="badge badge-warning">Belum Lunas</span>';
            elseif ($row->status == 'Lunas')
                return '<span class="badge badge-success">Lunas</span>';
        })->add('created_at', function ($row) {
            return date_format(date_create($row->created_at), "d F Y");
        })->add('aksi', function ($row) {
            $btn = "<a href='" . base_url('riwayatTransaksi/read/' . $row->id) . "' class='btn btn-primary btn-sm mx-1'><i class='fa-solid fa-eye'></i></a>";
            if ($row->status == 'Lunas') {
                $btn = $btn . "<a href='" . base_url('riwayatTransaksi/print/' . $row->id) . "' target='_blank' class='btn btn-success btn-sm mx-1'><i class='fa-solid fa-print'></i></a>";
            }
            return $btn;
        })->toJson(true);
    }

    public function getRead($id = null)
    {
        //
        $kategoriBarang = model(KategoriBarang::class)->findAll();
        $find = $this->transaksiModel->with('customer')->find($id);
        if ($id == null || $find == null) {
            return redirect()->back()->with('toast_error', 'Data tidak ditemukan!');
        }
        $data = [
            'transaksi' => $find,
            'kategori_barang' => $kategoriBarang
        ];
        if ($find->status == 'Belum Lunas') {
            if (auth()->user()->getGroups()[0] == 'pemilik') {
                return view('pages/transaksi/riwayat/read', $data);
            }
            return view('pages/transaksi/riwayat/edit', $data);
        } else {
            return view('pages/transaksi/riwayat/read', $data);
        }
    }

    public function getJsonDataItemKeranjang($kode_transaksi = null)
    {
        // 
        $data = $this->detailTransaksiModel->select('detail_transaksi.id, detail_transaksi.qty, detail_transaksi.total_harga, barang.nama as nama_barang, layanan_servis.nama as nama_jasa')->where('kode_transaksi', $kode_transaksi)->join('barang', 'barang.id=detail_transaksi.id_barang', 'left')->join('layanan_servis', 'layanan_servis.id=detail_transaksi.id_layanan_servis', 'left');
        // dd($data);
        return DataTable::of($data)->addNumbering('no')->add('total_harga', function ($row) {
            return "Rp" . number_format($row->total_harga, 2, ",", ".");
        })->add('nama', function ($row) {
            return ($row->nama_barang == null) ? $row->nama_jasa : $row->nama_barang;
        })->add('aksi', function ($row) {
            return "<a href='#' class='btn btn-danger btn-sm' id='delete-item' data-row-id='" . $row->id . "'><i class='fa fa-trash'></i></a>";
        })->toJson(true);
    }

    public function getJsonDataKeranjang($kode_transaksi = null)
    {
        $keranjang = $this->detailTransaksiModel->where('kode_transaksi', $kode_transaksi)->find();
        $data = [];
        $total_harga = 0;
        $total_qty = 0;
        $total_barang = 0;
        if (isset($keranjang)) {
            $total_barang = count($keranjang);
            foreach ($keranjang as $index => $item) {
                $total_qty += $item->qty;
                $total_harga += $item->total_harga;
            }
            $data = [
                'total_harga' => $total_harga,
                'total_qty' => $total_qty,
                'total_barang' => $total_barang
            ];
            return response()->setJSON(['data' => $data]);
        }
        return response()->setJSON(['data' => 'null']);
    }

    public function postTambahItemKeranjang()
    {
        //
        $kode_transaksi = $this->request->getVar('kode_transaksi');
        $id_barang = $this->request->getVar('id_barang');
        $id_layanan_servis = $this->request->getVar('id_servis');
        $qty = $this->request->getVar('qty');
        $harga = $this->request->getVar('harga');
        $data = [
            'kode_transaksi' => $kode_transaksi,
            'id_barang' => ($id_barang == null) ? null : $id_barang,
            'id_layanan_servis' => ($id_layanan_servis == null) ? null : $id_layanan_servis,
            'qty' => $qty,
            'total_harga' => $harga
        ];

        $find = $this->detailTransaksiModel->where('kode_transaksi', $kode_transaksi)->find();
        if (isset($find)) {
            $exist = 0;
            $jasa = 0;

            // Mengambil data detail_pembelian, ambil data qty dan harga
            foreach ($find as $item) {
                // Cek jika data id_barang sama dengan yang di inputkan
                if ($id_barang != null) {
                    if ($item->id_barang == $id_barang) {
                        // Menyiapkan data yang diperbarui
                        $data = [
                            'qty' => $item->qty + $qty,
                            'total_harga' => $item->total_harga + $harga,
                        ];
                        // menambahkan nilai exist
                        $exist++;
                    }
                }
                if ($id_layanan_servis != null) {
                    if ($item->id_layanan_servis == $id_layanan_servis) {
                        $jasa++;
                    }
                }
            }
            if ($id_barang != null) {
                // memperbarui stok barang
                $barang = $this->barangModel->find($id_barang);
                $stok_awal = $barang->jumlah_stok;
                $stok_baru = $stok_awal - $qty;
                $this->barangModel->updateStok($barang->id, $stok_baru);
            }

            if ($jasa == 0) {
                // jika exist 0 maka data di tambahkan, tp bila bukan, data di perbaharui
                if ($exist == 0) {
                    // simpan item keranjang
                    $res = $this->detailTransaksiModel->save($data);
                } else {
                    //memperbarui item keranjang
                    $res = $this->detailTransaksiModel->updateItem($data, $kode_transaksi, $id_barang);
                }
            } else {
                return response()->setJSON(['status' => false, 'message' => 'Item gagal di tambahkan, jasa sudah ada!']);
            }
        }
        if ($res) {
            return response()->setJSON(['status' => true, 'message' => 'Item berhasil di tambahkan!']);
        } else {
            return response()->setJSON(['status' => false, 'message' => 'Item gagal di tambahkan!']);
        }
    }

    public function getHapusItemKeranjang($id)
    {
        $find = $this->detailTransaksiModel->find($id);
        if ($id == null || $find == null) {
            return response()->setJSON(['message' => 'Data tidak ditemukan!'])->setStatusCode(404);
        }
        $result = $this->detailTransaksiModel->delete($id);
        if ($find->id_barang != null && $result) {
            $qty = $find->qty;
            $barang = $this->barangModel->find($find->id_barang);
            $stok_lama = $barang->jumlah_stok;
            $stok_baru = $stok_lama + $qty;
            $this->barangModel->updateStok($barang->id, $stok_baru);
        }
        if ($result) {
            return response()->setJSON(['status' => true, 'message' => 'Berhasil menghapus item keranjang!']);
        } else {
            return response()->setJSON(['status' => false, 'message' => 'Gagal menghapus item keranjang!']);
        }
    }

    public function getHapusTransaksi($kode_transaksi)
    {
        $transaksi = $this->transaksiModel->where('kode_transaksi', $kode_transaksi)->find();
        $keranjang = $this->detailTransaksiModel->where('kode_transaksi', $kode_transaksi)->find();
        if ($kode_transaksi == null || $transaksi == null || $keranjang == null) {
            return response()->setJSON(['message' => 'Data tidak ditemukan!'])->setStatusCode(404);
        }

        foreach ($keranjang as $item) {
            if ($item->id_barang != null) {
                $qty = $item->qty;
                $barang = $this->barangModel->find($item->id_barang);
                $stok_lama = $barang->jumlah_stok;
                $stok_baru = $stok_lama + $qty;
                $this->barangModel->updateStok($barang->id, $stok_baru);
            }
        }
        $res = $this->transaksiModel->deleteByKodeTransaksi($kode_transaksi);

        if ($res) {
            return redirect()->to('riwayatTransaksi')->with('success', 'Data transaksi berhasil di hapus!');
        } else {
            return redirect()->back()->with('toast_error', 'Data transaksi gagal di hapus!');
        }
    }

    public function postUpdateDataTransaksi()
    {
        $kode_transaksi = $this->request->getVar('kode_transaksi');
        $data = [
            'no_plat' => $this->request->getVar('no_plat'),
            'model_kendaraan' => $this->request->getVar('model_kendaraan'),
            'nama_pemilik' => $this->request->getVar('nama_pemilik'),
            'no_telp' => $this->request->getVar('no_telp')
        ];
        $res = $this->customerModel->updateByKodeTransaksi($kode_transaksi, $data);
        if ($res) {
            session()->setFlashdata('success', 'Transaksi berhasil di perbaharui!');
            return response()->setJSON(['status' => true, 'message' => 'Transaksi berhasil di perbaharui!']);
        } else {
            return response()->setJSON(['status' => false, 'message' => 'Transaksi gagal di perbaharui!']);
        }
    }

    public function postUpdateStatusTransaksi()
    {
        $kode_transaksi = $this->request->getVar('kode_transaksi');
        $total_dibayar = $this->request->getVar('total_dibayar');
        $total_uang = $this->request->getVar('total_uang');

        $data = [
            'total_dibayar' => $total_dibayar,
            'total_uang' => $total_uang,
            'status' => 'Lunas',
        ];

        $res = $this->transaksiModel->updateByKodeTransaksi($kode_transaksi, $data);
        if ($res) {
            session()->setFlashdata('success', 'Transaksi berhasil di perbaharui!');
            return response()->setJSON(['status' => true, 'message' => 'Transaksi berhasil di perbaharui!']);
        } else {
            return response()->setJSON(['status' => false, 'message' => 'Transaksi gagal di perbaharui!']);
        }
    }

    public function getPrint($id)
    {
        $find = $this->transaksiModel->with('customer')->with('user')->find($id);
        $keranjang = $this->detailTransaksiModel->where('kode_transaksi', $find->kode_transaksi)->with('barang')->with('layanan_servis')->find();
        if ($id == null || $find == null) {
            return redirect()->back()->with('toast_error', 'Data tidak ditemukan!');
        }
        $data = [
            'data' => $find,
            'keranjang' => $keranjang
        ];
        // dd($data);
        return view('pages/transaksi/print', $data);
    }
}
