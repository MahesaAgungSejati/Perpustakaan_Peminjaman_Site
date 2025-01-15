<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'books'; // Nama tabel
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'author', 'status', 'publication_year', 'cover_image']; // Kolom yang bisa diisi
    protected $useTimestamps = true; // Menggunakan timestamp otomatis
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
