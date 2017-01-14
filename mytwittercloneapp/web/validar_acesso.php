<?php

    session_start();

    require_once('bd.class.php');

    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']);

    $objBd = new bd();
    $objBd->conecta_mysql();

    $sql = " SELECT id, usuario, email FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
  
    //agora você deve recuperar o link de conexão com o banco de dados criado na função conecta_mysql()
    $link = $objBd->conecta_mysql();

    //o link deve ser utilizado como primeiro parâmetro da função mysqli_query(), observe que agora a função tem um "i" em mysqli_...
    $resultado_id = mysqli_query($link, $sql);
    
    if ($resultado_id){
        $dados_usuario = mysqli_fetch_array($resultado_id);

        if(isset($dados_usuario['usuario'])){
           
            $_SESSION["id_usuario"] = $dados_usuario['id'];
            $_SESSION["usuario"] = $dados_usuario['usuario'];
            $_SESSION["email"] = $dados_usuario['email'];


            header("Location: home.php");
        }else{
            header("Location: index.php?erro=1");
        }
       
    }else{
        echo 'Erro ao efetuar registro!';
    }


?>