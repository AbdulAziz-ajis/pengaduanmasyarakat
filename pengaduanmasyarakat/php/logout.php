<?php
session_start(); // Memulai sesi
session_destroy(); // Menghancurkan semua data sesi
header("Location: login.php"); // Mengarahkan pengguna kembali ke halaman login
exit(); // Menghentikan eksekusi script
?>