<?php
include_once 'session.php';
if (!isAdmin()) {
    header("Location: index.php");
    die();
}
include_once "header.php";
?>
    <h1>Dodaj kraj</h1>
    <form action="city_insert.php" method="post">
        Vnesi kraj: <input type="text" name="title" placeholder="Vnesi ime kraja"  /><br />
        Vnesi poštno številko: <input type="text" name="post_number" /><br />
        <input type="submit" value="Shrani" />
    </form>
<?php
include_once "footer.php";
?>
