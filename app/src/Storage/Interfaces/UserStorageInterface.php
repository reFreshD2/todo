<?php

namespace App\Storage\Interfaces;

interface UserStorageInterface {
    public function create($data);
    public function findBy($data);
    public function isUnique($data);
}