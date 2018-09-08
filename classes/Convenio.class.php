<?php 

class Convenio
{
    private $id;
    private $numero;
    private $objeto;
    private $concedente;
    private $data;
    private $valor;
    private $vigencia;
    private $arquivo;
    private $exercicio;
    private $orgao;

    public function getId()
    {
        return $this->id;
    }
    public function getNumero()
    {
        return $this->numero;
    }
    public function getObjeto()
    {
        return $this->objeto;
    }
    public function getConcedente()
    {
        return $this->concedente;
    }
    public function getData()
    {
        return $this->data;
    }
    public function getValor()
    {
        return $this->valor;
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
    public function setObjeto($objeto)
    {
        $this->objeto = $objeto;
        return $this;
    }
    public function setConcedente($concedente)
    {
        $this->concedente = $concedente;
        return $this;
    }
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    public function setValor($valor)
    {
        $this->valor = $valor;
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
                case "objeto" :
                    $this->objeto = ($campo ?? "");
                    break;
                case "concedente" :
                    $this->concedente = ($campo ?? "");
                    break;
                case "data" :
                    $this->data = ($campo ?? "");
                    break;
                case "valor" :
                    $this->valor = ($campo ?? "");
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

?>