<?php
session_start();
include 'db.php';

$to_user = $_GET['user_id'];
$from_user = $_SESSION['user_id'];

if (isset($_POST['send_review'])) {

    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // защита от повторов (опционально позже)
    $check = $conn->query("
        SELECT id FROM reviews 
        WHERE user_id=$to_user AND from_user_id=$from_user
    ");

    if ($check->num_rows == 0) {

        $stmt = $conn->prepare("
            INSERT INTO reviews (user_id, from_user_id, rating, comment)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->bind_param("iiis", $to_user, $from_user, $rating, $comment);
        $stmt->execute();
    }

    header("Location: profile.php?id=$to_user");
    exit;
}
?>

<div class="container">

<div class="card">

<h2>⭐ Оставить отзыв</h2>

<form method="post">

    <select name="rating">
        <option value="5">⭐⭐⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="2">⭐⭐</option>
        <option value="1">⭐</option>
    </select>

    <textarea name="comment" placeholder="Комментарий..."></textarea>

    <button name="send_review">Отправить</button>

</form>

</div>

</div>
