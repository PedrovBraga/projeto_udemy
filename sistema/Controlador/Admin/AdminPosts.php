<?php

namespace sistema\Controlador\Admin;

use sistema\Modelo\CategoriaModelo;
use sistema\Modelo\PostModelo;
use sistema\Nucleo\Helpers;

class AdminPosts extends AdminControlador {

    public function listar():void {
        $post = new PostModelo();

        echo $this->template->renderizar('posts/listar.html', [
            'posts' => $post->busca(),
            'total' => $post->total()
        ]);
    }

    public function cadastrar():void {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if(isset($dados)){
            (new PostModelo())->armazenar($dados);
            Helpers::redirecionar('admin/posts/listar');
        }

        echo $this->template->renderizar('posts/formulario.html', [
            'categorias' => (new CategoriaModelo())->busca()
        ]);
    }

    public function editar(int $id):void {
        $post = (new PostModelo())->buscarPorId($id);
        
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(isset($dados)){
            (new PostModelo())->atualizar($dados, $id);
            Helpers::redirecionar('admin/posts/listar');
        }

        echo $this->template->renderizar('posts/formulario.html', [
            'post' => $post,
            'categorias' => (new CategoriaModelo())->busca()
        ]);
    }

    public function deletar(int $id):void {

        (new PostModelo())->deletar($id);
        Helpers::redirecionar('admin/posts/listar');

    }

}

?>