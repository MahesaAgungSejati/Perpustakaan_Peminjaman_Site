<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman Buku</title>
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
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        label {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }

        select, input[type="date"], button {
            width: 96%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            font-family: 'Poppins', sans-serif;
            background-color: #007bff;
            color: white;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
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
        <div class="form-container">
            <h1>Tambah Peminjaman Buku</h1>

            <?php if (session()->getFlashdata('errors')): ?>
                <div style="color: red;">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/loans/store" method="post">
                <?= csrf_field(); ?>

                <label for="member_id">Nama Anggota:</label>
                <select id="member_id" name="member_id" required>
                    <option value="">Pilih Anggota</option>
                    <?php foreach ($members as $member): ?>
                        <option value="<?= $member['id']; ?>"><?= $member['name']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>

                <label for="book_id">Judul Buku:</label>
                <select id="book_id" name="book_id" required>
                    <option value="">Pilih Buku</option>
                    <?php foreach ($books as $book): ?>
                        <option value="<?= $book['id']; ?>"><?= $book['title']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>

                <label for="loan_date">Tanggal Pinjam:</label>
                <input type="date" id="loan_date" name="loan_date" required><br><br>

                <label for="return_date">Tanggal Kembali:</label>
                <input type="date" id="return_date" name="return_date" required><br><br>

                <label for="status">Status Peminjaman:</label>
                <select id="status" name="status" required>
                    <option value="">Pilih Status</option>
                    <option value="ongoing">Ongoing</option>
                    <option value="returned">Returned</option>
                    <option value="overdue">Overdue</option>
                </select><br><br>

                <button type="submit">Tambah Peminjaman</button>
            </form>
        </div>
    </div>

</body>
</html>
