<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Identitas;

class Editor extends BaseController
{
    protected $editorModel;

    public function __construct()
    {
        $this->editorModel = new Identitas();
    }

    public function getIndex()
    {
        $data = ['editor' => $this->editorModel->select('*')];
        // dd($data['editor']->where('type', 'section1-headline')->first()->id);
        return view('pages/editor/index', $data);
    }

    public function getRead($id = null)
    {
        if (!$this->request->isAJAX()) {
            return response()->setJSON(['message' => 'Not AJAX request!']);
        }
        $find = $this->editorModel->find($id);
        if ($id == null || $find == null) {
            return response()->setJSON(['status' => 404, 'message' => 'Data tidak ditemukan'])->setStatusCode(404, 'Data tidak ditemukan');
        }
        return response()->setJSON($find)->setStatusCode(200);
    }

    public function postSetVisibility($id = null)
    {
        if (!$this->request->isAJAX()) {
            return response()->setJSON(['message' => 'Not AJAX request!']);
        }
        $find = $this->editorModel->find($id);
        if ($id == null || $find == null) {
            return response()->setJSON(['status' => 404, 'message' => 'Data tidak ditemukan'])->setStatusCode(404, 'Data tidak ditemukan');
        }
        $data = [
            'visibility' => $this->request->getPost('visibility')
        ];

        $res = $this->editorModel->update($id, $data);
        if ($res) {
            session()->setFlashdata('toast_success', 'Section berhasil di perbaharui!');
            return response()->setJSON(['status_code' => 200, 'message' => 'Data berhasil di perbaharui!']);
        }
        session()->setFlashdata('toast_error', 'Section gagal di perbaharui!');
        return response()->setJSON(['status_code' => 200, 'message' => 'Data gagal di perbaharui!']);
    }

    public function postSaveItem()
    {
        if (!$this->request->isAJAX()) {
            return response()->setJSON(['message' => 'Not AJAX request!']);
        }
        $file = $this->request->getFile('upload_file');
        $fileName = "";
        if ($file->getFilename() != null) {
            $rules = [
                'upload_file' => [
                    'rules' => 'uploaded[upload_file]|mime_in[upload_file,image/jpg,image/jpeg,image/gif,image/png]|max_size[upload_file,2048]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                return response()->setJSON(['status_code' => 200, 'message' => 'File wajib di upload!']);
            }

            $fileName = $file->getRandomName();
            if (!$file->hasMoved()) {
                $file->move('uploads/images/', $fileName);
            }
        }
        $data = [
            'type' => $this->request->getPost('type'),
            'data' => json_encode([
                'title' => $this->request->getPost('title'),
                'subtitle' => $this->request->getPost('subtitle'),
                'small' => $this->request->getPost('small'),
                'image' => $fileName
            ]),
            'visibility' => 1,
        ];
        $res = $this->editorModel->save($data);
        if ($res) {
            session()->setFlashdata('toast_success', 'Item berhasil di tambahkan!');
            return response()->setJSON(['status_code' => 200, 'message' => 'Item berhasil di tambahkan!']);
        }
        session()->setFlashdata('toast_error', 'Item gagal di tambahkan!');
        return response()->setJSON(['status_code' => 200, 'message' => 'Item gagal di tambahkan!']);
    }

    public function postUpdateItem($id = null)
    {
        if (!$this->request->isAJAX()) {
            return response()->setJSON(['message' => 'Not AJAX request!']);
        }
        $find = $this->editorModel->find($id);
        if ($id == null || $find == null) {
            return response()->setJSON(['status' => 404, 'message' => 'Data tidak ditemukan'])->setStatusCode(404, 'Data tidak ditemukan');
        }
        $file = $this->request->getFile('upload_file');
        $fileName = "";
        if (isset(json_decode($find->data)->image)) {
            $fileName = json_decode($find->data)->image;
        }
        $data = [
            'type' => $this->request->getPost('type'),
            'data' => json_encode([
                'title' => $this->request->getPost('title'),
                'subtitle' => $this->request->getPost('subtitle'),
                'small' => $this->request->getPost('small'),
                'icon' => $this->request->getPost('icon'),
                'image' => $fileName,
            ]),
            'visibility' => 1,
        ];
        if ($file->getFilename() != null) {
            $rules = [
                'upload_file' => [
                    'rules' => 'uploaded[upload_file]|mime_in[upload_file,image/jpg,image/jpeg,image/gif,image/png]|max_size[upload_file,2048]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                return response()->setJSON(['status_code' => 200, 'message' => 'File wajib di upload!']);
            }

            $fileName = $file->getRandomName();
            if (!$file->hasMoved()) {
                $file->move('uploads/images/', $fileName);
            }
            $data = [
                'type' => $this->request->getPost('type'),
                'data' => json_encode([
                    'title' => $this->request->getPost('title'),
                    'subtitle' => $this->request->getPost('subtitle'),
                    'small' => $this->request->getPost('small'),
                    'icon' => $this->request->getPost('icon'),
                    'image' => $fileName
                ]),
                'visibility' => 1,
            ];
        }
        // return response()->setJSON($data);
        $res = $this->editorModel->update($id, $data);
        if ($res) {
            session()->setFlashdata('toast_success', 'Item berhasil di perbaharui!');
            return response()->setJSON(['status_code' => 200, 'message' => 'Item berhasil di perbaharui!']);
        }
        session()->setFlashdata('toast_error', 'Item gagal di perbaharui!');
        return response()->setJSON(['status_code' => 200, 'message' => 'Item gagal di perbaharui!']);
    }

    public function postUpdateSection($id = null)
    {
        if (!$this->request->isAJAX()) {
            return response()->setJSON(['message' => 'Not AJAX request!']);
        }
        $find = $this->editorModel->find($id);
        if ($id == null || $find == null) {
            return response()->setJSON(['status' => 404, 'message' => 'Data tidak ditemukan'])->setStatusCode(404, 'Data tidak ditemukan');
        }
        $data = [
            'type' => $this->request->getPost('type'),
            'data' => json_encode([
                'title' => $this->request->getPost('title'),
                'subtitle' => $this->request->getPost('subtitle'),
            ]),
            'visibility' => 1,
        ];
        $res = $this->editorModel->update($id, $data);
        if ($res) {
            session()->setFlashdata('toast_success', 'Section berhasil di perbaharui!');
            return response()->setJSON(['status_code' => 200, 'message' => 'Section berhasil di perbaharui!']);
        }
        session()->setFlashdata('toast_error', 'Section gagal di perbaharui!');
        return response()->setJSON(['status_code' => 200, 'message' => 'Section gagal di perbaharui!']);
    }

    public function getDeleteItemSection($id = null)
    {
        if (!$this->request->isAJAX()) {
            return response()->setJSON(['message' => 'Not AJAX request!']);
        }
        $find = $this->editorModel->find($id);
        if ($id == null || $find == null) {
            return response()->setJSON(['status' => 404, 'message' => 'Data tidak ditemukan'])->setStatusCode(404, 'Data tidak ditemukan');
        }
        $res = $this->editorModel->delete($id);
        if ($res) {
            session()->setFlashdata('toast_success', 'Item berhasil di hapus!');
            return response()->setJSON(['status_code' => 200, 'message' => 'Item berhasil di hapus!']);
        }
        session()->setFlashdata('toast_error', 'Item gagal di hapus!');
        return response()->setJSON(['status_code' => 200, 'message' => 'Item gagal di hapus!']);
    }
}
