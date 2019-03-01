<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {
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

	public function addalojamiento() {
    // Añade un alojamiento en la BD y, seguramente terminara haciendo toda la mandanga

    // Primero pillamos los datos del estado del componente
    $datos["host"] = $this -> input -> post('host');
    $datos["user"] = $this -> input -> post('user');
    $datos["password"] = $this -> input -> post('password');
    $datos["responsable"] = $this -> input -> post('responsable');
    $datos["emailContacto"] = $this -> input -> post('emailContacto');
    $datos["ip"] = $this -> input -> post('ip');
    $_idestado = $this -> input -> post('idestado');
    $_url = $this -> input -> post('url');
    $_alias = $this -> input -> post('alias');
    $_fechaPeticion = $this -> input -> post('fechaPeticion');
    $_descripcion = $this -> input -> post('descripcion');

  }

}
