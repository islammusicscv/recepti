<?php
include_once 'session.php';
include_once 'db.php';

$user_id = $_SESSION['user_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$city_id = (int) $_POST['city_id'];

//posodobitev besedilnih podatkov
$sql = "UPDATE users SET first_name=?, last_name=?, city_id=? WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$first_name, $last_name, $city_id, $user_id]);
msg("Posdobljeno", "success");

//posodobitev avatarja
$target_dir = "avatars/";
$uniqe = date("YmdHis").rand();
$target_file = $target_dir . $uniqe . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if (!empty($_FILES["fileToUpload"]["tmp_name"])) {
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }

// Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        $uploadOk = 0;
    }

// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "webp"
        && $imageFileType != "gif") {
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 1
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //vse je ok
            $sql = "UPDATE users SET avatar = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$target_file, $user_id]);
            msg("Posodobljeno", "success");
        }
    }
}

header("Location: profile.php");