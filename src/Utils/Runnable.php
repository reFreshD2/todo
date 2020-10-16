<?php

namespace App\Utils;

use App\HttpFoundation\Request;
use App\Storage\UserStorage;
use App\Repository\UserRepository;
use App\Controller\UserController;

class Runnable
{
    private $twig;
    private $userRepository;

    public function __construct()
    {
        $this->twig = new \Twig\Environment(
            new \Twig\Loader\FilesystemLoader([dirname(__DIR__, 2) . '/templates'])
        );
        $userStorage = new UserStorage();
        $this->userRepository = new UserRepository($userStorage);
    }

    public function run()
    {
        $path = Request::getRequestUri();
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
            case '/api/user':
                $method = Request::getRequestMethod();
                switch ($method) {
                    case 'GET':
                        UserController::getBy($this->userRepository);
                        break;
                    case 'POST':
                        UserController::addUser($this->userRepository);
                        break;
                }
                break;
            default:
                echo $this->twig->render('404.html.twig');
        }
    }
}