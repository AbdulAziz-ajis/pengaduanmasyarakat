<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Pengaduan Masyarakat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e9ecef; /* Warna latar belakang yang lebih cerah */
            margin: 0;
            padding: 0;
        }

        header {
            background: #28a745; /* Warna hijau cerah */
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff; /* Latar belakang putih untuk konten */
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Bayangan lebih halus */
        }

        h2 {
            color: #343a40; /* Warna teks gelap */
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            color: #495057; /* Warna teks yang lebih lembut */
        }

        nav {
            margin-top: 20px;
            text-align: center;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            background: #007BFF; /* Warna biru cerah */
            padding: 12px 25px; /* Ukuran tombol lebih besar */
            border-radius: 5px;
            transition: background 0.3s, transform 0.3s; /* Efek transisi */
            margin: 0 10px; /* Jarak antar tombol */
        }

        nav a:hover {
            background: #0056b3; /* Warna saat hover */
            transform: translateY(-2px); /* Efek mengangkat tombol */
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background: #28a745; /* Warna hijau cerah */
            color: #fff;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .hero-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Pengaduan Masyarakat</h1>
    </header>
    <main>
        <img src="download (2).jpeg" alt="Hero Image" class="hero-image">
        <h2>Selamat Datang di Sistem Pengaduan Masyarakat</h2>
        <p>Silakan login untuk mengajukan pengaduan. Kami siap mendengarkan dan membantu Anda dalam menyelesaikan masalah yang ada.</p>
        <nav>
            <a href="php/login.php">Login</a>
            <a href="php/register.php">Register</a>
        </nav>
    </main>
    <footer>
        <p>&copy; 2023 Pengaduan Masyarakat</p>
    </footer>
</body>
</html>