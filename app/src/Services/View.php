<?php

namespace App\src\Services;

class View extends \Slim\View
{

    public $twig;

    public function twig()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/Views');

        $this->twig = new \Twig\Environment($loader, [
            'debug' => true,
        ]);
        $this->twig->addFilter(new \Twig\TwigFilter('var_dump', 'var_dump'));
    }

    public function functions()
    {   

    }

    protected function load()
    {
        $this->twig();
        $this->functions();
    }

    public function render($template, $data = null)
    {
        $this->load();
        $template = $this->twig->loadTemplate(str_replace('.', '/', "{$template}").".html");

        return $template->render($this->data->all());

    }
    
}