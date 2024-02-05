<?php

namespace App\Controller;

use App\Library\View;
use App\Library\Auth;
use App\Library\InjectContainer;
use App\Model\Post;

class UserController extends InjectContainer
{

    protected $view;
    protected $auth;

    function __construct($container)
    {
        parent::__construct($container);
    }

    protected function initialize()
    {
        // Acceder al contenedor y realizar configuraciones específicas para UserController
        $this->view =  $this->container->make(View::class);
        $this->view->setViewLayout('layout');
        $this->auth = $this->container->make(Auth::class);
        $this->view->setViewData('auth', $this->auth->isUserAuthenticated());
    }

    public function about()
    {
        $this->view->setViewFile('aboutView');
        $this->view->render();
    }

    public function index()
    {
        $post = new Post($this->container);
        $posts = $post->findAll();
        $this->view->setViewFile('indexView');
        $this->view->setViewData('posts', $posts);
        $this->view->render();
    }

    public function post($params)
    {
        $post = new Post($this->container);
        $id = $params[0] ?? null;
        $dataPost = $post->findById($id);
        $this->view->setViewFile('postView');
        $this->view->setViewData('post', $dataPost);
        $this->view->render();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($this->auth->login($username, $password)) {
                header("Location: /");
            }
            $this->view->setViewData('error', 'Failed login!');
        }
        $this->view->setViewFile('loginView');
        $this->view->render();
    }

    public function logout()
    {
        $this->auth->logout();
        header("Location: /");
    }
}
