<?php 
namespace CarlosGabriel\Classes;

class Licitacao
{
    private $id;
    private $processo;
    private $modalidade;
    private $tipo;
    private $objeto;
    private $publicacao;
    private $data_publicacao;
    private $situacao;
    private $valor;
    private $vencedor;
    private $edital;
    private $orgao;
    private $exercicio;

    public function getId()
    {
        return $this->id;
    }
    public function getProcesso()
    {
        return $this->processo;
    }
    public function getModalidade()
    {
        return $this->modalidade;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    public function getObjeto()
    {
        return $this->objeto;
    }
    public function getPublicacao()
    {
        return $this->publicacao;
    }
    public function getData_publicacao()
    {
        return $this->data_publicacao;
    }
    public function getSituacao()
    {
        return $this->situacao;
    }
    public function getValor()
    {
        return $this->valor;
    }
    public function getVencedor()
    {
        return $this->vencedor;
    }
    public function getEdital()
    {
        return $this->edital;
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
    public function setProcesso($processo)
    {
        $this->processo = $processo;
        return $this;
    }
    public function setModalidade($modalidade)
    {
        $this->modalidade = $modalidade;
        return $this;
    }
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }
    public function setObjeto($objeto)
    {
        $this->objeto = $objeto;
        return $this;
    }
    public function setPublicacao($publicacao)
    {
        $this->publicacao = $publicacao;
        return $this;
    }
    public function setData_publicacao($data_publicacao)
    {
        $this->data_publicacao = $data_publicacao;
        return $this;
    }
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
        return $this;
    }
    public function setValor($valor)
    {
        $this->valor = $valor;
        return $this;
    }
    public function setVencedor($vencedor)
    {
        $this->vencedor = $vencedor;
        return $this;
    }
    public function setEdital($edital)
    {
        $this->edital = $edital;
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
                case "processo" :
                    $this->processo = ($campo ?? "");
                    break;
                case "modalidade" :
                    $this->modalidade = ($campo ?? "");
                    break;
                case "tipo" :
                    $this->tipo = ($campo ?? "");
                    break;
                case "objeto":
                    $this->objeto = ($campo ?? "");
                    break;
                case "publicacao" :
                    $this->publicacao = ($campo ?? "");
                    break;
                case "data_publicacao" :
                    $this->data_publicacao = ($campo ?? "");
                    break;
                case "situacao" :
                    $this->situacao = ($campo ?? "");
                    break;
                case "valor" :
                    $this->valor = ($campo ?? "");
                    break;
                case "vencedor" :
                    $this->vencedor = ($campo ?? "");
                    break;
                case "edital" :
                    $this->edital = ($campo ?? "");
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