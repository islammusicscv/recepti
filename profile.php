<?php
include_once 'header.php';
include_once 'db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id =?";
$stmt= $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>
<h1>Zdravo <?php echo $user['first_name'];?></h1>

<h2>Moji podatki</h2>
<form action="profile_update.php" method="post" enctype="multipart/form-data">
    <input type="text" name="first_name" value="<?php echo $user['first_name'];?>" placeholder="Vnesi ime" required="required" class="form-control" /><br />
    <input type="text" name="last_name" value="<?php echo $user['last_name'];?>" placeholder="Vnesi priimek" required="required" class="form-control" /><br />
    <select name="city_id" required="required" class="form-control">
        <?php
        include_once 'db.php';
        $sql = "SELECT * FROM cities";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            if ($user['city_id'] == $row['id']) {
                echo '<option value="'.$row['id'].'" selected="selected">'.$row['title'].'</option>';
            }
            else {
                echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
            }
        }
        ?>
    </select> <br />
    <input type="file" name="fileToUpload" placeholder="Naloži avatar" /><br />
    <input type="submit" value="Shrani" />
</form>
<hr />
<h2>Spremeni geslo</h2>
<form action="password_change.php" method="post">
    <input type="password" name="old_pass" placeholder="Vnesi trenutno geslo" required="required" class="form-control"/><br />
    <input type="password" name="pass1" placeholder="Vnesi novo geslo" required="required" class="form-control"/><br />
    <input type="password" name="pass2" placeholder="Ponovi novo geslo" required="required" class="form-control"/><br />
    <input type="submit" value="Shrani" />
</form>
<?php
include_once 'footer.php';
?>
