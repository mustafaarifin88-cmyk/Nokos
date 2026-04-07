<?php

namespace App\Models;

use CodeIgniter\Model;

class NegaraModel extends Model
{
    protected $table            = 'negara';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama_negara', 'kode_negara'];
    protected $useTimestamps    = false;
}