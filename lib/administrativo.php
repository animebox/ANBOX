<?php
	#Include nas funcoes do cliente
	include('functions/banco-administrativo.php');

	#Instancia objeto que vai tratar o banco de dados dessa pagina
	$banco = new bancoadministrativo;
	
	$Conteudo = $banco->CarregaHtml('administrativo');
?>