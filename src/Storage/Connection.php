<?php

namespace App\Storage;

class Connection {
    protected static $instance;

    public static function getInstance() {
        if (empty(self::$instance)) {
            $db_host = 'localhost';
            $db_username = 'todo';
            $db_password = 'password';
            $db_name = 'todos';
            self::$instance = new mysqli($db_host,$db_username,$db_password,$db_name);
            if (self::$instance->connect_error) {
                return self::$instance->connect_error;
            }
        }
        return self::$instance;
    }
}