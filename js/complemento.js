		
			function exclui(id) {
					swal({
					  title: "Excluir",
					  text: "Tem certeza que deseja excluir, todos os dados do usuário?",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonColor: "#DD6B55",
					  cancelButtonText: "Não",
					  confirmButtonText: "Sim, exclua",
					  html:true,
					  closeOnConfirm: false
					},
					function(value){
						switch(value){
							case true:
							swal("Exclusão selecionada!", "Aguarde um instante...", "success");

							function clicar(){

								window.open("?op=excluir&url=https://reqres.in/api/users/"+id, '_top');
								
							}
	
							clicar();
							break;
							default: 
							//window.location.href='guia_de_autorizacao_nav.php?aut=nao';	
							break;
						}				

					}				
				);
			}
