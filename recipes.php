<?php
include_once 'header.php';
include_once 'db.php';
?>

<h1>Pregled receptov</h1>

<a href="recipe_add.php">Dodaj recept</a> <br />

<ul>
<?php
    $sql = "SELECT r.id, r.title AS recipe, c.title AS category 
    FROM recipes r INNER JOIN categories c ON c.id=r.category_id ORDER BY r.title";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch()) {

    }
?>
</ul>

<?php
include_once 'footer.php';
?>
