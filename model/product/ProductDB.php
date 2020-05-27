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
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1,$id);
        $stmt->execute();
        $result = $stmt->fetch();
        $product = new Product($result["name"],$result["price"], $result['category_id'],$result["description"]);
        $product->setCreatedDate($result['createdDate']);
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
                       products.price,             
                       products.category_id,       
                       products.description
                From products INNER JOIN categories on products.category_id=categories.name".$type."ORDER BY createdDate ASC LIMIT 0, 8";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        $products = [];

        foreach ($result as $item){
            $product = new Product($item["name"],
                                    $item["price"],
                                    $item["category_id"],
                                    $item["description"]);
            $product->setId($item["id"]);
            $product->setCreatedDate($item["createdDate"]);
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


        $sql = "SELECT products.* FROM products INNER JOIN categories ON products.category_id = categories.id"."$orderStr $type $limitStr";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        $products = [];
        foreach ($result as $item){
            $product = new Product($item["name"],
                $item["price"],
                $item['category_id'],
                $item["description"]);
            $product->setId($item["id"]);
            $product->setCreatedDate($item["createdDate"]);
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
                $item["price"],
                $item["category_id"],
                $item["description"],
                $item["createdDate"]);
            $product->setId($item["id"]);
            array_push($products,$product);
        }
        return $products;
    }
    public function add($product)
    {
        $sql = "INSERT INTO products(name, price, category_id, description, createdDate) VALUE (?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $product->getName());
        $stmt->bindParam(2, $product->getPrice());
        $stmt->bindParam(3, $product->getCategoryId());
        $stmt->bindParam(4, $product->getDescription());
        $stmt->bindParam(5, $product->getCreatedDate());
        return $stmt->execute();
    }

    public function getLastProductId()
    {
        $sql = 'SELECT id FROM products ORDER BY id DESC LIMIT 1';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE id = $id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1,$id);
        $stmt->execute();
    }

    public function edit($product)
    {
        $sql = "UPDATE products SET name = ?,
                                    price = ?,
                                    category_id = ?,
                                    description = ?,
                                    createdDate = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1,$product->getName());
        $stmt->bindParam(2,$product->getPrice());
        $stmt->bindParam(3,$product->getCategoryId());
        $stmt->bindParam(4,$product->getDescription());
        $stmt->bindParam(5,$product->getCreatedDate());
        $stmt->execute();
    }
}