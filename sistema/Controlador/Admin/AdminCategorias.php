<?php

namespace sistema\Controlador\Admin;

use PDOException;
use sistema\Modelo\CategoriaModelo;
use sistema\Nucleo\Helpers;

class AdminCategorias extends AdminControlador {

    public function listar():void {
        echo $this->template->renderizar('categorias/listar.html', [
            'categorias' => (new CategoriaModelo())->busca() 
        ]);
    }

    public function cadastrar():void {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(isset($dados)){
            (new CategoriaModelo())->armazenar($dados);
            Helpers::redirecionar('admin/categorias/listar');
        }

        echo $this->template->renderizar('categorias/formulario.html', []);
    }

    public function editar(int $id):void {
        $categoria = (new CategoriaModelo())->buscarPorId($id);
        
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(isset($dados)){
            (new CategoriaModelo())->atualizar($dados, $id);
            Helpers::redirecionar('admin/categorias/listar');
        }

        echo $this->template->renderizar('categorias/formulario.html', [
            'categoria' => $categoria
        ]);
    }
    
    public function deletar(int $id):void {
        try{
            (new CategoriaModelo())->deletar($id);
            Helpers::redirecionar('admin/categorias/listar');
        } catch (PDOException $e){
            // Caso haja violação de integridade referencial (essa "amarração" foi feita ao criar o BD)
            if($e->getCode() === '23000'){ // Código de violação de chave estrangeira
                echo "Erro: Não é possível deletar esta categoria, pois existem registros dependentes dela!";
                Helpers::redirecionar('admin/categorias/listar?erro=dependencia');
            }
        }

    }

}

?>