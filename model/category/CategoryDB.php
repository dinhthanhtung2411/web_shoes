<?php


class CategoryDB
{
    private $db;

    public function __construct()
    {
        $db = new DB();
        $this->db = $db->connection();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM categories";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetchAll();
        $arr = [];
        foreach ($result as $item){
            $category = new Category($item['name'],$item['description']);
            $category->setId($item['id']);
            array_push($arr,$category);
        }
        return $arr;
    }

    public function add($category)
    {
        $sql = "INSERT INTO categories(name,description) VALUE (?,?)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(1,$category->getName());
        $stmt->bindParam(2,$category->getDescription());

        return $stmt->execute();

    }
}