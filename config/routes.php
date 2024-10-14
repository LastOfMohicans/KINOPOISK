<?php

use App\Controllers\AdminController;
use App\Controllers\CategoriesController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\MainController;
use App\Controllers\MoviesController;
use App\Controllers\RegisterController;
use App\Controllers\ReviewController;
use App\Kernel\Router\Route;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

//dd([HomeController::class,'index']);

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/register', [RegisterController::class, 'index']),
    Route::post('/register', [RegisterController::class, 'register']),
    Route::get('/login', [LoginController::class, 'index']),
    Route::post('/login', [LoginController::class, 'login']),
    Route::post('/logout', [LoginController::class, 'logout']),
    Route::get('/admin', [AdminController::class, 'index']),
    Route::get('/categories', [CategoriesController::class, 'index']),
    Route::get('/admin/categories/add', [CategoriesController::class, 'create']),
    Route::post('/admin/categories/add', [CategoriesController::class, 'store']),
    Route::post('/admin/categories/destroy', [CategoriesController::class, 'destroy']),
    Route::get('/admin/categories/update', [CategoriesController::class, 'edit']),
    Route::post('/admin/categories/update', [CategoriesController::class, 'update']),
    Route::get('/admin/movies/add', [MoviesController::class, 'create']),
    Route::post('/admin/movies/add', [MoviesController::class, 'store']),
    Route::post('/admin/movies/destroy', [MoviesController::class, 'destroy']),
    Route::get('/admin/movies/update', [MoviesController::class, 'edit']),
    Route::post('/admin/movies/update', [MoviesController::class, 'update']),
    Route::get('/movie', [MoviesController::class, 'show']),
    Route::post('/reviews/add', [ReviewController::class, 'store']),







    // Route::get('/movies', [MoviesController::class, 'index']),
    // Route::get(
    //     '/admin/movies/add',
    //     [MoviesController::class, 'add'],
    //     [AuthMiddleware::class]
    // ),
    // Route::post('/admin/movies/store', [MoviesController::class, 'store']),
    // Route::get(
    //     '/register',
    //     [RegisterController::class, 'index'],
    //     [GuestMiddleware::class]
    // ),
    // Route::post('/register', [RegisterController::class, 'register']),
    // Route::get(
    //     '/login',
    //     [LoginController::class, 'index'],
    //     [GuestMiddleware::class]
    // ),
    // Route::post('/login', [LoginController::class, 'login']),
    // Route::post('/logout', [LoginController::class, 'logout']),



    // Route::get('/test', function() {
    //     echo 'Test';
    // }),
    // '/' => function() {
    //     require_once APP_PATH . '/views/pages/index.php';       
    // },
    // '/home' => function() {
    //     require_once APP_PATH . '/views/pages/home.php';       
    // },
    // '/movies' => function() {
    //     require_once APP_PATH . '/views/pages/movies.php';
    // },
];
