<?php
	 require_once(dirname(__DIR__)."../../conection/db_connecton.php");        
        
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        //$data= json_decode(file_get_contents('php://input'),true);
        $idProducto =  $_GET['idProducto'];
        $db = new DBconfig();
        $dbconnection  = $db->connect();
        $query= "SELECT * FROM producto WHERE id_producto='$idProducto'";
        $producto=$dbconnection->query($query)->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        if(empty($producto)){
            $array="no se encontro el producto";
            echo(json_encode($array));
        }else{
            $item=json_encode($producto[0]);
            echo($item);
        }
    }else{
        echo "ERROR";
    }
