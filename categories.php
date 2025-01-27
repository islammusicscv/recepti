<?php
include_once "header.php";
?>
<h1>Kategorije</h1>
<?php
    if (isAdmin()) {
        echo '<a href="category_add.php">Dodaj kategorijo</a>';
    }
?>
<ul>
    <?php
    include_once "db.php";
    $sql = "SELECT * FROM categories";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo '<li>'.$row['title'];
        if (isAdmin()) {
            echo ' <a href="category_delete.php?id=' . $row['id'] . '" onclick="return confirm(\'Prepričani?\')">(x)</a>';
            echo ' <a href="category_edit.php?id=' . $row['id'] . '">(u)</a>';
        }
        echo '</li>';
    }
    ?>
</ul>
<?php
include_once "footer.php";
?>
