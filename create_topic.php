<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'forum_db');

    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO topics (title, content, user_id) VALUES ('$title', '$content', '$user_id')";
    if ($conn->query($query) === TRUE) {
        echo "Topik berhasil dibuat!";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>
<form method="POST">
    <input type="text" name="title" placeholder="Judul Topik" required><br>
    <textarea name="content" placeholder="Isi Topik" required></textarea><br>
    <button type="submit">Buat Topik</button>
</form>
