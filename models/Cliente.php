<?php

include('connection/Connection.php');

class Cliente {

    public static function GetAll()
    {
        $baseDatos = new Connection();
        $consulta = "SELECT * FROM clientes". ';';
        $resultado = $baseDatos->query($consulta);
        $datos = [];
        if($resultado->num_rows)
        {
            while($fila = $resultado->fetch_assoc())
            {
                $datos [] = [
                    'id' => $fila['IdCliente'],
                    'nombre' => $fila['Nombre'],
                    'apellidoPaterno' => $fila['ApellidoPat'],
                    'apellidoMaterno' => $fila['ApellidoMat'],
                    'fechaNacimiento' => $fila['fechaNacimiento'],
                    'genero' => $fila['genero']
                ];
            }
        }
        return $datos; 
    }

    public static function GetWhere($idCliente)
    {
        $baseDatos = new Connection();
        $query = 'SELECT * FROM clientes WHERE IdCliente = '. $idCliente . ';';
        $resultado = $baseDatos->query($query);
        $datos = [];

        if($resultado->num_rows)
        {
            while($fila = $resultado->fetch_assoc())
            {
                $datos [] = [
                    'id' => $fila['IdCliente'],
                    'nombre' => $fila['Nombre'],
                    'apellidoPat' => $fila['ApellidoPat'],
                    'apellidoMat' => $fila['ApellidoMat'],
                    'fecha' => $fila['fechaNacimiento'],
                    'genero' => $fila['genero'],

                ];
            }
        }

        return $datos;
    }

    public static function Insert($nombre, $apellidoPat, $apellidoMat, $fecha, $genero)
    {

        $coneccionDB = new Connection();
        $query = "INSERT INTO clientes (Nombre, ApellidoPat, ApellidoMat, fechaNacimiento, genero) 
                VALUES (?, ?, ?, ?, ?)";
        // Preparar la declaración
        if ($stmt = $coneccionDB->prepare($query)) 
        {
            $stmt->bind_param("sssss", $nombre, $apellidoPat, $apellidoMat, $fecha, $genero);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) 
            {
                $stmt->close();
                $coneccionDB->close();      

                return TRUE;
            }
            $stmt->close();
        }
        $coneccionDB->close();        
        return FALSE;
    }

    /*
    public static function Insert($nombre,$apellidoPat,$apellidoMat,$fecha,$genero)
    {
        $coneccionDB = new Connection();
        $query = "INSERT INTO clientes (Nombre , ApellidoPat , ApellidoMat , fechaNacimiento , genero ) VALUES ('".$nombre.",".$apellidoPat.",".$apellidoMat.",".$fecha.",".$genero."');";
        $coneccionDB->query($query);
        if($coneccionDB->affected_rows)
        {
            $coneccionDB->close();
            return TRUE;
        }
        $coneccionDB->close();
        return FALSE;
    }*/

    public static function Update($idCliente, $nombre, $apellidoPat, $apellidoMat, $fecha, $genero)
    {
        $coneccionDB = new Connection();
        $query = "UPDATE clientes SET 
                Nombre = ?, 
                ApellidoPat = ?, 
                ApellidoMat = ?, 
                fechaNacimiento = ?, 
                genero = ? 
                WHERE IdCliente = ?";

        if ($declaracion = $coneccionDB->prepare($query)) 
        {
            // "sssssi" indica que los primeros cinco parámetros son cadenas y el último es un entero
            $declaracion->bind_param("sssssi", $nombre, $apellidoPat, $apellidoMat, $fecha, $genero, $idCliente);
            $declaracion->execute();

            if ($declaracion->affected_rows > 0) 
            {
                $declaracion->close();
                $coneccionDB->close();

                return TRUE;
            }
            $declaracion->close();
        }
        $coneccionDB->close();

        return FALSE;
    }

    /*
    public static function Update($idCliente,$nombre,$apellidoPat,$apellidoMat,$fecha,$genero)
    {
        $coneccionDB = new Connection();

        $query = "UPDATE clientes SET  
        'Nombre = ".$nombre.", 
        ApellidoPat = ".$apellidoPat.",
        ApellidoMat =  ".$apellidoMat.",
        fechaNacimiento = ".$fecha.", genero = ".$genero."'
        WHERE IdCliente = '".$idCliente."';";
        $coneccionDB->query($query);

        if($coneccionDB->affected_rows)
        {
            return TRUE;
        }
        return FALSE;
    }*/


    public static function Delete($idCliente)
    {
        $coneccionDB = new Connection();
        $query = 'DELETE FROM clientes WHERE IdCliente = '. $idCliente. ';';
        $coneccionDB->query($query);
        if($coneccionDB->affected_rows)
        {
            return TRUE;
        }
        return FALSE;
    }


}



