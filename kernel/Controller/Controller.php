<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Redirect;
use App\Kernel\Http\Request;
use App\Kernel\Interfaces\AuthInterface;
use App\Kernel\Interfaces\RedirectInterface;
use App\Kernel\Interfaces\RequestInterface;
use App\Kernel\Interfaces\SessionInterface;
use App\Kernel\Interfaces\StorageInterface;
use App\Kernel\Interfaces\ViewInterface;
use App\Kernel\Session\Session;
use App\Kernel\View\View;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Review;
use App\Models\User;
use App\Services\CategoryService;
use App\Services\MovieService;

abstract class Controller
{
    private ViewInterface $view;

    private RequestInterface $request;

    private RedirectInterface $redirect;

    private SessionInterface $session;

    private AuthInterface $auth;

    private StorageInterface $storage;


    public function view(
        string $name,
        array $data = [],
        string $title = ''
    ): void {
        $this->view->page($name, $data, $title);
    }

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    /**
     * Get the value of request
     *
     * @return Request
     */
    public function request(): RequestInterface
    {
        return $this->request;
    }

    /**
     * Set the value of request
     *
     * @param Request $request
     *
     * @return void
     */
    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
        
    }


    /**
     * Set the value of redirect
     *
     * @param Redirect $redirect
     *
     * @return void
     */
    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;        
    }

    public function redirect(string $url): void
    {
        $this->redirect->to($url);
    }

    /**
     * Get the value of session
     *
     * @return Session
     */
    public function session(): SessionInterface
    {
        return $this->session;
    }

    /**
     * Set the value of session
     *
     * @param Session $session
     *
     * @return void
     */
    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;        
    }

    /**
     * This function return new User
     *
     * @return User
     */
    public function getUser(): User
    {

        return new User();
    }

    /**
     * This function return new Movie
     *
     * @return Movie
     */
    public function getMovie(): Movie
    {
        return new Movie();
    }

    /**
     * This function return new MovieService
     *
     * @return MovieService
     */
    public function getMovieService(): MovieService
    {
        return new MovieService();
    }

    /**
     * Get the value of auth
     *
     * @return AuthInterface
     */
    public function auth(): AuthInterface
    {
        return $this->auth;
    }

    /**
     * Set the value of auth
     *
     * @param AuthInterface $auth
     *
     * @return void
     */
    public function setAuth(AuthInterface $auth): void
    {
        $this->auth = $auth;
        
    }

    /**
     * Get the value of storage
     *
     * @return StorageInterface
     */
    public function storage(): StorageInterface
    {
        return $this->storage;
    }

    /**
     * Set the value of storage
     *
     * @param StorageInterface $storage
     *
     * @return void
     */
    public function setStorage(StorageInterface $storage): void
    {
        $this->storage = $storage;
        
    }

    /**
     * Return new Category
     *
     * @return Category
     */
    public function getCategory(): Category
    {
        return new Category();
    }

    /**
     * Return new Category
     *
     * @return CategoryService
     */
    public function getCategoryService(): CategoryService
    {
        return new CategoryService();
    }

    /**
     * Return review model.
     *
     * @return Review
     */
    public function getReview(): Review
    {
        return new Review();
    }
}
