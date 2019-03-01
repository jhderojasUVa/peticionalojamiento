<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
  // Este controlador tiene todo lo de añadir, es muy gordo y muy bonito

	public function __construct() {
		// Constructor!
		parent::__construct();

 }

	public function index() {
		// El principal esta vacio y le enviamos al principio por listo que eres un listo, LISTO
		echo "Esta pagina no se puede cargar directamente";
		echo "<script>window.location.href('/');</script>";
	}

	public function cambiarderopa() {
    // Funcion que cambia de ropa al pollo

    // Primero siempre comprobar que es de la uva y admin
    $datos["usuario"] = $this -> ssouva -> login();
    // Vamos a meter si es admin o no
		if (($this -> sesiones -> esAdmin($datos['usuario']) == true) && ($this -> sesiones -> fueAdminSesiones($datos["usuario"]) == true)) {
			// Bieeeeeeen es admin
      if ($this -> sesiones -> cambiaEstadoAdmin()) {
				// Al inicio como usuario
				header("location: http://peticionalojamientos.uva.es/index.php/principal/login");
			} else {
				// Mostramos un error como un piano, no deberia llegar nunca aqui pero...
				show_error("Error de narices. Algo para con Mary y las sesiones", 500, "Oh my gos!");
			}
		} else {
			// Ohhh no es admin
			show_error("Error de narices. Tu no deberias estar haciendo esto, colega", 200, "A donde vas, bacalao");
		}
  }
}
