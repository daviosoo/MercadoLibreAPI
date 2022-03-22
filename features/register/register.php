<?php
 require_once(dirname(__DIR__).'../../conection/db_connecton.php');        
        
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $data= json_decode(file_get_contents('php://input'),true);

        if(empty($data))
        {
            echo("No se ingresaron los datos requeridos");
        }
        else
        {
            
            $identificacion = $data['identificacion'];
            $email = $data['email'];
            $celular = $data['celular'];
            $contra = $data['contra'];
    
            
            $db = new DBconfig();
            $dbconnection = $db->connect();

            header('Content-Type: application/json');
            try
            {
                $query= "INSERT INTO usuario (identificacion, email, celular, contra) VALUES ($identificacion, '$email', '$celular', '$contra')";
                $response=$dbconnection->prepare($query)->execute();
                echo(json_encode("Exito en el registro"));
            }
            catch(Exception $e)
            {
                echo(json_encode("Error en el registro"));
            }

        }

    }
    else
    {
        echo "ERROR";
    }
