<?php
	include_once("../lib/includes.php");
	$chat = new chat($pdo);
	$usuario = (isset($_SESSION['usuario']) ? $_SESSION['usuario'] : false);	
	echo $chat->pega_chats($usuario);
?>
	
