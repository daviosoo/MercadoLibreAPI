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
        $db = new DBconfig();
        $dbconnection = $db->connect();

        header('Content-Type: application/json');
        
        try
        {
            foreach($data as $producto)
            {
                $idProducto = $producto['idProducto'];
                $nombreProducto = $producto['nombreProducto'];
                $precio = $producto['precio'];
                $urlProducto = $producto['urlProducto'];
                $cantidadProducto = $producto['cantidadProducto'];
                $identificacionUsuario = $producto['identificacionUsuario'];

                
                $query= "INSERT INTO historial (id_producto, nombre_producto, precio_producto, url_producto, cantidad_producto, identification_usuario) VALUES ($idProducto, '$nombreProducto', $precio, '$urlProducto', $cantidadProducto, $identificacionUsuario)";
                $response=$dbconnection->prepare($query)->execute();
                
            }
            echo(json_encode("Exito agregando al historial"));
        } 
        catch(Exception $e)
        {
            echo(json_encode("E: ". $e));
        }

    }
}
elseif($_SERVER['REQUEST_METHOD'] == 'GET')
{

    if(isset($_GET['identification']))
    {
        $db = new DBconfig();
        $dbconnection = $db->connect();

        $users = "";

        $user = $_GET['identification'];
        $query = "SELECT * FROM historial WHERE identification_usuario='$user'";
        $productos = $dbconnection->query($query)->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($productos);
       
    }
    else
    {
        echo("No se pudieron encontrar los articulos del historial");
    }

}
else
{
    echo "Invalid Method";
}