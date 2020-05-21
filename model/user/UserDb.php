<?php


class UserDb
{
    private $conn;

    public function __construct()
    {
        $db = new DB();
        $this->conn = $db->connection();
    }

    public function register($user)
    {
        $sql = "INSERT INTO users ( email, password,name ,role) VALUES ( :email, :password,:name, :role)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("email", $user->getEmail());
        $stmt->bindParam("password",$user->getPassword());
        $stmt->bindParam("name", $user->getName());
        $stmt->bindParam("role", $user->getRole());
        $stmt->execute();
    }

    public function getValue()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->query($sql);
        $result = $stmt->fetchAll();
        $arr = [];
        foreach ($result as $item) {
            $user = new User($item['email'],$item['password'], $item['name'], $item['role']);
            array_push($arr, $user);
        }
        return $arr;
    }

    public function login($user)
    {
        $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $user->getEmail());
        $stmt->bindParam(2, $user->getPassword());
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }


}