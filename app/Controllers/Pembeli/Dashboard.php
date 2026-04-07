<?php

namespace App\Controllers\Pembeli;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $id_user = session()->get('id');

        $data['pesanan_aktif'] = $db->table('pesanan')
            ->where('id_pembeli', $id_user)
            ->whereIn('status', ['proses', 'dikirim'])
            ->countAllResults();

        $data['histori_pesanan'] = $db->table('pesanan')
            ->where('id_pembeli', $id_user)
            ->where('status', 'selesai')
            ->countAllResults();

        return view('pembeli/dashboard', $data);
    }
}