<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get("/", function () {
    return redirect()->route("users");
});
Route::resource("/users", UsersController::class)->names(
    [
        "index" => "users",
        "create" => "users.create",
        "store" => "users.store",
        "show" => "users.show",
    ]
)->only(["index", "create", "store", "show"]);
Route::get("/users/{user}/posts/create", [PostsController::class, "create"])->name("posts.create");
Route::resource("/posts", PostsController::class)->names(
    [
        "index" => "posts",
        "store" => "posts.store",
        "show" => "posts.show",
    ]
)->only(["index", "store", "show"]);
Route::resource("/comments", CommentsController::class)->names(
    [
        "store" => "comments.store",
        "destroy" => "comments.destroy",
    ]
)->only(["store", "destroy"]);