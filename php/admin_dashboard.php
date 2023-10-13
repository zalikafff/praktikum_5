<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['username'] != 'admin') {
    header("Location: login.php");
    exit;
}

include 'database.php';

// Menggabungkan data dari tabel 'user' dan 'mahasiswa' dengan JOIN
$stmt = $pdo->prepare("SELECT user.id, user.username, user.email, mahasiswa.nama, mahasiswa.alamat, mahasiswa.fakultas, mahasiswa.tahun_masuk FROM user LEFT JOIN mahasiswa ON user.id = mahasiswa.id_user");
$stmt->execute();
$users = $stmt->fetchAll(); // Fetch all users
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        nav a {
            color: #007BFF;
            padding: 10px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #eef5ff;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-links a {
            margin-right: 10px;
            color: #007BFF;
        }

        .action-links a:last-child {
            margin-right: 0;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
<div class="container">
    <h1>Welcome, Admin</h1>
    <nav>
        <!-- <a href="home.php">Home</a> -->
        <a href="admin_dashboard.php">Daftar User</a>
        <a href="add_user.php" class="button">Tambah User</a>
        <a href="logout.php">Logout</a>
    </nav>

    <h2>Daftar User</h2>
    <table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Fakultas</th>
        <th>Tahun Masuk</th>
        <th>Action</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['nama']; ?></td>
            <td><?php echo $user['alamat']; ?></td>
            <td><?php echo $user['fakultas']; ?></td>
            <td><?php echo $user['tahun_masuk']; ?></td>
            <td class="action-links">
                <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a>
                <a href="delete_user.php?id=<?php echo $user['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</div>    
</body>
</html>
