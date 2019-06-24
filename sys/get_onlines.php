<?php
	include_once("../lib/includes.php");
	$chat = new chat($pdo);
	$chat->get_onlines($_GET['sexo']);
?>
	
