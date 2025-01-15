<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            font-weight: 600;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .content {
            padding: 30px;
        }

        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .add-btn {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .add-btn:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td {
            background-color: #fff;
        }

        td img {
            max-width: 80px;
            max-height: 120px;
            object-fit: cover;
        }

        .btn-action {
            color: #007bff;
            font-weight: 600;
            text-decoration: none;
            margin-right: 10px;
        }

        .btn-action:hover {
            text-decoration: underline;
        }

        .btn-delete {
            color: #dc3545;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-delete:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="<?= site_url('books'); ?>">Books</a>
        <a href="<?= site_url('members'); ?>">Members</a>
        <a href="<?= site_url('loans'); ?>">Loans</a>
    </div>

    <div class="content">
        <h1>Daftar Buku</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>

        <a href="/books/create" class="add-btn">Tambah Buku</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Waktu Ditambahkan</th>
                    <th>Cover</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($books)): ?>
                    <?php foreach ($books as $index => $book): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= $book['title']; ?></td>
                            <td><?= $book['author']; ?></td>
                            <td><?= $book['created_at']; ?></td>
                            <td><img src="<?= base_url('uploads/' . $book['cover_image']); ?>" alt="Cover Image"></td>
                            <td>
                                <a href="/books/edit/<?= $book['id']; ?>" class="btn-action">Edit</a> |
                                <a href="/books/delete/<?= $book['id']; ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Belum ada buku terdaftar.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
