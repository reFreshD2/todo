<?php

namespace App\Storage\Interfaces;

interface TodoStorageInterface {
    public function create($data);
    public function isUnique($data);
    public function change($todo,$data);
    public function getAll($user);
    public function getActive($user);
    public function getCompleted($user);
    public function deleteOne($data);
    public function deleteAll($user);
}