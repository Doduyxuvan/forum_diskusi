<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'forum_db');
$topic_id = $_GET['id'];
$topic_result = $conn->query("SELECT * FROM topics WHERE id = $topic_id");
$topic = $topic_result->fetch_assoc();
$comments_result = $conn->query("SELECT * FROM comments WHERE topic_id = $topic_id ORDER BY created_at DESC");
?>
<h1><?php echo $topic['title']; ?></h1>
<p><?php echo $topic['content']; ?></p>

<h2>Komentar</h2>
<form method="POST">
    <textarea name="content" placeholder="Tulis komentar" required></textarea><br>
    <button type="submit">Kirim Komentar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];
    $conn->query("INSERT INTO comments (content, user_id, topic_id) VALUES ('$content', '$user_id', '$topic_id')");
    header("Location: view_topic.php?id=$topic_id");
}

while ($comment = $comments_result->fetch_assoc()): ?>
    <div>
        <p><?php echo $comment['content']; ?></p>
        <p>Oleh: <?php echo $comment['user_id']; ?> pada <?php echo $comment['created_at']; ?></p>
    </div>
<?php endwhile; ?>
