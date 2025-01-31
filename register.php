<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'forum_db');

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    // Menyimpan data ke tabel users
    $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($query) === TRUE) {
        echo "Registrasi berhasil!";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
</form>
