<?php

namespace App\Controllers\Manajemen;

use App\Controllers\BaseController;
use App\Models\GroupModel;
use App\Models\UserModel;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserIdentityModel;


class Pegawai extends BaseController
{
    protected $userModel, $userIdentityModel, $groupModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userIdentityModel = new UserIdentityModel();
        $this->groupModel = new GroupModel;
    }
    public function getIndex()
    {
        $data = ['data' => $this->userModel->withIdentities()->findAll(), 'no' => 0, 'group' => $this->groupModel, 'identities' => $this->userIdentityModel];
        return view('pages/manajemen/pegawai/index', $data);
    }

    public function getJsonDataTable()
    {
        $data = $this->userModel->withIdentities()->findAll();
        dd($data);
        // return DataTable::of($data)->addNumbering()->toJson();
    }

    public function getCreate()
    {
        return view('pages/manajemen/pegawai/create');
    }

    public function postSave()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
        ];
        $dataGroup = $this->request->getPost('jabatan');

        $rules = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama wajib di isi!'
                ]
            ],
            'username' => [
                'rules' => 'required|is_unique[users.username]|max_length[30]|min_length[3]|regex_match[/\A[a-zA-Z0-9\.]+\z/]',
                'errors' => [
                    'required' => 'Nama Pengguna wajib di isi!',
                    'is_unique' => 'Nama Pengguna sudah terpakai!, harap gunakan yang lain.',
                    'max_length' => 'Panjang Nama Pengguna maksimal 30',
                    'min_length' => 'Panjang Nama Pengguna minimal 3',
                    'regex_match' => 'Nama Pengguna tidak boleh menggunakan simbol'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|max_length[254]',
                'errors' => [
                    'required' => 'Email wajib di isi!',
                    'valid_email' => 'Email harus yang valid!',
                    'max_length' => 'Email terlalu panjang!'
                ]
            ],
            'password' => [
                'rules' => 'required|matches[password_confirm]',
                'errors' => [
                    'required' => 'Sandi wajib di isi!',
                    'matches' => 'Konfirmasi Sandi salah!'
                ]
            ],
            'no_telp' => [
                'rules' => 'permit_empty|numeric|max_length[15]',
                'errors' => [
                    'numeric' => 'No Telpon hanya boleh angka!'
                ]
            ],
            'jabatan' => [
                'rules' => 'required|in_list[admin, manajer, kasir, pemilik]',
                'errors' => [
                    'required' => 'Jabatan wajib dipilih!'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->with('toast_error', 'Data gagal di simpan!')->withInput();
        }

        $users = auth()->getProvider();
        $user = new User($data);
        $users->save($user);

        $user = $users->findById($users->getInsertID());
        $users->addToGroup($user, $dataGroup);


        return redirect()->to('manajemen/pegawai')->with('success', 'Data berhasil di tambahkan!');
    }

    public function getRead($id = null)
    {
        $find = $this->userModel->withIdentities()->find($id);
        if ($id == null || $find == null) {
            return redirect()->back()->with('toast_error', 'Data tidak ditemukan!');
        }
        $data = ['data' => $this->userModel->withIdentities()->find($id), 'group' => $this->groupModel];
        return view('pages/manajemen/pegawai/read', $data);
    }

    public function getEdit($id = null)
    {
        $find = $this->userModel->withIdentities()->find($id);
        if ($id == null || $find == null) {
            return redirect()->back()->with('toast_error', 'Data tidak ditemukan!');
        }
        $data = ['data' => $this->userModel->withIdentities()->find($id), 'group' => $this->groupModel];
        return view('pages/manajemen/pegawai/edit', $data);
    }

    public function postUpdate($id = null)
    {
        $find = $this->userModel->withIdentities()->find($id);
        if ($id == null || $find == null) {
            return redirect()->back()->with('toast_error', 'Data tidak ditemukan!');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
        ];
        $dataGroup = $this->request->getPost('jabatan');
        // Jika password tidak kosong maka update passwordnya
        if (!empty($this->request->getPost('password'))) {
            $data['password'] = $this->request->getPost('password');
        }

        $rules = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama wajib di isi!'
                ]
            ],
            'username' => [
                'rules' => "required|is_unique[users.username,id,$id]|max_length[30]|min_length[3]|regex_match[/\A[a-zA-Z0-9\.]+\z/]",
                'errors' => [
                    'required' => 'Nama Pengguna wajib di isi!',
                    'is_unique' => 'Nama Pengguna sudah terpakai!, harap gunakan yang lain.',
                    'max_length' => 'Panjang Nama Pengguna maksimal 30',
                    'min_length' => 'Panjang Nama Pengguna minimal 3',
                    'regex_match' => 'Nama Pengguna tidak boleh menggunakan simbol'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|max_length[254]',
                'errors' => [
                    'required' => 'Email wajib di isi!',
                    'valid_email' => 'Email harus yang valid!',
                    'max_length' => 'Email terlalu panjang!'
                ]
            ],
            'password' => [
                'rules' => 'matches[password_confirm]',
                'errors' => [
                    'matches' => 'Konfirmasi Sandi salah!'
                ]
            ],
            'no_telp' => [
                'rules' => 'permit_empty|numeric|max_length[15]',
                'errors' => [
                    'numeric' => 'No Telpon hanya boleh angka!'
                ]
            ],
            'jabatan' => [
                'rules' => 'required|in_list[admin, manajer, kasir, pemilik]',
                'errors' => [
                    'required' => 'Jabatan wajib dipilih!'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->with('toast_error', 'Data gagal di simpan!')->withInput();
        }

        // Memperbarui data pegawai
        $users = auth()->getProvider();
        $user = $users->findById($id);
        $user->fill($data);
        $users->save($user);

        // Memperbarui group
        $groupId = $this->groupModel->where('user_id', $id)->first();
        $this->groupModel->update($groupId['id'], ['group' => $dataGroup]);

        return redirect()->to('manajemen/pegawai')->with('success', 'Data berhasil di perbaharui!');
    }

    public function getDelete($id = null)
    {
        if ($id == null) {
            return redirect()->back()->with('toast_error', 'Data tidak di temukan!');
        }
        $users = auth()->getProvider();
        $user = $users->findById($id);
        $users->delete($user->id, true);

        return redirect()->to('manajemen/pegawai')->with('success', 'Data berhasil di hapus!');
    }
}
