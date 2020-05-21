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

    public function getID($id)
    {

        $sql = "SELECT * FROM categories WHERE id= $id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        $result = $stmt->fetch();
        $category = new Category($result["name"],$result["description"]);
        $category->setId($result["id"]);
        return $category;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM categories WHERE id = $id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1,$id);
        return $stmt->execute();
    }
    public function edit($category)
    {
        $sql = "UPDATE categories SET name = ?, description = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(1,$category->getName());
        $stmt->bindParam(2,$category->getDescription());
        $stmt->bindParam(3,$category->getId());
        $stmt->execute();
    }
}