<?php

namespace Controller;
use Category;
use CategoryDB;

class CategoryController
{
    private $categoryDB;

    public function __construct()
    {
        $this->categoryDB = new CategoryDB();
    }

    public function index()
    {
        $categories = $this->categoryDB->getAll();
        include "../view/category/list.php";
    }

    public function add()
    {
        include "../view/category/add.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $category = new Category($_POST['name'], $_POST['description']);
            $this->categoryDB->add($category);
        }
    }
}