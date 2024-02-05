<?php

namespace App\Library;

use App\LIbrary\Container;

interface ContainerAwareInterface
{
    public function setContainer(Container $container);
}
