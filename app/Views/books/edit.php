<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
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
            padding: 40px;
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            font-size: 28px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: 500;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }

        input, select {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            margin-top: 5px;
        }

        input[type="file"] {
            padding: 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
        }

        .back-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .cover-image-preview {
            margin-top: 10px;
            text-align: center;
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
        <h1>Edit Buku</h1>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/books/update/<?= $book['id']; ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div>
                <label for="title">Judul Buku:</label>
                <input type="text" id="title" name="title" value="<?= esc($book['title']); ?>" required>
            </div>
            <div>
                <label for="author">Penulis:</label>
                <input type="text" id="author" name="author" value="<?= esc($book['author']); ?>" required>
            </div>
            <div>
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="available" <?= ($book['status'] == 'available') ? 'selected' : ''; ?>>Tersedia</option>
                    <option value="borrowed" <?= ($book['status'] == 'borrowed') ? 'selected' : ''; ?>>Dipinjam</option>
                </select>
            </div>
            <div>
                <label for="publication_year">Tahun Terbit:</label>
                <input type="text" id="publication_year" name="publication_year" value="<?= esc($book['publication_year']); ?>" required>
            </div>
            <div>
                <label for="cover_image">Cover Image (Opsional):</label>
                <input type="file" id="cover_image" name="cover_image">
            </div>

            <div class="cover-image-preview">
                <img src="<?= base_url('uploads/' . $book['cover_image']); ?>" width="100" alt="Cover Image">
            </div>

            <button type="submit">Update Buku</button>
        </form>

        <div class="back-link">
            <a href="/books">Kembali ke Daftar Buku</a>
        </div>
    </div>

</body>
</html>
