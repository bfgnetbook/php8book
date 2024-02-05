<?php

namespace App\Model;

use App\Library\AbstractModel;

class User extends AbstractModel
{
    public function __construct($container)
    {
        parent::__construct($container, 'users'); // 'users' es el nombre de la tabla
    }

    public function findUser($username)
    {
        $query = "SELECT * FROM users WHERE username = :username";
        return $this->executeQuery($query, ['username' => $username], false);
    }
}
