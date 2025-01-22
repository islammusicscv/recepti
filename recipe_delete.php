<?php
include_once 'session.php';
include_once 'db.php';
$id = $_GET['id'];
$sql = "DELETE FROM recipes WHERE id=? and user_id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id, $_SESSION['user_id']]);
//preusmeritev nazaj
header("Location: recipes.php");
