<?php

namespace Controller;
use Product;
use ProductDB;
ob_start();
class ProductController
{
    private $productDB;

    public function __construct()
    {
        $this->productDB = new ProductDB();
    }

    public function index()
    {
        $products = $this->productDB->getAll();
        include "../view/product/list.php";
    }
}

?>