<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use Mpdf\Mpdf;

class Laporan extends BaseController
{
    public function index()
    {
        $data['laporan'] = $this->getFilteredData();
        return view('admin/laporan', $data);
    }

    public function cetak()
    {
        $data['laporan'] = $this->getFilteredData();
        $html = view('admin/cetak_laporan', $data);

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('Laporan_Penjualan.pdf', 'I');
    }

    private function getFilteredData()
    {
        $filter = $this->request->getGet('filter');
        $tanggal_awal = $this->request->getGet('tanggal_awal');
        $tanggal_akhir = $this->request->getGet('tanggal_akhir');

        $db = \Config\Database::connect();
        $builder = $db->table('pesanan')
            ->join('users', 'users.id = pesanan.id_pembeli')
            ->join('produk', 'produk.id = pesanan.id_produk')
            ->select('pesanan.*, users.nama as pembeli, produk.nama as produk')
            ->where('pesanan.status', 'selesai');

        if ($filter == '1_minggu') {
            $builder->where('pesanan.created_at >=', date('Y-m-d', strtotime('-1 week')));
        } elseif ($filter == '1_bulan') {
            $builder->where('pesanan.created_at >=', date('Y-m-d', strtotime('-1 month')));
        } elseif ($filter == '1_tahun') {
            $builder->where('pesanan.created_at >=', date('Y-m-d', strtotime('-1 year')));
        } elseif ($tanggal_awal && $tanggal_akhir) {
            $builder->where('DATE(pesanan.created_at) >=', $tanggal_awal);
            $builder->where('DATE(pesanan.created_at) <=', $tanggal_akhir);
        }

        return $builder->get()->getResultArray();
    }
}