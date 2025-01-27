<?php
include_once 'session.php';
include_once 'db.php';

$user_id = $_SESSION['user_id'];
$old_pass = $_POST['old_pass'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

if ($pass1 != $pass2) {
    msg('Novi gesli se ne ujamata','error');
    header("Location: profile.php");
    die();
}

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!password_verify($old_pass, $user['pass'])) {
    msg('Nepravilno geslo','error');
    header("Location: profile.php");
    die();
}

$pass_hash = password_hash($pass1, PASSWORD_DEFAULT);

$sql = "UPDATE users SET pass=? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$pass_hash,$user_id]);

msg('Geslo je posodobljeno!','success');
header("Location: profile.php");
die();