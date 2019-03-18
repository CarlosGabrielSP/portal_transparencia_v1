<?php 
namespace CarlosGabriel\classes\cnx;

class ZConexao
{
	private $exercicio;

	private $hostSCPI;
	private $userSCPI = "FSCSCPI8";
	private $passSCPI = "scpi";

	private $hostSIP;
	private $userSIP = "FSCSIP";
	private $passSIP = "sip";

	public function __construct($exercicio){
		$this->exercicio = $exercicio;
		$this->hostSCPI = "LOCALHOST/3050:C:\Fiorilli\SCPI_8\CIDADES\GURUPA_PM\ARQ{$this->exercicio}\SCPI{$this->exercicio}.FDB";
		$this->hostSPI = "localhost/3050:C:\Fiorilli\SIP_7\GURUPA_PM\SIP.FDB";
	}

	public function getExercicio(){
		return $this->exercicio;
	}

	public function getConexaoSCPI(){
		return ibase_connect($this->hostSCPI,$this->userSCPI,$this->passSCPI);
	}

	public function getConexaoSIP(){
		return ibase_connect($this->hostSIP,$this->userSIP,$this->passSIP);
	}
}