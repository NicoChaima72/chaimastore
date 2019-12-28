<?php 
require_once '../models/usuarioModel.php';
class usuarioController extends usuarioModel {
  public function registrar_usuario_controller() {
    $email = mainModel::limpiar_cadena($_POST['email'], 1);
    $confirmarEmail = mainModel::limpiar_cadena($_POST['confirmarEmail'], 1);
    $password = mainModel::limpiar_cadena($_POST['password']);
    $confirmarPassword = mainModel::limpiar_cadena($_POST['confirmarPassword']);
    $nombre = mainModel::limpiar_cadena($_POST['nombre'], 4);
    $apellidos = mainModel::limpiar_cadena($_POST['apellidos'], 4);
    $referencial = mainModel::limpiar_cadena($_POST['referencial'], 3);
    $rut = mainModel::limpiar_cadena($_POST['rut']);
    $direccion = $_POST['direccion'];
    $region = mainModel::limpiar_cadena($direccion['region']);
    $provincia = mainModel::limpiar_cadena($direccion['provincia']);
    $comuna = mainModel::limpiar_cadena($direccion['comuna']);
    $calle = mainModel::limpiar_cadena($direccion['calle'], 3);
    $numero = mainModel::limpiar_cadena($direccion['numero']);
    $tipo = mainModel::limpiar_cadena($direccion['tipo'], 3);
    $depto = mainModel::limpiar_cadena($direccion['depto'], 3);
    $block = mainModel::limpiar_cadena($direccion['block'], 2);
    $telefono = mainModel::limpiar_cadena($_POST['telefono']);
    $nuevaDireccion = $calle.' '.$numero.' '.$tipo.' '.$depto.' '.$block;
    $nuevaDireccion = mainModel::limpiar_cadena($nuevaDireccion);
    $rol = 2;

    if (!(campo_requerido($email) && campo_requerido($confirmarEmail) && campo_requerido($password) && campo_requerido($confirmarPassword) && campo_requerido($nombre) && campo_requerido($apellidos) && campo_requerido($referencial) && campo_requerido($rut) && campo_requerido($region) && campo_requerido($provincia) && campo_requerido($comuna) && campo_requerido($calle) && campo_requerido($numero) && campo_requerido($telefono) && campo_requerido($nuevaDireccion)) 
      ) {
        return enviar_error('Verifica algun campo vacio');
      }

    if ($email != $confirmarEmail) {
      return enviar_error('El email no coincide');
    }
    if ($password != $confirmarPassword) {
      return enviar_error('La contraseña no coincide');
    }
    $verificarRut = mainModel::ejecutar_consulta_simple("SELECT id FROM usuarios WHERE rut = '".$rut."'");
    if ($verificarRut->rowCount() > 0) {
      return enviar_error("El RUT ya está registrado. Inicia sesion arriba");
    }
    $verificarEmail = mainModel::ejecutar_consulta_simple("SELECT id FROM usuarios WHERE email = '".$rut."'");
    if ($verificarEmail->rowCount() > 0) {
      return enviar_error("El email ya está registrado. Inicia sesion arriba");
    }
    
    $nuevaPassword = password_hash($password, PASSWORD_BCRYPT);

    $datosUsuario = [
      "rol" => $rol,
      "region" => $region,
      "provincia" => $provincia,
      "comuna" => $comuna,
      "rut" => $rut,
      "nombre" => $nombre,
      "apellidos" => $apellidos,
      "referencial" => $referencial,
      "email" => $email,
      "password" => $nuevaPassword,
      "direccion" => $nuevaDireccion
    ];
    
    $guardarUsuario = parent::registrar_usuario_model($datosUsuario);
    
    if ($guardarUsuario->rowCount() == "1") {
      return enviar_success('data', 1);
    } else {
      return enviar_error('No se ha podido registrar, intenta mas tarde');
    }
  }

  public function obtener_regiones_controller() {
    $resultado = usuarioModel::obtener_regiones_model();
    return $resultado;
  }
  public function obtener_provincias_controller($region) {
    $resultado = usuarioModel::obtener_provincias_model($region);
    return $resultado;
  }
  public function obtener_comunas_controller($provincia) {
    $resultado = usuarioModel::obtener_comunas_model($provincia);
    return $resultado;
  }
}


function enviar_success($nombreCampo, $mensaje) {
  $respuesta = [
    $nombreCampo => $mensaje
  ];
  return $respuesta; 
}
function enviar_error($mensaje) {
  $respuesta = [
    'error' => $mensaje
  ];
  return $respuesta;
}

function campo_requerido($campo) {
  $esValido = true;
  if (strlen($campo) == 0) {
    $esValido = false;
  }
  return $esValido;
}
?>