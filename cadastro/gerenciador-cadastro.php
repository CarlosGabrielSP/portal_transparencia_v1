<?php 
require_once('../classes/Licitacao.class.php');
require_once('../classes/LicitacaoDAO.class.php');
require_once('../classes/Contrato.class.php');
require_once('../classes/ContratoDAO.class.php');
require_once('../classes/Convenio.class.php');
require_once('../classes/ConvenioDAO.class.php');
require_once('../classes/Empenho.class.php');
require_once('../classes/EmpenhoDAO.class.php');
require_once('../classes/Liquidacao.class.php');
require_once('../classes/LiquidacaoDAO.class.php');
require_once('../classes/Pagamento.class.php');
require_once('../classes/PagamentoDAO.class.php');
require_once('../classes/Salario.class.php');
require_once('../classes/SalarioDAO.class.php');
require_once('../classes/Departamento.class.php');
require_once('../classes/DepartamentoDAO.class.php');
require_once('../classes/Evento.class.php');
require_once('../classes/EventoDAO.class.php');
require_once('../classes/Obra.class.php');
require_once('../classes/ObraDAO.class.php');

$elemento = trim($_POST['elemento']) ?? false;

if($elemento){
	
	$array = array_map('trim',$_POST);
	$array['valor'] = str_replace(',','.', $array['valor']);

	switch ($elemento) {
		case "licitacoes" :
			//Upload do Arquivo =============
			$prefixo			= $array['modalidade'];
			$nome_arquivo		= $prefixo.preg_replace("/[^0-9]/","-",$array['processo']).".pdf";
			$diretorio			= "../arquivo/".$elemento."/".$array['exercicio']."/";
			if(!is_dir($diretorio)){
				mkdir($diretorio);
			}
			$caminho_completo	= $diretorio.$nome_arquivo;
			$local_temp			= $_FILES['edital']['tmp_name'];
			$uploadArquivo		= move_uploaded_file($local_temp, $caminho_completo);
			//$array['edital']	= $uploadArquivo ? $caminho_completo : "";
			$licitacao = new Licitacao();
			$licitacao->setAll($array);
			$licitacaoDAO = new LicitacaoDAO();
			$licitacaoDAO->setLicitacao($licitacao);

			break;

		case "contratos" :
			//Upload do Arquivo =============
			$prefixo			= $elemento;
			$nome_arquivo		= $prefixo.preg_replace("/[^0-9]/","",$array['numero']).".pdf";
			$diretorio			= "../arquivo/".$elemento."/".$array['exercicio']."/";
			if(!is_dir($diretorio)){
				mkdir($diretorio);
			}
			$caminho_completo	= $diretorio.$nome_arquivo;
			$local_temp			= $_FILES['arquivo']['tmp_name'];
			$uploadArquivo		= move_uploaded_file($local_temp, $caminho_completo);
			//$array['arquivo']	= $uploadArquivo ? $caminho_completo : "";
			$contrato = new Contrato();
			$contrato->setAll($array);
			$contratoDAO = new ContratoDAO();
			$contratoDAO->setContrato($contrato);

			break;

		case "convenios" :
			//Upload do Arquivo =============
			$prefixo			= $elemento;
			$nome_arquivo		= $prefixo.preg_replace("/[^0-9]/","",$array['numero']).".pdf";
			$diretorio			= "../arquivo/".$elemento."/".$array['exercicio']."/";
			if(!is_dir($diretorio)){
				mkdir($diretorio);
			}
			$caminho_completo	= $diretorio.$nome_arquivo;
			$local_temp			= $_FILES['arquivo']['tmp_name'];
			$uploadArquivo		= move_uploaded_file($local_temp, $caminho_completo);
			//$array['arquivo']	= $uploadArquivo ? $caminho_completo : "";
			$convenio = new Convenio();
			$convenio->setAll($array);
			$convenioDAO = new ConvenioDAO();
			$convenioDAO->setConvenio($convenio);

			break;

		case "empenhos" :
			$empenho = new Empenho();
			$empenho->setAll($array);
			$empenhoDAO = new EmpenhoDAO();
			$empenhoDAO->setEmpenho($empenho);
			
			break;

		case "liquidacoes" :
			$liquidacao = new Liquidacao();
			$liquidacao->setAll($array);
			$liquidacaoDAO = new LiquidacaoDAO();
			$liquidacaoDAO->setLiquidacao($liquidacao);
			
			break;

		case "pagamentos" :
			$pagamento = new Pagamento();
			$pagamento->setAll($array);
			$pagamentoDAO = new PagamentoDAO();
			$pagamentoDAO->setPagamento($Pagamento);
			
			break;

		case "fopag" :
			$empenho = new Empenho();
			$empenho->setAll($array);
			$empenhoDAO = new EmpenhoDAO();
			$empenhoDAO->setEmpenho($empenho);
			
			break;

		case "departamentos" :
			//Upload do Arquivo =============
			$nome_arquivo		= $array['nome'].".jpg";
			$diretorio			= "../arquivo/".$elemento;
			if(!is_dir($diretorio)){
				mkdir($diretorio);
			}
			$caminho_completo	= $diretorio."/".$nome_arquivo;
			$local_temp			= $_FILES['fotoResponsavel']['tmp_name'];
			$uploadArquivo		= move_uploaded_file($local_temp, $caminho_completo);
			$array['fotoResponsavel']	= $uploadArquivo ? $caminho_completo : "";
			// var_dump($uploadArquivo);
			$departamento = new Departamento();
			$departamento->setAll($array);
			$departamentoDAO = new DepartamentoDAO();
			$departamentoDAO->setDepartamento($departamento);

			break;

		case "eventos" :
			$evento = new Evento();
			$evento->setAll($array);
			$eventoDAO = new EventoDAO();
			$eventoDAO->setEvento($evento);
			
			break;

		case "obras" :
			$obra = new Obra();
			$obra->setAll($array);
			$obraDAO = new ObraDAO();
			$obraDAO->setObra($obra);

			break;
	}

	header("Location: ../cadastro/".$elemento."-cadastro.php");
} else {
	header("Location: ../index");
}
?>
