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
        break;
    default:
        break;
}





