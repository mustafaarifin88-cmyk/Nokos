<?php

namespace App\Controllers\Pembeli;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profil extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->find(session()->get('id'));
        return view('pembeli/profil', $data);
    }

    public function update()
    {
        $userModel = new UserModel();
        $id = session()->get('id');
        $data = [];

        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
        }

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move('uploads/profil', $namaFoto);
            $data['foto'] = $namaFoto;
            session()->set('foto', $namaFoto);
        }

        if (!empty($data)) {
            $userModel->update($id, $data);
        }

        return redirect()->to('/pembeli/profil');
    }
}