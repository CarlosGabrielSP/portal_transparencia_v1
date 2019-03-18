<?php
namespace CarlosGabriel\Classes;

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
    public function getProcLicitatorio()
    {
        return $this->procLicitatorio;
    }
    public function getObjeto()
    {
        return $this->objeto;
    }
    public function getValor()
    {
        return $this->valor;
    }
    public function getContratado()
    {
        return $this->contratado;
    }
    public function getData()
    {
        return $this->data;
    }
    public function getVigencia()
    {
        return $this->vigencia;
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
    public function setProcLicitatorio($procLicitatorio)
    {
        $this->procLicitatorio = $procLicitatorio;
        return $this;
    }
    public function setObjeto($objeto)
    {
        $this->objeto = $objeto;
        return $this;
    }
    public function setValor($valor)
    {
        $this->valor = $valor;
        return $this;
    }
    public function setContratado($contratado)
    {
        $this->contratado = $contratado;
        return $this;
    }
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    public function setVigencia($vigencia)
    {
        $this->vigencia = $vigencia;
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
                case "procLicitatorio" :
                    $this->procLicitatorio = ($campo ?? "");
                    break;
                case "objeto" :
                    $this->objeto = ($campo ?? "");
                    break;
                case "valor" :
                    $this->valor = ($campo ?? "");
                    break;
                case "contratado" :
                    $this->contratado = ($campo ?? "");
                    break;
                case "data" :
                    $this->data = ($campo ?? "");
                    break;
                case "vigencia" :
                    $this->vigencia = ($campo ?? "");
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
