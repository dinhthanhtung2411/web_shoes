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
        $sql = "INSERT INTO users (email, password, role) VALUE (:email, :password, :role)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $user->getEmail());
        $stmt->bindParam(":password",$user->getPassword());
        $stmt->bindParam(":role", $user->getRole());
        $stmt->execute();
    }

}