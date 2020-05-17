<?php


class DB
{
    private $dsn = "mysql:host=127.0.0.1;dbname=web_shoes";
    private $user = "root";
    private $password = "@Tung123";

    public function connection()
    {
        return new PDO($this->dsn, $this->user, $this->password);
    }

}