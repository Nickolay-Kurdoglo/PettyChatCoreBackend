<?php

namespace App\API\Domain\Repository;

interface UserRepository
{
    public function findOne();

    public function all();

    public function put();

    public function remove();
}