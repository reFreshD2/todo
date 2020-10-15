<?php

namespace App\Storage;

use App\Storage\Interfaces\UserStorageInterface;
use App\Storage\Connection;

class UserStorage implements UserStorageInterface
{
    public $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    public function create($data)
    {
        $table = 'user';
        if (isset($data['login']) && isset($data['password'])) {
            $login = $this->connection->real_escape_string($data['login']);
            $password = $this->connection->real_escape_string($data['password']);
            $sql = "INSERT INTO $table(login, password) VALUES (\"$login\",\"$password\")";
            if (!$this->connection->query($sql)) {
                return false;
            }
            return true;
        }
        return false;
    }

    public function getBy($data)
    {
        $table = 'user';
        if (isset($data['login']) && isset($data['password'])) {
            $login = $this->connection->real_escape_string($data['login']);
            $password = $this->connection->real_escape_string($data['password']);
            $sql = "SELECT FROM $table WHERE login = \"$login\" and password = \"$password\"";
            $result = $this->connection->query($sql);
            if ($result->num_row == 1) {
                $row = $result->fetch_assoc();
                return ["login" => $row['login'], "password" => $row['password']];
            } else {
                return -1;
            }
        }
        return -2;
    }

    public function haveIn($data)
    {
        $table = 'user';
        if (isset($data['login'])) {
            $login = $this->connection->real_escape_string($data['login']);
            $sql = "SELECT FROM $table WHERE login = \"$login\"";
            $result = $this->connection->query($sql);
            if ($result->num_row == 1) {
                return true;
            }
        }
        return false;
    }
}