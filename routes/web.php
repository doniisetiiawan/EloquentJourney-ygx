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
