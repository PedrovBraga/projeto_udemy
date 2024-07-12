<?php

namespace sistema\Nucleo;

use Exception;
use PDO;
use PDOException;


class Conexao {

    private static $instancia;

    public static function getInstancia(): PDO {
        if(empty(self::$instancia)){
            try{
                self::$instancia = new PDO('mysql:host='.DB_HOST.';port='.DB_PORTA.';dbname='.DB_NOME, DB_USUARIO, DB_SENHA, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Essa propriedade faz com que todo erro seja uma exceção
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // Converte resultado da consulta em objeto
                    PDO::ATTR_CASE => PDO::CASE_NATURAL // Retorna as colunas com mesmo nome das colunas das tabelas
                ]);
            } catch(PDOException $ex) {
                die("Erro de conexão: ".$ex->getMessage());
            }
            
            return self::$instancia;
        }
    }

    // protected impede que sejam feitos vários "new Conexao" no sistema (singleton)
    protected function __construct() {
        
    }

    // declara a função explicitamente com private e impede que classe seja clonada (singleton)
    private function __clone(): void
    {
        
    }

}


?>