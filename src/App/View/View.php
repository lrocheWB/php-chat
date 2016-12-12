<?php

namespace App\View;

use App\View\Exception\ViewException;

class View
{
    private $data = [];

    /**
     * @param string $template
     * @throws ViewException
     */
    public function render($template)
    {
        $render = false;

        try {
            $file = __DIR__ . '/../Templates/' . strtolower($template) . '.php';

            if (file_exists($file)) {
                $render = $file;
            } else {
                throw new ViewException('Template ' . $template . ' not found!');
            }
        }
        catch (ViewException $e) {
            echo $e->getMessage();
        }

        extract($this->data);
        include($render);
    }

    /**
     * @param string $variable
     * @param string $value
     */
    public function assign($variable, $value)
    {
        $this->data[$variable] = $value;
    }
}
