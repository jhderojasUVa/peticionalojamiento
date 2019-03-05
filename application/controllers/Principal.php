<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	public function __construct() {
		// Constructor!
		parent::__construct();

 }

	public function index() {
		// Landing
		$this -> load -> view('cabecera');
		$this -> load -> view('principal');
		// No, no... footer no
		// Consuela Style
		// https://www.youtube.com/watch?v=4sGxSOaliuE
		// https://www.youtube.com/watch?v=In2K0J7daQo
		//$this -> load -> view('footer');
	}

	public function login() {
		// Cuando le dan al boton de entrar
		// Se mostrara un resumen de como andan sus peticiones

		// Primero el SSO, always!
		$datos['usuario'] = $this -> ssouva -> login();

		// Vamos a meter si es admin o no, seguro que todo esto se puede mejorar un porron
		if (($this -> sesiones -> esAdmin($datos['usuario'])) && ($this -> sesiones -> fueAdminSesiones()) == false) {
			// Es admin y hay que hacerle las cochinadas
			$this -> sesiones -> setAdmin();
		}

		// Puesta la sesion en el sitio correcto...
		if (($this -> sesiones -> esAdminSesiones()) && ($this -> sesiones -> fueAdminSesiones())) {
			// Bieeeeeeen es admin
			$this -> sesiones -> esAdminCookie($datos['usuario']);
			$this -> load -> view('doc/cabecera');
			$this -> load -> view('doc/principal');
		} else {
			// Ohhh no es admin o no quiere parecerlo
			$this -> load -> view('cabecera');
			$this -> load -> view('login', $datos);
			$this -> load -> view('footer');
		}
	}

	public function salir() {
		// Funcion para salir

		// Matar las sesiones
		$this -> sesiones -> matarSesion();
		// Enviar al logout del SSO
		$this -> ssouva -> logout();
	}

	public function new() {
		// Nueva peticion!

		// Primero el SSO, always!
		$datos['usuario'] = $this -> ssouva -> login();

		$datos['alojamientos'] = $this -> alojamientos_model -> devuelveTodosAlojamientosPersona($datos['usuario']);

		$this -> load -> view('cabecera');
		$this -> load -> view('new', $datos);
		$this -> load -> view('footer');
	}

	public function verDatosAlojamiento($idalojamiento) {
		// Devuelve todos los datos de un alojamiento concreto

		// Primero el SSO, always! Al menos que hasta el WS le mande al guano
		$datos['usuario'] = $this -> ssouva -> login();

		$this -> load -> view('cabecera');
		$this -> load -> view('alojamiento', $datos);
		$this -> load -> view('footer');
	}

	public function otras($idalojamiento) {
		// Llama a la funcion que muestra

		// Primero el SSO, always! Al menos que hasta el WS le mande al guano
		$datos['usuario'] = $this -> ssouva -> login();

		$datos['idalojamiento'] = $idalojamiento;

		$this -> load -> view('cabecera');
		$this -> load -> view('otras', $datos);
		$this -> load -> view('footer');
	}

}
