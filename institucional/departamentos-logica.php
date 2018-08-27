<?php 
require_once('../classes/DepartamentoDAO.php');
$departamentoDAO = new DepartamentoDAO();
$array_departamentos = $departamentoDAO->getDepartamentos();