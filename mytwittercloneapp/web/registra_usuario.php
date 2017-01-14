<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
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
	            <li><a href="index.php">Home</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">
	    	
	    	<br /><br />

	    	<div class="col-md-3"></div>
	    	<div class="col-md-6" align="center">
                <?php

					$usuario_existe = false;
					$email_existe = false;

                    require_once('bd.class.php');

                    //$_POST
                    //$_GET

                    $usuario = $_POST['usuario'];
                    $email = $_POST['email'];
                    $senha = md5($_POST['senha']);

                    $objBd = new bd();
                    $objBd->conecta_mysql();

					$sql = " SELECT * FROM `usuarios` WHERE usuario = '$usuario' ";

										 //agora você deve recuperar o link de conexão com o banco de dados criado na função conecta_mysql()
                    $link = $objBd->conecta_mysql();

                    //o link deve ser utilizado como primeiro parâmetro da função mysqli_query(), observe que agora a função tem um "i" em mysqli_...
                    $resultado_id = mysqli_query($link, $sql);
                    
                    if ($resultado_id){
						$dados = mysqli_fetch_array($resultado_id);
						if(isset($dados['usuario'])){
							$usuario_existe = true;
						}

						$sql = " SELECT * FROM `usuarios` WHERE email = '$email' ";

										 //agora você deve recuperar o link de conexão com o banco de dados criado na função conecta_mysql()
                    $link = $objBd->conecta_mysql();

                    //o link deve ser utilizado como primeiro parâmetro da função mysqli_query(), observe que agora a função tem um "i" em mysqli_...
                    $resultado_id = mysqli_query($link, $sql);
                    
                    if ($resultado_id){
						$dados = mysqli_fetch_array($resultado_id);
						if(isset($dados['usuario'])){
							$email_existe = true;
						}
					}

					if($usuario_existe || $email_existe){

						$retorno_get = '';

						if($usuario_existe){

							$retorno_get.="erro_usuario=1&";

						}

						if($email_existe){

							$retorno_get.="erro_email=1&";

						}

						header("Location: inscrevase.php?".$retorno_get);
						
						die();
					  }
					

					}
					

                    $sql = "INSERT INTO usuarios(usuario, email, senha)VALUES('$usuario', '$email', '$senha')";

                    //agora você deve recuperar o link de conexão com o banco de dados criado na função conecta_mysql()
                    $link = $objBd->conecta_mysql();

                    //o link deve ser utilizado como primeiro parâmetro da função mysqli_query(), observe que agora a função tem um "i" em mysqli_...
                    $resultado_id = mysqli_query($link, $sql);
                    
                    if ($resultado_id){
                        echo '<h4>Usuário registrado com sucesso!</h4>';
                        echo '</br>';
                        echo $usuario;
                        echo '</br>';
                        echo $email;
                    }else{
                        echo '<h4>Erro ao efetuar registro!</h4>';
                    }
                ?>
            </div>
			<div class="col-md-3"></div>

			<div class="clearfix"></div>
			<br />
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>

		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>