<?php 
	include('functions/sessao-usuario.php');
	
	$sessao =  new sessaousuario;
	
	$sessao->Sair();
	$sessao->RedirecionaPara('animebox');	
?>