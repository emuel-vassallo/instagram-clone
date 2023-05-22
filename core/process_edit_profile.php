<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    require_once("db_functions.php");

    $conn = connect_to_db();

    $errors = array();

    if (isset($_POST['user_display_name']) && !empty($_POST['user_display_name'])) {
        $user_display_name = mysqli_real_escape_string($conn, trim($_POST['user_display_name']));
        if (strlen($user_display_name) === 0) {
            $errors[] = "Display name is required.";
        }
        if (strlen($user_display_name) < 1 || strlen($user_display_name) > 30) {
            $errors[] = "Display name must be between 1 and 30 characters long.";
        }
    }

    if (isset($_POST['bio']) && !empty($_POST['bio'])) {
        $bio = stripslashes(mysqli_real_escape_string($conn, trim($_POST['bio'])));
        if (strlen($bio) > 150) {
            $errors[] = "Bio must not exceed 150 characters.";
        }
    }

    if (empty($errors)) {
        $user_id = $_SESSION['user_id'];

        $new_pfp_file = $_FILES['profile_picture_picker'];

        if (!empty($new_pfp_file['name'])) {
            $profile_picture_path = upload_profile_picture($new_pfp_file);
        } else {
            $profile_picture_path = $_SESSION['user_profile_picture_path'];
        }

        $result = update_user_profile($conn, $user_id, $user_display_name, $profile_picture_path, $bio);

        if ($result) {
            $_SESSION['user_display_name'] = $user_display_name;
            $_SESSION['user_bio'] = stripslashes($bio);
            header("Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/index.php");
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
} else {
    header("Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/index.php");
}
?>