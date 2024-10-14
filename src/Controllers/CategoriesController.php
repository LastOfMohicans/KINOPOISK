<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;

class CategoriesController extends Controller
{
    private CategoryService $service;

    public function __construct()
    {
        $this->service = $this->getCategoryService();
    }

    /**
     * View all categories.
     *
     * @return void
     */
    public function index(): void
    {   
        $this->view('categories', [
            'categories' => $this->service->all(),
        ]);
    }

    /**
     * View page for category create.
     *
     * @return void
     */
    public function create(): void
    {
        $this->view('admin/categories/add');
    }

    /**
     * Save in database current category.
     *
     * @return void
     */
    public function store(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
        ]);

        if (!$validation) {
            $errors = $this->request()->errors();

            foreach ($errors as $field => $error) {
                $this->session()->set($field, $error);
            }

            $this->redirect('/admin/categories/add');
        } else {
            $name = $this->request()->input('name');
            $this->service->store($name);

            $this->redirect('/admin');
        }
    }

    /**
     * Change category.
     *
     * @return void
     */
    public function edit(): void
    {
        $id = $this->request()->input('id');
        $category = $this->service->find($id);

        $this->view('/admin/categories/update', [
            'category' => $category
        ]);
    }

    /**
     * Save in database edited category.
     *
     * @return void
     */
    public function update(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
        ]);
        $id = $this->request()->input('id');
        $name = $this->request()->input('name');

        if (!$validation) {
            $errors = $this->request()->errors();

            foreach ($errors as $field => $error) {
                $this->session()->set($field, $error);
            }

            $this->redirect("/admin/categories/update?id={$id}");
        } else {
            $this->service->update($id, $name);
            $this->redirect('/admin');
        }
    }

    /**
     * Delete category.
     *
     * @return void
     */
    public function destroy(): void
    {
        $id = $this->request()->input('id');
        $this->service->delete($id);
        $this->redirect('/admin');
    }
}
