<?php

namespace App\Storage;

use mysqli;

class Connection {
    protected static $instance;

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new mysqli('localhost', 'todo', 'password', 'todos');
            if (self::$instance->connect_error) {
                return self::$instance->connect_error;
            }
        }
        return self::$instance;
    }
}