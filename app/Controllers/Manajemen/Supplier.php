<?php

namespace App\Controllers\Manajemen;

use App\Controllers\BaseController;
use App\Models\Supplier as ModelsSupplier;
use CodeIgniter\Validation\Validation;
use Hermawan\DataTables\DataTable;
use Irsyadulibad\DataTables\DataTables;

// use Config\Validation;

class Supplier extends BaseController
{
    protected $supplierModel;

    public function __construct()
    {
        $this->supplierModel = new ModelsSupplier();
    }

    public function getIndex()
    {
        $data = [
            'data' => $this->supplierModel->findAll(),
            'no' => 0
        ];
        return view('pages/manajemen/supplier/index', $data);
    }

    public function getJsonDataTable()
    {

        $data = $this->supplierModel->select('id, kode_supplier, nama_supplier, no_telp');
        return DataTable::of($data)->addNumbering()->hide('id')->add('aksi', function ($row) {
            $btn = "<a href='" . base_url('manajemen/supplier/read/' . $row->id) . "' class='mx-1 btn btn-warning btn-sm'><i class='fas fa-eye'></i></a>";
            $btn = $btn . "<a href='#' id='delete' data-id='" . $row->id . "' class='mx-1 btn btn-danger btn-sm'><i class='fas fa-trash'></i></a>";
            return $btn;
        })->toJson();
    }

    public function getCreate()
    {
        return view('pages/manajemen/supplier/create');
    }

    public function postSave()
    {
        $data = [
            'kode_supplier' => $this->request->getPost('kode_supplier'),
            'nama_supplier' => $this->request->getPost('nama_supplier'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telp' => $this->request->getPost('no_telp'),
        ];
        if (!$this->supplierModel->validate($data)) {
            session()->setFlashdata('errors', $this->supplierModel->errors());
            return redirect()->back()->with('toast_error', 'Data gagal di tambahkan!')->withInput();
        }
        $this->supplierModel->save($data);
        return redirect()->to('manajemen/supplier')->with('success', 'Data berhasil di tambahkan!');
    }

    public function getRead($id = null)
    {
        $find = $this->supplierModel->find($id);
        if ($id == null || $find == null) {
            return redirect()->back()->with('toast_error', 'Data tidak ditemukan!');
        }
        $data = ['data' => $find];
        return view('pages/manajemen/supplier/read', $data);
    }

    public function getEdit($id = null)
    {
        $find = $this->supplierModel->find($id);
        if ($id == null || $find == null) {
            return redirect()->back()->with('toast_error', 'Data tidak ditemukan!');
        }
        $data = ['data' => $find];
        return view('pages/manajemen/supplier/edit', $data);
    }

    public function postUpdate($id = null)
    {
        $find = $this->supplierModel->find($id);
        if ($id == null || $find == null) {
            return redirect()->back()->with('toast_error', 'Data tidak ditemukan!');
        }
        $data = [
            'kode_supplier' => $this->request->getPost('kode_supplier'),
            'nama_supplier' => $this->request->getPost('nama_supplier'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telp' => $this->request->getPost('no_telp'),
        ];
        $validation = ['kode_supplier' => "required|is_unique[supplier.kode_supplier,id,$id]"];
        $this->supplierModel->setValidationRules($validation);
        if (!$this->supplierModel->validate($data)) {
            session()->setFlashdata('errors', $this->supplierModel->errors());
            return redirect()->back()->with('toast_error', 'Data gagal di perbaharui!')->withInput();
        }
        $this->supplierModel->update($id, $data);
        return redirect()->to('manajemen/supplier')->with('success', 'Data berhasil di perbaharui!');
    }

    public function getDelete($id = null)
    {
        if (!$this->request->isAJAX()) {
            return response()->setJSON(['message' => 'Not AJAX Request!']);
        }
        $find = $this->supplierModel->find($id);
        if ($id == null || $find == null) {
            return response()->setJSON(['status' => '404', 'message' => 'Data tidak ditemukan!'])->setStatusCode(404);
        }
        $this->supplierModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus!');
        return response()->setJSON(['status' => '200', 'message' => 'Data berhasil dihapus!'])->setStatusCode(200);
    }
}
