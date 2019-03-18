<?php
namespace CarlosGabriel\Classes;

class Evento
{
    private $id;
    private $data;
    private $hora;
    private $tipo;
    private $titulo;
    private $descrição;
    private $local;

    public function setId($id){
        $this->id = $id;
        return $this;
    }
    public function setData($data){
        $this->data = $data;
        return $this;
    }
    public function sethora($hora){
        $this->hora = $hora;
        return $this;
    }
    public function setTipo($tipo){
        $this->tipo = $tipo;
        return $this;
    }
    public function setTitulo($titulo){
        $this->titulo = $titulo;
        return $this;
    }
    public function setDescricao($descricao){
        $this->descricao = $descricao;
        return $this;
    }
    public function setLocal($local){
        $this->local = $local;
        return $this;
    }

    public function getId(){
        return $this->id;
    }
    public function getData(){
        return $this->data;
    }
    public function getHora(){
        return $this->hora;
    }
    public function getTipo(){
        return $this->tipo;
    }
    public function getTitulo(){
        return $this->titulo;
    }
    public function getDescricao(){
        return $this->descricao;
    }
    public function getLocal(){
        return $this->local;
    }

    public function setAll($array){
        foreach ($array as $nome => $campo) {
            switch($nome){
            	case "id" :
                    $this->id = ($campo ?? "");
                    break;
                case "data" :
                    $this->data = ($campo ?? "");
                    break;
                case "hora" :
                    $this->hora = ($campo ?? "");
                    break;
                case "tipo":
                    $this->tipo = ($campo ?? "");
                    break;
                case "titulo":
                    $this->titulo = ($campo ?? "");
                    break;
                case "descricao":
                    $this->descricao = ($campo ?? "");
                    break;
                case "local":
                    $this->local = ($campo ?? "");
                    break;
            }
        }
    }
}