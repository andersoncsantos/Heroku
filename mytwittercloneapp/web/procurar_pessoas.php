<?php
    session_start();
    if(!isset($_SESSION['usuario'])) header("Location: index.php?erro=1");

	require_once('bd.class.php');
    
    $objBd = new bd();
    $objBd->conecta_mysql();

	$id_usuario = $_SESSION['id_usuario'];

	
	
	//query - quantidade de tweets
	$sql = " SELECT COUNT(*) AS qtde_tweets FROM tweet WHERE id_usuario = $id_usuario ";

	//conexão com o banco
	$link = $objBd->conecta_mysql();

	//consulta ao banco
    $resultado_id = mysqli_query($link, $sql);

	//retorno da consulta de acordo com os parâmetros passados na variável $sql
	$qtde_tweets = mysqli_fetch_array($resultado_id);

	
	
	//query - quantidade de seguidores
	$sql = " SELECT COUNT(*) AS qtde_seguidores FROM usuarios_seguidores WHERE seguindo_id_usuario = $id_usuario ";

	//conexão com o banco
	$link = $objBd->conecta_mysql();

	//consulta ao banco
    $resultado_id = mysqli_query($link, $sql);

	//retorno da consulta de acordo com os parâmetros passados na variável $sql
	$qtde_seguidores = mysqli_fetch_array($resultado_id);


	//query - quantidade de usuarios que estou seguindo
	$sql = " SELECT COUNT(*) AS qtde_seguindo FROM usuarios_seguidores WHERE id_usuario = $id_usuario ";

	//conexão com o banco
	$link = $objBd->conecta_mysql();

	//consulta ao banco
    $resultado_id = mysqli_query($link, $sql);

	//retorno da consulta de acordo com os parâmetros passados na variável $sql
	$qtde_seguindo = mysqli_fetch_array($resultado_id);
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<script type="text/javascript">
		$(document).ready(function(){
			
			$('#btn-pesquisar').click(function(){
				
				if($('#txt_nome').val().length > 0){
						$.ajax({
						
							url: 'get_pessoas.php',
							method: 'post',
							data: $('#form_procurar_pessoas').serialize(),

							success: function(data){
								$('#pessoas').html(data);

                                    $('.btn_seguir').click(function(){
                                        
                                        var id_usuario = $(this).data('id_usuario');
                                            
                                        $('#seguir_'+id_usuario).hide();
                                        $('#deixar_seguir_'+id_usuario).show();

                                        $.ajax({
                                            url: 'seguir.php',
							                method: 'post',
							                data: {seguir_id_usuario : id_usuario},

                                            success: function(data){
                                                
                                            }
                                        })
                                    })

                                    $('.btn_deixar_seguir').click(function(){
                                        
                                        var id_usuario = $(this).data('id_usuario');
                                            
                                        $('#deixar_seguir_'+id_usuario).hide();
                                        $('#seguir_'+id_usuario).show();

                                        $.ajax({
                                            url: 'deixar_seguir.php',
							                method: 'post',
							                data: {seguir_id_usuario : id_usuario},

                                            success: function(data){
                                                
                                            }
                                        })
                                    })
								

							}
						})
					}
				})
	

           })
		</script>
	
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img src="imagens/icone_twitter.png" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
                <li><a href="home.php">Home</a></li>
	            <li><a href="sair.php">Sair</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">
		
	    	<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-body">
						<font size="4px"><?= $_SESSION['usuario']?></font><br>
						<small><font color="#66757f"><?= $_SESSION['email']?></font></small>
						<hr>
						
						<div class="row">
						<div class="col-md-3" >
							<font size="1px" color="#8899a6">TWEETS</font><br>
							<font size="4px" color="#2FC2EF"><?=$qtde_tweets['qtde_tweets']?></font>
						</div>
						<div class="col-md-3" >
							<font size="1px" color="#8899a6">SEGUINDO</font><br>
							<font size="4px" color="2FC2EF"><?=$qtde_seguindo['qtde_seguindo']?></font>
						</div>
						<div class="col-md-6">
							<font size="1px" color="#8899a6">SEGUIDORES</font><br>
							<font size="4px" color="2FC2EF"><?=$qtde_seguidores['qtde_seguidores']?></font>
						
						</div>
						</div>
					</div>
				</div>
				</div>

	    	<div class="col-md-6">

					<form id="form_procurar_pessoas">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="input-group">
									<input type="text" class="form-control" id="txt_nome" name="txt_nome" placeholder="Quem você está procurando?" maxlenght="140">
										<span class="input-group-btn">
											<button class="btn btn-default" id="btn-pesquisar" type="button">Pesquisar</button>
										</span>
									</div>
								</div>
							</div>
					 </form>

					<div id="pessoas" class="list-group">
					</div>

				</div>
					
					<div class="col-md-3">
														
					</div>

			<div class="clearfix"></div>
			

		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>