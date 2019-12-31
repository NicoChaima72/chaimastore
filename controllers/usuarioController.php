<?php 
require_once '../models/usuarioModel.php';
class usuarioController extends usuarioModel {
  public function login_usuario_controller() {
    $email = mainModel::limpiar_cadena($_POST['email'], 1);
    $password = mainModel::limpiar_cadena($_POST['password']);
    $recuerdame = mainModel::limpiar_cadena($_POST['recuerdame']);

    $datosUsuario = [
      "email" => $email,
      "password" => $password
    ];

    $estadoLogin = parent::login_usuario_model($datosUsuario);
    if (!$estadoLogin) {
      return enviar_error('Email y/o contraseña incorrectas.');
    }
    $datos = $estadoLogin->fetch();

    $rol = mainModel::encryption($datos['rol_id']);
    $region = mainModel::encryption($datos['region_id']);
    $provincia = mainModel::encryption($datos['provincia_id']);
    $comuna = mainModel::encryption($datos['comuna_id']);
    $rut = mainModel::encryption($datos['rut']);
    $nombre = mainModel::encryption($datos['nombre']);
    $apellidos = mainModel::encryption($datos['apellidos']);
    $referencia = mainModel::encryption($datos['nombre_referencial']);
    $email = mainModel::encryption($datos['email']);
    $direccion = mainModel::encryption($datos['direccion']);
    $telefono = mainModel::encryption($datos['telefono']);
    $token = md5(uniqid(mt_rand(), true));
    $token_hash = mainModel::encryption($token);

    session_start();
    $_SESSION['chaimastore__rol'] = $rol;
    $_SESSION['chaimastore__region'] = $region;
    $_SESSION['chaimastore__provincia'] = $provincia;
    $_SESSION['chaimastore__comuna'] = $comuna;
    $_SESSION['chaimastore__rut'] = $rut;
    $_SESSION['chaimastore__nombre'] = $nombre;
    $_SESSION['chaimastore__apellidos'] = $apellidos;
    $_SESSION['chaimastore__referencia'] = $referencia;
    $_SESSION['chaimastore__email'] = $email;
    $_SESSION['chaimastore__direccion'] = $direccion;
    $_SESSION['chaimastore__telefono'] = $telefono;
    $_SESSION['chaimastore__token'] = $token_hash;
    $_SESSION['chaimastore__id'] = $token;

    if ($recuerdame == "true") {
      setcookie('_id', $token, strtotime('+20 days'), '/', false, false);
      setcookie('_user', $email, strtotime('+20 days'), '/', false, false);
      setcookie('_token', $token_hash, strtotime('+20 days'), '/', false, false);
    }

    return enviar_success('data', 1);
  }
  
  public function logout_usuario_controller() {
    session_start();
    $token = $email = mainModel::limpiar_cadena($_POST['token']);
    if ($token != $_SESSION['chaimastore__id']) {
      return enviar_error("El token de registro ha sido modificado");
    }
    session_destroy();
    setcookie("_id", '', 1, "/", false, false);
    setcookie("_user", '', 1, "/", false, false);
    setcookie("_token", '', 1, "/", false, false);
    
    return enviar_success('data', 1);
  }

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
      "direccion" => $nuevaDireccion,
      "telefono" => $telefono
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