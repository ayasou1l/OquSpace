<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
$announcement_id = $_POST['announcement_id'];
$message = $_POST['message'];

$conn->query("
    INSERT INTO announcement_responses 
    (announcement_id, user_id, message)
    VALUES ($announcement_id, $user_id, '$message')
");

header("Location: index.php");
exit;
?>
