<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ws extends CI_Controller {

	public function __construct() {
		// Constructor!
		parent::__construct();

 }

	public function index() {
		// El principal esta vacio y le enviamos al principio por listo que eres un listo, LISTO
		echo "Esta pagina no se puede cargar directamente";
		echo "<script>window.location.href('/');</script>";
	}

	public function devuelveHosts() {
		// Cuando le dan al boton de entrar
		// Se mostrara un resumen de como andan sus peticiones

		// Primero el SSO, always! Al menos que hasta el WS le mande al guano
		$datos['usuario'] = $this -> ssouva -> login();

		$datos['hosts'] = $this -> host_model -> devuelveTodosHost();

		// Devolver el JSON
		header('Content-Type: application/json');
		// Escupimos la respuesta
    echo json_encode($datos);
	}

	public function devuelveTodosEstados() {
		// Devuelve todos los alojamientos de una persona no need for GET or POST

		// Primero el SSO, always! Al menos que hasta el WS le mande al guano
		$datos['usuario'] = $this -> ssouva -> login();

		$datos['estados'] = $this -> estados_model -> devuelveTodosEstados();
		// Devolver el JSON
		header('Content-Type: application/json');
		// Escupimos la respuesta
    echo json_encode($datos);
	}

	public function devuelveTodosAlojamientosPersona() {
		// Devuelve todos los alojamientos de una persona no need for GET or POST

		// Primero el SSO, always! Al menos que hasta el WS le mande al guano
		$datos['usuario'] = $this -> ssouva -> login();

		//$datos['alojamientosUsuario'] = $this -> alojamientos_model -> devuelveDatosAlojamiento($datos['usuario']);
		$datos['alojamientosUsuario'] = $this -> alojamientos_model -> devuelveDatosAlojamientoyBD($datos['usuario']);
		// Devolver el JSON
		header('Content-Type: application/json');
		// Escupimos la respuesta
    echo json_encode($datos);
	}

	public function datosAlojamiento($idAlojamiento) {
		// Devuelve los datos de un alojamiento concreto

		// Primero el SSO, always! Al menos que hasta el WS le mande al guano
		$datos['usuario'] = $this -> ssouva -> login();

		$datos['alojamiento'] = $this -> alojamientos_model -> verDatosAlojamiento($idAlojamiento);

		// Devolver el JSON
		header('Content-Type: application/json');
		if ($datos['usuario'] == $datos['alojamiento'][0] -> responsable) {
			// Escupimos la respuesta
	    echo json_encode($datos);
		} else {
			echo json_encode($datos['usuario']);
		}

	}

	public function datosBD($idAlojamiento) {
		// Devuelve los datos de una bd concreta

		// Primero el SSO, always! Al menos que hasta el WS le mande al guano
		$datos['usuario'] = $this -> ssouva -> login();

		$datos['bd'] = $this -> bd_model -> verDatosBd($idAlojamiento);

		// Devolver el JSON
		header('Content-Type: application/json');
		// Escupimos la respuesta
    echo json_encode($datos);
	}

	public function addalojamiento() {
		// Usuario quiere pupa nueva, alojamiento

		// Primero el SSO, always!
		$datos['usuario'] = $this -> ssouva -> login();

		// Sacamos los datos
		$datosPost = json_decode(file_get_contents('php://input'), true);

		// A la bd
		$datos['resultado'] = $this -> alojamientos_model -> addalojamiento($datosPost['host'], $datosPost['user'], $datosPost['password'], $datosPost['responsable'], $datosPost['emailContacto'], $datosPost['ip'], $datosPost['url'], $datosPost['alias'], $datosPost['descripcion']);

		// Devolver el JSON
		header('Content-Type: application/json');
		// Escupimos la respuesta
    echo json_encode($datos);
	}

	public function nuevoPassword() {
		// El usuario quiere un nuevo password

		// Primero el SSO, always!
		$datos['usuario'] = $this -> ssouva -> login();

		// Sacamos los datos
		$datosPost = json_decode(file_get_contents('php://input'), true);

		// Comprobamos si tiene permisos para hacer semejante atropelia
		if ($this -> alojamientos_model -> esElDuenyoAlojamiento($datosPost['id'], $datos['usuario'])) {
			// SiiiiiiIIIIIIiiiiiIIIIiii eres el pollo y has pedido un cambio de password

			// Ahora el nuevo password de un tiron
			$nuevoPassword = $this -> generarPassword(); // Password sin cochinadas
			$datos['resultado'] = $this -> alojamientos_model -> changeDatosAlojamiento($datosPost['id'], 'pass', $nuevoPassword);

			// Enviamos al responsable el email
			$emailContacto = $this -> alojamientos_model -> devuelveEmailContacto($datosPost['id']);

			// Sera necesario enviarle mas informacion al responsable?...

			// Pintamos el mail (aqui hay mucho que mejorar)
			$mensaje = 'Hola\r\nHa pedido un cambio de contraseña para el alojamiento el cual usted esta como responsable.\r\nSu nueva contraseña es: '.$nuevoPassword.'\r\nSi tiene cualquier duda, pongase en contacto con el Area Web para que le ayudemos.\r\nReciba un cordial saludo';
			$asunto = "Cambio de contraseña";
			// Y patapum que va el mail
			$this -> mail_UVa -> envia_mail($emailContacto, $asunto, $mensaje);

			// Y todo ha ido correcto... o no
			//$datos['resultado'] = true;
		} else {
			// NooooooooooOOOOOOoooooOOOOOoooooo
			$datos['resultado'] = false;
		}

		// Devolver el JSON
		header('Content-Type: application/json');
		// Escupimos la respuesta
    echo json_encode($datos);
	}

	public function nuevaBD() {
		// Funcion/Metodo/llamalo como quieras para pedir y crear una BD nueva
		// Primero el SSO, always!
		$datos['usuario'] = $this -> ssouva -> login();

		// Sacamos los datos
		$datosPost = json_decode(file_get_contents('php://input'), true);

		// ¿Lo puede hacer o viene el zorro a dar de comer a las gallinas?
		if ($this -> alojamientos_model -> esElDuenyoAlojamiento($datosPost['id'], $datos['usuario'])) {
			// Si puede

			// Generamos un password
			$nuevoPassword = $this -> generarPassword(); // Password sin cochinadas

			// Yogurt contra la BD
			$datos['resultado'] = $this -> bd_model -> addBd($datosPost['id'], $usuario, $nuevoPassword, $basedatos, $host);

			// Enviamos al responsable el email
			$emailContacto = $this -> alojamientos_model -> devuelveEmailContacto($datosPost['id']);

			// Pintamos el mail (aqui hay mucho que mejorar)
			$mensaje = "Hola\r\n\r\nSe ha creado una base de datos para su alojamiento. Los datos son los siguientes.\r\n\r\nHost: ".$host."\r\nUsuario: ".$usuario."\r\nPassword: ".$nuevoPassword."\r\nBase de datos: ".$basedatos."\r\n\r\n";
			$asunto = "Creacion de base de datos en alojamiento";
			// Y patapum que va el mail
			$this -> mail_UVa -> envia_mail($emailContacto, $asunto, $mensaje);

			// Y todo ha ido correcto
			//$datos['resultado'] = true;
		} else {
			// No puede
			$datos['resultado'] = false;
		}

		// Devolver el JSON
		header('Content-Type: application/json');
		// Escupimos la respuesta
    echo json_encode($datos);
	}

	public function enviaMail($idAlojamiento) {
		// Funcion publica que envia un correo con las cosas que el pollo quiere
		// Primero el SSO, always!
		$datos['usuario'] = $this -> ssouva -> login();

		// Sacamos los datos
		$datosPost = json_decode(file_get_contents('php://input'), true);

		// Enviamos al responsable el email
		$emailContacto = $this -> alojamientos_model -> devuelveEmailContacto($datosPost['id']);

		// Enviamos el correo
		$datos['resultado'] = $this -> email_UVa -> envia_mail_a_soporte($emailContacto, $datosPost['asunto'], $datosPost['texto']);

		// Devolver el JSON
		header('Content-Type: application/json');
		// Escupimos la respuesta
    echo json_encode($datos);
	}

	private function generarPassword() {
		// Funcion PRIVADA que genera un password de 16 caracteres
		$letrasPermitidasPassword = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		// Segundo el array que contiene el nuevo password
		$nuevoPasswordtmp = array();
		// Tercero saber hasta donde podemos contar
		$tamanyoPassword = strlen($letrasPermitidasPassword) - 1;
		for ($i = 0; $i < 16; $i++) {
			// Desde 0 hasta el tamaño del password nuevo
			// Coge un aleatorio de las letras
			$temp = rand(0, $tamanyoPassword);
			// Metemos la letra nueva
			$nuevoPasswordtmp[] = $letrasPermitidasPassword[$temp];
		}
		// Ahora el nuevo password de un tiron
		return implode($nuevoPasswordtmp);
	}

}
