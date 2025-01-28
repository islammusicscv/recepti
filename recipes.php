<?php
include_once 'header.php';
include_once 'db.php';
?>

<h1>Pregled receptov</h1>

<a href="recipe_add.php">Dodaj recept</a> <br />

<div id="recepti">
<?php
    $sql = "SELECT r.*, r.title AS recipe, c.title AS category 
    FROM recipes r INNER JOIN categories c ON c.id=r.category_id ORDER BY r.title";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        echo '<div class="recept">';
        echo '<img src="assets/img/recipe.png" alt="" />';
        echo '<div class=podrobnosti">';
        echo '<a href="recipe.php?id='.$row['id'].'">';
            echo $row['recipe'].' ('.$row['category'].')';
        echo '</a>';
        if ($_SESSION['user_id'] == $row['user_id']) {
            echo '<div class="akcija">';
            echo ' <a href="recipe_delete.php?id=' . $row['id'] . '" onclick="return confirm(\'Prepričani?\')">(x)</a>';
            echo ' <a href="recipe_edit.php?id=' . $row['id'] . '">(u)</a>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    }

?>
</div>

<?php
include_once 'footer.php';
?>
