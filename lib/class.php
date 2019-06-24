<?php
	class chat{
		
		protected $pdo;
		protected $usuario;

		public function __construct($pdo){
			$this->pdo = $pdo;

			$this->usuario = (isset($_SESSION['usuario']) ? $_SESSION['usuario'] : NULL);

			if($this->usuario != null){
				$this->atualiza_status();
			}

		}

		public function get_explode(){
			$url = (isset($_GET['pagina'])) ? $_GET['pagina'] : 'login';
			return $explode = explode('/', $url);
		}

		public function paginacao($pdo){
			$explode = $this->get_explode();
			$dir = "pags/";
			$ext = ".php";
			$validas = array("login", "cadastro");

			if(file_exists($dir.$explode['0'].$ext) && isset($_SESSION['usuario'])){
				include_once($dir.$explode['0'].$ext);
			}else if(file_exists($dir.$explode['0'].$ext) && !isset($_SESSION['usuario'])){
				if(!in_array($explode['0'], $validas))	{
					include_once($dir."login".$ext);
				}else{
					include_once($dir.$explode['0'].$ext);
				}		
			 	 
			}else if(!file_exists($dir.$explode['0'].$ext) && isset($_SESSION['usuario'])){			
			 	 echo "Página não encontrada";
			}
		}

		public function update_class(){
			$class = array("class='col-sm-8 offset-md-4' style='border:none; background: none;'", "class='col-sm-8'");

			if(isset($_SESSION['usuario'])){
				return $class[1];
			}else{
				return $class[0];
			}
		}

		public function redirect($url){
				echo "<meta http-equiv='refresh' content='3;URL={$url}'>";
		}

		public function redirect_direct($url){
				echo "<meta http-equiv='refresh' content='0;URL={$url}'>";
		}

		public function alerta($tipo, $mensagem, $col){
			echo "<div class='alert alert-{$tipo} {$col}'>{$mensagem}</div>";
		}

		protected function login(){
			if(isset($_POST['env']) && $_POST['env'] == "login"){
				try{
					$stmt = $this->pdo->prepare("SELECT * FROM 
						usuarios WHERE email = :email AND senha = :senha");
					$stmt->execute(array(':email' => $_POST['email'], ':senha' => $_POST['senha']));
					$total = $stmt->rowCount();

					if($total > 0){
						$dados = $stmt->fetch(PDO::FETCH_ASSOC);
						$_SESSION['usuario'] = $dados['usuario'];
						$this->alerta('success', 'Logado com sucesso...', 'col-sm-6');
						$this->redirect('inicio');
					}else{
						$this->alerta('danger', 'Usuário ou senha inválidos',  'col-sm-6');
					}
					


				}catch(PDOException $e){
					return $e->getMessage();
				}


			}
		}

		public function cadastro(){
			if(isset($_POST['env']) && $_POST['env'] == "cad"){
				$status = $this->verifica_cadastro($_POST['email'], $_POST['usuario']);
				$post_dados = array($_POST['nome'], $_POST['usuario'], $_POST['email'], $_POST['senha'], $_POST['sexo']);
				$uploaddir = 'images/uploads/';
				$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);

				if($status == TRUE){
					try{
						$stmt = $this->pdo->prepare("INSERT INTO usuarios (nome, usuario, email, senha, sexo, foto) VALUES(:nome, :usuario, :email, :senha, :sexo, :foto)");
						$stmt->execute(array(':nome' => $post_dados[0], 
											':usuario'  => $post_dados[1],
											':email' => $post_dados[2],
											':senha' => $post_dados[3],
											':sexo'  => $post_dados[4],
											':foto' => $uploadfile));
						$conta = $stmt->rowCount();

						if($conta > 0){
							move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
							$this->alerta("success", "Cadastro efetuado com sucesso! Aguarde...", false);
							$this->redirect("login");

						}
						
					}catch(PDOException $e){
						$e->getMessage();
					}
				}else{
					echo "<div class='alert alert-danger'>Usuário ou email já cadastrados, tente outro!</div>";
				}
			}
		}

		public function verifica_cadastro($email, $usuario){
			try{
				$stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario OR email = :email");
				$stmt->execute(array(':usuario' => $usuario, ':email' => $email));
				$total = $stmt->rowCount();

				if($total > 0){
					return false;
				}else{
					return true;
				}
			}catch(PDOException $e){
				$e->getMessage();
			}
		}

		public function atualiza_status(){
			$dataAtualizada = date('d-m-Y H:i:s', strtotime('+2 minutes'));

			try{
				$stmt = $this->pdo->prepare("UPDATE usuarios SET status = :status WHERE usuario = :usuario");
				$stmt->execute(array(':status' => $dataAtualizada, ':usuario' => $this->usuario));
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function get_status($usuario){
			$dataUser = $this->dados_user($usuario, "status");
			$data = $this->get_data();

			if($data <= $dataUser){
				return "<img src='images/status-online.png' title='Online'>";
			}
		}

		public function verifica_chat($id_para){
			try{
		      $stmt = $this->pdo->prepare("SELECT * FROM chats WHERE id_de = :id_de AND id_para = :id_para OR id_de = :id_para AND id_para = :id_de");
		      $stmt->execute(array(':id_de' => $this->usuario, ':id_para' => $id_para));
		      $total = $stmt->rowCount();

		      if($total > 0){
		      	$dados = $stmt->fetch(PDO::FETCH_ASSOC);
		      	$this->redirect_direct("chat/{$dados['id']}");
		      	exit();
		      }else{
		      	$this->cria_chat($id_para);
		      	exit();
		      }
		    }catch(PDOException $e){
		      echo $e->getMessage();
		    }
		}

		public function cria_chat($id_para){ //falta adicionar a data
			$data = $this->get_data();
		    try{
		      $stmt = $this->pdo->prepare("INSERT INTO chats (id_de, id_para) VALUES (:id_de, :id_para)");
		      $stmt->execute(array(':id_de' => $this->usuario, ':id_para' => $id_para));
		      $id = $this->pdo->lastInsertId();
		  
		      $this->redirect_direct("chat/{$id}");
		      exit();
		    }catch(PDOException $e){
		      echo $e->getMessage();
		    }
		  }


		public function get_data(){
			date_default_timezone_set('America/Sao_Paulo');
			return date('d-m-Y H:i:s');
		}

	  	public function diferencia_datas($data1){

		$data1 = new DateTime($data1);
		$data2 = new DateTime($this->get_data());

		$intervalo = $data1->diff($data2);

		if($intervalo->y > 1){
		  return $intervalo->y." Anos atrás";
		}elseif($intervalo->y == 1){
		  return $intervalo->y." Ano atrás";
		}elseif($intervalo->m > 1){
		  return $intervalo->m." Meses atrás";
		}elseif($intervalo->m == 1){
		  return $intervalo->m." Mês atrás";
		}elseif($intervalo->d > 1){
		  return $intervalo->d." Dias atrás";
		}elseif($intervalo->d > 0){
		  return $intervalo->d." Dia atrás";
		}elseif($intervalo->h > 0){
		  return $intervalo->h." Horas atrás";
		}elseif($intervalo->i > 1 && $intervalo->i < 59){
		  return $intervalo->i." Minutos atrás";
		}elseif($intervalo->i == 1){
		  return $intervalo->i." Minuto atrás";
		}elseif($intervalo->s < 60 && $intervalo->i <= 0){
		  return $intervalo->s." Segundo atrás";
		}
	  }


	  	public function dados_user($usuario, $arr){
	  		try{
	  			$stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
	  			$stmt->execute(array(':usuario' => $usuario));
	  			$conta = $stmt->rowCount();

	  			if($conta > 0){
	  				$dados = $stmt->fetch(PDO::FETCH_ASSOC);
	  				return $dados[$arr];
	  			}
	  		}catch(PDOException $e){
	  			$e->getMessage();
	  		}
	  	}


		public function pega_chats($id_de){
			try{
		      $stmt = $this->pdo->prepare("SELECT * FROM chats WHERE id_de = :id_de OR id_para = :id_de ORDER BY lastupdate DESC");
		      $stmt->execute(array(':id_de' => $id_de));
		      $count = $stmt->rowCount();

		      while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
		      	$this->pega_mensagem_chat($dados['id']);
		      }
		    }catch(PDOException $e){
		      echo $e->getMessage();
		    }
		}

		public function pega_mensagem_chat($id){
			try{
		      	$sql = $this->pdo->prepare("SELECT * FROM mensagens WHERE id_chat = :id_chat ORDER BY id DESC LIMIT 1");
		      	$sql->execute(array(':id_chat' => $id));

		      	while($dsql = $sql->fetch(PDO::FETCH_ASSOC)){

		      		echo "{$this->verifica_chat_ativo($id)}
					  <div class='chat_people'>
					    <div class='chat_img'> <img src='{$this->dados_user($this->verifica_nomes_chat($id),"foto")}'> </div>
					    <div class='chat_ib'>
					      <h5><a href='chat/{$id}' class='name-user' onclick='verifica_status()'>{$this->get_status($this->dados_user($this->verifica_nomes_chat($id),"usuario"))} 
					      		{$this->dados_user($this->verifica_nomes_chat($id),"nome")}</a> <span class='chat_date'>{$this->diferencia_datas($dsql['data'])}</span></h5>
					      <p>{$dsql['mensagem']}</p>
					    </div>
					  </div>
					</div>";

		      	}
		      }catch(PDOException $e){
		      	echo $e->getMessage();
		      }
		}

		public function verifica_nomes_chat($id){
			try{
				$stmt = $this->pdo->prepare("SELECT * FROM chats WHERE id = :id");
				$stmt->execute(array(':id' => $id));

				$dados = $stmt->fetch(PDO::FETCH_ASSOC);

				if($dados['id_de'] == $this->usuario ){
					return $dados['id_para'];
				}else if ($dados['id_para'] == $this->usuario){
					return $dados['id_de'];
				}
			}catch(PDOException $e){
				return $e->getmessage();
			}
			
		}

		public function verifica_chat_ativo($id){
			//$explode = $this->get_explode();
			if(isset($_GET['atual']) && $_GET['atual'] == $id){
				echo "<div class='chat_list active_chat'>";
			}else{
				echo "<div class='chat_list'>";
			}
		}

		public function insere_mensagem(){
		//$explode = $this->get_explode();
		$get = (isset($_GET['atual']) ? $_GET['atual'] : NULL);

		$form = array($this->usuario, $get, date("d-m-Y H:i:s"));
          if(isset($_POST['env']) && $_POST['env'] == "ms"){
            
            try{
              $stmt = $this->pdo->prepare("INSERT INTO mensagens (id_de, id_chat, mensagem, data) VALUES(:id_de, :id_chat, :mensagem, :data)");
              $stmt->execute(array(':id_de' => $form['0'], 
                                    ':id_chat' => $form['1'], 
                                    ':mensagem' => $_POST['msg'], 
                                    ':data' => $form['2']));
              $this->atualiza_tempo_chat($get);
              return json_encode(array("success" => TRUE));
            }catch(PDOException $e){
              return json_encode(array("success" => FALSE, "error" => $e->getMessage()));
            }
          }
      }

      public function form_mensagem(){
      	$this->insere_mensagem();
      }

      protected function atualiza_tempo_chat($id){
      	$data = $this->get_data();

      	try{
      		$stmt = $this->pdo->prepare("UPDATE chats SET lastupdate = :data WHERE id = :id");
      		$stmt->execute(array(':data' => $data, ':id' => $id));
      	}catch(PDOException $e){
      		echo $e->getMessage();
      	}
      	
      }

      public function atualiza_lido($id){
      	try{
      		$stmt = $this->pdo->prepare("UPDATE mensagens SET lido = 1 WHERE id_de != :id_de AND id_chat = :id_chat");
      		$stmt->execute(array(':id_de' => $this->usuario, ':id_chat' => $id));	
      	}catch(PDOException $e){
      		echo $e->getMessage();
      	}
      	
      }

      public function verifica_logado(){
      	if($this->usuario != NULL){
      		echo "<meta http-equiv='refresh' content='0;URL=inicio'>";
      		exit();
      	}
      }

      public function get_onlines($sexo){
      	$data = $this->get_data();
      	try{
      		if($sexo == 2){
      			$stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE status >= :data AND usuario <> :usuario LIMIT 50");
      			$stmt->execute(array(':data' => $data, ':usuario' => $this->usuario));
	      	}else{
	      		$stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE sexo = :sexo AND status >= :data AND usuario <> :usuario LIMIT 50");
	      		$stmt->execute(array(':sexo' => $sexo, ':data' => $data, ':usuario' => $this->usuario));	
	      	}
      		
      		$conta = $stmt->rowCount();

      		if($conta > 0){
      			while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
      				$separa_nome = explode(' ', $dados['nome']);
      				echo "<div class='user'>
						<img src='{$dados['foto']}' class='img-user'><br>
						<span><img src='images/status-online.png' class='status' /> <a href='nchat/{$dados['usuario']}'>".ucfirst($separa_nome['0'])."</a></span>
					</div>
				</div>";
      			}
      		}
      	}catch(PDOException $e){
      		echo $e->getMessage();
      	}
      }


      public function editar_dados(){
      	if(isset($_POST['env']) && $_POST['env'] == "alt"){
      		//move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)
      		$uploaddir = 'images/uploads';
			$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
      		if($_FILES['userfile']['size'] <= 0 ){
      			$stmt = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, sexo = :sexo WHERE usuario = :usuario");
      			$stmt->execute(array(':nome' => $_POST['nome'],
      									':email' => $_POST['email'],
      									':senha' => $_POST['senha'],
      									':sexo' => $_POST['sexo'],
      									':usuario' => $this->usuario));
      		}else{
      			$stmt = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, sexo = :sexo, foto = :foto WHERE usuario = :usuario");
      			$stmt->execute(array(':nome' => $_POST['nome'],
      									':email' => $_POST['email'],
      									':senha' => $_POST['senha'],
      									':sexo' => $_POST['sexo'],
      									':foto' => $uploadfile,
      									':usuario' => $this->usuario));
      			move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
      		}

      		if($stmt->rowCount() > 0){
      			$this->alerta("success", "Dados alterados com sucesso!", false);
      			$this->redirect("configs");
      		}else{
      			echo "Erro: ".$this->pdo->errorInfo();
      		}


      	}
      }

	}
?>