<?php

namespace App\services\renders;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class TwigRender implements IRender
{
    protected $loader;
    protected $twig;
    protected $template;

    public function render($template, $params = [])
    {
        $template .= ".php.twig";
        $this->loader = new FilesystemLoader(dirname(dirname(__DIR__)) . '/templates/');
        $twig = new Environment($this->loader, [
           // 'cache' => '/path/to/compilation_cache',
        ]);

        return  $twig->render($template, $params);

    }
}



