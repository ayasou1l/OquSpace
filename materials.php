<?php
session_start();
include 'db.php';

$result = $conn->query("
    SELECT m.*, u.username 
    FROM materials m
    JOIN users u ON m.user_id = u.id
    ORDER BY m.id DESC
");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Материалы</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">

<h2>📚 Учебные материалы</h2>

<?php while($m = $result->fetch_assoc()): ?>

<div class="card">

    <h3><?= htmlspecialchars($m['title']) ?></h3>
    <p><?= htmlspecialchars($m['description']) ?></p>

    <p>👤 <?= $m['username'] ?></p>

    <a href="<?= $m['file_path'] ?>" download class="btn-primary">
        Скачать
    </a>

</div>

<?php endwhile; ?>

</div>

</body>
</html>
