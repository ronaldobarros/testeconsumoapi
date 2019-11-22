<?php

   /**
    * Teste de Consumo API
    * Copyright (C) 2019
    * Autor: Ronaldo de Souza Barros
	*/

	include "classes.php";

?>

<!DOCTYPE html>
<html class="ls-theme-green">
	<head>
		<title>Página Teste de Consumo API</title>

		<meta charset="utf-8">
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<meta name="description" content="Insira aqui a descrição da página.">
		<link href="http://assets.locaweb.com.br/locastyle/3.10.1/stylesheets/locastyle.css" rel="stylesheet" type="text/css">
		<link href="css/estilo.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">		
		<script src="js/sweetalert.min.js"></script>
		<script src="js/complemento.js"></script>		
	</head>
	<body>
		<div class="ls-topbar ">


			<span class="ls-show-sidebar ls-ico-menu"></span>


			<h1 class="ls-brand-name">
				<a href="/testaapi" class="ls-ico-multibuckets">
					<small>Consumo API REQ RES</small>
					Página Teste de Consumo API
				</a>
			</h1>


		</div>


		<aside class="ls-sidebar">

			<div class="ls-sidebar-inner">

				<nav class="ls-menu">
					<ul>
						<li>
							<a href="?op=adiciona" class="ls-ico-user-add" title="Adiciona Usuários">Adiciona Usuários</a>
						</li>
						<li>
							<a href="#" class="ls-ico-docs" title="Relatórios">Relatórios</a>
							<ul>
								<li>
									<a href="?" class="ls-ico-users" title="Lista Usuários">Lista Usuários</a>
								</li>
							</ul>
						</li>
					</ul>
				  </nav>


			</div>
		</aside>


		<main class="ls-main ">
			<div class="container-fluid">
			
			
				<h1 class="ls-title-intro ls-ico-users">Usuários</h1>

				<?php
					
					if(!$_GET['pagina'] && !$_GET['op']){
						$url_api = "https://reqres.in/api/users"; 
						$dados = new consomeApi($url_api);
						$dados->LoadUsuarios($url_api);
						$errors = $dados->response->errors;
						echo $errors;																	
					}elseif($_GET['pagina'] && !$_GET['op']){
						$url_api = "https://reqres.in/api/users?page=".$_GET['pagina'];  	
						$dados = new consomeApi($url_api);
						$dados->LoadUsuarios($url_api);
						$errors = $dados->response->errors;
						echo $errors;																	
					}
					
					if($_GET['op']=='excluir'){
						$url_api = $_GET['url'];  	
						$delete = callAPI('DELETE', $url_api, false);
					    $response = json_decode($delete, true);
						$errors = $response['response']['errors'];
						echo $errors;											
					}	
					
					if($_GET['op']=='edita' && $_POST['first_name']){
						$data_array =  array(
									"first_name"      => $_POST['first_name'],
									"last_name"       => $_POST['last_name'],
									"email"   	      => $_POST['email'],
									"avatar"   	      => $_POST['avatar']
							 		);						
						$url_api = "https://reqres.in/api/users/" . $_POST['id']; 
						$edita = callAPI('PUT', $url_api, json_encode($data_array));
					    $response = json_decode($edita, true);
						$errors = $response['response']['errors'];
						echo $errors;											
					}elseif($_GET['op']=='edita'){	
								$url_api = "https://reqres.in/api/users/" . $_GET['id']; 
								$dados = callAPI('GET', $url_api, false);
								$errors = $dados->response->errors;
								echo $errors;

								
								// Loop para percorrer o Objeto
								foreach($dados->data as $registro){
									$i++;
									$campo[$i]=$registro;
																								
									}					
	   
					}
					
					if($_GET['op']=='adiciona' && $_POST['first_name']){
						$data_array =  array(
									"first_name"      => $_POST['first_name'],
									"last_name"       => $_POST['last_name'],
									"email"   	      => $_POST['email'],
									"avatar"   	      => $_POST['avatar']
							 		);						
						$url_api = "https://reqres.in/api/users/"; 
						$edita = callAPI('POST', $url_api, json_encode($data_array));
						
						
					    $response = json_decode($edita, true);
						$errors = $response['response']['errors'];
						echo $errors;											
					}
					
					if($_GET['op'] && $_GET['op']!='excluir'){
				?>				  
				
						<form action="" class="ls-form ls-form-horizontal row" method="post">
						  <fieldset>
							<label class="ls-label col-md-2 col-xs-12">
							  <b class="ls-label-text">Nome</b>
							  <input type="text" name="first_name" placeholder="Primeiro nome" class="ls-field" value="<?php echo $campo[3]; ?>" required>
							</label>
							<label class="ls-label col-md-2 col-xs-12">
							  <b class="ls-label-text">Sobrenome</b>
							  <input type="text" name="last_name" placeholder="Sobrenome" class="ls-field" value="<?php echo $campo[4]; ?>" required>
							</label>  
							<label class="ls-label col-md-3 col-xs-12">
							  <b class="ls-label-text">Email</b>
							  <input type="text" name="email" placeholder="Email" class="ls-field" value="<?php echo $campo[2]; ?>" required>
							</label>
							<label class="ls-label col-md-5 col-xs-12">
							  <b class="ls-label-text">Foto</b>
							  <input type="text" name="avatar" placeholder="Foto" class="ls-field" value="<?php echo $campo[5]; ?>" required>
							</label>
							<input type="hidden" name="id" value="<?php echo $campo[1]; ?>">
							<div class="ls-actions-btn">
								<button class="ls-btn">Salvar</button>
							</div>					
						  </fieldset>
						</form>  

				<?php 
					} 
				?>							
				</div>
		</main>

	
		<!-- We recommended use jQuery 1.10 or up -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="http://assets.locaweb.com.br/locastyle/3.10.1/javascripts/locastyle.js" type="text/javascript"></script>
	</body>
</html>




