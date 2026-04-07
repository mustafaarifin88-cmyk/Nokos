<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TokoModel;

class ProfilToko extends BaseController
{
    public function index()
    {
        $tokoModel = new TokoModel();
        $data['toko'] = $tokoModel->first();
        
        return view('admin/profil_toko', $data);
    }

    public function update()
    {
        $tokoModel = new TokoModel();
        $id = $this->request->getPost('id');
        
        $data = [
            'nama'   => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'email'  => $this->request->getPost('email'),
            'tele'   => $this->request->getPost('tele'),
            'wa'     => $this->request->getPost('wa'),
        ];

        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            $namaLogo = $logo->getRandomName();
            $logo->move('uploads/toko', $namaLogo);
            $data['logo'] = $namaLogo;
        }

        if ($id) {
            $tokoModel->update($id, $data);
        } else {
            $tokoModel->insert($data);
        }

        return redirect()->to('/admin/profiltoko');
    }
}