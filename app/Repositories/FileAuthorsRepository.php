<?php

namespace App\Repositories;

use App\Repositories\Contracts\AuthorsRepository;

class FileAuthorsRepository implements AuthorsRepository
{
    public function getAll($perPage, $pageNumber)
    {
        dd('getting all records from flat file driver...');
    }

    public function find($authorId)
    {
        dd('searching by id: ' . $authorId);
    }

    public function search($firstName, $lastName)
    {
        dd('searching by first and last name...', $firstName, $lastName);
    }

    public function create($authorData)
    {
        dd('creating new author ', $authorData);
    }

    public function update($authorData, $authorId)
    {
        dd('updating author ' . $authorId, $authorData);
    }
}
