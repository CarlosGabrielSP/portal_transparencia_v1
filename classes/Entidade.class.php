<?php 

class Entidade{
    private $idEntidade;
    private $tipo;
    private $municipio;
    private $codigoIBGE;
    private $endereco;
    private $telefone;
    private $email;
    private $mesorregiao;
    private $cnpj;


    public function setId($id){
        $this->id = $id;
        return $this;
    }
    public function setmunicipio($municipio){
        $this->municipio = $municipio;
        return $this;
    }
    public function setcodigoIBGE($codigoIBGE){
        $this->codigoIBGE = $codigoIBGE;
        return $this;
    }
    public function setendereco($endereco){
        $this->endereco = $endereco;
        return $this;
    }
    public function settelefone($telefone){
        $this->telefone = $telefone;
        return $this;
    }
    public function setTipo($tipo){
        $this->tipo = $tipo;
        return $this;
    }
    public function setemail($email){
        $this->email = $email;
        return $this;
    }
    public function setmesorregiao($mesorregiao){
        $this->mesorregiao = $mesorregiao;
        return $this;
    }
    public function setcnpj($cnpj){
        $this->cnpj = $cnpj;
        return $this;
    }


    public function getId(){
        return $this->id;
    }
    public function getmunicipio(){
        return $this->municipio;
    }
    public function getcodigoIBGE(){
        return $this->codigoIBGE;
    }
    public function getendereco(){
        return $this->endereco;
    }
    public function gettelefone(){
        return $this->telefone;
    }
    public function getTipo(){
        return $this->tipo;
    }
    public function getemail(){
        return $this->email;
    }
    public function getmesorregiao(){
        return $this->mesorregiao;
    }
    public function getcnpj(){
        return $this->cnpj;
    }


    public function setAll($array){
        foreach ($array as $ind => $campo) {
            switch($ind){
                case "id" :
                    $this->id = ($campo ?? "");
                    break;
                case "municipio" :
                    $this->municipio = ($campo ?? "");
                    break;
                case "codigoIBGE" :
                    $this->codigoIBGE = ($campo ?? "");
                    break;
                case "endereco" :
                    $this->endereco = ($campo ?? "");
                    break;
                case "telefone":
                    $this->telefone = ($campo ?? "");
                    break;
                case "tipo":
                    $this->tipo = ($campo ?? "");
                    break;
                case "email":
                    $this->email = ($campo ?? "");
                    break;
                case "mesorregiao":
                    $this->mesorregiao = ($campo ?? "");
                    break;
                case "cnpj":
                    $this->cnpj = ($campo ?? "");
                    break;
            }
        }
    }
}

?>