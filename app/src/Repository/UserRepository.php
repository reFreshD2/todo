<?php

namespace App\Repository;

use App\Repository\Interfaces\UserRepositoryInterface;
use App\Entity\User;
use App\Storage\Interfaces\UserStorageInterfaces;

class UserRepository implements UserRepositoryInterface {
    private $storage;

    public function __construct($storage)
    {
        $this->storage = $storage;
    }

    public function create($user) {
        return $this->storage->create($user->json());
    }

    public function findBy($data) {
        return $this->storage->findBy($data);
    }

    public function isUnique($data) {
        return $this->storage->isUnique($data);
    }
}