<?php

   /**
    * Teste de Consumo API
    * Copyright (C) 2019
    * Autor: Ronaldo de Souza Barros
	*
	* Function de consumo da API REQ RES	
	*/
	
	function callAPI($method, $url, $data){

	   $curl = curl_init();

	   switch ($method){
		  case "POST":
			 curl_setopt($curl, CURLOPT_POST, 1);
			 if ($data)
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			 break;
		  case "PUT":
			 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
			 if ($data)
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
			 break;
		  default:
			 if ($data)
				$url = sprintf("%s?%s", $url, http_build_query($data));
				
	   }

	   // OPTIONS:
	   curl_setopt($curl, CURLOPT_URL, $url);
	   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		  //'APIKEY: 111111111111111111111',
		  "Content-Type: application/json",
		  "email: eve.holt@reqres.in",
		  "password: cityslicka"
	   ));
	   curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

	   // EXECUTE:
	   $result = curl_exec($curl);
	   
		echo '<div class="ls-alert-warning ls-dismissable">';
		echo '<span data-ls-module="dismiss" class="ls-dismiss">&times;</span>';
		echo '<strong>Json Retornado:</strong><pre class="result">' . $result . '</pre>';
		echo '</div>';
		
	   //echo '<pre>';
	   //var_dump($result);		
	   //echo '</pre>';

	   if(!$result){die("Falha na conexão!");}
	   curl_close($curl);
	   return json_decode($result, false);
	}
	
	class consomeApi {
		
		public static function LoadUsuarios($url_api){
		
			$json = file_get_contents($url_api);
			$dados = json_decode($json);

			$totaldepaginas = $dados->total_pages;
			$paginaatual = $dados->page;
			$itensporpagina = $dados->per_page;
			$totaldeitens = $dados->total;

			if(intval($totaldeitens) > 0){
				
				echo '<table class="ls-table">';
				echo '  <thead>';
				echo '    <tr>';
				echo '      <th class="td50">id</th>';
				echo '      <th>Nome</th>';
				echo '      <th class="hidden-xs">Sobrenome</th>';
				echo '      <th class="hidden-xs">Email</th>';
				echo '      <th class="hidden-xs">Foto</th>';
				echo '      <th class="hidden-xs td50"></th>';
				echo '      <th class="hidden-xs td50"></th>';
				echo '    </tr>';
				echo '  </thead>';
				echo '  <tbody>';
				
				
				// Loop para percorrer o Objeto
				foreach($dados->data as $registro){		

					echo '    <tr>';
					echo '      <td class="td50">'. $registro->id .'</td>';
					echo '      <td>'.$registro->first_name.'</td>';
					echo '      <td class="hidden-xs">'.$registro->last_name.'</td>';
					echo '      <td class="hidden-xs" nowrap>'.$registro->email.'</td>';
					echo '      <td class="hidden-xs"><img src="'.$registro->avatar.'" class="avatar"/></td>';
					echo '      <td class="hidden-xs td50"><a href="#" class="ls-btn-primary-danger ls-ico-remove" onclick="exclui('. $registro->id .');"  title="Excluir o registro"></a></td>';
					echo '      <td class="hidden-xs td50"><a href="?op=edita&id='.$registro->id.'" class="ls-btn-primary ls-ico-pencil" title="Editar o registro"></a></td>';
					echo '    </tr>';		
		
				}	
				
				echo '  </tbody>';
				echo '</table>';
			
			}else{
				echo "Nenhum registro retornado pela API!";
			}
			
			echo '<div class="ls-pagination-filter">';
			echo '<ul class="ls-pagination">';
					
			if($paginaatual < 2) {
				$paginaanterior = $paginaatual;
			}else{
				$paginaanterior = $paginaatual -1;
			}

			if($paginaanterior !=$paginaatual){
				
				echo '<li><a href="?pagina='. $paginaanterior .'">&laquo; Anterior</a></li>';
				
			}	

			for($i=1;$i<=$totaldepaginas;$i++){
				
				echo '<li><a href="?pagina='. $i . '">'. $i .'</a></li>';
				
			}

			if($paginaatual < $totaldepaginas){
				$proximapagina = $paginaatual + 1;
				echo '<li><a href="?pagina=' . $proximapagina . '">Próximo &raquo;</a></li>';
			} 

			echo '</div>';
			echo '</ul>';
			
		}
		

	}
	
	


?>
