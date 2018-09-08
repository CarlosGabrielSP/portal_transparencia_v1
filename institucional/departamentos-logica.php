<?php 
require_once('../classes/DepartamentoDAO.class.php');
$departamentoDAO = new DepartamentoDAO();
$array_departamentos = $departamentoDAO->getDepartamentos();