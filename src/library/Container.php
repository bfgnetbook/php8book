<?php

namespace App\Library;

class Container
{
    private $bindings = [];

    public function bind($abstract, $concrete)
    {
        $this->bindings[$abstract] = $concrete;
    }

    public function make($abstract)
    {
        if (!isset($this->bindings[$abstract])) {
            throw new \Exception("No se ha encontrado el binding para {$abstract}");
        }

        return $this->build($this->bindings[$abstract]);
    }

    private function build($concrete)
    {
        if ($concrete instanceof \Closure) {
            return $concrete($this);
        } else {
            $reflector = new \ReflectionClass($concrete);

            if (!$reflector->isInstantiable()) {
                throw new \Exception("{$concrete} no es instanciable");
            }

            $constructor = $reflector->getConstructor();

            if (is_null($constructor)) {
                return new $concrete;
            }

            $parameters = $constructor->getParameters();
            $dependencies = $this->resolveDependencies($parameters);

            return $reflector->newInstanceArgs($dependencies);
        }
    }

    private function resolveDependencies($parameters)
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();

            if ($dependency === null) {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new \Exception("No se puede resolver la dependencia del parámetro {$parameter->name}");
                }
            } else {
                $dependencies[] = $this->make($dependency->name);
            }
        }

        return $dependencies;
    }
}
