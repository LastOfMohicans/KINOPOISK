<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;

class AdminController extends Controller
{
    
    public function index(): void
    {
        $category = $this->getCategoryService();
        $movies = $this->getMovieService();
        $user = $this->auth()->check();
        
        if (!$user) {
            $this->redirect('/');
        }
        
        $this->view('admin/index', [
            'categories' => $category->all(),
            'movies' => $movies->all(),
        ]);
    }
}
