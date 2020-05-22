<?php
namespace Controller;
use Category;
use CategoryDB;
use DB;


ob_start();

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
            header("Location: ../admin/admin.php?page=category&action=list");
        }
    }
    public function delete()
    {
        $id = $_GET['id'];
        $category = $this->categoryDB->getId($id);
        include '../view/category/delete.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $this->categoryDB->delete($id);
            header("Location: ../admin/admin.php?page=category&action=list");
        };

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
        include "../view/category/edit.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $category = new Category($_POST["name"], $_POST["description"]);
            $category->setId($_POST["id"]);
            $this->categoryDB->edit($category);
            header("Location: ../admin/admin.php?page=category&action=list");

        }
    }
}

?>