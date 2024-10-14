<?php

use App\Kernel\Migrations\CreateCategoriesTable;
use App\Kernel\Migrations\CreateMoviesTable;
use App\Kernel\Migrations\CreateReviewsTable;
use App\Kernel\Migrations\CreateTestTable;
use App\Kernel\Migrations\CreateUsersTable;

define('APP_PATH', __DIR__);
error_reporting(E_ERROR | E_PARSE);
require_once APP_PATH . '/vendor/autoload.php';

CreateReviewsTable::down();
CreateCategoriesTable::down();
CreateMoviesTable::down();
CreateUsersTable::down();
//CreateTestTable::down();