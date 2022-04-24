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

        $idProducto = $data['idProducto'];
        $nombreProducto = $data['nombreProducto'];
        $precio = $data['precio'];
        $urlProducto = $data['urlProducto'];
        $cantidadProducto = $data['cantidadProducto'];
        $identificacionUsuario = $data['identificacionUsuario'];

        header('Content-Type: application/json');
        try
        {
            $query= "INSERT INTO cart (id_producto, nombre_producto, precio_producto, url_producto, cantidad_producto, identification_usuario ) VALUES ($idProducto, '$nombreProducto', $precio, '$urlProducto',$cantidadProducto, $identificacionUsuario)";
            $response=$dbconnection->prepare($query)->execute();
            echo(json_encode("Exito agregando al carrito"));
        }
        catch(Exception $e)
        {
            echo(json_encode($e));
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
        $query = "SELECT * FROM cart WHERE identification_usuario='$user'";
        $users = $dbconnection->query($query)->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($users);
       
    }
    else
    {
        echo("No se pudieron encontrar los articulos del carrito");
    }

}
elseif($_SERVER['REQUEST_METHOD'] == 'DELETE')
{

    if(isset($_GET['identification']) && isset($_GET['idProducto']))
    {
        $db = new DBconfig();
        $dbconnection = $db->connect();

        $user = $_GET['identification'];
        $idProducto = $_GET['idProducto'];
        
        try
        {
            $query = "DELETE FROM cart WHERE identification_usuario='$user' AND id_producto=$idProducto";
            $users = $dbconnection->query($query);

            header('Content-Type: application/json');
            echo json_encode("Producto retirado del carrito");

        }
         catch(Exception $e)
        {
            echo(json_encode("Error agregando al carrito"));
        }
       
    }
    else
    {
        echo("No se pudo retirar el articulo del carrito");
    }

}
else
{
    echo "Invalid Method";
}