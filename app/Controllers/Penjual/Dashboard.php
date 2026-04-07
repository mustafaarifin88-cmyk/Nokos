<?php

namespace App\Controllers\Penjual;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $id_user = session()->get('id');
        $produkModel = new ProdukModel();
        
        $db = \Config\Database::connect();
        
        $data['total_produk'] = $produkModel->where('id_user', $id_user)->countAllResults();
        
        $data['total_pesanan'] = $db->table('pesanan')
            ->join('produk', 'produk.id = pesanan.id_produk')
            ->where('produk.id_user', $id_user)
            ->countAllResults();

        return view('penjual/dashboard', $data);
    }
}