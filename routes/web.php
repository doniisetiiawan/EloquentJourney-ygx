<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Database\Schema\Blueprint as BlueprintAlias;

Route::get('/', function () {
    return view('welcome');
});

Route::get('create_books_table', function () {
    Schema::create('books', function (BlueprintAlias $table) {
        $table->increments('id');
        $table->string('title', 30);
        $table->integer('pages_count');
        $table->decimal('price', 5, 2);
        $table->text('description');
        $table->timestamps();
    });
});

Route::get('update_books_table', function () {
    Schema::table('books', function (BlueprintAlias $table) {
        $table->string('title', 250)->change();
    });
});

Route::get('update_books_table_2', function () {
    Schema::create('authors', function (BlueprintAlias $table) {
        $table->increments('id');
        $table->string('first_name');
        $table->string('last_name');
        $table->timestamps();
    });
    Schema::table('books', function (BlueprintAlias $table) {
        $table->index('title');
        $table->integer('author_id')->unsigned();
        $table->foreign('author_id')->references('id')->on('authors');
    });
});

Route::get('book_create', function () {
    $book              = new \App\Book;
    $book->title       = 'My First Book!';
    $book->pages_count = 230;
    $book->price       = 10.5;
    $book->description = 'A very original lorem ipsum dolor sit amet...';
    $book->save();
    $book              = new \App\Book;
    $book->title       = 'My Second Book!';
    $book->pages_count = 122;
    $book->price       = 9.5;
    $book->description = 'Another very original lorem ipsum dolor sit amet...';
    $book->save();
});

Route::get('book_get_all', function () {
    return \App\Book::all();
});
Route::get('book_get_2', function () {
    return \App\Book::find(2);
});
Route::get('book_get_where', function () {
    $result = \App\Book::where('pages_count', '<', 1000)->get();
    return $result;
});
Route::get('book_get_where_chained', function () {
    $result = \App\Book::where('pages_count', '<', 1000)
        ->where('title', '=', 'My First Book!')
        ->get();
    return $result;
});
Route::get('book_get_where_iterate', function () {
    $results = \App\Book::where('pages_count', '<', 1000)->get();
    if (count($results) > 0) {
        foreach ($results as $book) {
            echo 'Book: ' . $book->title . ' - Pages:' . $book->pages_count . ' <br/>';
        }
    } else
        echo 'No Results!';
    return '';
});

Route::get('book_update', function () {
    $book              = \App\Book::find(1);
    $book->title       = 'My Updated First Book!';
    $book->pages_count = 150;
    $book->save();
});

Route::get('book_delete_1', function () {
    \App\Book::find(1)->delete();
});

Route::get('book_get_where_complex', function () {
    $results = \App\Book::where('title', 'LIKE', '%Second%')
        ->orWhere('pages_count', '>', 140)
        ->get();
    return $results;
});
Route::get('book_get_where_more_complex', function () {
    $results = \App\Book::where(function ($query) {
        $query
            ->where('pages_count', '>', 120)
            ->where('title', 'LIKE', '%Book%');
    })->orWhere(function ($query) {
        $query
            ->where('pages_count', '<', 200)
            ->orWhere('description', '=', '');
    })->get();
    return $results;
});
Route::get('book_get_books_count', function () {
    $booksCount = \App\Book::count();
    return $booksCount;
});
Route::get('book_get_books_min_pages_count', function () {
    $minPagesCount = \App\Book::where('pages_count', '>', 120)->min('pages_count');
    return $minPagesCount;
});
Route::get('book_get_books_max_pages_count', function () {
    $maxPagesCount = \App\Book::where('pages_count', '>', 180)->max('pages_count');
    return $maxPagesCount;
});
Route::get('book_get_books_avg_price', function () {
    $avgPrice = \App\Book::where('title', 'LIKE', '%Book%')->avg('price');
    return $avgPrice;
});
