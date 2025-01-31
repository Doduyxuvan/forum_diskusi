<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'forum_db');
$result = $conn->query("SELECT * FROM topics ORDER BY created_at DESC");
?>
<h1>Forum Diskusi</h1>
<a href="create_topic.php">Buat Topik Baru</a>
<table>
    <tr>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Waktu Dibuat</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><a href="view_topic.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></td>
        <td><?php echo $row['user_id']; ?></td>
        <td><?php echo $row['created_at']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>
