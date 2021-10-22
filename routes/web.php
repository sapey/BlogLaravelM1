<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;

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



// Récupère une variable depuis l'url et l'affiche dans la page
Route::get('blabla/{id}', function ($id){
    dd($id);
});


// Affichage de la requete http
//Route::get('/request/{id}', function(\Illuminate\Http\Request $request, $id){
   // dd($request);
//});

//Appeller fonction présent dans le controller
Route::get('/', [PostController::class, 'index'])->name('postList');

Route::get('/posts/ajouter', [PostController::class, 'add'])->name('postAjouter');
Route::post('/posts/ajouter', [PostController::class, 'store'])->name('postStore');

Route::get('/posts/{id}', [PostController::class, 'details'])->name('postDetails');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('postUpdate');
Route::put('/posts/{id}/picture', [PostController::class, 'updatePicture'])->name('postUpdatePicture');

Route::delete('/posts/{id}', [PostController::class, 'delete'])->name('postDelete');

Route::post('/commentaires/{postId}', [CommentController::class, 'store'])->name('commentAdd');
Route::delete('/commentaires/{id}', [CommentController::class, 'delete'])->name('commentDelete');

Route::get('/categories', [CategoryController::class, 'index'])->name('categoryList');
Route::get('/categories/ajouter', [CategoryController::class, 'add'])->name('categoryAdd');
Route::post('/categories/ajouter', [CategoryController::class, 'store'])->name('categoryStore');
Route::put('categories/{id}/modifier', [CategoryController::class, 'update'])->name('categoryUpdate');
Route::delete('categories/{id}/supprimer', [CategoryController::class, 'delete'])->name('categoryDelete');



