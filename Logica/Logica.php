<?php    
    require_once("../Model/UsuariosModel.php");
    require_once("../Model/VehiculoModel.php");

    $data = json_decode(file_get_contents("php://input"));

    switch ($data->operacion) {
        case "Guardar":
            $vehiculo = new Vehiculo();
            $vehiculo->setId($data->id);
            $vehiculo->setPlaca($data->placa);
            $vehiculo->setMarca($data->marca);
            $vehiculo->setMotor($data->motor);
            $vehiculo->setChasis($data->chasis);
            $vehiculo->setCombustible($data->combustible);
            $vehiculo->setAnio($data->anio);
            $vehiculo->setColor($data->color);
            $vehiculo->setAvaluo($data->avaluo);
            if($vehiculo->getId() == "") {
                $vehiculo->insertar();
                echo "Guardado";
            } else {
                $vehiculo->actualizar();
                echo "Actualizado";
            }
            break;

        case "BuscarTodos":
            $vehiculo = new Vehiculo();
            $resultado = $vehiculo->BuscarTodos();
            foreach($resultado as $fila) {                
                echo "<tr align='center'><td>$fila[0]</td><td>$fila[1]</td><td>$fila[2]</td><td>$fila[3]</td><td>$fila[4]</td>
                <td>$fila[5]</td><td>$fila[6]</td><td>$fila[7]</td><td>$fila[8]</td>
                <td><button class='btn btn-danger' onclick='Eliminar($fila[0]);'>Eliminar</button></td></tr>";
            }
            break;

        case "Eliminar":
            $vehiculo = new Vehiculo();
            $vehiculo->setId($data->id);
            $vehiculo->eliminar();
            echo "Eliminado";
            break;       

        case "Login":
            session_start();
            $usuario = new UsuariosModel();
            $usuario->setPassword(hash('sha256',md5($data->pwd)));
            $usuario->setUsuario($data->usr);            
            if($usuario->BuscarUsuario()) {
                echo 'Correcto';
                $_SESSION["usuario"] = $usuario->getUsuario();
                $_SESSION["pasword"] = $usuario->getPassword();
            } else {
                echo '<div class="alert alert-danger col-lg-4 offset-lg-4" role="alert" id="res">
                Usuario o contraseña incorrectos</div>';
            }
            break;
        
        case "Crear":
            $usuario = new UsuariosModel();
            $usuario->setPassword(hash('sha256',md5($data->pwd)));
            $usuario->setUsuario($data->usr);
            
            $usuario->crear();
            echo '<div class="alert alert-success col-lg-4 offset-lg-4" role="alert" id="res">
            Usuario registrado correctamente</div>';
            break;

        case "BuscarColor":
            $color = new Color();
            $resultado = $color->BuscarTodos();
            
            foreach($resultado as $fila) {                
                echo "<option value='$fila[0]'>$fila[1]</option>";
            }
            echo "</select></div>";
            break;
    }
