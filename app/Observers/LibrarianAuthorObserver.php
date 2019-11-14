<?php

namespace App\Observers;

class LibrarianAuthorObserver
{
    public function created($author)
    {
        \Mail::send('emails.created_author_librarian',
            ['author' => $author], function ($message) use ($author) {
                $message->to('librarian@awesomelibrary.com',
                    'The Librarian')->subject('New Author: ' .
                    $author->first_name . ' ' . $author->last_name);
            });
    }

    public function deleted($author)
    {
        \Mail::send('emails.deleted_author_librarian',
            ['author' => $author], function ($message) use ($author) {
                $message->to('librarian@awesomelibrary.com',
                    'The Librarian')->subject('New Author: ' .
                    $author->first_name . ' ' . $author->last_name);
            });
    }
}
