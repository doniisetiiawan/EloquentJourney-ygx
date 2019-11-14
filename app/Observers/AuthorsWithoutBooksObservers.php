<?php

namespace App\Observers;

class AuthorsWithoutBooksObservers
{
    public function deleted()
    {
        $authorsWithoutBooks = \App\Author::has('books', '=', 0)->get();
        if (count($authorsWithoutBooks) > 0) {
            \Mail::send('emails.author_without_books_librarian',
                ['authorsWithoutBooks' => $authorsWithoutBooks],
                function ($message) {
                    $message->to('librarian@awesomelibrary.com',
                        'The Librarian')->subject('Authors without Books!
A check is required!');
                });
        }
    }
}
