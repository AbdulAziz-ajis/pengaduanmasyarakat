<?php
session_start();
include 'db.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Cek apakah ID pengaduan diberikan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data pengaduan berdasarkan ID
    $stmt = $conn->prepare("SELECT * FROM complaints WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $complaint = $result->fetch_assoc();

    if (!$complaint) {
        die("Pengaduan tidak ditemukan.");
    }
} else {
    die("ID pengaduan tidak diberikan.");
}

// Proses pembaruan pengaduan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    // Validasi input
    if (empty($title) || empty($description)) {
        $error = "Judul dan deskripsi tidak boleh kosong.";
    } else {
        // Update pengaduan
        $stmt = $conn->prepare("UPDATE complaints SET title = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $title, $description, $id);
        
        if ($stmt->execute()) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pengaduan</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

header {
    text-align: center;
    margin-bottom: 20px;
}

h1 {
    color: #333;
}

main {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.form-container {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    margin-bottom: 5px;
    display: block;
    font-weight: bold;
}

input[type="text"], textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s;
}

input[type="text"]:focus, textarea:focus {
    border-color: #007BFF;
    outline: none;
}

button {
    padding: 10px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius:
    </style>
</head>
<body>
    <header>
        <h1>Update Pengaduan</h1>
    </header>
    <main>
        <div class="form-container">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title" placeholder="Masukkan Judul" value="<?php echo htmlspecialchars($complaint['title']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" placeholder="Masukkan Deskripsi" required><?php echo htmlspecialchars($complaint['description']); ?></textarea>
                </div>
                <button type="submit">Update</button>
            </form>
            <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>
        </div>
    </main>
</body>
</html>