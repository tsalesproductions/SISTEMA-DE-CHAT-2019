<?php
	date_default_timezone_set('america/sao_paulo');
	
	$conexao = array("localhost", "root", "", "teste");

	try{
		$pdo = new PDO("mysql:host=$conexao[0]; dbname=$conexao[3];", $conexao[1], $conexao[2]);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo "Erro ao conectar-se: ".$e->getMessage();
	}
?>