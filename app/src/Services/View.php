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
        $this->twig->addFunction(new TwigFunction('getFlash', 'getFlash'));
        $session = isset($_SESSION) ? $_SESSION : [];
        $this->twig->addGlobal('session', $session);
        $this->twig->addExtension(new IntlExtension());
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
        $template = $this->twig->load(str_replace('.', '/', "{$template}").".html");

        return $template->render($this->data->all());

    }
    
}