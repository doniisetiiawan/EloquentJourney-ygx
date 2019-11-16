<?php

namespace App\Repositories;

use App\Author;
use App\Repositories\Contracts\AuthorsRepository;

class DbAuthorsRepository implements AuthorsRepository
{
    private $model;

    public function __construct(Author $model)
    {
        $this->model = $model;
    }

    public function getAll($perPage, $pageNumber)
    {
        $authors = $this->model->skip(($pageNumber - 1) * $perPage)->take($perPage)->get();
        return $authors->toArray();
    }

    public function find($authorId)
    {
        return $this->model->find($authorId)->toArray();
    }

    public function search($firstName, $lastName)
    {
        return $this->model
            ->where('first_name', 'LIKE', '%' . $firstName . '%')
            ->where('last_name', 'LIKE', '%' . $lastName . '%')
            ->get()
            ->toArray();
    }

    public function create($authorData)
    {
        return $this->model->create($authorData);
    }

    public function update($authorData, $authorId)
    {
        return $this->model->find($authorId)->update($authorData);
    }
}
