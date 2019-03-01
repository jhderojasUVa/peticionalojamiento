<?
/*	Modelo para Administradores */

class Admin_model extends CI_Model {

  function __construct() {
      // Constructoooooor
      parent::__construct();
      // Cargamos la base de datos
      $this -> load -> database();
  }

  public function esAdmin($idUsuario) {
      // Consulta si es admin o no

      $sql = "SELECT id FROM admin WHERE admin='".$idUsuario."'";
      $resultado = $this -> db -> query($sql);
      if ($resultado -> num_rows() > 0) {
        return true;
      }
      return false;
  }

}
