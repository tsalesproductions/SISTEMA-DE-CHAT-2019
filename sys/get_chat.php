<?php
	
	include_once("../lib/includes.php");
		try{
			$stmt = $pdo->prepare("SELECT * FROM mensagens WHERE id_chat = :id_chat ORDER BY id ASC");
			$stmt->execute(array(':id_chat' => $_GET['id']));
			
			$chat = new chat($pdo);


		while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
			$lido = null;
			switch($dados['lido']){
				case 0:
					$lido = "<i class='fas fa-check'></i>";
				break;


				case 1:
					$lido = "<i class='fas fa-check-double'></i>";
				break;
			}
		 	if($dados['id_de'] != $_SESSION['usuario']){

			 	echo "<div class='incoming_msg'>
	      <div class='incoming_msg_img'> <img src='{$chat->dados_user($dados['id_de'],'foto')}' alt='sunil'> </div>
	      <div class='received_msg'>
	        <div class='received_withd_msg'>
	          <p>{$dados['mensagem']}</p>
	          <span class='time_date'> {$chat->diferencia_datas($dados['data'])}</span></div>
	      </div>
	    </div>";
		}else{
    echo "<div class='outgoing_msg'>
      <div class='sent_msg'>
        <p>{$dados['mensagem']}</p>
        <span class='time_date'>{$lido} {$chat->diferencia_datas($dados['data'])}</span> </div>
    </div>";
		 }}	

			}catch(PDOException $e){
				echo $e->getmessage();
			}

?>
	
