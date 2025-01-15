<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'members'; // Nama tabel
    protected $primaryKey = 'id'; // Primary Key
    protected $allowedFields = ['name', 'contact', 'created_at', 'updated_at']; // Kolom yang dapat diisi
    protected $useTimestamps = true; // Aktifkan fitur timestamps
}
