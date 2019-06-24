$(document).ready(function(){
	comeca();
	send_msg();
	change_busca_user();

})

	var timerI = null;
	var timerR = false;

	function para(){
		if(timerR)
			clearTimeout(timerI);
			timerR = false;
	}

	function comeca(){
		para();
		lista();
		lista_chats();
		lista_onlines();
	}

	function lista(){
		var id = $("#id_post").val();
		$.ajax({
			url:"sys/get_chat.php?id="+id,
			success: function(textStatus){
				$("#mensagens").html(textStatus); //Mostra o resultado da página lista.php
				scrollBottomJQuery();
			}
		})
		timerI = setTimeout("lista()", 3000); //Tempo de espera para atualizar novamente
		timerR = true;
	}

	function lista_chats(){
		var id = $("#id_post").val();
		$.ajax({
			url:"sys/get_chats.php?atual="+id,
			crossDomain: true,
			success: function(textStatus){
				$("#chats").html(textStatus); //Mostra o resultado da página lista.php
			}
		})
		timerI = setTimeout("lista_chats()", 3000); //Tempo de espera para atualizar novamente
		timerR = true;
	}

	function lista_onlines(){
		var id = $("#busca-por").val();
		$.ajax({
			url:"sys/get_onlines.php?sexo="+id,
			crossDomain: true,
			success: function(textStatus){
				$("#users").html(textStatus); //Mostra o resultado da página lista.php
			}
		})
		timerI = setTimeout("lista_onlines()", 3000); //Tempo de espera para atualizar novamente
		timerR = true;
	}

	function change_busca_user(){
		 $("#busca-por").change(function() { 
            lista_onlines();
        }); 
	}

	function send_msg(){
		$("#sendmsg").on("submit", function(e){
		var id = $("#id_post").val();
		e.preventDefault();
		var form = $(this);

		$.ajax({
			type: "post",
			url: "sys/send_msg.php?atual="+id,
			data: form.serialize(),
			dataType: "json",
			success: function(data){
				lista();
				$("#msg").val("");
			},error: function (jqXHR, exception) {
				alert(jqXHR.responseText);
			}
		});
	});
	}

	function show_bar(){
		$("#left-menu").show();
	}

	//essa versao usando o jquery
	function scrollBottomJQuery(){
	  $("#msghistory").scrollTop($("#msghistory")[0].scrollHeight);
	}

	function vefifica_mobile(){
	 if( navigator.userAgent.match(/Android/i)
		 || navigator.userAgent.match(/webOS/i)
		 || navigator.userAgent.match(/iPhone/i)
		 || navigator.userAgent.match(/iPad/i)
		 || navigator.userAgent.match(/iPod/i)
		 || navigator.userAgent.match(/BlackBerry/i)
		 || navigator.userAgent.match(/Windows Phone/i)){
		    return true;
	  	}
		else {
		    return false;
		}
	}

	function verifica_status(){
		if(vefifica_mobile() == true){
		   seta_status(true);
		}
	}

	function seta_status(status){
		if(status == true && vefifica_mobile() == true){
			$("#left-menu").hide();
		}else{
			$("#left-menu").show();
		}
	}
