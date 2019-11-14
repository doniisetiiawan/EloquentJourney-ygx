<?php

namespace App\Observers;

class BookObserver
{
    public function creating($book)
    {
// I want to create the $book book, but first...
    }

    public function saving($book)
    {
// I want to save the $book book, but first...
    }

    public function saved($book)
    {
// I just saved the $book book, so....
    }
}
