<?php

namespace App\Services;

use App\Kernel\Controller\Controller;
use App\Models\Category;

class CategoryService extends Controller 
{
    private Category $category;

    public function __construct()
    {
        $this->category = $this->getCategory();
    }
    public function all(): ?array
    {
        return $this->category->get('categories', []);        
    }

    public function find(int $id): ?array
    {
        return $this->category->first('categories', [
            'id' => $id
        ]);
    }

    public function store(string $name): int
    {
        return $this->category->insert('categories', [
            'name' => $name
        ]);
    }

    public function update(int $id, string $name): void
    {
        $this->category->update('categories', [
            'name' => $name
        ], [
            'id' => $id
        ]);
    }

    public function delete(int $id): void
    {
        $this->category->delete('categories', [
            'id' => $id
        ]);
    }
}
