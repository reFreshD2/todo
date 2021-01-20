<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use App\HttpFoundation\Request;
use App\HttpFoundation\JSONResponse;
use App\HttpFoundation\Cookie;

class UserController
{
    /*
     * route = /api/user method = POST
     */
    public static function addUser(UserRepository $userRepository)
    {
        $request = json_decode(Request::getContent(), true);
        if (!$request || !isset($request['login']) || !isset($request['password']) || $userRepository->isUnique(['login' => $request['login']])) {
            $response = new JSONResponse(['message' => "No login/password or user already exists"], 422);
            return $response->send();
        }
        $user = new User();
        $user->setLogin($request['login']);
        $user->setPassword(sha1($request['password'] . 'wj64s53l'));
        if ($userRepository->create($user)) {
            setcookie('login',$user->getLogin(),0,'/');
            setcookie('password',$user->getPassword(),0,'/');
            $response = new JSONResponse(['message' => "Success"], 200);
        } else {
            $response = new JSONResponse(['message' => "Can't registrate"], 500);
        }
        return $response->send();
    }

    /*
     * route = /api/user/find method = POST
     */
    public static function findBy(UserRepository $userRepository)
    {
        $request = json_decode(Request::getContent(), true);
        if (!$request || !isset($request['login']) || !isset($request['password'])) {
            $response = new JSONResponse(['message' => "No login/password"], 422);
            return $response->send();
        }
        $log = $request['login'];
        $pass = sha1($request['password'] . 'wj64s53l');
        if ($userRepository->findBy(['login'=>$log,'password'=>$pass])) {
            $response = new JSONResponse(['message' => "User found"],200);
            setcookie('login',$log,0,'/');
            setcookie('password',$pass,0,'/');
        } else {
            $response = new JSONResponse(['message' => "User is not found"],404);
        }
        return $response->send();
    }
}