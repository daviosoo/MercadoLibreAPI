<?php

class DBconfig{
    private $user="root";
    private $password="";
    private $servidor="localhost";
    private $nameDB="MercadoLibreBD";

    public function connect(){
        try{        
            $dns="mysql:host=$this->servidor;dbname=$this->nameDB";
            $connection= new PDO($dns,$this->user,$this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        }catch(PDOException $err){
            echo "Error en la Base de datos".$err->getMessage();
        }
    }
}


