<?php
use Controller\CategoryController;
use Controller\ProductController;
include 'controller/CartController.php';
include 'model/DB.php';
require_once "include_scr.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Minishop - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="template/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="template/css/animate.css">

    <link rel="stylesheet" href="template/css/owl.carousel.min.css">
    <link rel="stylesheet" href="template/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="template/css/magnific-popup.css">

    <link rel="stylesheet" href="template/css/aos.css">

    <link rel="stylesheet" href="template/css/ionicons.min.css">

    <link rel="stylesheet" href="template/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="template/css/jquery.timepicker.css">


    <link rel="stylesheet" href="template/css/flaticon.css">
    <link rel="stylesheet" href="template/css/icomoon.css">
    <link rel="stylesheet" href="template/css/style.css">
</head>
<body class="goto-here">
<?php include "header_shop.php"?>
<?php
$page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : null;
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : null;

switch ($page) {
    case "category":
        $controller = new CategoryController();
        break;
    case "product":
        $controller = new ProductController();
        break;
    case "shop":
        $controller = new ShopController();
        break;
    case "cart":
        $controller = new CartController();
        break;
    default:
        $controller = new CategoryController();
};

switch ($action) {
    case "add":
        $controller->add();
        break;
    case "delete":
        $controller->delete();
        break;
    case "edit":
        $controller->edit();
        break;
    case "getList":
        $controller->getList();
        break;
    case 'show':
        $controller->show();
        break;
    default:
        $controller->index();
};
?>
<?php include "fooster_shop.php"?>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg>
    <script src="template/js/jquery.min.js"></script>
    <script src="template/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="template/js/popper.min.js"></script>
    <script src="template/js/bootstrap.min.js"></script>
    <script src="template/js/jquery.easing.1.3.js"></script>
    <script src="template/js/jquery.waypoints.min.js"></script>
    <script src="template/js/jquery.stellar.min.js"></script>
    <script src="template/js/owl.carousel.min.js"></script>
    <script src="template/js/jquery.magnific-popup.min.js"></script>
    <script src="template/js/aos.js"></script>
    <script src="template/js/jquery.animateNumber.min.js"></script>
    <script src="template/js/bootstrap-datepicker.js"></script>
    <script src="template/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="template/js/google-map.js"></script>
    <script src="template/js/main.js"></script>
</div>
</body>
</html>
