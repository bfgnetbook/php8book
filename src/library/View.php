<?php

namespace App\Library;

use App\Library\InjectContainer;

class View extends InjectContainer
{
    protected $viewFile;
    protected $viewData;
    protected $viewLayout;

    public function __construct()
    {
    }

    public function setViewLayout($viewLayout)
    {
        $this->viewLayout = $viewLayout;
    }

    public function setViewFile($viewFile)
    {
        $this->viewFile = $viewFile;
    }

    public function setViewData($key, $viewData)
    {
        $this->viewData[$key] = $viewData;
    }

    public function render()
    {
        $config = $this->container->make(Config::class);
        $path_view = $config->getKey('path_view');
        $file = $path_view . DIRECTORY_SEPARATOR . $this->viewFile . '.php';
        if (file_exists($file)) {
            if (!is_null($this->viewData)) {
                extract($this->viewData);
            }
            ob_start();
            include $file;
            $content = ob_get_clean();

            $layout = $path_view . DIRECTORY_SEPARATOR . $this->viewLayout;
            if (file_exists("$layout.php")) {
                include "$layout.php";
            } else {
                echo $content;
            }
        } else {
            throw new \Exception("{$this->viewFile} no existe");
        }
    }

    public function get($key)
    {
        return $this->viewData[$key] ?? null;
    }
}
