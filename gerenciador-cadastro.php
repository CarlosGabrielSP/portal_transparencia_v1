<?php 
require_once('classes/Licitacao.php');
require_once('classes/LicitacaoDAO.php');
require_once('classes/Contrato.php');
require_once('classes/ContratoDAO.php');
require_once('classes/Convenio.php');
require_once('classes/ConvenioDAO.php');
require_once('classes/Empenho.php');
require_once('classes/EmpenhoDAO.php');
require_once('classes/Liquidacao.php');
require_once('classes/LiquidacaoDAO.php');
require_once('classes/Pagamento.php');
require_once('classes/PagamentoDAO.php');
require_once('classes/Salario.php');
require_once('classes/SalarioDAO.php');
require_once('classes/Departamento.php');
require_once('classes/DepartamentoDAO.php');
require_once('classes/Evento.php');
require_once('classes/EventoDAO.php');

$elemento = $_POST['elemento'] ?? false;

if($elemento){
	switch ($elemento) {
		case "licitacoes" :
			$array['exercicio']			= trim($_POST['exercicio']) ?? '';
			$array['orgao']				= trim($_POST['orgao']) ?? '';
			$array['processo']			= trim($_POST['processo']) ?? '';
			$array['modalidade']		= trim($_POST['modalidade']) ?? '';
			$array['tipo']				= trim($_POST['tipo']) ?? '';
			$array['objeto']			= trim($_POST['objeto']) ?? '';
			$array['situacao']			= trim($_POST['situacao']) ?? '';
			$array['publicacao']		= trim($_POST['publicacao']) ?? '';
			$array['data_publicacao']	= trim($_POST['data_publicacao']) ?? '';
			$array['valor']				= trim($_POST['valor']) ?? '';
			$array['vencedor']			= trim($_POST['vencedor']) ?? '';

			//Upload do Arquivo =============
			$prefixo			= $elemento;
			$nome_arquivo		= $prefixo.preg_replace("/[^0-9]/","",$array['processo']).".pdf";
			$diretorio			= "arquivo/".$elemento."/".$array['exercicio']."/";
			if(!is_dir($diretorio)){
				mkdir($diretorio);
			}
			$caminho_completo	= $diretorio.$nome_arquivo;
			$local_temp			= $_FILES['edital']['tmp_name'];
			$uploadArquivo		= move_uploaded_file($local_temp, $caminho_completo);
			$array['edital']	= $uploadArquivo ? $caminho_completo : "";
			
			$licitacao = new Licitacao();
			$licitacao->setAll($array);
			$licitacaoDAO = new LicitacaoDAO();
			$licitacaoDAO->setLicitacao($licitacao);
			
			break;

		case "contratos" :
			$array['exercicio']	= trim($_POST['exercicio']) ?? '';
			$array['orgao']		= trim($_POST['orgao']) ?? '';
			$array['numero']	= trim($_POST['numero']) ?? '';
			$array['ementa']	= trim($_POST['ementa']) ?? '';

			//Upload do Arquivo =============
			$prefixo			= $elemento;
			$nome_arquivo		= $prefixo.preg_replace("/[^0-9]/","",$array['numero']).".pdf";
			$diretorio			= "arquivo/".$elemento."/".$array['exercicio']."/";
			if(!is_dir($diretorio)){
				mkdir($diretorio);
			}
			$caminho_completo	= $diretorio.$nome_arquivo;
			$local_temp			= $_FILES['arquivo']['tmp_name'];
			$uploadArquivo		= move_uploaded_file($local_temp, $caminho_completo);
			$array['arquivo']	= $uploadArquivo ? $caminho_completo : "";
			// var_dump($uploadArquivo);
			$contrato = new Contrato();
			$contrato->setAll($array);
			$contratoDAO = new ContratoDAO();
			$contratoDAO->setContrato($contrato);

			break;

		case "convenios" :
			$array['exercicio']	= trim($_POST['exercicio']) ?? '';
			$array['orgao']		= trim($_POST['orgao']) ?? '';
			$array['numero']	= trim($_POST['numero']) ?? '';
			$array['objeto']	= trim($_POST['objeto']) ?? '';
			$array['concedente']= trim($_POST['concedente']) ?? '';
			$array['data']		= trim($_POST['data']) ?? '';
			$array['vigencia']	= trim($_POST['vigencia']) ?? '';
			$array['valor']		= trim($_POST['valor']) ?? '';

			//Upload do Arquivo =============
			$prefixo			= $elemento;
			$nome_arquivo		= $prefixo.preg_replace("/[^0-9]/","",$array['numero']).".pdf";
			$diretorio			= "arquivo/".$elemento."/".$array['exercicio']."/";
			if(!is_dir($diretorio)){
				mkdir($diretorio);
			}
			$caminho_completo	= $diretorio.$nome_arquivo;
			$local_temp			= $_FILES['arquivo']['tmp_name'];
			$uploadArquivo		= move_uploaded_file($local_temp, $caminho_completo);
			$array['arquivo']	= $uploadArquivo ? $caminho_completo : "";
			// var_dump($caminho_completo);
			$convenio = new Convenio();
			$convenio->setAll($array);
			$convenioDAO = new ConvenioDAO();
			$convenioDAO->setConvenio($convenio);

			break;

		case "empenhos" :
			$array['exercicio']			= trim($_POST['exercicio']) ?? '';
			$array['orgao']				= trim($_POST['orgao']) ?? '';
			$array['numero']			= trim($_POST['numero']) ?? '';
			$array['favorecido']		= trim($_POST['favorecido']) ?? '';
			$array['valor']				= trim($_POST['valor']) ?? '';
			$array['objeto']			= trim($_POST['objeto']) ?? '';
			$array['data']				= trim($_POST['data']) ?? '';
			$array['procedimento_lic']	= trim($_POST['procedimento_lic']) ?? '';
			$array['unidade_orc']		= trim($_POST['unidade_orc']) ?? '';
			$array['funcao']			= trim($_POST['funcao']) ?? '';
			$array['subfuncao']			= trim($_POST['subfuncao']) ?? '';
			$array['natureza']			= trim($_POST['natureza']) ?? '';
			$array['fonte']				= trim($_POST['fonte']) ?? '';
			
			$empenho = new Empenho();
			$empenho->setAll($array);
			$empenhoDAO = new EmpenhoDAO();
			$empenhoDAO->setEmpenho($empenho);
			
			break;

		case "liquidacoes" :
			$array['exercicio']	= trim($_POST['exercicio']) ?? '';
			$array['orgao']		= trim($_POST['orgao']) ?? '';
			$array['valor']		= trim($_POST['valor']) ?? '';
			$array['data']		= trim($_POST['data']) ?? '';
			$array['empenho'] 	= trim($_POST['empenho']);

			$liquidacao = new Liquidacao();
			$liquidacao->setAll($array);
			$liquidacaoDAO = new LiquidacaoDAO();
			$liquidacaoDAO->setLiquidacao($liquidacao);
			
			break;

		case "pagamentos" :
			$array['exercicio']	= trim($_POST['exercicio']) ?? '';
			$array['orgao']		= trim($_POST['orgao']) ?? '';
			$array['valor']		= trim($_POST['valor']) ?? '';
			$array['data']		= trim($_POST['data']) ?? '';
			$array['empenho'] 	= trim($_POST['empenho']);

			$pagamento = new Pagamento();
			$pagamento->setAll($array);
			$pagamentoDAO = new PagamentoDAO();
			$pagamentoDAO->setPagamento($Pagamento);
			
			break;

		case "fopag" :
			$array['exercicio']		= trim($_POST['exercicio']) ?? '';
			$array['orgao']			= trim($_POST['orgao']) ?? '';
			$array['matricula']		= trim($_POST['matricula']) ?? '';
			$array['nome']			= trim($_POST['nome']) ?? '';
			$array['cargo']			= trim($_POST['cargo']) ?? '';
			$array['remuneracao']	= trim($_POST['remuneracao']) ?? '';
			
			$empenho = new Empenho();
			$empenho->setAll($array);
			$empenhoDAO = new EmpenhoDAO();
			$empenhoDAO->setEmpenho($empenho);
			
			break;

		case "departamentos" :
			$array['nome']			= trim($_POST['nome']) ?? '';
			$array['cnpj']			= trim($_POST['cnpj']) ?? '';
			$array['municipio']		= trim($_POST['municipio']) ?? '';
			$array['tipo']			= trim($_POST['tipo']) ?? '';
			$array['endereco']		= trim($_POST['endereco']) ?? '';
			$array['telefone']		= trim($_POST['telefone']) ?? '';
			$array['email']			= trim($_POST['email']) ?? '';
			$array['horario']		= trim($_POST['horario']) ?? '';
			$array['responsavel']	= trim($_POST['responsavel']) ?? '';
			$array['tituloResponsavel']	= trim($_POST['tituloResponsavel']) ?? '';
			$array['competencia']	= trim($_POST['competencia']) ?? '';

			//Upload do Arquivo =============
			$nome_arquivo		= $array['nome'].".jpg";
			$diretorio			= "arquivo/".$elemento;
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
			$array['data']		= trim($_POST['data']) ?? '';
			$array['hora']		= trim($_POST['hora']) ?? '';
			$array['titulo']	= trim($_POST['titulo']) ?? '';
			$array['descricao']	= trim($_POST['descricao']) ?? '';
			$array['local']		= trim($_POST['local']) ?? '';
			$array['tipo'] 		= trim($_POST['tipo']);

			$evento = new Evento();
			$evento->setAll($array);
			$eventoDAO = new EventoDAO();
			$eventoDAO->setEvento($evento);
			
			break;
	}

	header("Location: ".$elemento."-cadastro.php");
} else {
	header("Location: ./");
}
?>