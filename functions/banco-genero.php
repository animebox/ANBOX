<?php
	class bancogenero extends banco{
		
		#Função que busca o genero no banco
		function BuscaGenero($nome)
		{
			$sql = "SELECT * FROM GENERO WHERE GENERONOME = '".$nome."'";
			$result = parent::Execute($sql);
			return $result;
		}
		
		function BuscaListaGenero()
		{
			$sql = "SELECT GENERONOME,GENEROIDADE FROM GENERO";
			$result = parent::Execute($sql);
			return $result;
		}
		
		#Função que verifica se já existe o genero
		function GeneroJaExiste($nome)
		{
			$sql = "SELECT * FROM GENERO WHERE GENERONOME='".$nome."'";
			$result = parent::Execute($sql);
			$num_rows = parent::Linha($result);
			if($num_rows){
				return true;
			}else{
				return false;
			}
		}
		
		#Função que cadastra o genero
		function Cadastro($nome, $idade){
			$sql = "INSERT INTO GENERO (GENERONOME,GENEROIDADE) VALUES ('".$nome."',".$idade.")";
			parent::Execute($sql);
		}
	}
?>