<?php

namespace App\Controllers\Manajemen;

use App\Controllers\BaseController;
use App\Models\KategoriBarang as ModelsKategoriBarang;
use Hermawan\DataTables\DataTable;

class KategoriBarang extends BaseController
{
    protected $kategoriBarangModel;

    public function __construct()
    {
        $this->kategoriBarangModel = new ModelsKategoriBarang();
    }

    public function getIndex()
    {
        $data = [
            'kategori' => $this->kategoriBarangModel->findAll(),
            'no' => 0
        ];
        return view('pages/manajemen/kategori_barang/index', $data);
    }

    public function getJsonDataTable()
    {
        $data = $this->kategoriBarangModel->select('id, kategori_barang');
        return DataTable::of($data)->addNumbering()->hide('id')->add('aksi', function ($row) {
            $btn = "<a href='#' id='edit' data-id='" . $row->id . "' class='mx-1 btn btn-warning btn-sm'><i class='fas fa-edit'></i></a>";
            $btn = $btn . "<a href='#' id='delete' data-id='" . $row->id . "' class='mx-1 btn btn-danger btn-sm'><i class='fas fa-trash'></i></a>";
            return $btn;
        })->toJson();
    }

    public function getJsonRead($id = null)
    {
        if (!$this->request->isAJAX()) {
            return response()->setJSON(['message' => 'Not AJAX request!']);
        }
        $find = $this->kategoriBarangModel->find($id);
        if ($find == null) {
            return response()->setJSON(['status' => 404, 'message' => 'Data tidak ditemukan'])->setStatusCode(404, 'Data tidak ditemukan');
        }
        return response()->setJSON($find)->setStatusCode(200);
    }

    public function postSave()
    {
        $data = [
            'kategori_barang' => $this->request->getPost('nama_kategori')
        ];
        if (!$this->kategoriBarangModel->validate($data)) {
            session()->setFlashdata('errors', $this->kategoriBarangModel->getValidationMessages());
            return redirect()->back()->with('toast_error', 'Data Gagal Di Tambahkan')->withInput();
        }
        $this->kategoriBarangModel->save($data);
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function postUpdate($id = null)
    {
        $id = $this->request->getPost('id');
        $find = $this->kategoriBarangModel->find($id);
        if ($id == null && $find == null) {
            return response()->setJSON(['status' => 404, 'reason' => 'Data tidak ditemukan'])->setStatusCode(404, 'Data tidak ditemukan');
        }
        $data = ['kategori_barang' => $this->request->getPost('nama_kategori')];
        $update = $this->kategoriBarangModel->update($id, $data);

        return response()->setJSON([$find, $update]);
    }

    public function getDelete($id = null)
    {
        if (!$this->request->isAJAX()) {
            return response()->setJSON(['message' => 'Not AJAX Request!']);
        }
        $cek = $this->kategoriBarangModel->find($id);
        if ($cek == null) {
            return response()->setJSON(['status' => '404', 'message' => 'Data tidak ditemukan!'])->setStatusCode(404);
        }
        $this->kategoriBarangModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus!');
        return response()->setJSON(['status' => '200', 'message' => 'Data berhasil dihapus!'])->setStatusCode(200);
    }
}
