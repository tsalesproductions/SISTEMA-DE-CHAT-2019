<?php 
	include_once("lib/includes.php");
	$chat = new chat($pdo);
?>
<!DOCTYPE html>
<html>
<head>
 	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Sistema de chat</title>

	<!-- COLOCAR A URL DO SEU SITE AQUI EM BAIXO!!!! -->
	<base href="http://192.168.0.100/chat/">

	<!-- CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" >
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link href="css/style.css" rel="stylesheet" id="bootstrap-css">


	<!-- JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
<div class="row">
	<?php if(isset($_SESSION['usuario'])){?>
	<div class="col-sm-4" id="left-menu">
		<div class="user_infos">
			<img src="<?php echo $chat->dados_user($_SESSION['usuario'],'foto');?>"> <span><?php echo $chat->dados_user($_SESSION['usuario'],'nome');?></span>
			<div class="float-right">
				<a href="inicio/" class="nlink"><i class="fas fa-home"></i></a> 
				<a href="configs/" class="nlink"><i class="fas fa-user"></i></a>
				<a href="sair/" class="nlink"><i class="fas fa-sign-out-alt"></i></a>
			</div>
		</div>
		 <!-- <div class="inbox_peoplen">
			<div class="headind_srch">
	            <div class="srch_bar">
	              <div class="stylish-input-group">
	                <input type="text" class="search-bar"  placeholder="Search" >
	                <span class="input-group-addon">
	                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
	                </span> </div>
	            </div>
	          </div>
		</div> -->

		<div class="inbox_chat" id="chats">
		</div>
	</div><?php }?>
	<div <?php echo $chat->update_class();?>>
		<?php $chat->paginacao($pdo);?>
	</div>
</div>
</body>
</html>