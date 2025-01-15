<?php

namespace App\Controllers;

use App\Models\MemberModel;

class MemberController extends BaseController
{
    protected $memberModel;

    public function __construct()
    {
        $this->memberModel = new MemberModel();
    }

    /**
     * Menampilkan daftar anggota.
     */
    public function index()
    {
        $data['members'] = $this->memberModel->findAll(); // Ambil semua data anggota
        return view('members/index', $data); // Tampilkan view dengan data
    }

    /**
     * Menampilkan form tambah anggota baru.
     */
    public function create()
    {
        return view('members/create'); // Tampilkan form tambah anggota
    }

    /**
     * Menyimpan anggota baru ke database.
     */
    public function store()
    {
        // Validasi input
        $validation = $this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'contact' => 'required|min_length[10]|max_length[255]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data ke database
        $this->memberModel->save([
            'name' => $this->request->getPost('name'),
            'contact' => $this->request->getPost('contact'),
        ]);

        return redirect()->to('/members')->with('success', 'Anggota berhasil ditambahkan!');
    }
    public function edit($id)
    {
        $member = $this->memberModel->find($id);
        
        if (!$member) {
            return redirect()->to('/members')->with('error', 'Anggota tidak ditemukan!');
        }

        $data['member'] = $member;
        return view('members/edit', $data);
    }

    /**
     * Mengupdate data anggota.
     */
    public function update($id)
    {
        // Validasi input
        $validation = $this->validate([
            'name' => 'required|min_length[3]|max_length[255]',
            'contact' => 'required|min_length[10]|max_length[255]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update data anggota
        $this->memberModel->update($id, [
            'name' => $this->request->getPost('name'),
            'contact' => $this->request->getPost('contact'),
        ]);

        return redirect()->to('/members')->with('success', 'Anggota berhasil diperbarui!');
    }

    /**
     * Menghapus anggota dari database.
     */
    public function delete($id)
    {
        $this->memberModel->delete($id);
        return redirect()->to('/members')->with('success', 'Anggota berhasil dihapus!');
    }
}
