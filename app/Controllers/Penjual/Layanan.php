<?php

namespace App\Controllers\Penjual;

use App\Controllers\BaseController;
use App\Models\LayananModel;
use App\Models\PesananModel;

class Layanan extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $id_user = session()->get('id');

        $data['layanan'] = $db->table('pesanan')
            ->join('users', 'users.id = pesanan.id_pembeli')
            ->join('negara', 'negara.id = pesanan.id_negara')
            ->join('layanan', 'layanan.id_pesanan = pesanan.id', 'left')
            ->join('produk', 'produk.id = pesanan.id_produk')
            ->select('pesanan.id as id_pesanan, users.nama as pembeli, negara.nama_negara, layanan.nomor_hp, layanan.otp, layanan.id as id_layanan, pesanan.status')
            ->where('produk.id_user', $id_user)
            ->whereIn('pesanan.status', ['proses', 'dikirim'])
            ->get()->getResultArray();
            
        return view('penjual/layanan/index', $data);
    }

    public function store()
    {
        $layananModel = new LayananModel();
        $pesananModel = new PesananModel();
        
        $id_layanan = $this->request->getPost('id_layanan');
        $id_pesanan = $this->request->getPost('id_pesanan');
        
        $data = [
            'id_pesanan' => $id_pesanan,
            'nomor_hp'   => $this->request->getPost('nomor_hp'),
            'otp'        => $this->request->getPost('otp')
        ];

        if ($id_layanan) {
            $layananModel->update($id_layanan, $data);
        } else {
            $layananModel->insert($data);
            $pesananModel->update($id_pesanan, ['status' => 'dikirim']);
        }

        return redirect()->to('/penjual/layanan');
    }
}