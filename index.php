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
            if(Cliente::Insert($datos->nombre,$datos->apellidoPaterno,$datos->apellidoMataterno,$datos->fechaNacimiento,$datos->genero))
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

        case 'PUT':
            $datos = json_decode(file_get_contents('php://input'));
            if($datos != NULL)
            {
                if(Cliente::Update($datos->id,$datos->nombre,$datos->apellidoPaterno,$datos->apellidoMaterno,$datos->fechaNacimiento,$datos->genero))
                {
                    http_response_code(200);
                    echo "<br> Se modifico con exito";
                }else{
                    http_response_code(404);
                }
            }else{
                http_response_code(405);
            }

        break;

        case 'DELETE':
            if(isset($_GET['id']))
            {
                if(Cliente::Delete($_GET['id']))
                {
                    http_response_code(200);
                    echo "<br> Se elimino con exito";
                }else{
                    http_response_code(404);
                }
            }else{
                echo "<br> Ese id no existe..";
            }

        break;
    default:
            http_response_code(404);
            echo "<br>Ese metodo no existe..";
        break;
}





