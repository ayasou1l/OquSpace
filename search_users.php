<?php
include 'db.php';

$q = $_GET['q'] ?? '';

$result = null;

if ($q != '') {
    $result = $conn->query("
        SELECT * FROM users 
        WHERE username LIKE '%$q%'
    ");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Поиск пользователей</title>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">

<h2>🔍 Поиск пользователей</h2>

<form method="GET">
    <input type="text" name="q" placeholder="Введите username...">
    <button>Найти</button>
</form>

<?php if ($result): ?>
    <?php while($u = $result->fetch_assoc()): ?>
        <div class="card">
            <h3><?= htmlspecialchars($u['username']) ?></h3>
            <a href="profile.php?id=<?= $u['id'] ?>">Открыть профиль</a>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

</div>

</body>
</html>
