<?
/*	Modelo para Alojamientos */

class Estados_model extends CI_Model {

  function __construct() {
      // Constructoooooor
      parent::__construct();
      // Cargamos la base de datos
      $this -> load -> database();
    }

    function devuelveTodosEstados() {
      // Metodo/funcion que devuelve todos los hosts de la base de datos

      $sql = "SELECT id, estado, color FROM estado ORDER BY id";
      $resultado = $this -> db -> query($sql);
      return $resultado -> result();
    }

}
?>
