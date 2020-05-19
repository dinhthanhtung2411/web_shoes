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
        $sql = "INSERT INTO users (name, email, password, role) VALUE (:name, :email, :password, :role)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("name", $user->getName());
        $stmt->bindParam(":email", $user->getEmail());
        $stmt->bindParam(":password",$user->getPassword());
        $stmt->bindParam(":role", $user->getRole());
        $stmt->execute();
    }

    public function getValue()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->query($sql);
        $result = $stmt->fetchAll();
        $arr = [];
        foreach ($result as $item) {
            $user = new User($item['name'],$item['email'], $item['password'], $item['role']);
            array_push($arr, $user);
        }
        return $arr;
    }

    public function login($user)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $user->getEmail());
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result["password"] == $user->getPassword){
            header("Location: .././index.php");
        }else{
            return "Wrong email or password";
        }

    }
//
//    public function get_current_username()
//    {
//        $user = is_logged();
//            return isset($user['username']) ? $user['username'] : '';
//
//    }
//
//    function get_current_level(){
//        $user  = is_logged();
//        return isset($user['level']) ? $user['level'] : '';
//    }


}