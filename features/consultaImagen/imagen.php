<?php
	 require_once(dirname(__DIR__)."../../conection/db_connecton.php");        
        
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        //$data= json_decode(file_get_contents('php://input'),true);
        $db = new DBconfig();
        $dbconnection  = $db->connect();
        $query= "SELECT * FROM producto";
        $producto=$dbconnection->query($query)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
          if(count($producto) == 0){
            $array="No se encontraron productos";
            echo(json_encode($array));
        }else{
            $item=json_encode($producto);
            echo($item);
        }
    }else{
        echo "ERROR";
    }
