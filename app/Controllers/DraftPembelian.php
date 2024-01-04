<?php

namespace App\Controllers;

use App\Models\DetailPembelian;
use App\Models\Pembelian as ModelsPembelian;
use App\Controllers\BaseController;
use App\Models\Barang;
use Hermawan\DataTables\DataTable;

class DraftPembelian extends BaseController
{
    protected $pembelianModel, $detailPembelianModel, $barangModel;

    public function __construct()
    {

        $this->barangModel = new Barang();
        $this->pembelianModel = new ModelsPembelian();
        $this->detailPembelianModel = new DetailPembelian();
    }
    public function getIndex()
    {
        $countStokNormal = count($this->barangModel->where('jumlah_stok >', '20')->find());
        $countStokMenipis = count($this->barangModel->where('jumlah_stok <', '15')->find());
        $countStokHabis = count($this->barangModel->where('jumlah_stok =', '0')->find());
        $countDraft = count($this->pembelianModel->where('status', 'Menunggu Persetujuan')->find());
        $data = [
            'countDraft' => $countDraft,
            'countStokNormal' => $countStokNormal,
            'countStokMenipis' => $countStokMenipis,
            'countStokHabis' => $countStokHabis,
        ];
        return view('pages/pembelian/draft/index', $data);
    }

    public function getJsonDataPembelian()
    {
        $data = $this->pembelianModel->select('pembelian.id, kode_pembelian, supplier.nama_supplier, jumlah_order, total_harga, status, pembelian.created_at')->join('supplier', 'supplier.id = pembelian.id_supplier', 'inner')->orderBy('pembelian.created_at', 'DESC');
        return DataTable::of($data)->addNumbering("no")->hide('id')->add('tanggal', function ($row) {
            return date_format(date_create($row->created_at), "d F Y");
        })->add('status', function ($row) {
            if ($row->status == 'Menunggu Persetujuan') {
                return '<span class="badge text-body bg-secondary">Menunggu Persetujuan</span>';
            } else if ($row->status == 'Disetujui') {
                return '<span class="badge bg-success">Disetujui</span>';
            } else if ($row->status == 'Ditolak') {
                return '<span class="badge bg-warning">Ditolak</span>';
            }
        })->add('aksi', function ($row) {
            return "<a href='" . base_url('draftpembelian/read/' . $row->id) . "' class='btn btn-primary btn-sm'><i class='fas fa-eye'></i></a>";
        })->toJson(true);
    }

    public function getRead($id = null)
    {
        $find = $this->pembelianModel->with('detail_pembelian')->with('supplier')->find($id);
        if ($id == null || $find == null) {
            return redirect()->back()->with('toast_error', 'Data tidak ditemukan!');
        }
        $countDraft = count($this->pembelianModel->where('status', 'Menunggu Persetujuan')->find());
        $countStokNormal = count($this->barangModel->where('jumlah_stok >', '20')->find());
        $countStokMenipis = count($this->barangModel->where('jumlah_stok <', '15')->find());
        $countStokHabis = count($this->barangModel->where('jumlah_stok =', '0')->find());

        $data = [
            'countDraft' => $countDraft,
            'countStokNormal' => $countStokNormal,
            'countStokMenipis' => $countStokMenipis,
            'countStokHabis' => $countStokHabis,
            'pembelian' => $find
        ];
        if ($find->status == 'Menunggu Persetujuan') {
            if (auth()->user()->getGroups()[0] == 'pemilik') {
                return view('pages/pembelian/draft/read', $data);
            }
            return view('pages/pembelian/draft/edit', $data);
        } else {
            return view('pages/pembelian/draft/read', $data);
        }
    }

    public function getJsonKeranjang($kode_pembelian = null)
    {
        //
        $data = $this->detailPembelianModel->select('detail_pembelian.id, kode_pembelian, jumlah, total_harga, barang.nama')->where('kode_pembelian', $kode_pembelian)->join('barang', 'barang.id = detail_pembelian.id_barang', 'inner');
        return DataTable::of($data)->addNumbering("no")->hide('id')->add('harga', function ($row) {
            return "Rp" . number_format($row->total_harga, 2, ",", ".");
        })->add('aksi', function ($row) {
            return "<a href='#' class='btn btn-danger btn-sm' id='delete-item' data-row-id='" . $row->id . "'><i class='fa fa-trash'></i></a>";
        })->toJson(true);
        // dd($data);
    }

    public function getJsonDraftKeranjang($kode_pembelian = null)
    {
        $data = $this->detailPembelianModel->select('detail_pembelian.id, kode_pembelian, jumlah, total_harga, barang.nama')->where('kode_pembelian', $kode_pembelian)->join('barang', 'barang.id = detail_pembelian.id_barang', 'inner');
        return DataTable::of($data)->addNumbering("no")->hide('id')->add('harga', function ($row) {
            return "Rp" . number_format($row->total_harga, 2, ",", ".");
        })->toJson(true);
    }

