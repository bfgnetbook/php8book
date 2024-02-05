<?php

namespace App\Controller;

use App\Library\View;
use App\Library\Auth;
use App\Library\InjectContainer;
use App\Model\Post;

class PostController extends InjectContainer
{

    protected $view;
    protected $auth;

    function __construct($container)
    {
        parent::__construct($container);
    }

    protected function initialize()
    {
        // Acceder al contenedor y realizar configuraciones específicas para PostController
        $this->view =  $this->container->make(View::class);
        $this->view->setViewLayout('layout');
        $this->auth = $this->container->make(Auth::class);
        $this->view->setViewData('auth', $this->auth->isUserAuthenticated());
    }

    public function new()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'author' => $_POST['author'] ?? '',
                'content' => $_POST['content'] ?? ''
            ];

            $validate = $this->validate($data);

            if ($validate === true) {
                $post = new Post($this->container);
                $post->create([
                    'title' => $data['title'],
                    'author' => $data['author'],
                    'content' => $data['content']
                ]);
                header("Location: /");
                exit();
            } else {
                $this->view->setViewData('errors', $validate);
            }
        }
        $this->view->setViewFile('handlePostView');
        $this->view->render();
    }

    public function edit($params)
    {
        $post = new Post($this->container);
        $id = $params[0] ?? null;
        $dataPost = $post->findById($id);
        $this->view->setViewData('dataPost', $dataPost);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'author' => $_POST['author'] ?? '',
                'content' => $_POST['content'] ?? ''
            ];
            $this->view->setViewData('dataPost', $data);
            $validate = $this->validate($data);

            if ($validate === true) {
                $post->update($id, [
                    'title' => $data['title'],
                    'author' => $data['author'],
                    'content' => $data['content']
                ]);
                header("Location: /");
                exit();
            } else {
                $this->view->setViewData('errors', $validate);
            }
        }
        $this->view->setViewFile('handlePostView');
        $this->view->render();
    }

    public function delete($params)
    {
        $post = new Post($this->container);
        $id = $params[0] ?? null;
        $post->delete($id);
        header("Location: /");
        exit();
    }

    private function validate($data)
    {
        $errors = [];
        // Sanitización y Validación
        if (empty($data['title'])) {
            $errors[] = 'The title is required.';
        } else {
            $data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);
            if (strlen($data['title']) > 250) {
                $errors[] = 'The title must not exceed 250 characters.';
            }
        }

        if (empty($data['author'])) {
            $errors[] = 'The author is required.';
        } else {
            $data['author'] = filter_var($data['author'], FILTER_SANITIZE_STRING);
            if (strlen($data['author']) > 100) {
                $errors[] = 'The author should not exceed 100 characters.';
            }
        }

        if (empty($data['content'])) {
            $errors[] = 'The content is required.';
        } else {
            $data['content'] = filter_var($data['content'], FILTER_SANITIZE_STRING);
            if (strlen($data['content']) > 10000) {
                $errors[] = 'Content must not exceed 10.000 characters.';
            }
        }
        if (count($errors) === 0) {
            return true;
        }
        return $errors;
    }
}
