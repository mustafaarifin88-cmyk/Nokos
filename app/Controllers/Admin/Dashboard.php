<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\UserModel;
use App\Models\ProdukModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $pesananModel = new PesananModel();
        $userModel = new UserModel();
        $produkModel = new ProdukModel();

        $data['total_pesanan'] = $pesananModel->countAllResults();
        $data['total_user'] = $userModel->countAllResults();
        $data['total_produk'] = $produkModel->countAllResults();

        return view('admin/dashboard', $data);
    }
}