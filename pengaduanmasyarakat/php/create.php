<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO complaints (user_id, title, description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $description);
    
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buat Pengaduan</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 1rem;
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 100px); /* Adjust height based on header */
        }
        form {
            background: white;
            padding: 2rem;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px; /* Fixed width for the form */
        }
        div {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 0.7rem;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
        p {
            text-align: center;
        }
    </style>
    <script>
        function validateForm() {
            const title = document.forms["complaintForm"]["title"].value;
            const description = document.forms["complaintForm"]["description"].value;
            if (title === "" || description === "") {
                alert("Semua field harus diisi!");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <header>
        <h1>Buat Pengaduan</h1>
    </header>
    <main>
        <form name="complaintForm" method="POST" action="" onsubmit="return validateForm()">
            <div>
                <label for="title">Judul:</label>
                <input type="text" id="title" name="title" placeholder="Masukkan judul pengaduan" required>
            </div>
            <div>
                <label for="description">Deskripsi:</label>
                <textarea id="description" name="description" placeholder="Jelaskan pengaduan Anda secara detail" required></textarea>
            </div>
            <button type="submit">Kirim</button>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <?php if (isset($_GET['success'])) echo "<p style='color:green;'>Pengaduan Anda telah berhasil dikirim!</p>"; ?>
        </form>
    </main>
</body>
</html>