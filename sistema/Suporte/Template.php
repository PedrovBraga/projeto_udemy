<?php

namespace sistema\Suporte;

class Template {
    
    private \Twig\Environment $twig;

    public function public function __construct(string $diretorio) {
        $loader = new \Twig\Loader\FilesystemLoader(string $diretorio);
        $this->twig = new \Twig\Enviroment($loader);
    }

    public function renderizar(string $view, array $dados){
        return $this->twig->render($view, $dados);
    }

}