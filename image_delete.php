<?php
include_once 'session.php';
include_once 'db.php';

$image_id = (int) $_GET['id'];

$sql = "SELECT r.*, i.url FROM images i INNER JOIN recipes r ON i.recipe_id=r.id WHERE i.id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$image_id]);
$recipe = $stmt->fetch();

//preverim, ali je trenutno prijavljeni uporabnik lastnik recepta
if ($recipe['user_id'] == $_SESSION['user_id']) {
    //vse ok
    $sql = "DELETE FROM images WHERE id=?"; 
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$image_id]);

    //izbris iz strežnika
    unlink($recipe['url']);

    msg('Uspešno brisanje slike.','success');
}
else {
    msg('Nisi lastnik!','error');
}

header("Location: recipe.php?id=".$recipe['id']);