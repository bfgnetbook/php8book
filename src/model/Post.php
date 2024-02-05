<?php

namespace App\Model;

use App\Library\AbstractModel;

class Post extends AbstractModel
{
    public function __construct($container)
    {
        parent::__construct($container, 'posts'); // 'posts' es el nombre de la tabla
    }

}
