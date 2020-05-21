<?php

namespace Controller;
use Category;
use CategoryDB;
use DB;


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
    public function delete()
    {
        $id = $_GET['id'];
        $category = $this->categoryDB->getId($id);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $this->categoryDB->delete($id);
        };
        include '../view/category/delete.php';

//
//        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//            $id = $_GET['id'];
//            $categoty = $this->categoryDB->getID($id);
//            include "../view/category/delete.php";
//        } else {
//            $id = $_POST['id'];
//            $this->categoryDB->delete($id);
//
//        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        $category = $this->categoryDB->getId($id);

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $category = new Category($_POST["name"], $_POST["description"]);
            $category->setId($_POST["id"]);
            $this->categoryDB->edit($category);
        }
        include "../view/category/edit.php";
    }
}