<?php
include_once 'session.php';
if (!isAdmin()) {
    msg('Nedovoljen dostop','warning');
    header("Location: index.php");
    die();
}

include_once 'db.php';
$id = $_GET['id'];
$sql = "DELETE FROM cities WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
//preusmeritev nazaj
header("Location: cities.php");
