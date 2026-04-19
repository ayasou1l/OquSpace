<?php
session_start();
include 'db.php';

$result = $conn->query("
    SELECT v.*, u.username 
    FROM video_lessons v
    JOIN users u ON v.user_id = u.id
    ORDER BY v.id DESC
");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Видео уроки</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">

<h2>🎥 Видео уроки</h2>

<?php while($v = $result->fetch_assoc()): ?>

<div class="card">

    <h3><?= htmlspecialchars($v['title']) ?></h3>
    <p><?= htmlspecialchars($v['description']) ?></p>

    <p>👤 <?= $v['username'] ?></p>

    <video width="100%" controls>
        <source src="<?= $v['video_path'] ?>">
    </video>

</div>

<?php endwhile; ?>

</div>

</body>
</html>
