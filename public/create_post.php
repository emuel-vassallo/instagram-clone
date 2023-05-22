<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/login.php');
}

$activePage = '';
if (basename($_SERVER['PHP_SELF']) === 'index.php') {
    $activePage = 'feed';
} elseif (basename($_SERVER['PHP_SELF']) === 'edit_profile.php') {
    $activePage = 'settings';
} elseif (basename($_SERVER['PHP_SELF']) === 'logout.php') {
    $activePage = 'logout';
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Instagram Clone</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Bootstrap Bundle JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <!-- JustValidate JavaScript -->
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>

    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body class="d-flex">
    <?php include('navbar.php'); ?>
    <main class="d-flex flex-column w-100 h-100">
        <div class="d-flex justify-content-between w-100 feed-top-section pt-3 pe-5 pb-3 ps-5 m-0">
            <div class="form-group has-search d-flex align-items-center">
                <span class="bi bi-search form-control-feedback"></span>
                <input type="search" class="form-control mr-sm-2" placeholder="Search" aria-label="Search">
            </div>

            <a type="button" href="create_post.php"
                class="btn btn-primary d-flex align-items-center justify-content-center">
                <i class="bi bi-plus fs-4 d-flex me-1"></i>
                Create Post
            </a>
        </div>

        <div class="create-post-container">
        </div>

        <?php include('footer.php'); ?>
    </main>
</body>

</html>