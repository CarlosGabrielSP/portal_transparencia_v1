<?php 

class Obra
{
    private $id;
    private $descricao;
    private $tipo;
    private $termo_convenio;
    private $anoTermo_convenio;
    private $fornecedor;
    private $situacao;

    public function getId()
    {
        return $this->id;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    public function getValor()
    {
        return $this->valor;
    }
    public function getTermo_convenio()
    {
        return $this->termo_convenio;
    }
    public function getAnoTermo_convenio()
    {
        return $this->anoTermo_convenio;
    }
    public function getFornecedor()
    {
        return $this->fornecedor;
    }
    public function getSituacao()
    {
        return $this->situacao;
    }
    

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }
    public function setTermo_convenio($termo_convenio)
    {
        $this->termo_convenio = $termo_convenio;
        return $this;
    }
    public function setAnoTermo_convenio($anoTermo_convenio)
    {
        $this->anoTermo_convenio = $anoTermo_convenio;
        return $this;
    }
    public function setFornecedor($fornecedor)
    {
        $this->fornecedor = $fornecedor;
        return $this;
    }
    public function setsituacao($situacao)
    {
        $this->situacao = $situacao;
        return $this;
    }


    public function setAll($array){
        foreach ($array as $ind => $campo) {
            switch($ind){
                case "id" :
                    $this->id = ($campo ?? "");
                    break;
                case "descricao" :
                    $this->descricao = ($campo ?? "");
                    break;
                case "tipo" :
                    $this->tipo = ($campo ?? "");
                    break;
                case "termo_convenio" :
                    $this->termo_convenio = ($campo ?? "");
                    break;
                case "anoTermo_convenio" :
                    $this->anoTermo_convenio = ($campo ?? "");
                    break;
                case "valor" :
                    $this->valor = ($campo ?? "");
                    break;
                case "fornecedor" :
                    $this->fornecedor = ($campo ?? "");
                    break;
                case "situacao" :
                    $this->situacao = ($campo ?? "");
                    break;
            }
        }
    }
}

?>