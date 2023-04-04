<?php

class Create extends Conn{

    private $tabela;
    private $dados;
    private $resultado;
    private $msg;
    private $query;
    private $conn;

    public function ExeCreate($tabela, array $dados){
        $this->tabela = (string) $tabela;
        $this->dados = $dados;

        $this->getInstrucao();
        $this->ExecutarInstrucao();
    }

    public function getResultado(){
        return $this->resultado;
    }

    public function getMsg(){
        return $this->msg;
    }

    public function Conexao(){
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->query);
    }

    public function getInstrucao(){
        $keys = implode(', ', array_keys($this->dados));
        $values = ':'.implode(', :', array_keys($this->dados));

        $this->query = "INSERT INTO {$this->tabela} ({$keys}) VALUES ({$values})";
        //echo $this->query;
    }

    public function ExecutarInstrucao(){
        $this->Conexao();
        try {
            $this->query->execute($this->dados);
            $this->resultado = $this->conn->lastInsertId();

        } catch (Exception $e) {
            $this->resultado = null;
            $this->msg = "<b>Erro ao Cadastrar: </b> {$e->getMessage()}";
        }
    }
}