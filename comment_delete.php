<?php
include_once 'session.php';
include_once 'db.php';

$comment_id = (int) $_GET['id'];

$sql = "SELECT * FROM comments WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$comment_id]);

$comment = $stmt->fetch();

if ($_SESSION['user_id'] == $comment['user_id']) {
    //lahko brišem
    $sql = "DELETE FROM comments WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$comment_id]);
}

header("Location: recipe.php?id=".$comment['recipe_id']);