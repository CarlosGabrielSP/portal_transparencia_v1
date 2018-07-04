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
			$array['exercicio']			= $_POST['exercicio'] ?? '';
			$array['orgao']				= $_POST['orgao'] ?? '';
			$array['processo']			= $_POST['processo'] ?? '';
			$array['modalidade']		= $_POST['modalidade'] ?? '';
			$array['tipo']				= $_POST['tipo'] ?? '';
			$array['objeto']			= $_POST['objeto'] ?? '';
			$array['situacao']			= $_POST['situacao'] ?? '';
			$array['publicacao']		= $_POST['publicacao'] ?? '';
			$array['data_publicacao']	= $_POST['data_publicacao'] ?? '';
			$array['valor']				= $_POST['valor'] ?? '';
			$array['vencedor']			= $_POST['vencedor'] ?? '';

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
			$array['exercicio']	= $_POST['exercicio'] ?? '';
			$array['orgao']		= $_POST['orgao'] ?? '';
			$array['numero']	= $_POST['numero'] ?? '';
			$array['ementa']	= $_POST['ementa'] ?? '';

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
			$array['exercicio']	= $_POST['exercicio'] ?? '';
			$array['orgao']		= $_POST['orgao'] ?? '';
			$array['numero']	= $_POST['numero'] ?? '';
			$array['ementa']	= $_POST['ementa'] ?? '';

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
			$array['exercicio']			= $_POST['exercicio'] ?? '';
			$array['orgao']				= $_POST['orgao'] ?? '';
			$array['numero']			= $_POST['numero'] ?? '';
			$array['favorecido']		= $_POST['favorecido'] ?? '';
			$array['valor']				= $_POST['valor'] ?? '';
			$array['objeto']			= $_POST['objeto'] ?? '';
			$array['data']				= $_POST['data'] ?? '';
			$array['procedimento_lic']	= $_POST['procedimento_lic'] ?? '';
			$array['unidade_orc']		= $_POST['unidade_orc'] ?? '';
			$array['funcao']			= $_POST['funcao'] ?? '';
			$array['subfuncao']			= $_POST['subfuncao'] ?? '';
			$array['natureza']			= $_POST['natureza'] ?? '';
			$array['fonte']				= $_POST['fonte'] ?? '';
			
			$empenho = new Empenho();
			$empenho->setAll($array);
			$empenhoDAO = new EmpenhoDAO();
			$empenhoDAO->setEmpenho($empenho);
			
			break;

		case "liquidacoes" :
			$array['exercicio']	= $_POST['exercicio'] ?? '';
			$array['orgao']		= $_POST['orgao'] ?? '';
			$array['valor']		= $_POST['valor'] ?? '';
			$array['data']		= $_POST['data'] ?? '';
			$array['empenho'] 	= $_POST['empenho'];

			$liquidacao = new Liquidacao();
			$liquidacao->setAll($array);
			$liquidacaoDAO = new LiquidacaoDAO();
			$liquidacaoDAO->setLiquidacao($liquidacao);
			
			break;

		case "pagamentos" :
			$array['exercicio']	= $_POST['exercicio'] ?? '';
			$array['orgao']		= $_POST['orgao'] ?? '';
			$array['valor']		= $_POST['valor'] ?? '';
			$array['data']		= $_POST['data'] ?? '';
			$array['empenho'] 	= $_POST['empenho'];

			$pagamento = new Pagamento();
			$pagamento->setAll($array);
			$pagamentoDAO = new PagamentoDAO();
			$pagamentoDAO->setPagamento($Pagamento);
			
			break;

		case "fopag" :
			$array['exercicio']		= $_POST['exercicio'] ?? '';
			$array['orgao']			= $_POST['orgao'] ?? '';
			$array['matricula']		= $_POST['matricula'] ?? '';
			$array['nome']			= $_POST['nome'] ?? '';
			$array['cargo']			= $_POST['cargo'] ?? '';
			$array['remuneracao']	= $_POST['remuneracao'] ?? '';
			
			$empenho = new Empenho();
			$empenho->setAll($array);
			$empenhoDAO = new EmpenhoDAO();
			$empenhoDAO->setEmpenho($empenho);
			
			break;

		case "departamentos" :
			$array['nome']	= $_POST['nome'] ?? '';
			$array['cnpj']		= $_POST['cnpj'] ?? '';
			$array['municipio']	= $_POST['municipio'] ?? '';
			$array['tipo']	= $_POST['tipo'] ?? '';
			$array['endereco']	= $_POST['endereco'] ?? '';
			$array['telefone']	= $_POST['telefone'] ?? '';
			$array['email']	= $_POST['email'] ?? '';
			$array['horario']	= $_POST['horario'] ?? '';
			$array['responsavel']	= $_POST['responsavel'] ?? '';
			$array['tituloResponsavel']	= $_POST['tituloResponsavel'] ?? '';
			$array['competencia']	= $_POST['competencia'] ?? '';

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
			$array['data']	= $_POST['data'] ?? '';
			$array['hora']		= $_POST['hora'] ?? '';
			$array['titulo']		= $_POST['titulo'] ?? '';
			$array['descricao']		= $_POST['descricao'] ?? '';
			$array['local']		= $_POST['local'] ?? '';
			$array['tipo'] 	= $_POST['tipo'];

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