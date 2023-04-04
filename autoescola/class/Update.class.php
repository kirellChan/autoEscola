<?php

class Create extends Conn{

    private $tabela;
    private $dados;
    private $termos;
    private $values;
    private $resultado;
    private $msg;
    private $query;
    private $conn;

    public function ExeUpdate($tabela, array $dados, $termos, $parseString){
        $this->tabela = (string) $tabela;
        $this->dados = $dados;
        $this->termos = (string)$termos;
        parse_str($parseString, $this->values);

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