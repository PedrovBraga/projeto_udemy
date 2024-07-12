<?php

namespace sistema\Controlador;

use sistema\Nucleo\Controlador;
use sistema\Modelo\PostModelo;

class SiteControlador extends Controlador
{
    public function __construct()
    {
        parent::__construct('templates/site/views');
    }

    public function index(): void
    {
        $posts = (new PostModelo())->ler();
        echo $this->template->renderizar('index.html', [
            'posts' => $posts
        ]);
    }

    public function sobre(): void
    {
        echo $this->template->renderizar('sobre.html', [
        ]);
    }
    
    public function erro404(): void
    {
        echo $this->template->renderizar('404.html', [

        ]);
    }


}
