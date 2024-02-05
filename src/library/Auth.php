<?php

namespace App\Library;

use App\Model\User;

class Auth
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function login($username, $password)
    {
        $user = $this->user->findUser($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_authenticated'] = true;
            return true;
        }

        return false;
    }

    public function getUser()
    {
        return $_SESSION['user_id'] ?? null;
    }

    public function isUserAuthenticated()
    {
        return !empty($_SESSION['is_authenticated']);
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }

    // Otras funciones relacionadas con la autenticación...
}
