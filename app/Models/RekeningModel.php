<?php

namespace App\Models;

use CodeIgniter\Model;

class RekeningModel extends Model
{
    protected $table            = 'rekening';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama_bank', 'no_rekening', 'atas_nama'];
    protected $useTimestamps    = false;
}