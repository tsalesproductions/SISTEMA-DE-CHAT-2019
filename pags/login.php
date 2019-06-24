<?php $chat = new chat($pdo); $chat->verifica_logado();?>
<div class="login col-sm-6">
<div class="login-content">
	<form method="POST">
		<p><input type="email" name="email" class="form-control" placeholder="email" required></p>

		<p><input type="password" name="senha" class="form-control" placeholder="*********"  required></p>

		<p class="infos-login"><a href="cadastro" class="small">É novo? Cadastre-se</a></p>

		<p><input type="submit" value="Entrar" class="btn btn-success btn-lg btn-block"/></p>
		<input type="hidden" name="env" value="login">
	</form>
	</div>

</div>
<?php $chat->login();?>
