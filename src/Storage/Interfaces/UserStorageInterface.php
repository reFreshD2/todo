<?php

namespace App\Storage\Interfaces;

interface UserStorageInterface {
    public function create($data);
    public function getBy($data);
    public function haveIn($data);
}