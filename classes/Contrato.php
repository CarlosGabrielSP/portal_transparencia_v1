<?php 

class Contrato
{
    private $id;
    private $numero;
    private $ementa;
    private $arquivo;
    private $orgao;
    private $exercicio;

    public function getId()
    {
        return $this->id;
    }
    public function getNumero()
    {
        return $this->numero;
    }
    public function getEmenta()
    {
        return $this->ementa;
    }
    public function getArquivo()
    {
        return $this->arquivo;
    }
    public function getOrgao()
    {
        return $this->orgao;
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
    public function setNumero($numero)
    {
        $this->numero = $numero;
        return $this;
    }
    public function setEmenta($ementa)
    {
        $this->ementa = $ementa;
        return $this;
    }
    public function setArquivo($arquivo)
    {
        $this->arquivo = $arquivo;
        return $this;
    }
    public function setOrgao($orgao)
    {
        $this->orgao = $orgao;
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
                case "numero" :
                    $this->numero = ($campo ?? "");
                    break;
                case "ementa" :
                    $this->ementa = ($campo ?? "");
                    break;
                case "arquivo":
                    $this->arquivo = ($campo ?? "");
                    break;
                case "orgao" :
                    $this->orgao = ($campo ?? "");
                    break;
                case "exercicio" :
                    $this->exercicio = ($campo ?? "");
                    break;
            }
        }
    }
}

?>