<?php 

class Salario
{
    private $id;
    private $matricula;
    private $nome;
    private $cargo;
    private $vinculo;
    private $bruto;
    private $desconto;
    private $liquido;
    private $orgao;
    private $mes;
    private $exercicio;

    public function getId()
    {
        return $this->id;
    }
    public function getMatricula()
    {
        return $this->matricula;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getCargo()
    {
        return $this->cargo;
    }
    public function getVinculo()
    {
        return $this->vinculo;
    }
    public function getBruto()
    {
        return $this->bruto;
    }
    public function getDesconto()
    {
        return $this->desconto;
    }
    public function getLiquido()
    {
        return $this->liquido;
    }
    public function getOrgao()
    {
        return $this->orgao;
    }
    public function getMes()
    {
        return $this->mes;
    }
    public function getExercicio()
    {
        return $this->exercicio;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
        return $this;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
        return $this;
    }
    public function setVinculo($vinculo)
    {
        $this->vinculo = $vinculo;
        return $this;
    }
    public function setBruto($bruto)
    {
        $this->bruto = $bruto;
        return $this;
    }
    public function setDesconto($desconto)
    {
        $this->desconto = $desconto;
        return $this;
    }
    public function setLiquido($liquido)
    {
        $this->liquido = $liquido;
        return $this;
    }
    public function setOrgao($orgao)
    {
        $this->orgao = $orgao;
        return $this;
    }
    public function setMes($mes)
    {
        $this->mes = $mes;
        return $this;
    }
    public function setExercicio($exercicio)
    {
        $this->exercicio = $exercicio;
        return $this;
    }

    public function setAll($array){
        foreach ($array as $ind => $campo) {
            switch($ind){
                case "id" :
                    $this->id = ($campo ?? "");
                    break;
                case "matricula" :
                    $this->matricula = ($campo ?? "");
                    break;
                case "nome" :
                    $this->nome = ($campo ?? "");
                    break;
                case "cargo":
                    $this->cargo = ($campo ?? "");
                    break;
                case "vinculo":
                    $this->vinculo = ($campo ?? "");
                    break;
                case "bruto":
                    $this->bruto = ($campo ?? "");
                    break;
                case "desconto":
                    $this->desconto = ($campo ?? "");
                    break;
                case "liquido":
                    $this->liquido = ($campo ?? "");
                    break;
                case "orgao" :
                    $this->orgao = ($campo ?? "");
                    break;
                case "mes" :
                    $this->mes = ($campo ?? "");
                    break;
                case "exercicio" :
                    $this->exercicio = ($campo ?? "");
                    break;
            }
        }
    }
}

?>