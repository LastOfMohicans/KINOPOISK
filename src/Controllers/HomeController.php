<?php

namespace App\Controllers;
use App\Kernel\Controller\Controller;
use App\Kernel\View\View;

class HomeController extends Controller
{
    public function index(): void
    {
        $movies = $this->getMovieService();
        $avg = $movies->avgRating();
        
        $this->view('home', [
            'movies' => $movies->new(),
            'avg'    => $avg,
        ], 'Главная страница');
    }
}
