<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

include 'database.php';

$id_user = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE id_user = ?");
$stmt->execute([$id_user]);
$profil = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
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
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    <nav>
        <a href="home.php">Home</a>
        <a href="logout.php">Logout</a>
    </nav>

    <h2>Your Profile</h2>
    <?php if ($profil): ?>
        <p>Nama: <?php echo $profil['nama']; ?></p>
        <p>Alamat: <?php echo $profil['alamat']; ?></p>
        <p>Fakultas: <?php echo $profil['fakultas']; ?></p>
        <p>Tahun Masuk: <?php echo $profil['tahun_masuk']; ?></p>
    <?php else: ?>
        <p>You haven't filled out your profile yet. <a href="create_profile.php">Create Profile</a></p>
    <?php endif; ?>

    </div>
</body>
</html>
