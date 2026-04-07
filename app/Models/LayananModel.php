<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table            = 'layanan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_pesanan', 'nomor_hp', 'otp'];
    protected $useTimestamps    = false;
}