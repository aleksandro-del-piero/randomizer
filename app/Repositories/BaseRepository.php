<?php

namespace App\Repositories;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct(Application $app)
    {
        $this->model = $app->make($this->getModel());
    }

    public function model(): Model
    {
        return $this->model;
    }

    public abstract function getModel(): string;
}
