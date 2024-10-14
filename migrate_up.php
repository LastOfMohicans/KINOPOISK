<?php

error_reporting(E_ERROR | E_PARSE);
define('APP_PATH', __DIR__);
require_once APP_PATH . '/vendor/autoload.php';

use App\Kernel\Migrations\CreateCategoriesTable;
use App\Kernel\Migrations\CreateMoviesTable;
use App\Kernel\Migrations\CreateReviewsTable;
use App\Kernel\Migrations\CreateTestTable;
use App\Kernel\Migrations\CreateUsersTable;

//CreateTestTable::up();

CreateUsersTable::up();
CreateMoviesTable::up();
CreateCategoriesTable::up();
CreateReviewsTable::up();
