<div class="row">
	<div class="col-sm-5 cadastro-form" style="background-color: #FFF">
		<h4>Cadastre-se</h4>
		<p class="small">Cadastre-se para conhecer e conversar com pessoas</p>
		<hr>
		<form method="POST" enctype="multipart/form-data">
			<p><input type="text" name="nome" class="form-control" placeholder="Seu nome" required></p>
			<p><input type="text" name="usuario" class="form-control" placeholder="Usuário"  required></p>
			<p><input type="email" name="email" class="form-control" placeholder="Email"  required></p>
			<p><input type="password" name="senha" class="form-control" placeholder="Senha"  required></p>
			<p><label>Sexo</label>
			<select class="form-control" name="sexo" required>
				<option value="0">Feminino</option>
				<option value="0">Masculino</option>
			</select>
			</p><label>Imagem de perfil</label>
			<p><input type="file" name="userfile" class="form-control" accept="image/*" required></p>
			<input type="submit" value="Cadastrar" class="btn btn-outline-success btn-lg btn-block">
			<input type="hidden" name="env" value="cad">
		</form><br>
		<?php $chat = new chat($pdo); $chat->cadastro();?>
	</div>
	
</div>