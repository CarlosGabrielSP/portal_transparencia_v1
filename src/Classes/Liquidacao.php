<?php
namespace CarlosGabriel\Classes;

require_once(__DIR__.'/../../vendor/autoload.php');

class Liquidacao
{
    private $id;
    private $empenho;
    private $valor;
    private $data;
    private $exercicio;
    private $orgao;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function setEmpenho($empenho)
    {
        $this->empenho = $empenho;
        return $this;
    }
    public function setValor($valor)
    {
        $this->valor = $valor;
        return $this;
    }
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    public function setExercicio($exercicio)
    {
        $this->exercicio = $exercicio;
        return $this;
    }
    public function setOrgao($orgao)
    {
        $this->orgao = $orgao;
        return $this;
    }
    

    public function getId()
    {
        return $this->id;
    }
    public function getEmpenho()
    {
        return $this->empenho;
    }
    public function getValor()
    {
        return $this->valor;
    }
    public function getData()
    {
        return $this->data;
    }
    public function getExercicio()
    {
        return $this->exercicio;
    }
    public function getOrgao()
    {
        return $this->orgao;
    }

    public function setAll($array){
        foreach ($array as $ind => $campo) {
            switch($ind){
                case "id" :
                    $this->id = ($campo ?? "");
                    break;
                case "empenho" :
                    $this->empenho = ($campo ?? "");
                    break;
                case "valor" :
                    $this->valor = ($campo ?? "");
                    break;
                case "data":
                    $this->data = ($campo ?? "");
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