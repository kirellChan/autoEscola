<?php


class Read extends Conn {

    private $select;
    private $values;
    private $resultado;
    private $msg;
    private $query;
    private $conn;

    public function ExeRead($tabela, $termos = null, $parseString = null) {

        if (!empty($parseString)):
            parse_str($parseString, $this->values);
        endif;

        $this->select = "SELECT * FROM {$tabela} {$termos}";
        $this->ExecutarInstrucao();
    }

    public function getResultado() {
        return $this->resultado;
    }

    public function getMsg() {
        return $this->msg;
    }

    public function getRowCount() {
        return $this->query->rowCount();
    }

    private function Conexao() {
        $this->conn = parent::getConn();
        $this->query = $this->conn->prepare($this->select);
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function getInstrucao() {
        if ($this->values):
            foreach ($this->values as $link => $valor):
                if ($link == 'limit' || $link == 'offset'):
                    $valor = (int) $valor;
                endif;
                $this->query->bindValue(":{$link}", $valor, (is_int($valor)?PDO::PARAM_INT : PDO::PARAM_STR));
            endforeach;
        endif;
    }

    private function ExecutarInstrucao() {
        $this->Conexao();
        try {
            $this->getInstrucao();
            $this->query->execute();
            $this->resultado = $this->query->fetchAll();
        } catch (PDOException $e) {
            $this->resultado = null;
            return "<b>Erro ao Ler:</b> {$e->getMessage()}";
        }
    }

}







