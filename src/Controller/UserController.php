<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;

class UserController
{
    /*
     * route = /api/user method = POST
     */
    public function addUser(UserRepository $userRepository) {

    }

    /*
     * route = /api/user/{login} method = GET
     */
    public function haveIn(UserRepository $userRepository) {

    }

    /*
     * route = /api/user method = GET
     */
    public function getBy(UserRepository $userRepository) {
        
    }
}