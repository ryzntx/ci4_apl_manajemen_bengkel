<?php

namespace App\Controllers\Manajemen;

use App\Controllers\BaseController;
use App\Models\Barang as ModelsBarang;
use App\Models\Supplier as ModelsSupplier;
use App\Models\KategoriBarang;
use Hermawan\DataTables\DataTable;

class Barang extends BaseController
{
    protected $kategoribarangModel, $barangModel, $supplierModel;

    public function __construct()
    {
        $this->kategoribarangModel = new KategoriBarang();
        $this->barangModel = new ModelsBarang();
        $this->supplierModel = new ModelsSupplier();
    }

    public function getIndex(): string
    {
        return view('pages/manajemen/barang/index');
    }

    public function getJsonDataTable()
    {
        $data = $this->barangModel->select('id, kode_barang, nama, jumlah_stok, harga_jual');
        return DataTable::of($data)->addNumbering()->hide('id')->add('aksi', function ($row) {
            $btn = "<a href='" . base_url('manajemen/barang/read/' . $row->id) . "' class='mx-1 btn btn-warning btn-sm'><i class='fas fa-eye'></i></a>";
            $btn = $btn . "<a href='#' id='delete' data-id='" . $row->id . "' class='mx-1 btn btn-danger btn-sm'><i class='fas fa-trash'></i></a>";
            return $btn;
        })->toJson();
    }

    public function getCreate(): string
    {
        $kategori = $this->kategoribarangModel->findAll();
        $supplier = $this->supplierModel->findAll();
        $data = [
            'kode_barang' => "DSM" . (string)mt_rand(11111111, 99999999),
            'kategori' => $kategori,
            'supplier' => $supplier
        ];
        return view('pages/manajemen/barang/create', $data);
    }

    public function postSave()
    {
        $data = [
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama' => $this->request->getPost('nama_barang'),
            'merek_barang' => $this->request->getPost('merek_barang'),
            'jumlah_stok' => $this->request->getPost('jumlah_stok'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'id_supplier' => $this->request->getPost('supplier'),
            'id_kategori_barang' => $this->request->getPost('kategori_barang'),
        ];
        $this->barangModel->setValidationRule('harga_jual', "required|numeric|greater_than[" . (int)$this->request->getVar('harga_beli') . "]");
        if (!$this->barangModel->validate($data)) {
            session()->setFlashdata('errors', $this->barangModel->errors());
            return redirect()->back()->with('toast_error', 'Data gagal di simpan!')->withInput();
        }
        $this->barangModel->save($data);
        return redirect()->to('manajemen/barang')->with('success', 'Data berhasil di simpan!');
    }

    public function getRead($id = null)
    {
        $find = $this->barangModel->with('kategori_barang')->with('supplier')->find($id);
        if ($id == null || $find == null) {
            return redirect()->back()->with('toast_error', 'Data tidak di temukan!');
        }
        $data = [
            'barang' => $find,
            'kategori_barang'

        ];
        return view('pages/manajemen/barang/read', $data);
    }

    public function getEdit($id = null): string
    {
        $find = $this->barangModel->find($id);
        if ($id == null || $find == null) {
            return redirect()->back()->with('toast_error', 'Data tidak di temukan!');
        }
        $kategori = $this->kategoribarangModel->findAll();
        $supplier = $this->supplierModel->findAll();
        $data = [
            'barang' => $find,
            'kategori' => $kategori,
            'supplier' => $supplier
        ];
        return view('pages/manajemen/barang/edit', $data);
    }

    public function postUpdate($id = null)
    {
        $find = $this->barangModel->find($id);
        if ($id == null || $find == null) {
            return redirect()->back()->with('toast_error', 'Data tidak di temukan!');
        }
        $data = [
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama' => $this->request->getPost('nama_barang'),
            'merek_barang' => $this->request->getPost('merek_barang'),
            'jumlah_stok' => $this->request->getPost('jumlah_stok'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'id_supplier' => $this->request->getPost('supplier'),
            'id_kategori_barang' => $this->request->getPost('kategori_barang'),
        ];
        $validation = ['kode_barang' => "required|is_unique[barang.kode_barang,id,$id]"];
        $this->barangModel->setValidationRules($validation);
        if (!$this->barangModel->validate($data)) {
            session()->setFlashdata('errors', $this->barangModel->errors());
            return redirect()->back()->with('toast_error', 'Data gagal di simpan!')->withInput();
        }
        $this->barangModel->update($id, $data);
        return redirect()->to('manajemen/barang')->with('success', 'Data berhasil di perbaharui!');
    }

    public function getDelete($id = null)
    {
        $find = $this->barangModel->find($id);
        if ($id == null || $find == null) {
            return redirect()->back()->with('toast_error', 'Data tidak di temukan!');
        }
        $this->barangModel->delete($id);
        return redirect()->to('manajemen/barang')->with('success', 'Data berhasil di hapus!');
    }
}
