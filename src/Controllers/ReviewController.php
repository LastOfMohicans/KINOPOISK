<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class ReviewController extends Controller
{
    /**
     * Insert data to reviews table.
     *
     * @return void
     */
    public function store(): void
    {
        $review = $this->getReview();
        $id = $this->request()->input('id');
        $rating = $this->request()->input('rating');
        $comment = $this->request()->input('comment');
        $userID = $this->session()->get($this->auth()->sessionField());
                
        $validation = $this->request()->validate([
            'rating' => ['required'],
            'comment' => ['required'],
        ]);

        if (!$validation) {
            $errors = $this->request()->errors();

            foreach ($errors as $field => $error) {
                $this->session()->set($field, $error);
            }

            $this->redirect("/movie?id={$id}");
        } else {
            $review->insert('reviews', [
                'rating' => $rating,
                'review' => $comment,
                'movie_id' => $id,
                'user_id' => $userID
            ]);

            $this->redirect("/movie?id={$id}");
        }
    }
}
