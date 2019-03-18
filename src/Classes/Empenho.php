<?php 
namespace CarlosGabriel\Classes;
class Empenho{
    private $id;
    private $numero;
    private $favorecido;
    private $valor;
    private $objeto;
    private $tipo;
    private $data;
    private $procedimento_lic;
    private $unidade_orc;
    private $funcao;
    private $subfuncao;
    private $natureza;
    private $fonte;
    private $exercicio;
    private $orgao;


    public function setId($id){
        $this->id = $id;
        return $this;
    }
    public function setNumero($numero){
        $this->numero = $numero;
        return $this;
    }
    public function setFavorecido($favorecido){
        $this->favorecido = $favorecido;
        return $this;
    }
    public function setValor($valor){
        $this->valor = $valor;
        return $this;
    }
    public function setObjeto($objeto){
        $this->objeto = $objeto;
        return $this;
    }
    public function setTipo($tipo){
        $this->tipo = $tipo;
        return $this;
    }
    public function setData($data){
        $this->data = $data;
        return $this;
    }
    public function setProcedimento_lic($procedimento_lic){
        $this->procedimento_lic = $procedimento_lic;
        return $this;
    }
    public function setUnidade_orc($unidade_orc){
        $this->unidade_orc = $unidade_orc;
        return $this;
    }
    public function setFuncao($funcao){
        $this->funcao = $funcao;
        return $this;
    }
    public function setSubfuncao($subfuncao){
        $this->subfuncao = $subfuncao;
        return $this;
    }
    public function setNatureza($natureza){
        $this->natureza = $natureza;
        return $this;
    }
    public function setFonte($fonte){
        $this->fonte = $fonte;
        return $this;
    }
    public function setExercicio($exercicio){
        $this->exercicio = $exercicio;
        return $this;
    }
    public function setOrgao($orgao){
        $this->orgao = $orgao;
        return $this;
    }


    public function getId(){
        return $this->id;
    }
    public function getNumero(){
        return $this->numero;
    }
    public function getFavorecido(){
        return $this->favorecido;
    }
    public function getValor(){
        return $this->valor;
    }
    public function getObjeto(){
        return $this->objeto;
    }
    public function getTipo(){
        return $this->tipo;
    }
    public function getData(){
        return $this->data;
    }
    public function getProcedimento_lic(){
        return $this->procedimento_lic;
    }
    public function getUnidade_orc(){
        return $this->unidade_orc;
    }
    public function getFuncao(){
        return $this->funcao;
    }
    public function getSubfuncao(){
        return $this->subfuncao;
    }
    public function getNatureza(){
        return $this->natureza;
    }
    public function getFonte(){
        return $this->fonte;
    }
    public function getExercicio(){
        return $this->exercicio;
    }
    public function getOrgao(){
        return $this->orgao;
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
                case "favorecido" :
                    $this->favorecido = ($campo ?? "");
                    break;
                case "valor" :
                    $this->valor = ($campo ?? "");
                    break;
                case "objeto":
                    $this->objeto = ($campo ?? "");
                    break;
                case "tipo":
                    $this->tipo = ($campo ?? "");
                    break;
                case "data":
                    $this->data = ($campo ?? "");
                    break;
                case "procedimento_lic":
                    $this->procedimento_lic = ($campo ?? "");
                    break;
                case "unidade_orc":
                    $this->unidade_orc = ($campo ?? "");
                    break;
                case "funcao":
                    $this->funcao = ($campo ?? "");
                    break;
                case "subfuncao":
                    $this->subfuncao = ($campo ?? "");
                    break;
                case "natureza":
                    $this->natureza = ($campo ?? "");
                    break;
                case "fonte":
                    $this->fonte = ($campo ?? "");
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