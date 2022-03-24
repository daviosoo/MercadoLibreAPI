<?php

    require_once(dirname(__DIR__)."../../conection/db_connecton.php");        
        
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $data= json_decode(file_get_contents('php://input'),true);
        $email = $data['email'];
        $contra=$data['contra'];
        $db = new DBconfig();
        $dbconnection  = $db->connect();
        $query= "SELECT * FROM usuario WHERE email='$email' AND contra='$contra'";
        $users=$dbconnection->query($query)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        if(empty($users)){
            echo("ingresaste mal los datos");
        }else{
            echo(json_encode($users));
        }
    }else{
        echo "ERROR";
    }


