<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;

class Pesanan extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $data['pesanan'] = $db->table('pesanan')
            ->join('users', 'users.id = pesanan.id_pembeli')
            ->join('produk', 'produk.id = pesanan.id_produk')
            ->select('pesanan.*, users.nama as nama_pembeli, produk.nama as nama_produk')
            ->orderBy('pesanan.id', 'DESC')
            ->get()->getResultArray();

        return view('admin/pesanan/index', $data);
    }

    public function updateStatus($id)
    {
        $pesananModel = new PesananModel();
        $status = $this->request->getPost('status');
        
        $pesananModel->update($id, ['status' => $status]);
        
        if ($status == 'proses') {
            return redirect()->to('/admin/layanan');
        }
        
        return redirect()->to('/admin/pesanan');
    }
}