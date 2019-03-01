<?
/*	Modelo para Alojamientos */

class Host_model extends CI_Model {

  function __construct() {
      // Constructoooooor
      parent::__construct();
      // Cargamos la base de datos
      $this -> load -> database();
    }

    function devuelveTodosHost() {
      // Metodo/funcion que devuelve todos los hosts de la base de datos

      $sql = "SELECT id, hostName, ip, descripcion, active FROM host";
      $resultado = $this -> db -> query($sql);
      return $resultado -> result();
    }

}
?>
