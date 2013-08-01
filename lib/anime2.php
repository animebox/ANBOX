<?php
	$msg = "";
	$animeNome = "";
	$botao = "Incluir Anime";
	
	#Include nas funcoes do anime
	include('functions/banco-anime.php');
	
	#Instancia objeto que vai tratar o banco de dados dessa pÃ¡gina
	$banco = new bancoanime;
	
	#Verifica se está editando
	if($this->PaginaAux[0] == "editar"){
		$id = $this->PaginaAux[1];
		$result = $banco->BuscaAnime($id);
		$num_rows = $banco->Linha($result);
		$rs = mysql_fetch_array($result , MYSQL_ASSOC);
		$animeNome = $rs['ANIMENOME'];
		$botao = "Alterar Anime";
	}	
	
	#Trabalha com Post
	if(isset($_POST["acao"]) && $_POST["acao"] != ''){
		$nome = strip_tags(trim(addslashes($_POST["nomeanime"])));
		if($nome != ""){
			#Se for editar, usa outra função
			if($this->PaginaAux[0] == "editar"){
				$banco->Atualiza($nome, $id);
				$banco->RedirecionaPara("lista-anime");
			}else{
				#Verifica se já existe o anime cadastrado
				$existe = $banco->ANIMEJaExiste($nome);
				
				if($existe){
					$msg = "Anime já cadastrado";
				}else{
					$banco->Cadastro($nome);
					$msg = "Anime cadastrado com sucesso!";
				}
			}
		}else{
			$msg = "Favor preencher todos os campos!";
		}
	}
	
	#Imprime Valores
	$Conteudo = $banco->CarregaHtml('anime');
	$Conteudo = str_replace('<%MSG%>', $msg, $Conteudo);
	$Conteudo = str_replace('<%NOMEANIME%>', $animeNome, $Conteudo);
	$Conteudo = str_replace('<%BOTAO%>', $botao, $Conteudo);

?>