<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Получение списка всех категорий
Route::get('/categories', [CategoryController::class, 'categories']);

// Получение списка товаров в конкретной категории
Route::get('/{category}/products', [ProductController::class, 'productsByCategory']);

// Добавление / Редактирование / Удаление категории (для авторизованных пользователей)
Route::post('/categories/add', [CategoryController::class, 'addCategory']);
Route::put('/categories/{category}/edit', [CategoryController::class, 'editCategory']);
Route::delete('/categories/{category}/delete', [CategoryController::class, 'deleteCategory']);

// Добавление / Редактирование / Удаление характеристик товара для категории (для авторизованных пользователей)
Route::post('/categories/{category}/property/add', [CategoryController::class, 'addCategoryProperty']);
Route::put('/categories/{category}/property/edit', [CategoryController::class, 'editCategoryProperty']);
Route::delete('/categories/{category}/property/delete', [CategoryController::class, 'deleteCategoryProperty']);

// Добавление / Редактирование / Удаление товара (для авторизованных пользователей)
Route::post('/products/add', [ProductController::class, 'addProduct']);
Route::put('/products/{product}/edit', [ProductController::class, 'editProduct']);
Route::delete('/products/{product}/delete', [ProductController::class, 'deleteProduct']);
