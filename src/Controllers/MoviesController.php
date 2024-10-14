<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\Redirect;
use App\Kernel\Validator\Validator;
use App\Kernel\View\View;
use App\Services\MovieService;

class MoviesController extends Controller
{
    private MovieService $service;

    public function __construct()
    {
        $this->service = new MovieService();
    }
    public function create(): void
    {
        $categories = $this->getCategoryService();
        $this->view('admin/movies/add', [
            'categories' => $categories->all()
        ]);
    }

    public function add(): void
    {
        $this->view('admin/movies/add');
    }

    public function store(): void
    {
        $name = $this->request()->input('name');
        $description = $this->request()->input('description');
        $image = $this->request()->file('image');
        $category = $this->request()->input('category');

        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'description' => ['required'],
            'category' => ['required'],
        ]);

        if (!$validation) {
            $errors = $this->request()->errors();

            foreach ($errors as $field => $error) {
                $this->session()->set($field, $error);
            }

            $this->redirect('/admin/movies/add');
        } else {
            $this->service->store($name, $description, $image, $category);
            $this->redirect('/admin');
        }
    }

    /**
     * View edit page.
     *
     * @return void
     */
    public function edit(): void
    {
        $categories = $this->getCategoryService();
        $id = $this->request()->input('id');
        $movie = $this->service->find($id);
        $this->view('/admin/movies/update', [
            'movie'      => $movie,
            'categories' => $categories->all()
        ]);
    }

    /**
     * Update record.
     *
     * @return void
     */
    public function update(): void
    {
        $id = $this->request()->input('id');
        $name = $this->request()->input('name');
        $description = $this->request()->input('description');
        $image = $this->request()->file('image');
        $category = $this->request()->input('category');

        $validation = $this->request()->validate([
            'name'        => ['required', 'min:3', 'max:50'],
            'description' => ['required'],
            'category'    => ['required'],
        ]);

        if (!$validation) {
            $errors = $this->request()->errors();

            foreach ($errors as $field => $error) {
                $this->session()->set($field, $error);
            }

            $this->redirect("/admin/movies/update?id={$id}");
        } else {
            $this->service->update(
                $id,
                $name,
                $description,
                $image,
                $category
            );

            $this->redirect('/admin');
        }
    }

    /**
     * Show movie page.
     *
     * @return void
     */
    public function show(): void
    {
        $id = $this->request()->input('id');
        $user = $this->auth()->user();
        $movie = $this->service->find($id);
        $reviews = $this->service->getReviews($id);
        $avgRatings = $this->service->avgRating();

        $this->view('movie', [
            'movie' => $movie,
            'reviews' => $reviews,
            'user' => $user,
            'avg' => $avgRatings,
        ], "Фильм - {$movie['name']}");
    }

    /**
     * Delete record.
     *
     * @return void
     */
    public function destroy(): void
    {
        $id = $this->request()->input('id');
        $this->service->destroy($id);
        $this->redirect('/admin');
    }
}
