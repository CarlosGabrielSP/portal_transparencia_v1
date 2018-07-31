<?php
require_once('classes/Conexao.php');
require_once('classes/Salario.php');

class SalarioDAO {
	private $conexao;

    public function __construct(){
        $objConexao = new Conexao();
        $this->conexao = $objConexao->getConexao();
    }

    public function getConexao(){
        return $this->conexao;
    }

    function setSalario(Salario $salario){
        $matricula      = $this->conexao->real_escape_string($salario->getMatricula());
        $nome           = $this->conexao->real_escape_string($salario->getNome());
        $cargo          = $this->conexao->real_escape_string($salario->getCargo());
        $vinculo        = $this->conexao->real_escape_string($salario->getVinculo());
        $bruto          = $this->conexao->real_escape_string($salario->getBruto());
        $desconto       = $this->conexao->real_escape_string($salario->getDesconto());
        $liquido        = $this->conexao->real_escape_string($salario->getliquido());
        $orgao          = $this->conexao->real_escape_string($salario->getOrgao());
        $mes            = $this->conexao->real_escape_string($salario->getMes());
        $exercicio      = $this->conexao->real_escape_string($salario->getExercicio());

        $qry = "INSERT INTO Salario
                        (matricula,
                        nome,
                        cargo,
                        vinculo,
                        bruto,
                        desconto,
                        liquido,
                        orgao,
                        mes,
                        exercicio)
                VALUES
                        ('{$matricula}',
                        '{$nome}',
                        '{$cargo}',
                        '{$vinculo}',
                        {$bruto},
                        {$desconto},
                        {$liquido},
                        '{$orgao}',
                        {$mes},
                        {$exercicio})";
        return mysqli_query($this->conexao,$qry);
    }

     public function getSalarios($filtro=[],$ordenaPor='nome',$ordem='ASC'){
        $salarios = array();
        $ordenaPor = $this->conexao->real_escape_string($ordenaPor);
        $ordem = $this->conexao->real_escape_string($ordem);
        if($ordem != 'ASC' && $ordem != 'DESC') $ordem = 'ASC';
        $qry = "SELECT * FROM salario WHERE 1";
        foreach($filtro as $key => $value){
            $pesquisa = $this->conexao->real_escape_string($value);
            switch($key){
                case 'matricula':
                    $qry .= " AND matricula LIKE '%{$pesquisa}%'";
                    break;
                case 'nome':
                    $qry .= " AND nome LIKE '%{$pesquisa}%'";
                    break;
                case 'cargo':
                    $qry .= " AND cargo LIKE '%{$pesquisa}%'";
                    break;
                case 'vinculo':
                    $qry .= " AND vinculo LIKE '%{$pesquisa}%'";
                    break;
                case 'bruto':
                    $qry .= " AND bruto = {$pesquisa}";
                    break;
                case 'desconto':
                    $qry .= " AND desconto = {$pesquisa}";
                    break;
                case 'liquido':
                    $qry .= " AND liquido = {$pesquisa}";
                    break;
                case 'orgao':
                    $qry .= " AND orgao = '{$pesquisa}'";
                    break;
                case 'mes':
                    $qry .= " AND mes = {$pesquisa}";
                    break;
                case 'exercicio':
                    $qry .= " AND exercicio = {$pesquisa}";
                    break;
            }
        }
        $qry .= " ORDER BY {$ordenaPor} {$ordem}";
        $resultado = $this->conexao->query($qry);
        while($salario = $resultado->fetch_object('salario')){
            $salarios[] = $salario;
        }
        $resultado->free_result();
        return $salarios;
    }

    public function getMesesSalarios(){
        $meses = array();
        $qry = "SELECT DISTINCT mes FROM salario ORDER BY mes";
        $resultado = $this->conexao->query($qry);
        while($mes = $resultado->fetch_assoc()){
            $meses[] = $mes;
        }
        $resultado->free_result();
        return $meses;
    }

    public function getExerciciosSalarios(){
        $exercicios = array();
        $qry = "SELECT DISTINCT exercicio FROM salario ORDER BY exercicio";
        $resultado = $this->conexao->query($qry);
        while($exercicio = $resultado->fetch_assoc()){
            $exercicios[] = $exercicio;
        }
        $resultado->free_result();
        return $exercicios;
    }

    public function getOrgaoSalarios(){
        $orgaos = array();
        $qry = "SELECT DISTINCT orgao FROM salario ORDER BY orgao";
        $resultado = $this->conexao->query($qry);
        while($orgao = $resultado->fetch_assoc()){
            $orgaos[] = $orgao;
        }
        $resultado->free_result();
        return $orgaos;
    }
}