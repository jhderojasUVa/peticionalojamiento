<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// http://phpseclib.sourceforge.net/documentation/net.html

require_once 'phpseclib1.0.14/Net/SSH2.php';

class NetSSH {
  // Objeto de conexiones remotas SSH

  function __construct() {
    $this-> CI =& get_instance();
    $this -> CI -> load -> model('Admin_model');
    // Nos comemos la libreria que la virgen solo corre si sale corriendo
  }

  private function login($usuario, $host, $keyUser) {
    // Login por ssh
    // $usuario = usuario que hace el login
    // $host = host sobre el que se hace el login
    // $keyUser = key del usuario

    // Definimos el objeto key
    $key = new Crypt_RSA();

    // Le metemos la key del usuario
    $key -> loadKey($keyUser);

    // Y empezamos la conexion
    $ssh = new Net_SSH2($host);

    if (!$ssh -> login("www", $key)) {
      exit("Error al hacer login por SSH");
    }
    return $ssh;
  }

  private function logout() {
    // La libreria deberia tener un logout pero...
  }

  function ejecutaScript($usuario, $host, $keyUser, $script) {
    // Ejecuta en .sh determinado
    // $usuario = usuario que hace el login
    // $host = host sobre el que se hace el login
    // $keyUser = key del usuario
    // $script = nombre del fichero .sh (ha de tener .sh, permisos y todo en orden)

    // Hacemos el login
    $ssh = login($usuario, $host, $keyUser);

    $ssh -> write($script."\n");
  }


}
