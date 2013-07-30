<?php
	#Include nas funcoes do cliente
	include('functions/banco-principal.php');

	#Instancia objeto que vai tratar o banco de dados dessa pagina
	$banco = new bancoprincipal;
	
	$Conteudo = $banco->CarregaHtml('principal');
?>