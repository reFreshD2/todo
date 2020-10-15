<?php

namespace App\Utils;

class Runnable
{
    private $twig;

    public function __construct()
    {
        $this->twig = new \Twig\Environment(
            new \Twig\Loader\FilesystemLoader([dirname(__DIR__, 2) . '/templates'])
        );
    }

    public function run()
    {
        $path = $_SERVER['REQUEST_URI'];
        switch ($path) {
            case '/':
                echo $this->twig->render('todo.html.twig', ['script' => 'app']);
                break;
            case '/authorization':
                echo $this->twig->render('auth.html.twig', ['script' => 'auth']);
                break;
            case '/registration':
                echo $this->twig->render('reg.html.twig', ['script' => 'reg']);
                break;
            default:
                echo $this->twig->render('404.html.twig');
        }
    }
}