<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class Produk extends BaseController
{
    protected $produkModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        $data['produk'] = $this->produkModel->findAll();
        return view('admin/produk/index', $data);
    }

    public function store()
    {
        $data = [
            'id_user' => session()->get('id'),
            'nama'    => $this->request->getPost('nama'),
            'harga'   => $this->request->getPost('harga'),
            'stok'    => $this->request->getPost('stok'),
            'status'  => $this->request->getPost('status')
        ];

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move('uploads/produk', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $this->produkModel->insert($data);
        return redirect()->to('/admin/produk');
    }

    public function update($id)
    {
        $data = [
            'nama'   => $this->request->getPost('nama'),
            'harga'  => $this->request->getPost('harga'),
            'stok'   => $this->request->getPost('stok'),
            'status' => $this->request->getPost('status')
        ];

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move('uploads/produk', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $this->produkModel->update($id, $data);
        return redirect()->to('/admin/produk');
    }

    public function delete($id)
    {
        $this->produkModel->delete($id);
        return redirect()->to('/admin/produk');
    }
}