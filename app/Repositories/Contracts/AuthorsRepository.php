<?php

namespace App\Repositories\Contracts;

interface AuthorsRepository
{
    public function getAll($perPage, $pageNumber);

    public function find($authorId);

    public function search($firstName, $lastName);

    public function create($authorData);

    public function update($authorData, $authorId);
}
