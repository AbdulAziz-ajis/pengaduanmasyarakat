<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Mengambil data pengaduan
$stmt = $conn->prepare("SELECT * FROM complaints WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Pengaduan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        header {
            background-color: #28a745; /* Warna hijau */
        }
    </style>
</head>
<body>
    <header class="text-white text-center py-4">
        <h1>Dashboard Pengaduan</h1>
        <nav class="nav justify-content-start">
            <a class="nav-link text-white" href="create.php">Buat Pengaduan</a>
            <a class="nav-link text-danger" href="logout.php">Logout</a>
        </nav>
    </header>
    <main class="container mt-4">
        <h2>Selamat Datang di Website Pengaduan Masyarakat</h2>
        <br>
        <h3>Pengaduan Anda:</h3>
        <br>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['created_at'])); ?></td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php if ($result->num_rows === 0): ?>
            <div class="alert alert-info" role="alert">
                Belum ada pengaduan yang dibuat.
            </div>
        <?php endif; ?>
    </main>
    <footer class="text-center mt-4 mb-4">
        <p>&copy; <?php echo date("Y"); ?> Dashboard Pengaduan. All rights reserved.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>