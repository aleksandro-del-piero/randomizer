<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function getModel(): string
    {
        return User::class;
    }

    public function create(string $name, string $phone): ?User
    {
        return $this->model()->updateOrCreate(
            ['phone' => $phone],
            ['name' => $name]
        );
    }
}
