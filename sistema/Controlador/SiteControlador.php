<?php

namespace sistema\Controlador;

use sistema\Nucleo\Controlador;
use sistema\Modelo\PostModelo;
use sistema\Nucleo\Helpers;

class SiteControlador extends Controlador
{
    public function __construct()
    {
        parent::__construct('templates/site/views');
    }

    public function index(): void
    {
        $posts = (new PostModelo())->busca();
        echo $this->template->renderizar('index.html', [
            'posts' => $posts
        ]);
    }

    public function post(int $id): void
    {
        $post = (new PostModelo())->buscarPorId($id);
        if(!$post){
            Helpers::redirecionar('404');
        }

        echo $this->template->renderizar('post.html', [
            'post' => $post
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
