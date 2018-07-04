<?php 

class Departamento{
	private $id;
	private $cnpj;
	private $nome;
	private $tipo;
	private $responsavel;
	private $tituloResponsavel;
	private $fotoResponsavel;
	private $municipio;
	private $endereco;
	private $horario;
	private $telefone;
	private $email;
	private $competencia;

	public function getId(){
	    return $this->id;
	}
	public function getCnpj(){
	    return $this->cnpj;
	}
	public function getNome(){
	    return $this->nome;
	}
	public function getTipo(){
	    return $this->tipo;
	}
	public function getResponsavel(){
	    return $this->responsavel;
	}
	public function getTituloResponsavel(){
	    return $this->tituloResponsavel;
	}
	public function getFotoResponsavel(){
	    return $this->fotoResponsavel;
	}
	public function getMunicipio(){
	    return $this->municipio;
	}
	public function getEndereco(){
	    return $this->endereco;
	}
	public function getHorario(){
	    return $this->horario;
	}
	public function getTelefone(){
	    return $this->telefone;
	}
	public function getEmail(){
	    return $this->email;
	}
	public function getCompetencia(){
	    return $this->competencia;
	}


	public function setId($id){
	    $this->id = $id;
	    return $this;
	}
	public function setCnpj($cnpj){
	    $this->cnpj = $cnpj;
	    return $this;
	}
	public function setNome($nome){
	    $this->nome = $nome;
	    return $this;
	}
	public function setTipo($tipo){
	    $this->tipo = $tipo;
	    return $this;
	}
	public function setResponsavel($reponssavel){
	    $this->reponssavel = $reponssavel;
	    return $this;
	}
	public function setTituloResponsavel($tituloResponsavel){
	    $this->tituloResponsavel = $tituloResponsavel;
	    return $this;
	}
	public function setFotoResponsavel($fotoResponsavel){
	    $this->fotoResponsavel = $fotoResponsavel;
	    return $this;
	}
	public function setMunicipio($municipio){
	    $this->municipio = $municipio;
	    return $this;
	}
	public function setEndereco($endereco){
	    $this->endereco = $endereco;
	    return $this;
	}
	public function setHorario($horario){
	    $this->horario = $horario;
	    return $this;
	}
	public function setTelefone($telefone){
	    $this->telefone = $telefone;
	    return $this;
	}
	public function setEmail($email){
	    $this->email = $email;
	    return $this;
	}
	public function setCompetencia($competencia){
	    $this->competencia = $competencia;
	    return $this;
	}

	public function setAll($array){
        foreach ($array as $ind => $campo) {
            switch($ind){
                case "id" :
                    $this->id = ($campo ?? "");
                    break;
                case "cnpj" :
                    $this->cnpj = ($campo ?? "");
                    break;
                case "nome" :
                    $this->nome = ($campo ?? "");
                    break;
                case "tipo":
                    $this->tipo = ($campo ?? "");
                    break;
                case "responsavel":
                    $this->responsavel = ($campo ?? "");
                    break;
                case "tituloResponsavel":
                    $this->tituloResponsavel = ($campo ?? "");
                    break;
                case "fotoResponsavel":
                    $this->fotoResponsavel = ($campo ?? "");
                    break;
                case "municipio" :
                    $this->municipio = ($campo ?? "");
                    break;
                case "endereco" :
                    $this->endereco = ($campo ?? "");
                    break;
                    case "horario" :
                    $this->horario = ($campo ?? "");
                    break;
                case "telefone" :
                    $this->telefone = ($campo ?? "");
                    break;
                case "email" :
                    $this->email = ($campo ?? "");
                    break;
                case "competencia":
                    $this->competencia = ($campo ?? "");
                    break;
            }
        }
    }
}