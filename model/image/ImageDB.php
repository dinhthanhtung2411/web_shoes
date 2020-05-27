<?php

class ImageDB
{
    protected $db;

    public function __construct()
    {
        $db = new DB();
        $this->db = $db->connection();
    }

    public function create($name, $product_id)
    {
        $sql = "INSERT INTO image(name,product_id) VALUES ('$name', '$product_id')";
        $this->db->query($sql);
    }

    public function getBy($product_id)
    {
        $sql = "SELECT * FROM images WHERE product_id = '$product_id'";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        $images = [];

        foreach ($result as $item){
            $image = new Image($item['name']);
            $image->setId($item["id"]);
            array_push($images,$image);
        }
        return $images;
    }

    public function getAll()
    {
        $query = "SELECT * FROM image ORDER BY id DESC";
        $statement = $this->imgConnect->prepare($query);
        if ($statement->execute()) {
            $result = $statement->fetchAll();
            return $this->createImage($result);
        }
    }

    public function delete($image_id)
    {
        $sql = "DELETE FROM image WHERE id = $image_id";
        $stmt = $this->imgConnect->query($sql);
        $stmt->execute();
    }
}