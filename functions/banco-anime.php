<?php
	class bancoanime extends banco{
		
		function ExisteAnime($AnimeNome){
			$Query = "SELECT ANIMENOME FROM ANIME WHERE ANIMENOME LIKE '%".$AnimeNome."%'";
			$Resultado = parent::Execute($Query);
			return $Resultado;
		}
		
		function BuscaAnime($AnimeNome)
		{
			$Query = "SELECT ANIMENOME,ANIMEIMAGE,ANIMEDESCRICAO,ANIMEEPISODIOS FROM ANIME WHERE ANIMENOME='".$AnimeNome."'";
			$Resultado = parent::Execute($Query);
			return $Resultado;
		}
		
		function ListaEpisodio($AnimeNome){
			$Query =  "SELECT NOTICIATITULO,NOTICIAEMBED,NOTICIAEPISODIO FROM NOTICIA WHERE NOTICIATITULO = '".$AnimeNome."'";
			$Resultado = parent::Execute($Query);
			return $Resultado;
		}
		
		function BuscaEpisodio($anime,$episodio) {
			$sql = "SELECT NOTICIATITULO,NOTICIAEMBED,NOTICIAEPISODIO FROM NOTICIA WHERE NOTICIATITULO = '".$anime."' AND NOTICIAEPISODIO = '".$episodio."'";
			$result = parent::Execute($sql);
			return $result;
		}
		
		function ListaAnime($Letra){
			$Query = "SELECT ANIMENOME,ANIMEIMAGETHUMB,ANIMEEPISODIOS FROM ANIME WHERE ANIMENOME LIKE '".$Letra."%'";
			$Resultado = parent::Execute($Query);
			return $Resultado;
		}
		
		#Função que verifica se já existe o anime
		function ANIMEJaExiste($nome)
		{
			$sql = "SELECT * FROM ANIME WHERE ANIMENOME='".$nome."'";
			$result = parent::Execute($sql);
			$num_rows = parent::Linha($result);
			if($num_rows){
				return true;
			}else{
				return false;
			}
		}
		
		#Fun��o que cadastra o anime
		function Cadastro($nome,$image,$descricao){
			$sql = "INSERT INTO ANIME (ANIMENOME,ANIMEDESCRICAO,ANIMEIMAGE) VALUES ('".$nome."','".$descricao."','".$image."')";
			parent::Execute($sql);
		}
		
		#Fun��o que atualiza o anome
		function Atualiza($nome, $id){
			$sql = "UPDATE ANIME SET ANIMENOME = '".$nome."' WHERE ANIMECOD = '".$id."' ";
			parent::Execute($sql);
		}
		

	}
?>