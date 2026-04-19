<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['upload'])) {

    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $video_url = $_POST['url'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO video_lessons (user_id, title, video_url, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $title, $video_url, $description);
    $stmt->execute();
        
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Видеоуроки</title>
</head>
<body>

<nav class="navbar">
    <form class="global-search" method="GET" action="search_users.php">

       <input type="text" name="q" placeholder="🔍 Найти пользователя...">

    </form>

    <div class="logo">👩‍🏫 OquSpace</div>

    <div class="nav-links">

        <a href="index.php">🏠 Лента</a>
        <a href="create.php" class="active">📢 Объявления</a>
        <a href="create_material.php">📚 Учебные материалы</a>
        <a href="create_video.php">🎥 Видео уроки</a>
        <a href="create_group.php">👥 Группы</a>
        <a href="profile.php">👤 Профиль</a>

    </div>

    <div class="nav-right">
        <a href="logout.php" class="logout-link">🚪 Выйти</a>
    </div>

</nav>

<div class="page-center">

<div class="form-box">

<h2>🎥 Видеоурок</h2>

<form method="POST" enctype="multipart/form-data">

    <input type="text" name="title" placeholder="Название">

    <input type="text" name="url" placeholder="Ссылка">

    <textarea name="description" placeholder="Описание"></textarea>

    <button type="submit" name="upload">Загрузить</button>
</form>

</div>

</div>

</body>
</html>
