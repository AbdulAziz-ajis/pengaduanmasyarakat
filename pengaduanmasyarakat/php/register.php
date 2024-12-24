<?php
session_start();
include 'db.php'; // Perbaiki tanda kutip di sini

// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = ""; // Inisialisasi variabel error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi input
    if (empty($username) || empty($password)) {
        $error = "Username dan password tidak boleh kosong.";
    } elseif (strlen($username) < 3) {
        $error = "Username harus terdiri dari minimal 3 karakter.";
    } elseif (strlen($password) < 6) {
        $error = "Password harus terdiri dari minimal 6 karakter.";
    } else {
        // Periksa apakah username sudah ada di database
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username sudah terdaftar. Silakan pilih username lain.";
        } else {
            // Jika username belum ada, masukkan data baru
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $passwordHash);

            if ($stmt->execute()) {
                $_SESSION['user_id'] = $conn->insert_id; // Simpan ID pengguna di sesi
                header("Location: login.php"); // Redirect ke halaman login
                exit();
            } else {
                $error = "Terjadi kesalahan saat mendaftar. Silakan coba lagi.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="style.css"> <!-- Tambahkan CSS jika diperlukan -->
</head>
<body>
    <h2>Registrasi</h2>
    <?php if (!empty($error)): ?>
        <div style="color: red;"><?php echo htmlspecialchars($error); ?></div> <!-- Menggunakan htmlspecialchars untuk keamanan -->
    <?php endif; ?>
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Daftar</button>
    </form>
</body>
</html>