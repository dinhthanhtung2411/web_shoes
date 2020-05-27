<?php

class CartController
{
    private $cart;
    private $productDB;

    public function __construct()
    {
        if ($_SESSION['cart'] == null) {
            $_SESSION['cart'] = [];
        }
        $this->cart = $_SESSION['cart'];
        $this->productDB = new ProductDB();
    }

    public function add($product_id)
    {
        if (!key_exists($product_id, $this->cart)) {
            $product = $this->productDB->getById($product_id);
            $item = [$product, 1];
            $_SESSION['cart']["$product_id"] = $item;
            $this->cart = $_SESSION['cart'];
        }
    }

    public function delete($product_id)
    {
        if (key_exists($product_id, $this->cart)) {
            unset($this->cart["$product_id"]);
            unset($_SESSION['cart']["$product_id"]);
        }
    }

    public function update($product_id, $quantity)
    {
        $product = $this->productDB->getById($product_id);
        $item = [$product, (integer)$quantity];
        $_SESSION['cart']["$product_id"] = $item;
        $this->cart = $_SESSION['cart'];
    }

    public function getList()
    {
        include 'view/shop/shop-cart.php';
    }
}