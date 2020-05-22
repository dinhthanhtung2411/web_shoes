<?php


class ImageDB
{
    protected $imgConnect;

    public function __construct($imgConnect)
    {
        $this->imgConnect = $imgConnect;
    }

    public function createImage(array $result)
    {
        $arr = [];
        foreach ($result as $item) {
            $image = new Image($item['name']);
            $image->setId($item['id']);
            array_push($arr, $image);
        }
        return $arr;
    }


    public function createImages($image)
    {
        $images = $image->getName();
        $sql = "INSERT INTO image(name) VALUES ('$images')";
        $this->imgConnect->query($sql);
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