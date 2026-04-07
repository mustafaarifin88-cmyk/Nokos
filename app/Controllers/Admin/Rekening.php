<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RekeningModel;

class Rekening extends BaseController
{
    protected $rekeningModel;

    public function __construct()
    {
        $this->rekeningModel = new RekeningModel();
    }

    public function index()
    {
        $data['rekening'] = $this->rekeningModel->findAll();
        return view('admin/rekening/index', $data);
    }

    public function store()
    {
        $data = [
            'nama_bank'   => $this->request->getPost('nama_bank'),
            'no_rekening' => $this->request->getPost('no_rekening'),
            'atas_nama'   => $this->request->getPost('atas_nama')
        ];

        $this->rekeningModel->insert($data);
        return redirect()->to('/admin/rekening');
    }

    public function update($id)
    {
        $data = [
            'nama_bank'   => $this->request->getPost('nama_bank'),
            'no_rekening' => $this->request->getPost('no_rekening'),
            'atas_nama'   => $this->request->getPost('atas_nama')
        ];

        $this->rekeningModel->update($id, $data);
        return redirect()->to('/admin/rekening');
    }

    public function delete($id)
    {
        $this->rekeningModel->delete($id);
        return redirect()->to('/admin/rekening');
    }
}