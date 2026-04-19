<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['create'])) {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $creator_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO groups_table (name, description, creator_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $description, $creator_id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Группы</title>
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
        <a href="groups.php">👥 Группы</a>
        <a href="profile.php">👤 Профиль</a>

    </div>

    <div class="nav-right">
        <a href="logout.php" class="logout-link">🚪 Выйти</a>
    </div>

</nav>

<div class="page-center">

    <div class="form-box">

        <h2>👥 Создать группу</h2>

        <form method="post">

            <input type="text" name="name" placeholder="Название группы">

            <textarea name="description" placeholder="Описание"></textarea>

            <button>Создать</button>

        </form>

    </div>

</div>

</body>
</html>
