<?php

namespace App\Controllers\Penjual;

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
        $data['produk'] = $this->produkModel->where('id_user', session()->get('id'))->findAll();
        return view('penjual/produk/index', $data);
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
        return redirect()->to('/penjual/produk');
    }

    public function update($id)
    {
        $produk = $this->produkModel->find($id);
        if (!$produk || $produk['id_user'] != session()->get('id')) {
            return redirect()->to('/penjual/produk');
        }

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
        return redirect()->to('/penjual/produk');
    }

    public function delete($id)
    {
        $produk = $this->produkModel->find($id);
        if ($produk && $produk['id_user'] == session()->get('id')) {
            $this->produkModel->delete($id);
        }
        return redirect()->to('/penjual/produk');
    }
}