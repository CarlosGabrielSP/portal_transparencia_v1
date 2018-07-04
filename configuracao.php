<?php 

include_once('header.php') 
?>

<form action="grava-conexao.php" method="POST">
	<h1>SCPI</h1>
	<input type="text" name="caminho" placeholder="Caminho" value="" required>
	<input type="text" name="exercicios" placeholder="Exercícios" value="" required>
	<input type="text" name="userBD" placeholder="userBD" value="" required>
	<input type="text" name="passBD" placeholder="passBD" value="" required>
	<input type="submit" name="Enviar">
</form>

<?php include_once('footer.php') ?>