<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use App\HttpFoundation\Request;
use App\HttpFoundation\JSONResponse;

class UserController
{
    /*
     * route = /api/user method = POST
     */
    public static function addUser(UserRepository $userRepository)
    {
        $request = json_decode(Request::getContent(), true);
        if (!$request || !isset($request['login']) || !isset($request['password'])) {
            $response = new JSONResponse("Data no valid", 422);
            return $response->send();
        }
        $user = new User();
        $user->setLogin($request['login']);
        $user->setPassword($request['password']);
        $userRepository->create($user);
        $response = new JSONResponse("Success", 200);
        return $response->send();
    }

    /*
     * route = /api/user/{login} method = GET
     */
    public static function haveIn(UserRepository $userRepository)
    {

    }

    /*
     * route = /api/user method = GET
     */
    public static function getBy(UserRepository $userRepository)
    {
        
    }
}