<?php
require_once('../cnx/Conexao.php');
require_once('Evento.php');

class EventoDAO{
	private $conexao;

    public function __construct(){
        $objConexao = new Conexao();
        $this->conexao = $objConexao->getConexao();
    }

    public function getConexao(){
        return $this->conexao;
    }

    public function setEvento(Evento $evento){
    	$data = $this->conexao->real_escape_string($evento->getData());
        $hora = $this->conexao->real_escape_string($evento->getHora());
        $tipo = $this->conexao->real_escape_string($evento->getTipo());
        $titulo = $this->conexao->real_escape_string($evento->getTitulo());
        $descricao = $this->conexao->real_escape_string($evento->getDescricao());
        $local = $this->conexao->real_escape_string($evento->getLocal());

        $qry = "INSERT INTO evento
                        (data,
                        hora,
                        tipo,
                        titulo,
                        descricao,
                        local)
                VALUES
                        ('{$data}',
                        '{$hora}',
                        '{$tipo}',
                        '{$titulo}',
                        '{$descricao}',
                        '{$local}')";
        return $this->conexao->query($qry);
    }

    public function getEventoPorTipoData($tipo,$data){
    	$tipo = $this->conexao->real_escape_string($tipo);
    	$dma = explode('-',$data);
    	// var_dump($dma);
    	$eventos = array();
    	$qry = "SELECT * FROM evento AS e
    			WHERE e.tipo = '{$tipo}'
    			AND YEAR(e.data) = '{$dma[0]}'
    			AND MONTH(e.data) = '{$dma[1]}'
    			AND DAY(e.data) = '{$dma[2]}'
    			ORDER BY e.data,e.hora DESC";
    	$resultado = $this->conexao->query($qry);
        while($evento = $resultado->fetch_object('evento')){
            $eventos[] = $evento;
        }
        $resultado->free_result();
        return $eventos;
    }

    public function getAnosAgenda(){
    	$anos = array();
        $qry = "SELECT DISTINCT YEAR(e.data) AS ano FROM evento AS e ORDER BY ano";
        $resultado = $this->conexao->query($qry);
        while($ano = $resultado->fetch_assoc()){
            $anos[] = $ano;
        }
        $resultado->free_result();
        return $anos;
    }
}