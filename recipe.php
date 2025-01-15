<?php
include_once 'header.php';
include_once 'db.php';

$id = (int) $_GET['id'];

$sql = "SELECT r.*, c.title AS category, u.first_name, u.last_name 
FROM users u INNER JOIN recipes r ON r.user_id = u.id INNER JOIN categories c ON c.id=r.category_id
WHERE r.id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$row = $stmt->fetch();
?>

<h1>Pregled recepta</h1>

<div id="recpet">
    <div id="ime_recepta"><?php echo $row['title'];?></div>
    <div id="kategorija"><?php echo $row['category'];?></div>
    <div id="slike">
        <div class="slika"><img src="" alt="" /></div>
        <div class="slika"><img src="" alt="" /></div>
        <div class="slika"><img src="" alt="" /></div>
    </div>
    <form action="recipe_image_upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required="required" placeholder="Naloži sliko recepta" />
        <input type="submit" value="Naloži" />
    </form>
    <div id="opis_recepta"><?php echo $row['description'];?></div>
    <div id="podrobnosti">
        <div id="postopek"><?php echo $row['proceedings'];?></div>
        <div id="sestavine"><?php echo $row['ingredients'];?></div>
    </div>
    <div id="trajanje">
        <div id="cas"><?php echo $row['duration'];?> min</div>
        <div id="zahtevnost"><?php echo $row['level'];?></div>
    </div>
</div>


<?php
include_once 'footer.php';
?>
