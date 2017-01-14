<?php

    session_start();
    if(!isset($_SESSION['usuario'])) header("Location: index.php?erro=1");

    require_once('bd.class.php');


    $id_usuario = $_SESSION['id_usuario'];
    $tweet = $_POST['txt_tweet'];

    $objBd = new bd();
    $objBd->conecta_mysql();

    $sql = "INSERT INTO tweet(id_usuario, tweet)VALUES($id_usuario, '$tweet') ";

    echo $sql;

    $link = $objBd->conecta_mysql();

    $resultado_id = mysqli_query($link, $sql);

   

?>