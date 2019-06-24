<?php
	include_once("../lib/includes.php");
	$chat = new chat($pdo);	
	echo $chat->insere_mensagem();
?>