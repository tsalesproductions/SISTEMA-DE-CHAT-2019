<?php
	session_destroy();
	$chat = new chat($pdo);
	$chat->redirect('login');
	$chat->alerta('success', 'deslogando...', false);
?>