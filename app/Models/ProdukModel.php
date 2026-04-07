<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_user', 'nama', 'foto', 'harga', 'stok', 'status'];
    protected $useTimestamps    = false;
}