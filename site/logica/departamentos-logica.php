<?php 
require_once(__DIR__.'/../../vendor/autoload.php');
$departamentoDAO = new \CarlosGabriel\DAO\DepartamentoDAO;
$array_departamentos = $departamentoDAO->getDepartamentos();