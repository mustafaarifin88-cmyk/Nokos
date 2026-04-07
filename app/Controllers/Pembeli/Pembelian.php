<?php

namespace App\Controllers\Pembeli;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\NegaraModel;
use App\Models\RekeningModel;
use App\Models\PesananModel;

class Pembelian extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $negaraModel = new NegaraModel();
        $rekeningModel = new RekeningModel();

        $data['produk'] = $produkModel->where('status', 'aktif')->findAll();
        $data['negara'] = $negaraModel->findAll();
        $data['rekening'] = $rekeningModel->findAll();

        return view('pembeli/pembelian/checkout', $data);
    }

    public function store()
    {
        $pesananModel = new PesananModel();
        
        $data = [
            'id_pembeli'  => session()->get('id'),
            'id_produk'   => $this->request->getPost('id_produk'),
            'id_negara'   => $this->request->getPost('id_negara'),
            'id_rekening' => $this->request->getPost('id_rekening'),
            'total'       => $this->request->getPost('total'),
            'status'      => 'proses'
        ];

        $bukti = $this->request->getFile('bukti_tf');
        if ($bukti && $bukti->isValid() && !$bukti->hasMoved()) {
            $namaBukti = $bukti->getRandomName();
            $bukti->move('uploads/bukti_tf', $namaBukti);
            $data['bukti_tf'] = $namaBukti;
        }

        $pesananModel->insert($data);
        return redirect()->to('/pembeli/pesanan');
    }
}