<?php

namespace App\Observers;

class CustomerNewAuthorObserver
{
    public function created($author)
    {
        $users = \App\User::all();
        foreach ($users as $user) {
            \Mail::send('emails.created_author_customer',
                ['author' => $author], function ($message) use ($user) {
                    $message->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('New Author Added!');
                });
        }
    }
}
