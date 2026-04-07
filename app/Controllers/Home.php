<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Home extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        
        $data['produk_terbaru'] = $produkModel->where('status', 'aktif')->orderBy('id', 'DESC')->findAll(8);
        $data['produk_terlaris'] = $produkModel->where('status', 'aktif')->findAll(8);
        
        return view('front/home', $data);
    }
}