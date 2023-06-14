<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\DishController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts/layout');
});

//ajouter un ingredient
Route::get('/ingredient',  [IngredientController::class, 'getCreate'])->withoutMiddleware(['auth']);
Route::post('/ingredient',  [IngredientController::class, 'postCreate'])->withoutMiddleware(['auth']);

//stock des ingredient
Route::get('/ingredients',  [IngredientController::class, 'getRead'])->withoutMiddleware(['auth']);

//detail d'un ingredient
Route::get('/ingredient/{id}',  [IngredientController::class, 'getDetail'])->withoutMiddleware(['auth']);

//recherche movement de stock, entry
Route::get('/ingredient/{id}/entry',  [IngredientController::class, 'getMovementEntry'])->withoutMiddleware(['auth']);
//insertion de movement de stock entry
Route::post('/ingredient/{id}/entry',  [IngredientController::class, 'postMovementEntry'])->withoutMiddleware(['auth']);

//recherche movement de stock, sortie
Route::get('/ingredient/{id}/output',  [IngredientController::class, 'getMovementOutPut'])->withoutMiddleware(['auth']);

//recherche updatestock
Route::get('/ingredient/{id}/update',  [IngredientController::class, 'getUpdateStock'])->withoutMiddleware(['auth']);
//insertion de movement de stock update
Route::post('/ingredient/{id}/update',  [IngredientController::class, 'postUpdateStock'])->withoutMiddleware(['auth']);

//creer un repas
Route::get('/dish',  [DishController::class, 'getInsert'])->withoutMiddleware(['auth']);
Route::post('/dish',  [DishController::class, 'postInsert'])->withoutMiddleware(['auth']);
//liste des repas
Route::get('/dishes', [DishController::class, 'getRead'])->withoutMiddleware(['auth']);




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
