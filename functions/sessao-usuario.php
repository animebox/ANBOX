<?php 
	class sessaousuario{
		#Logout do usuario
		function Sair(){
			session_start();
			unset($_SESSION['email']);
			unset($_SESSION['senha']);
			session_destroy();
		}
		
		#Funcao que redireciona para pagina solicitada
		function RedirecionaPara($nome){
			header("Location: ".UrlPadrao.$nome);
		}
	}
?>