<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_SESSION['user_id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $fakultas = $_POST['fakultas'];
    $tahun_masuk = $_POST['tahun_masuk'];

    $stmt = $pdo->prepare("INSERT INTO mahasiswa (id_user, nama, alamat, fakultas, tahun_masuk) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$id_user, $nama, $alamat, $fakultas, $tahun_masuk]);
    header("Location: user_dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membuat Profile Mahasiswa</title>
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
    </style>
</head>
<body>
<div class="container">
    <h1>Create Your Profile</h1>
    <form method="post">
        <table>
            <tr>
                <td>Nama:</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>Alamat:</td>
                <td><input type="text" name="alamat" required></td>
            </tr>
            <tr>
                <td>Fakultas:</td>
                <td><input type="text" name="fakultas" required></td>
            </tr>
            <tr>
                <td>Tahun Masuk:</td>
                <td><input type="number" name="tahun_masuk" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Create Profile"></td>
            </tr>
        </table>
    </form>
</div>
    
</body>
</html>

