<?php
include_once 'session.php';
if (!isAdmin()) {
    msg('Nedovoljen dostop','warning');
    header("Location: index.php");
    die();
}
include_once "db.php";

$title = $_POST['title'];
$post_number = $_POST['post_number'];

$sql = "INSERT INTO cities(title, post_number) VALUES(?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$title,$post_number]);

//preusmeritev
header("Location: cities.php");
?>