    public function getJsonDataKeranjang($kode_pembelian = null)
    {
        $keranjang = $this->detailPembelianModel->where('kode_pembelian', $kode_pembelian)->find();
        $data = [];
        $total_harga = 0;
        $total_qty = 0;
        $total_barang = 0;
        if (isset($keranjang)) {
            $total_barang = count($keranjang);
            foreach ($keranjang as $index => $item) {
                $total_qty += $item->jumlah;
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
        $kode_pembelian = $this->request->getVar('kode_pembelian');
        $id_barang = $this->request->getVar('id_barang');
        $qty = $this->request->getVar('qty');
        $harga = $this->request->getVar('harga');
        $data = [
            'kode_pembelian' => $kode_pembelian,
            'id_barang' => $id_barang,
            'jumlah' => $qty,
            'total_harga' => $harga
        ];

        $find = $this->detailPembelianModel->where('kode_pembelian', $kode_pembelian)->find();
        if (isset($find)) {
            $exist = 0;

            // Mengambil data detail_pembelian, ambil data qty dan harga
            foreach ($find as $item) {
                // Cek jika data id_barang sama dengan yang di inputkan
                if ($item->id_barang == $id_barang) {
                    // Menyiapkan data yang diperbarui
                    $data = [
                        'jumlah' => $item->jumlah + $qty,
                        'total_harga' => $item->total_harga + $harga,
                    ];
                    // menambahkan nilai exist
                    $exist++;
                }
            }
            // jika exist 0 maka data di tambahkan, tp bila bukan, data di perbaharui
            if ($exist == 0) {
                $res = $this->detailPembelianModel->save($data);
            } else {
                $res = $this->detailPembelianModel->updateItem($data, $kode_pembelian, $id_barang);
            }
        }
        if ($res) {
            return response()->setJSON(['message' => 'Item berhasil di tambahkan!']);
        } else {
            return response()->setJSON(['message' => 'Item gagal di tambahkan!']);
        }
    }

    public function getHapusItemKeranjang($id)
    {
        $find = $this->detailPembelianModel->find($id);
        if ($id == null || $find == null) {
            return response()->setJSON(['message' => 'Data tidak ditemukan!'])->setStatusCode(404);
        }
        $result = $this->detailPembelianModel->delete($id);
        if ($result) {
            return response()->setJSON(['message' => 'Berhasil menghapus item keranjang!', 'data' => $find]);
        } else {
            return response()->setJSON(['message' => 'Gagal menghapus item keranjang!']);
        }
    }

    public function getHapusDraft($kode_pembelian = null)
    {
        $pembelian = $this->pembelianModel->where('kode_pembelian', $kode_pembelian)->find();
        $keranjang = $this->detailPembelianModel->where('kode_pembelian', $kode_pembelian)->find();

        if ($kode_pembelian == null || $pembelian == null || $keranjang == null) {
            return response()->setJSON(['message' => 'Data tidak ditemukan!'])->setStatusCode(404);
        }
        $res = $this->pembelianModel->deleteByKodePembelian($kode_pembelian);
        if ($res) {
            // return response()->setJSON(['message' => 'Draft berhasil di hapus!']);
            return redirect()->to('draftpembelian')->with('success', 'Draft berhasil di hapus!');
        } else {
            // return response()->setJSON(['message' => 'Draft gagal di hapus!']);
            return redirect()->back()->with('toast_error', 'Draft pembelian gagal di hapus!');
        }
    }

    public function postUpdateDraft($id)
    {
        $find = $this->pembelianModel->find($id);
        if ($find == null || $id == null) {
            return redirect()->back()->with('toast_error', 'Data tidak ditemukan!');
        }
        $total_harga = $this->request->getVar('total_harga');
        $jumlah_order = $this->request->getVar('total_order');
        $res = $this->pembelianModel->update($id, [
            'jumlah_order' => $jumlah_order,
            'total_harga' => $total_harga
        ]);
        if ($res) {
            session()->setFlashdata('success', 'Draft berhasil di perbaharui!');
            return response()->setJSON(['message' => 'Draft berhasil di perbaharui!']);
        } else {
            session()->setFlashdata('toast_error', 'Draft gagal di perbaharui!');
            return response()->setJSON(['message' => 'Draft gagal di perbaharui!']);
        }
    }

    public function getUpdateStatusDraft($id = null, $status = null)
    {
        //
        $find = $this->pembelianModel->find($id);
        if ($find == null || $id == null) {
            return redirect()->back()->with('toast_error', 'Data tidak ditemukan!');
        }
        $res = $this->pembelianModel->update($id, [
            'status' => ($status) ? 'Disetujui' : 'Ditolak'
        ]);
        if ($res) {
            return redirect()->to('draftpembelian')->with('success', 'Status draft berhasil di perbaharui!');
        } else {
            return redirect()->back()->with('toast_error', 'Status draft gagal di perbaharui!');
        }
    }

    public function getPrint($id)
    {
        $find = $this->pembelianModel->with('detail_pembelian')->with('supplier')->find($id);
        $keranjang = $this->detailPembelianModel->where('kode_pembelian', $find->kode_pembelian)->with('barang')->find();
        if ($id == null || $find == null) {
            return redirect()->back()->with('toast_error', 'Data tidak ditemukan!');
        }
        $total_qty = 0;
        if (isset($keranjang)) {
            foreach ($keranjang as $index => $item) {
                $total_qty += $item->jumlah;
            }
        }
        $data = ['data' => $find, 'keranjang' => $keranjang, 'total_item' => $total_qty];
        return view('pages/pembelian/draft/print', $data);
    }
}
