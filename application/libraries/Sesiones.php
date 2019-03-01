<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sesiones {
  // Objeto de sesiones

  function __construct() {
    $this-> CI =& get_instance();
    $this -> CI -> load -> model('Admin_model');

    session_start();
  }

  public function setAdmin() {
    $_SESSION['esAdmin'] = true;
    $_SESSION['fueAdmin'] = true;
  }

  public function esAdmin($usuario) {
    // Comprueba si es admin
    // Devuelve true si lo es y false si no
    // Esta es de obligado cumplimiento, si, porque es la unica que revisa en la BD el usuario

    if (is_null(get_cookie('esAdmin')) || get_cookie('esAdmin') == false) {
      // Si no tiene la cookie o no es admin, lo comprobamos
      return $this -> CI -> admin_model -> esAdmin($usuario);
    }
    return true;
  }

  public function esAdminSesiones() {
    // Comprueba si es admin por las sesiones
    if (isset($_SESSION['esAdmin']) && $_SESSION['esAdmin'] == true) {
      return true;
    }
    return false;
  }

  public function fueAdminSesiones() {
    // Comprueba si era admin
    if (isset($_SESSION['fueAdmin']) && $_SESSION['fueAdmin'] == true) {
      return true;
    }
    return false;
  }

  public function esAdminCookie($usuario) {
    // Comprueba y de paso, mete la cookie de es y era

    if ($this -> CI -> admin_model -> esAdmin($usuario)) {
      // Primero las borramos que fiate de la virgen y no corras
      unset($_SESSION['esAdmin']);
      unset($_SESSION['fueAdmin']);

      // Y luego las creamos, porque nuevas, saben mejjor
      $_SESSION['esAdmin'] = true;
      $_SESSION['fueAdmin'] = true;
      return true;
    }
    return false;
  }

  public function cambiaEstadoAdmin() {
    // Cambia de si fue admin o no
    // Hace lo que tenga que hacer y si lo ha hecho, retorna true
    // Si hay caca o tu de que vas barrabash, retorna false

    //echo "fue=".$_SESSION['fueAdmin']."<br>";
    //echo "es=".$_SESSION['esAdmin']."<br>";

    if ($_SESSION['fueAdmin'] == true && $_SESSION['esAdmin'] == false) {
      // Si lo fue, le ponemos que si
      unset($_SESSION['esAdmin']);
      $_SESSION['esAdmin'] = true;
      return true;
    } else if ($_SESSION['fueAdmin'] == true && $_SESSION['esAdmin'] == true) {
      // Sino, nos la cargamos y la creamos de nuevo diciendo que lo es
      unset($_SESSION['esAdmin']);
      $_SESSION['esAdmin'] = false;
      //echo "esv2=".$_SESSION['esAdmin']."<br>";
      return true;
    }
    return false;
  }

  public function matarSesion() {
    // Matamos todas las sesiones
    unset($_SESSION['esAdmin']);
    unset($_SESSION['fueAdmin']);
  }
}
