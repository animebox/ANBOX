<?php
	#Aqui fica todas as funчѕes gerais
	
	class banco{
		
		#funcao que inicia conexao com banco
		function Conecta(){	
			$link = mysql_connect(DB_Host,DB_User,DB_Pass);
			if (!$link) {
				die('Not connected : ' . mysql_error());
			}
			$db_selected = mysql_select_db(DB_Database, $link);
			if (!$db_selected) {
				die ('Can\'t use biblio: ' . mysql_error());
			}
			
		}
		
		#Funчуo que chama a pagina.php desejada.
		public function ChamaPhp($Nome){
			@require_once('lib/'.$Nome.'.php');
			return $Conteudo;
		}
	
		#funчуo que monta o html da pagina
		public function CarregaHtml($Nome){
			$filename = 'html/'.$Nome.".html";
			$handle = fopen($filename,"r");
			$Html = fread($handle,filesize($filename));
			fclose($handle);
			return $Html;
		}
		
		#Funcao que executa uma Sql e retorna.
		static function Execute($Sql){
			$result = mysql_query($Sql);
			return $result;
		}
		
		#Funcao que retorna o numero de linhas 
		static function Linha($result){
			$num_rows = mysql_num_rows($result);
			return $num_rows;
		}
		
		#Funcao que redireciona para pagina solicitada
		function RedirecionaPara($nome){
			header("Location: ".UrlPadrao.$nome);
		}
		
		#Funcao que carrega as peginas
		function CarregaPaginas(){
				
			#urlDesenvolve = ignora 'animebox' e oq tiver antes.
			$urlDesenvolve = 'anbox';
			$primeiraBol = true;
			$uri = strtolower($_SERVER["REQUEST_URI"]);
			$exUrls = explode('/',$uri);
			$SizeUrls = count($exUrls)-1;
		
			$p = 0;
			foreach( $exUrls as $chave => $valor ){
				if($valor != '' && $valor != $urlDesenvolve){
					$valorUri = $valor;
					$valorUri = strip_tags($valorUri);
					$valorUri = trim($valorUri);
					$valorUri = addslashes($valorUri);
					if( $primeiraBol ){
						$this->Pagina = $valorUri;
						$primeiraBol = false;
					}else{
						$this->PaginaAux[$p] = $valorUri;
						$p++;
					}
				}
			}
		}
	}
?>