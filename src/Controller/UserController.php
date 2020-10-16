<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use App\HttpFoundation\Request;

class UserController
{
    /*
     * route = /api/user method = POST
     */
    public static function addUser(UserRepository $userRepository) {

    }

    /*
     * route = /api/user/{login} method = GET
     */
    public static function haveIn(UserRepository $userRepository) {

    }

    /*
     * route = /api/user method = GET
     */
    public static function getBy(UserRepository $userRepository) {
        
    }
}