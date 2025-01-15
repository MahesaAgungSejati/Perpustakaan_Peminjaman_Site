<?php

namespace App\Controllers;

use App\Models\LoanModel;
use App\Models\BookModel;
use App\Models\MemberModel;

class LoanController extends BaseController
{
    protected $loanModel;
    protected $bookModel;
    protected $memberModel;

    public function __construct()
    {
        $this->loanModel = new LoanModel();
        $this->bookModel = new BookModel();
        $this->memberModel = new MemberModel();
    }

    public function getLoans()
{
    $loans = $this->loanModel
        ->select('loans.id, members.name AS member_name, books.title AS book_title, loans.loan_date, loans.return_date, loans.status')
        ->join('members', 'members.id = loans.member_id')
        ->join('books', 'books.id = loans.book_id')
        ->findAll();

    return view('loans/index', ['loans' => $loans]);
}


    public function create()
    {
        // Ambil semua data member dan buku untuk dropdown
        $members = $this->memberModel->findAll();
        $books = $this->bookModel->findAll();
    
        // Kirim data ke view
        return view('loans/create', ['members' => $members, 'books' => $books]);
    }
    

    public function store()
{
    // Validasi input
    $validation = $this->validate([
        'member_id' => 'required|is_natural_no_zero',
        'book_id' => 'required|is_natural_no_zero',
        'loan_date' => 'required|valid_date',
        'return_date' => 'required|valid_date',
        'status' => 'required|in_list[ongoing,returned,overdue]',
    ]);

    if (!$validation) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Simpan data peminjaman
    $this->loanModel->save([
        'member_id' => $this->request->getPost('member_id'),
        'book_id' => $this->request->getPost('book_id'),
        'loan_date' => $this->request->getPost('loan_date'),
        'return_date' => $this->request->getPost('return_date'),
        'status' => $this->request->getPost('status'),
    ]);

    return redirect()->to('/loans')->with('success', 'Peminjaman berhasil ditambahkan!');
}


    public function edit($id)
{
    log_message('info', 'Mencoba mengedit pinjaman dengan ID: ' . $id);

    $loan = $this->loanModel->find($id);

    if (!$loan) {
        log_message('error', 'Pinjaman dengan ID: ' . $id . ' tidak ditemukan.');
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Pinjaman dengan ID ' . $id . ' tidak ditemukan.');
    }

    log_message('info', 'Data pinjaman ditemukan: ' . print_r($loan, true));

    $members = $this->memberModel->findAll();
    $books = $this->bookModel->findAll();

    return view('loans/edit', [
        'loan' => $loan,
        'members' => $members,
        'books' => $books,
    ]);
}



    public function update($id)
    {
        // Validasi input
        $validation = $this->validate([
            'member_id' => 'required|is_natural_no_zero',
            'book_id' => 'required|is_natural_no_zero',
            'loan_date' => 'required|valid_date',
            'return_date' => 'required|valid_date',
            'status' => 'required|in_list[ongoing,returned,overdue]'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Perbarui data pinjaman
        $this->loanModel->update($id, [
            'member_id' => $this->request->getPost('member_id'),
            'book_id' => $this->request->getPost('book_id'),
            'loan_date' => $this->request->getPost('loan_date'),
            'return_date' => $this->request->getPost('return_date'),
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('/loans')->with('success', 'Peminjaman berhasil diperbarui!');
    }

    public function delete($id)
    {
        // Hapus data pinjaman berdasarkan ID
        $this->loanModel->delete($id);

        return redirect()->to('/loans')->with('success', 'Peminjaman berhasil dihapus!');
    }
}
