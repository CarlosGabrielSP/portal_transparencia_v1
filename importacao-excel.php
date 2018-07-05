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
require_once('classes/PHPExcel.php');

if ($_FILES['arquivo']) {
    $arquivo        = $_FILES['arquivo']['tmp_name'];
    $tipoArquivo    = PHPExcel_IOFactory::identify($arquivo);
    $objReader      = PHPExcel_IOFactory::createReader($tipoArquivo);
    $objReader->setReadDataOnly(true);
    $objPHPExcel    = $objReader->load($arquivo);

    $colunas        = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
    $total_linhas   = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
    $total_colunas  = PHPExcel_Cell::columnIndexFromString($colunas);

    $elemento = $_POST['elemento'];

    if($elemento == 'licitacoes'){
        for($linha=2;$linha<=$total_linhas;$linha++){
            set_time_limit(30);
            $licitacao = new Licitacao();
            $licitacaoDao = new LicitacaoDao();
            for($coluna=0;$coluna<=$total_colunas-1;$coluna++){
                $celula = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($coluna,$linha)->getValue();
                $celula = trim(mysqli_real_escape_string($licitacaoDao->getConexao(),$celula));
                switch($coluna){
                    case 0 :
                        $licitacao->setProcesso(!empty($celula) ? $celula : "");
                        break;
                    case 1 :
                        $licitacao->setModalidade(!empty($celula) ? $celula : "");
                        break;
                    case 2 :
                        $licitacao->setTipo(!empty($celula) ? $celula : "");
                        break;
                    case 3 :
                        $licitacao->setObjeto(!empty($celula) ? $celula : "");
                        break;
                    case 4 :
                        $licitacao->setPublicacao(!empty($celula) ? $celula : "");
                        break;
                    case 5 :
                        $data_publicacao = !empty($celula) ? PHPExcel_Style_NumberFormat::toFormattedString($celula, "YYYY-MM-DD") : "";
                        $licitacao->setData_publicacao($data_publicacao);
                        break;
                    case 6 :
                        $licitacao->setSituacao(!empty($celula) ? $celula : "");
                        break;
                    case 7 :
                        $licitacao->setValor(!empty($celula) ? $celula : 0);
                        break;
                    case 8 :
                        $licitacao->setVencedor(!empty($celula) ? $celula : "");
                        break;
                    case 9 :
                        $licitacao->setOrgao(!empty($celula) ? $celula : "");
                        break;
                    case 10 :
                        $licitacao->setExercicio(!empty($celula) ? $celula : "");
                        break;
                }
            }
            $licitacaoDao->setLicitacao($licitacao);
        }
    }else if($elemento == 'contratos'){
        for($linha=2;$linha<=$total_linhas;$linha++){
            set_time_limit(30);
            $contrato = new Contrato();
            $contratoDao = new ContratoDao();
            for($coluna=0;$coluna<=$total_colunas-1;$coluna++){
                $celula = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($coluna,$linha)->getValue();
                $celula = trim(mysqli_real_escape_string($contratoDao->getConexao(),$celula));
                switch($coluna){
                    case 0 :
                        $contrato->setNumero(!empty($celula) ? $celula : "");
                        break;
                    case 1 :
                        $contrato->setEmenta(!empty($celula) ? $celula : "");
                        break;
                    case 2 :
                        $contrato->setOrgao(!empty($celula) ? $celula : "");
                        break;
                    case 3 :
                        $contrato->setExercicio(!empty($celula) ? $celula : "");
                        break;
                }
            }
            $contratoDao->setContrato($contrato);
        }
    }else if($elemento == 'convenios'){
        for($linha=2;$linha<=$total_linhas;$linha++){
            set_time_limit(30);
            $convenio = new Convenio();
            $convenioDao = new ConvenioDao();
            for($coluna=0;$coluna<=$total_colunas-1;$coluna++){
                $celula = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($coluna,$linha)->getValue();
                $celula = trim(mysqli_real_escape_string($convenioDao->getConexao(),$celula));
                switch($coluna){
                    case 0 :
                        $convenio->setNumero(!empty($celula) ? $celula : "");
                        break;
                    case 1 :
                        $convenio->setObjeto(!empty($celula) ? $celula : "");
                        break;
                    case 2 :
                        $convenio->setConcedente(!empty($celula) ? $celula : "");
                        break;
                    case 3 :
                        $data = !empty($celula) ? PHPExcel_Style_NumberFormat::toFormattedString($celula, "YYYY-MM-DD") : "";
                        $convenio->setData($data);
                        break;
                    case 4 :
                        $vigencia = !empty($celula) ? PHPExcel_Style_NumberFormat::toFormattedString($celula, "YYYY-MM-DD") : "";
                        $convenio->setVigencia($vigencia);
                        break;
                    case 5 :
                        $convenio->setValor(!empty($celula) ? $celula : 0);
                        break;
                    case 6 :
                        $convenio->setOrgao(!empty($celula) ? $celula : "");
                        break;
                    case 7 :
                        $convenio->setExercicio(!empty($celula) ? $celula : "");
                        break;
                }
            }
            $convenioDao->setConvenio($convenio);
        }
    }else if($elemento == 'empenhos'){
        for($linha=2;$linha<=$total_linhas;$linha++){
            set_time_limit(30);
            $empenho = new Empenho();
            $empenhoDao = new EmpenhoDao();
            for($coluna=0;$coluna<=$total_colunas-1;$coluna++){
                $celula = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($coluna,$linha)->getValue();
                $celula = trim(mysqli_real_escape_string($empenhoDao->getConexao(),$celula));
                switch($coluna){
                    case 0:
                        $empenho->setNumero(!empty($celula) ? $celula : "");
                        break;
                    case 1:
                        $empenho->setFavorecido(!empty($celula) ? $celula : "");
                        break;
                    case 2:
                        $empenho->setValor(!empty($celula) ? $celula : 0);
                        break;
                    case 3:
                        $empenho->setObjeto(!empty($celula) ? $celula : "");
                        break;
                    case 4:
                        $empenho->setTipo(!empty($celula) ? $celula : "");
                        break;
                    case 5:
                        $data = !empty($celula) ?  PHPExcel_Style_NumberFormat::toFormattedString($celula, "YYYY-MM-DD") : "";
                        $empenho->setData($data);
                        break;
                    case 6:
                        $empenho->setProcedimento_lic(!empty($celula) ? $celula : "");
                        break;
                    case 7:
                        $empenho->setUnidade_orc(!empty($celula) ? $celula : "");
                        break;
                    case 8:
                        $empenho->setFuncao(!empty($celula) ? $celula : "");
                        break;
                    case 9:
                        $empenho->setSubfuncao(!empty($celula) ? $celula : "");
                        break;
                    case 10:
                        $empenho->setNatureza(!empty($celula) ? $celula : "");
                        break;
                    case 11:
                        $empenho->setFonte(!empty($celula) ? $celula : "");
                        break;
                    case 12:
                        $empenho->setOrgao(!empty($celula) ? $celula : "");
                        break;
                    case 13:
                        $empenho->setExercicio(!empty($celula) ? $celula : "");
                        break;
                }
            }
            $empenhoDao->setEmpenho($empenho);
        }
    }else if($elemento == 'liquidacoes'){
        for($linha=2;$linha<=$total_linhas;$linha++){
            set_time_limit(30);
            $permissao = 1;
            $liquidacao = new Liquidacao();
            $liquidacaoDAO = new LiquidacaoDAO();
            $tipo = "";
            for($coluna=0;$coluna<=$total_colunas-1;$coluna++){
                $celula = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($coluna,$linha)->getValue();
                $celula = trim(mysqli_real_escape_string($liquidacaoDAO->getConexao(),$celula));
                if($coluna==0 && empty($celula)){
                    $permissao = 0;
                    break;
                } else {
                    switch($coluna){
                        case 0:
                            $tipo = $celula;
                            break;
                        case 1:
                            $empenhoDAO = new empenhoDAO();
                            $empenho = $empenhoDAO->getEmpenhoPorNumeroTipo($celula,$tipo);
                            if(!$empenho){
                                $coluna = $total_colunas;
                                $permissao = 0;
                                break;
                            }
                            $liquidacao->setEmpenho($empenho);
                            break;
                        case 2:
                            $data = !empty($celula) ? PHPExcel_Style_NumberFormat::toFormattedString($celula, "YYYY-MM-DD") : "";
                            $liquidacao->setData($data);
                            break;
                        case 3:
                            $liquidacao->setValor(!empty($celula) ? $celula : 0);
                            break;
                        case 4:
                            $liquidacao->setExercicio(!empty($celula) ? $celula : "");
                            break;
                        case 5:
                            $liquidacao->setOrgao(!empty($celula) ? $celula : "");
                            break;
                    }
                }
            }
            if ($permissao) {
                $liquidacaoDAO->setLiquidacao($liquidacao);
            }
        }
    }else if($elemento == 'pagamentos'){
        for($linha=2;$linha<=$total_linhas;$linha++){
            set_time_limit(30);
            $permissao = 1;
            $pagamento = new Pagamento();
            $pagamentoDAO = new PagamentoDAO();
            $tipo = "";
            for($coluna=0;$coluna<=$total_colunas-1;$coluna++){
                $celula = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($coluna,$linha)->getValue();
                $celula = trim(mysqli_real_escape_string($pagamentoDAO->getConexao(),$celula));
                if($coluna==0 && empty($celula)){
                    $permissao = 0;
                    break;
                } else {
                    switch($coluna){
                        case 0:
                            $tipo = $celula;
                            break;
                        case 1:
                            $empenhoDAO = new empenhoDAO();
                            $empenho = $empenhoDAO->getEmpenhoPorNumeroTipo($celula,$tipo);
                            if(!$empenho){
                                $coluna = $total_colunas;
                                $permissao = 0;
                                break;
                            }
                            $pagamento->setEmpenho($empenho);
                            break;
                        case 2:
                            $data = !empty($celula) ? PHPExcel_Style_NumberFormat::toFormattedString($celula, "YYYY-MM-DD") : "";
                            $pagamento->setData($data);
                            break;
                        case 3:
                            $pagamento->setValor(!empty($celula) ? $celula : 0);
                            break;
                        case 4:
                            $pagamento->setExercicio(!empty($celula) ? $celula : "");
                            break;
                        case 5:
                            $pagamento->setOrgao(!empty($celula) ? $celula : "");
                            break;
                    }
                }
            }
            if ($permissao) {
                $pagamentoDAO->setPagamento($pagamento);
            }
        }
    }else if($elemento == 'fopag'){
        for($linha=2;$linha<=$total_linhas;$linha++){
            set_time_limit(30);
            $salario = new Salario();
            $salarioDao = new SalarioDao();
            for($coluna=0;$coluna<=$total_colunas-1;$coluna++){
                $celula = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($coluna,$linha)->getValue();
                $celula = trim(mysqli_real_escape_string($salarioDao->getConexao(),$celula));
                switch($coluna){
                    case 0 :
                        $salario->setMatricula(!empty($celula) ? $celula : "");
                        break;
                    case 1 :
                        $salario->setNome(!empty($celula) ? $celula : "");
                        break;
                    case 2 :
                        $salario->setCargo(!empty($celula) ? $celula : "");
                        break;
                    case 3 :
                        $salario->setVinculo(!empty($celula) ? $celula : "");
                        break;
                    case 4 :
                        $salario->setBruto(!empty($celula) ? $celula : 0);
                        break;
                    case 5 :
                        $salario->setDesconto(!empty($celula) ? $celula : 0);
                        break;
                    case 6 :
                        $salario->setLiquido(!empty($celula) ? $celula : 0);
                        break;
                    case 7 :
                        $salario->setOrgao(!empty($celula) ? $celula : "");
                        break;
                    case 8 :
                        $salario->setMes(!empty($celula) ? $celula : "");
                        break;
                    case 9 :
                        $salario->setExercicio(!empty($celula) ? $celula : "");
                        break;
                }
            }
            $salarioDao->setSalario($salario);
        }
    }
}
header("Location: ".$elemento.".php");
?>