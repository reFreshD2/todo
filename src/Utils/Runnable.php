<?php

namespace App\Utils;

class Runnable {
    private $twig;

    public function __construct()
    {
        $this->twig = new \Twig\Environment(
            new \Twig\Loader\FilesystemLoader([dirname(__DIR__, 2) . '/templates'])
        );
    }

    public function run() {
        $path = $_SERVER['REQUEST_URI'];
        if ($path == '/') {
            //echo file_get_contents('http://157.230.106.225:8888/html/index.html');
            echo $this->twig->render('todo.html.twig', ['script'=>'app']);
        }
        if ($path == '/auth') {
            echo $this->twig->render('auth.html.twig', ['script'=>'auth']);
        }
        if ($path == '/reg') {
            echo $this->twig->render('reg.html.twig', ['script'=>'reg']);
        }
    }
}