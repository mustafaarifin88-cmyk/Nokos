<?php

namespace App\Controllers\Pembeli;

use App\Controllers\BaseController;

class Histori extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $id_user = session()->get('id');

        $data['histori'] = $db->table('pesanan')
            ->join('produk', 'produk.id = pesanan.id_produk')
            ->join('layanan', 'layanan.id_pesanan = pesanan.id', 'left')
            ->select('pesanan.*, produk.nama as nama_produk, layanan.nomor_hp, layanan.otp')
            ->where('pesanan.id_pembeli', $id_user)
            ->where('pesanan.status', 'selesai')
            ->orderBy('pesanan.id', 'DESC')
            ->get()->getResultArray();

        return view('pembeli/histori', $data);
    }
}