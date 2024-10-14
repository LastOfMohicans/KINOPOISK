<?php
define('APP_PATH', dirname(__DIR__));
error_reporting(E_ERROR | E_PARSE);
require_once APP_PATH . '/vendor/autoload.php';

use App\Kernel\App;

$app = new App();
$app->run();


