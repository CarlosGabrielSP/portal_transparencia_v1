<?php 
class Conexao
{
    private $conexao;

    public function __construct()
    {
		$this->conexao = mysqli_connect('127.0.0.1','root','','transpbd');
    }

    public function getConexao(){
    	return $this->conexao;
    }
}