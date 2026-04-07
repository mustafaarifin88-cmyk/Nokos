<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table            = 'pesanan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_pembeli', 'id_produk', 'id_negara', 'id_rekening', 'total', 'bukti_tf', 'status'];
    protected $useTimestamps    = false;
}