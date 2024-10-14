<?php

namespace App\Services;

use App\Kernel\Controller\Controller;
use App\Kernel\Interfaces\UploadedFileInterface;
use App\Models\Movie;
use App\Models\Review;

class MovieService extends Controller
{
    private Movie $movie;
    private Review $review;

    public function __construct()
    {
        $this->movie = $this->getMovie();
        $this->review = $this->getReview();
    }

    /**
     * Save record.
     *
     * @param string $name
     * @param string $description
     * @param UploadedFileInterface $image
     * @param integer $category
     * @return false|integer
     */
    public function store(
        string $name, 
        string $description, 
        UploadedFileInterface $image,
        int $category
        ): false|int
    {
        $filePath = $image->move('movies');
        return $this->movie->insert('movies', [
            'name' => $name,
            'description' => $description,
            'preview' => $filePath,
            'category_id' => $category,
        ]);
    }

    /**
     * Get all records from movies table.
     *
     * @return array|null
     */
    public function all(): ?array
    {
        return $this->movie->get('movies');
    }

    /**
     * Get one record from movies table.
     *
     * @param integer $id
     * @return array|null
     */
    public function find(int $id): ?array
    {
        $movie = $this->movie->first('movies', [
            'id' => $id,

        ]);

        if (!$movie) {
            return null;
        }
        return $movie;
    }

    /**
     * Update record.
     *
     * @param integer $id
     * @param string $name
     * @param string $description
     * @param UploadedFileInterface $image
     * @param integer $category
     * @return void
     */
    public function update(
        int $id,
        string $name,
        string $description,
        ?UploadedFileInterface $image,
        int $category
    ): void
    {
        $data = [
            'name'        => $name,
            'description' => $description,
            'category_id' => $category
        ];

        if ($image && !$image->hasError()) {
            $data['preview'] = $image->move('movies');
        }

        $this->movie->update('movies', $data, [
            'id' => $id
        ]);
    }

    /**
     * Delete record
     *
     * @param integer $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->movie->delete('movies', [
            'id' => $id
        ]);
    }

    /**
     * Return movies count 10
     *
     * @return array
     */
    public function new(): array
    {
        $movies = $this->movie->get('movies', [], ['id' => 'DESC'], 10);
        return $movies;

    }

    /**
     * Return all reviews current user.
     *
     * @param integer $id
     * @return array
     */
    public function getReviews(int $id): array
    {
        $reviews = $this->review->get('reviews', [
            'movie_id' => $id
        ], ['id' => 'DESC']);
        return $reviews;
    }

    /**
     * Get average raiting.
     *
     * @return float
     */
    public function avgRating(): float
    {
        $review = $this->review;
        $ratings = array_map(function ($review) {
            return $review['rating'];
        }, $this->reviews());

        if (count($ratings) === 0) {
            return 0;
        }

        return round(array_sum($ratings) / count($ratings), 1);
    }

    /**
     * Get all data in reviews table.
     *
     * @return array
     */
    private function reviews(): array
    {
        return $this->review->get('reviews');
    }
}
