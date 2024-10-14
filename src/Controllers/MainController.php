<?php

namespace App\Controllers;
use App\Kernel\Controller\Controller;
use App\Kernel\View\View;

class MainController extends Controller
{
    public function index(): void
    {
        //$view = new View();
        $this->view('index');
    }
}
