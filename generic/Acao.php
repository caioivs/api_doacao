<?php
namespace generic;

use ReflectionMethod;

class Acao
{
    private $classe;
    private $metodo;

    // Construtor simplificado: recebe direto a classe e o método a executar
    public function __construct($classe, $metodo)
    {
        $this->classe = $classe;
        $this->metodo = $metodo;
    }

    public function executar()
    {
        // 1. Valida se a classe e método existem
        if (!class_exists($this->classe)) {
            return ["erro" => "Classe '{$this->classe}' não encontrada."];
        }
        $obj = new $this->classe();
        
        if (!method_exists($obj, $this->metodo)) {
            return ["erro" => "Método '{$this->metodo}' não encontrado na classe."];
        }

        // 2. Prepara a reflexão para injetar parâmetros
        $reflectMetodo = new ReflectionMethod($this->classe, $this->metodo);
        $parametros = $reflectMetodo->getParameters();
        
        // 3. Pega TUDO o que foi enviado (JSON + POST + GET)
        $dadosRecebidos = $this->getParam(); 
        $argumentosParaFuncao = [];

        // 4. Injeta os dados automaticamente nos argumentos da função
        foreach ($parametros as $param) {
            $nomeParametro = $param->getName();
            
            if (isset($dadosRecebidos[$nomeParametro])) {
                $argumentosParaFuncao[$nomeParametro] = $dadosRecebidos[$nomeParametro];
            } else {
                // Se o parâmetro for obrigatório e não veio, dá erro (evita o retorno null silencioso)
                if (!$param->isOptional()) {
                    return ["erro" => "Parâmetro obrigatório faltando: '$nomeParametro'. Verifique o JSON enviado."];
                }
                $argumentosParaFuncao[$nomeParametro] = $param->getDefaultValue();
            }
        }

        // 5. Executa
        return $reflectMetodo->invokeArgs($obj, $argumentosParaFuncao);
    }

    // Mantive suas funções originais de pegar dados, mas simplifiquei a chamada
    private function getPost(){
        return $_POST ? $_POST : [];
    }

    private function getGet(){
        if($_GET){
            $get = $_GET;
            unset($get["param"]); // Remove o parametro da rota
            return $get;
        }
        return [];
    }

    private function getInput(){
        // Esta é a parte MAIS IMPORTANTE para o Postman funcionar
        $input = file_get_contents("php://input");
        if($input){
            $json = json_decode($input, true);
            return is_array($json) ? $json : [];
        }
        return [];
    }

    public function getParam(){
        // Junta tudo num array só. O JSON (Input) tem prioridade.
        return array_merge($this->getGet(), $this->getPost(), $this->getInput());
    }
}