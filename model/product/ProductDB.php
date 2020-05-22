<?php


class ProductDB
{
    private $db;

    public function __construct()
    {
        $db = new DB();
        $this->db = $db->connection();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM products WHERE id = $id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        $result = $stmt->fetch();
        $product = new Product($result["name"],$result["image"],$result["price"],$result["category_id"],$result["image_id"],$result["description"], $result["createdDate"]);
        $product->setId($result["id"]);
        return $product;
    }

    public function getNewestProduct($type)
    {
        if($type != ''){
            $type = "WHERE category_id" . $type;
        }
        $sql = "SELECT products.id,
                       products.name,             
                       products.image,             
                       products.price,             
                       products.category_id,
                       products.image_id,             
                       products.description
                From products INNER JOIN categories on products.category_id=categories.name".$type."ORDER BY createdDate ASC LIMIT 0, 8";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        $products = [];

        foreach ($result as $item){
            $product = new Product($item["name"],
                                    $item["image"],
                                    $item["price"],
                                    $item["category_id"],
                                    $item["image_id"],
                                    $item["description"],
                                    $item["createdDate"]);
            $product->setId($item["id"]);
            array_push($products,$product);
        }
        return $products;
    }

    public function getProductByType($type, $limit = null, $isOrder = false)
    {
        if ($limit !== null) {
            $limitStr = "LIMIT 0, $limit";
        } else {
            $limitStr = '';
        }
        if ($type != '') {
            $type = "WHERE category_id = " . "'".$type."'";
        }
        if ($isOrder) {
            $orderStr = "ORDER BY createdDate";
        } else {
            $orderStr = '';
        }


        $sql = "SELECT products.id, products.name, products.image, products.price, products.category_id,products.image_id, products.description
            FROM products INNER JOIN categories ON products.category_id = categories.name"."$orderStr $type $limitStr";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        $products = [];
        foreach ($result as $item){
            $product = new Product($item["name"],
                $item["image"],
                $item["price"],
                $item["category_id"],
                $item["image_id"],
                $item["description"],
                $item["createdDate"]);
            $product->setId($item["id"]);
            array_push($products,$product);
        }
        return $products;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM products";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        $products = [];
        foreach ($result as $item){
            $product = new Product($item["name"],
                $item["image"],
                $item["price"],
                $item["category_id"],
                $item["image_id"],
                $item["description"],
                $item["createdDate"]);
            $product->setId($item["id"]);
            array_push($products,$product);
        }
        return $products;
    }

}