<?php

class DBconfig{
    private $user="admin";
    private $password="Admin01*";
    private $servidor="database-1.czr52zp12xr0.us-east-1.rds.amazonaws.com";

    private $nameDB="moviles2jueves";

    public function connect(){
        try{        
            $dns="mysql:host=$this->servidor;dbname=$this->nameDB";
            $connection= new PDO($dns,$this->user,$this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connection;
            //echo "Conexion Exitosa!!!!";

        }catch(PDOException $err){
            echo "Error en la Base de datos".$err->getMessage();
        }
    }
}


