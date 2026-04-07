<?php

namespace App\Controllers\Pembeli;

use App\Controllers\BaseController;
use App\Models\PesananModel;

class Pesanan extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $id_user = session()->get('id');

        $data['pesanan'] = $db->table('pesanan')
            ->join('produk', 'produk.id = pesanan.id_produk')
            ->join('layanan', 'layanan.id_pesanan = pesanan.id', 'left')
            ->select('pesanan.*, produk.nama as nama_produk, produk.foto, layanan.nomor_hp, layanan.otp')
            ->where('pesanan.id_pembeli', $id_user)
            ->whereIn('pesanan.status', ['proses', 'dikirim'])
            ->orderBy('pesanan.id', 'DESC')
            ->get()->getResultArray();

        return view('pembeli/pesanan/index', $data);
    }

    public function terima($id)
    {
        $pesananModel = new PesananModel();
        $pesanan = $pesananModel->find($id);

        if ($pesanan && $pesanan['id_pembeli'] == session()->get('id')) {
            $pesananModel->update($id, ['status' => 'selesai']);
        }

        return redirect()->to('/pembeli/histori');
    }
}