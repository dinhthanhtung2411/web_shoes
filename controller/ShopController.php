<?php

class ShopController
{
    private $shopDB;
    private $categoryDB;

    public function __construct()
    {
        $this->shopDB = new ProductDB();
        $this->categoryDB = new CategoryDB();
    }

    public function index()
    {
        include_once "view/shop/index.php";
    }

    public function show()
    {
        $product = $this->shopDB->getById($_GET['product-id']);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cartController = new CartController();
            $cartController->update($_GET['product-id'],$_POST['quantity']);
        }
        include 'view/shop/product-single.php';
    }

    public function getList()
    {
        $categories = $this->categoryDB->getAll();
        if ($_GET['filter']) {
            $products = $this->shopDB->getProductByType($_GET['category']);
        } else {
            $products = $this->shopDB->getAll();
        }
        if ($_GET['add-cart'] == true) {
            $cartController = new CartController();
            $cartController->add($_GET['product-id']);
        }
        include_once "view/shop/list.php";
    }

    public function listRelativeProduct($type, $limit)
    {
        return $this->shopDB->getProductByType($type, $limit);
    }

    public function detail()
    {
        $product = $this->shopDB->getById($_GET["id"]);
        $relativeProducts = $this->listRelativeProduct($product->getType(), 4);
        include_once "product-page.php";
    }

//    public function getList()
//    {
//        $categories = $this->getCategories();
//        if ($_SERVER["REQUEST_METHOD"] == "GET") {
//            $products = $this->shopDB->getAll();
//        } else {
//            $products = $this->shopDB->getProductByType($_GET["type"]);
//        }
//
//        include_once "categories.php";
//    }

    public function listNewestProduct()
    {
        $type = $_GET["type"];
        $products = $this->shopDB->getNewestProduct($type);
        include_once "homeuser.php";
    }

    public function getCategories()
    {
        $categoryDB = new CategoryDB();
        return  $categoryDB->getAll();
    }

    public function add()
    {
        $categories = $this->getCategories();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!empty($_FILES["image"]["name"])) {
                include "upload.php";
            }

            $product = new Product($_POST["name"],
                $_POST["price"],
                $_POST["type"],
                $_POST["description"],
                $target_file,
                $_POST["createdDate"]);

            if ($isSuccess = $this->shopDB->add($product)) {
                $message = "Add product successful!";
            } else {
                $message = "Something error! Try again!";
            }
        }
        include_once "view/product/add.php";
    }

    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $id = $_GET["id"];
            $product =$this->shopDB->getById($id);
        } else {
            $this->shopDB->delete($_POST["id"]);
            header("location: admin.php");
        }
        include "view/product/delete.php";

    }

    public function edit()
    {
        $categories = $this->getCategories();

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $id = $_GET["id"];
            $product = $this->shopDB->getById($id);
        } else {

            if (!empty($_FILES["image"]["name"])) {
                include "upload.php";
            } else {
                $target_file = $_POST["avatar"];
            }

            $product = new Product($_POST["name"],
                $_POST["price"],
                $_POST["type"],
                $_POST["description"],
                $target_file,
                $_POST["createdDate"]);
            $product->setId($_POST["id"]);

            $isSuccess = $this->shopDB->edit($product);

            if ($isSuccess) {
                $message = 'Edit successful!';
            } else {
                $message = "Something error! Retry!";
            }
        }
        include "view/product/edit.php";
    }


}