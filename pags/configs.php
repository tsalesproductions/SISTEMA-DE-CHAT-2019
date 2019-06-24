<?php $chat = new chat($pdo);?>
<div class="edit-dados">
	<h4>Editar dados</h4>
	<hr>

	<form method="POST" class="col-sm-7" enctype="multipart/form-data">
		<p>
			<label>Nome</label>
			<input type="text" name="nome" class="form-control" value="<?php echo $chat->dados_user($this->usuario, 'nome');?>">
		</p>

		<p>
			<label>Usuário</label>
			<input type="text" name="usuario" class="form-control" value="<?php echo $chat->dados_user($this->usuario, 'usuario');?>" disabled>
		</p>

		<p>
			<label>Email</label>
			<input type="email" name="email" class="form-control" value="<?php echo $chat->dados_user($this->usuario, 'email');?>">
		</p>

		<p>
			<label>Senha</label>
			<input type="password" name="senha" class="form-control" value="<?php echo $chat->dados_user($this->usuario, 'senha');?>">
		</p>

		<p>
			<label>Foto: </label>
			<img src="<?php echo $chat->dados_user($this->usuario, 'foto');?>" width="70">
			
			<input type="file" name="userfile" accept="image/*" class="form-control">
		</p>

		<p>
			<?php
				$sexoAtual = null;
				switch($chat->dados_user($this->usuario, 'sexo')){
					case 0:
						$sexoAtual = "<option value='0'>Feminino(Atual)</option>";
					break;

					case 1:
						$sexoAtual = "<option value='1'>Masculino(Atual)</option>";
					break;
				}
			?>
			<label>Sexo</label>
			<select class="form-control" name="sexo" required>
					<?php echo $sexoAtual;?>
					<option value="0">Feminino</option>
					<option value="0">Masculino</option>
				</select>
		</p>

		<p><input type="submit" value="Alterar cadastro" class="btn btn-outline-success btn-lg btn-block"></p>
		<input type="hidden" name="env" value="alt">
	</form>
	<?php $chat->editar_dados();?>
</div>