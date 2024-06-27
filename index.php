<?php
require_once('models/Cliente.php');

switch($_SERVER['REQUEST_METHOD'])
{
    case 'GET':
        if(isset($_GET['id']))
        {
            echo json_encode(Cliente::GetWhere($_GET['id']));
        }else{
            
            echo json_encode(Cliente::GetAll());
        }

        break;
    case 'POST':
        $datos = json_decode(file_get_contents('php://input'));
        if($datos != NULL)
        {            
            if(Cliente::Insert($datos->nombre,$datos->apellidoPaterno,$datos->apellidoMaterno,$datos->fechaNacimiento,$datos->genero))
            {
                http_response_code(200);
                echo "<br> Salio todo ok";

            }else{
                http_response_code(404);
            }
        }else{
            http_response_code(405);
        }
        break;
    default:
        break;
}





