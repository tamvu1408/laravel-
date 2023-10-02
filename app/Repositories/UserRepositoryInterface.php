<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getAll();

    public function create();

    public function store(array $attributes);

    public function update($userId, array $attributes);

    public function delete($userId);

    public function getProfile();

    public function changeAvatar($filePath);
}
