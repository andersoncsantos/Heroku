<?php

//conexao com o banco de dados
    class bd {
        /*
        //host
        private $host = 'localhost';

        //usuario
        private $user = 'root';

        //senha
        private $password = '';

        //banco de dados
        private $database = 'twitter_clone';
        */

        public function conecta_mysql(){
            
            $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

            $server = $url["host"];
            $username = $url["user"];
            $password = $url["pass"];
            $db = substr($url["path"], 1);

            $conn = new mysqli($server, $username, $password, $db);

            if(mysqli_connect_errno()) {
                echo "Erro ao tentar se conectar com o BD MySQL: " . mysqli_connect_error();
            }
             
            return $conn;
        }

    }

?>