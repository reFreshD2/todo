<?php

namespace App\Utils;

use App\HttpFoundation\Request;
use App\Storage\UserStorage;
use App\Repository\UserRepository;
use App\Controller\UserController;
use App\HttpFoundation\Cookie;

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
            case '/api/user':
                UserController::addUser($this->userRepository);
                return;
            case '/api/user/find':
                UserController::findBy($this->userRepository);
                return;
        }
        $log = Cookie::get('login');
        $pass = Cookie::get('password');
        if (isset($log) && isset($pass)) {
            $auth = $this->userRepository->findBy(['login' => $log, 'password' => $pass]);
        } else {
            $auth = false;
        }
        if ($auth) {
            switch ($path) {
                case '/':
                    echo $this->twig->render('todo.html.twig', ['script' => 'app','login'=>$log]);
                    break;
                case '/registration':
                case '/authorization':
                    $this->redirect('http://157.230.106.225:8888');
                    break;
                case '/exit':
                    setcookie("login", "", time() - 3600, '/');
                    setcookie("password", "", time() - 3600, '/');
                    $this->redirect('http://157.230.106.225:8888/authorization');
                    break;
                default:
                    echo $this->twig->render('404.html.twig');
            }
        } else {
            switch ($path) {
                case '/':
                    $this->redirect('http://157.230.106.225:8888/authorization');
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

    function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }
}