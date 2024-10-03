<?php

namespace sistema\Nucleo;

/**
 * Classe Modelo
 *
 * @author Ronaldo Aires
 */
class Modelo
{

    protected $dados;
    protected $query;
    protected $erro;
    protected $parametros;
    protected $tabela;
    protected $ordem;
    protected $limite;
    protected $offset;

    public function __construct(string $tabela)
    {
        $this->tabela = $tabela;
    }

    public function busca(?string $termos = null, ?string $parametros = null, string $colunas = '*'){
        if($termos){
            $this->query = 'SELECT {$colunas} FROM '.$this->tabela.' WHERE {$termos}';
            parse_str($parametros, $this->parametros);
            return $this;
        }

        $this->query = "SELECT {$colunas} FROM ".$this->tabela;
        return $this;
    }
    
    public function resultado(bool $todos = false){
        try {
            $stmt = Conexao::getInstancia()->prepare($this->query);
            $stmt->execute();
        } catch (\PDOException $ex) {
            $this->erro = $ex;
        }
    }
}
