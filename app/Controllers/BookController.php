<?php

namespace App\Controllers;

use App\Models\BookModel;

class BookController extends BaseController
{
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
    }

    /**
     * Menampilkan semua buku
     */
    public function getBooks()
    {
        $books = $this->bookModel->findAll(); // Ambil semua data buku
        return view('books/index', ['books' => $books]); // Mengirim data buku ke view
    }

    /**
     * Menampilkan form untuk menambah buku
     */
    public function create()
    {
        return view('books/create');
    }

    /**
     * Menyimpan buku baru ke database
     */
    public function store()
    {
        // Validasi input
        $validation = $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'author' => 'required|min_length[3]|max_length[255]',
            'status' => 'required|in_list[available,borrowed]',
            'publication_year' => 'required|numeric|exact_length[4]', // Validasi tahun terbit
            'cover_image' => 'uploaded[cover_image]|max_size[cover_image,2048]|is_image[cover_image]|mime_in[cover_image,image/jpg,image/jpeg,image/png]', // Validasi gambar
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Upload gambar
        $coverImage = $this->request->getFile('cover_image');
        $coverImageName = $coverImage->getRandomName();
        $coverImage->move(ROOTPATH . 'public/uploads', $coverImageName);

        // Simpan buku baru
        $this->bookModel->save([
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'status' => $this->request->getPost('status'),
            'publication_year' => $this->request->getPost('publication_year'),
            'cover_image' => $coverImageName, // Simpan nama gambar
        ]);

        return redirect()->to('/books')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit buku
     */
    public function edit($id)
    {
        $book = $this->bookModel->find($id); // Ambil buku berdasarkan ID
        if (!$book) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Buku dengan ID $id tidak ditemukan");
        }

        return view('books/edit', ['book' => $book]); // Kirim data buku ke form edit
    }

    /**
     * Menyimpan perubahan buku ke database
     */
    public function update($id)
    {
        // Validasi input
        $validation = $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'author' => 'required|min_length[3]|max_length[255]',
            'status' => 'required|in_list[available,borrowed]',
            'publication_year' => 'required|numeric|exact_length[4]', // Validasi tahun terbit
            'cover_image' => 'is_image[cover_image]|mime_in[cover_image,image/jpg,image/jpeg,image/png]', // Validasi gambar
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data buku lama
        $book = $this->bookModel->find($id);

        // Upload gambar jika ada gambar baru
        $coverImage = $this->request->getFile('cover_image');
        if ($coverImage && $coverImage->isValid()) {
            // Hapus gambar lama jika ada
            if ($book['cover_image'] && file_exists(ROOTPATH . 'public/uploads/' . $book['cover_image'])) {
                unlink(ROOTPATH . 'public/uploads/' . $book['cover_image']);
            }
            // Simpan gambar baru
            $coverImageName = $coverImage->getRandomName();
            $coverImage->move(ROOTPATH . 'public/uploads', $coverImageName);
        } else {
            $coverImageName = $book['cover_image']; // Jika tidak ada gambar baru, gunakan gambar lama
        }

        // Update buku
        $this->bookModel->update($id, [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'status' => $this->request->getPost('status'),
            'publication_year' => $this->request->getPost('publication_year'),
            'cover_image' => $coverImageName, // Update nama gambar
        ]);

        return redirect()->to('/books')->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Menghapus buku dari database
     */
    public function delete($id)
    {
        $book = $this->bookModel->find($id);
        if ($book) {
            // Hapus gambar buku jika ada
            if ($book['cover_image'] && file_exists(ROOTPATH . 'public/uploads/' . $book['cover_image'])) {
                unlink(ROOTPATH . 'public/uploads/' . $book['cover_image']);
            }

            // Hapus buku dari database
            $this->bookModel->delete($id);
            return redirect()->to('/books')->with('success', 'Buku berhasil dihapus!');
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException("Buku dengan ID $id tidak ditemukan");
    }
}
