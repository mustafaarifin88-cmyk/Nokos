<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('admin/user/index', $data);
    }

    public function store()
    {
        $data = [
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'role'     => $this->request->getPost('role')
        ];

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move('uploads/profil', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $this->userModel->insert($data);
        return redirect()->to('/admin/user');
    }

    public function update($id)
    {
        $data = [
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'role'     => $this->request->getPost('role')
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
        }

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move('uploads/profil', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $this->userModel->update($id, $data);
        return redirect()->to('/admin/user');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/admin/user');
    }
}