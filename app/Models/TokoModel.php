<?php

namespace App\Models;

use CodeIgniter\Model;

class TokoModel extends Model
{
    protected $table            = 'profil_toko';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama', 'logo', 'alamat', 'email', 'tele', 'wa'];
    protected $useTimestamps    = false;
}