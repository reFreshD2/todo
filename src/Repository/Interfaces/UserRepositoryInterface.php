<?php

namespace App\Repository\Interfaces;

interface UserRepositoryInterface {
    public function create($user);
    public function findBy($data);
    public function haveIn($data);
}