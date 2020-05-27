<?php

namespace Controller;
use Product;
//use ImageDB;
use ProductDB;
use CategoryDB;
use DB;
ob_start();
class ProductController
{
    private $productDB;
//    private $imageDB;

    public function __construct()
    {
        $this->productDB = new ProductDB();
//        $this->imageDB = new ImageDB();
    }

    public function index()
    {
        $products = $this->productDB->getAll();
//        $images = [];
//        foreach ($products as $product) {
//            $images["$product->id"] = $this->imageDB->getBy($product->id);
//        }
        include "../view/product/list.php";
    }

    public function add()
    {
        $categoryDB = new CategoryDB();
        $categories = $categoryDB->getAll();
        include "../view/product/add.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $product = new Product($_POST["name"],$_POST["price"], $_POST["category_id"], $_POST['description']);
            $product->setCreatedDate($_POST["createdDate"]);
            $this->productDB->add($product);
            $product_id = $this->productDB->getLastProductId();
            include_once 'upload_images.php';
            header("Location: ../admin/admin.php?page=product&action=list");
        }

    }
    public function delete()
    {
        $id = $_GET['id'];
        $product = $this->productDB->getById($id);
        include '../view/product/delete.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $this->productDB->delete($id);
            header("Location: ../admin/admin.php?page=product&action=list");
        };
    }

    public function edit()
    {
        $categoryDB = new CategoryDB();
        $categories = $categoryDB->getAll();
        $id = $_GET['id'];
        $product = $this->productDB->getById($id);
        include "../view/product/edit.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $product = new Product($_POST["name"], $_POST["price"],$_POST["category_id"],$_POST["description"]);
            $product->setId($_POST["id"]);
            $product->setCreatedDate($_POST["createdDate"]);
            $this->productDB->edit($product);
            include_once 'upload_images.php';
            header("Location: ../admin/admin.php?page=product&action=list");

        }
    }
}
?>