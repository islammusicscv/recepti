<?php
include_once 'header.php';
include_once 'db.php';
?>

<h1>Pregled receptov</h1>

<a href="recipe_add.php">Dodaj recept</a> <br />

<div id="recepti">
<?php
    $sql = "SELECT r.*, r.title AS recipe, c.title AS category 
    FROM recipes r INNER JOIN categories c ON c.id=r.category_id ORDER BY r.date_add ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        echo '<div class="recept">';
        $sql = "SELECT * FROM images WHERE recipe_id = ? ORDER BY date_add LIMIT 1";
        $stmt2 = $pdo->prepare($sql);
        $stmt2->execute([$row['id']]);
        $image = $stmt2->fetch();
        //if stavek, če slika obstaja
        $url = "assets/img/recipe.png";
        if (!empty($image['url'])) {
            $url = $image['url'];
        }
        echo '<a href="recipe.php?id='.$row['id'].'">';
            echo '<img src="'.$url.'" alt="" />';
        echo '</a>';
        echo '<div class="podrobnosti">';
        echo '<a href="recipe.php?id='.$row['id'].'">';
            echo $row['recipe'].' ('.$row['category'].')';
        echo '</a>';
        echo '</div>';
        if ($_SESSION['user_id'] == $row['user_id']) {
            echo '<div class="akcija">';
            echo ' <a href="recipe_delete.php?id=' . $row['id'] . '" onclick="return confirm(\'Prepričani?\')"><i class="bi bi-trash"></i></a>';
            echo ' <a href="recipe_edit.php?id=' . $row['id'] . '"><i class="bi bi-pencil"></i></a>';
            echo '</div>';
        }
        echo '</div>';
    }
    echo '<div style="clear:both"></div>';
?>
</div>

<?php
include_once 'footer.php';
?>
