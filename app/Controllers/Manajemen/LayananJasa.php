<?php

namespace App\Controllers\Manajemen;

use App\Controllers\BaseController;
use App\Models\LayananJasa as ModelsLayananJasa;
use Hermawan\DataTables\DataTable;

class LayananJasa extends BaseController
{
    protected $layananServiceModel;

    public function __construct()
    {
        $this->layananServiceModel = new ModelsLayananJasa();
    }

    public function getIndex()
    {
        return view('pages/manajemen/layanan_jasa/index');
    }

    public function getJsonDataTable()
    {
        $data = $this->layananServiceModel->select('id, nama, harga, deskripsi');
        return DataTable::of($data)->addNumbering()->hide('id')->hide('deskripsi')->add('aksi', function ($row) {
            $btn = "<a href='' id='edit' data-id='" . $row->id . "' class='mx-1 btn btn-warning btn-sm'><i class='fas fa-edit'></i></a>";
            $btn = $btn . "<a href='#' id='delete' data-id='" . $row->id . "' class='mx-1 btn btn-danger btn-sm'><i class='fas fa-trash'></i></a>";
            return $btn;
        })->toJson();
    }

    public function postSave()
    {
        if (!$this->request->isAJAX()) {
            return response()->setJSON(['message' => 'Not AJAX request!']);
        }
        $data = [
            'nama' => $this->request->getPost('nama_layanan'),
            'harga' => $this->request->getPost('harga_layanan'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];

        if (!$this->layananServiceModel->validate($data)) {
            session()->setFlashdata('errors', $this->layananServiceModel->errors());
            return response()->setJSON(['status' => 200, 'errors' => $this->layananServiceModel->errors()]);
        }
        $this->layananServiceModel->save($data);
        return response()->setJSON(['status' => 200, 'success' => 'Data Berhasil di Tambahkan!']);
    }

    public function getRead($id = null)
    {
        if (!$this->request->isAJAX()) {
            return response()->setJSON(['message' => 'Not AJAX request!']);
        }
        $find = $this->layananServiceModel->find($id);
        if ($id == null || $find == null) {
            return response()->setJSON(['status_code' => 404, 'message' => 'Data tidak di temukan!'])->setStatusCode(404, "Data tidak di temukan!");
        }
        return response()->setJSON($find)->setStatusCode(200);
    }

    public function postUpdate($id = null)
    {
        if (!$this->request->isAJAX()) {
            return response()->setJSON(['message' => 'Not AJAX request!']);
        }
        $find = $this->layananServiceModel->find($id);
        if ($id == null || $find == null) {
            return response()->setJSON(['status_code' => 404, 'message' => 'Data tidak di temukan!'])->setStatusCode(404, "Data tidak di temukan!");
        }
        $data = [
            'nama' => $this->request->getPost('nama_layanan'),
            'harga' => $this->request->getPost('harga_layanan'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];

        if (!$this->layananServiceModel->validate($data)) {
            session()->setFlashdata('errors', $this->layananServiceModel->errors());
            return response()->setJSON(['status' => 200, 'errors' => $this->layananServiceModel->errors()]);
        }
        $this->layananServiceModel->update($id, $data);
        return response()->setJSON(['status' => 200, 'success' => 'Data Berhasil di Perbaharui!']);
    }

    public function getDelete($id = null)
    {
        if (!$this->request->isAJAX()) {
            return response()->setJSON(['message' => 'Not AJAX Request!']);
        }
        $find = $this->layananServiceModel->find($id);
        if ($id == null || $find == null) {
            return response()->setJSON(['status' => 404, 'message' => 'Data tidak ditemukan!'])->setStatusCode(404);
        }
        $this->layananServiceModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus!');
        return response()->setJSON(['status' => '200', 'message' => 'Data berhasil dihapus!'])->setStatusCode(200);
    }
}
