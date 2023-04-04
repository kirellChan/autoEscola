<?php

class Usuario {
    private $dados;
    private $msg;
    private $resultado;

    const Entity = 'users';

    public function ExeCreate(array $dados){
        $this->dados = $dados;
        $this->validaDados();
        if($this->resultado){
            $this->Cadastrar();
        }
    }

    public function getResultado(){
        return $this->resultado;
    }

    public function getMsg(){
        return $this->msg;
    }

    public function validaDados(){
        $this->dados = array_map('strip_tags',$this->dados);
        $this->dados = array_map('trim',$this->dados);
        if (in_array('',$this->dados)) {
            $this->resultado = false;
            $this->msg = "Erro ao cadastrar";
        }else {
            $this->dados['password'] = md5($this->dados['password']);
            $this->resultado = true;
        }
    }

    public function Cadastrar(){
        $create = new Create();
        $create->ExeCreate(self::Entity, $this->dados);
        if ($create->getResultado()){
            $this->resultado = $create->getResultado();
            $this->msg = "Usuario {$this->dados['name']} foi cadastrado";
        }
    }
}