<?php

    require_once(dirname(__DIR__)."../../conection/db_conecton.php");        
        
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $data= json_decode(file_get_contents('php://input'),true);
        $identification = $data['identification'];
        $db = new DBconfig();
        $dbconnection  = $db->connect();
        $query= "SELECT * FROM tabla WHERE identification='$identification'";
        $users=$dbconnection->query($query)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo(json_encode($users));
    }else{
        echo "ERROR";
    }


