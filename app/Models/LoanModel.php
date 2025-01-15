<?php

namespace App\Models;

use CodeIgniter\Model;

class LoanModel extends Model
{
    protected $table = 'loans';
    protected $primaryKey = 'id';
    protected $allowedFields = ['member_id', 'book_id', 'loan_date', 'return_date', 'status'];
    protected $useTimestamps = true;

    // Tentukan relasi dengan Member dan Book
    public function getLoanDetails($id = null)
{
    $builder = $this->db->table($this->table)
        ->select('loans.id, members.name AS member_name, books.title AS book_title, loans.loan_date, loans.return_date, loans.status')
        ->join('members', 'members.id = loans.member_id')
        ->join('books', 'books.id = loans.book_id');
    
    if ($id !== null) {
        $builder->where('loans.id', $id);
        return $builder->get()->getRowArray();
    }
    
    return $builder->get()->getResultArray();
}


}
