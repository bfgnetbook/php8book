<?php
namespace App\Library;

use App\Library\ContainerAwareInterface;
use App\Library\Container;

abstract class InjectContainer implements ContainerAwareInterface {
    
    protected $container;

    public function __construct(Container $container) {
        $this->container = $container;
        $this->initialize();
    }

    protected function initialize() {
    }

    public function setContainer(Container $container) {
        $this->container = $container;
    }

}
