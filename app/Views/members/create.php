<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
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

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: 600;
            margin-bottom: 10px;
            display: block;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
            text-decoration: none;
            color: #007bff;
            font-weight: 600;
        }

        .back-link:hover {
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
        <h1>Tambah Anggota Baru</h1>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-error">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/members/store" method="post">
            <?= csrf_field(); ?>

            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" value="<?= old('name'); ?>" required>

            <label for="contact">Kontak:</label>
            <input type="text" name="contact" id="contact" value="<?= old('contact'); ?>" required>

            <button type="submit">Simpan</button>
        </form>

        <a href="/members" class="back-link">Kembali ke Daftar Anggota</a>
    </div>

</body>
</html>
