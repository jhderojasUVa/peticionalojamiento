<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Clase de calendario que hace todas las funciones de correo

class Mail_UVa {

	function __construct() {
		$this -> CI = &get_instance();
	}

	function envia_mail($usuario, $asunto, $texto) {
		// Funcion que envia un correo a un usuario con un asunto y le mete la firma chachi a traves
		// de un correo no-reply@uva.es

		// Devuelve true si no hay problema
		// Devuelve false si hay problema

		$cabecera = "From: soporte-web@uva.es" . "\r\n" .
  					"Reply-To: soporte-web@uva.es" . "\r\n" .
 					"X-Mailer: PHP/" . phpversion();

		$firma = "\r\n\r\n\r\n".
				 "------------------------------------------------\r\n".
				 "Area Web\r\n".
				 "Universidad de Valladolid\r\n".
				 "http://ipa.uva.es";

		$texto = trim($texto)."\r\n".$firma;

		//mail($usuario, $asunto, $texto, $cabecera);
		//mail($usuario, $asunto, $texto, $cabecera);
		if (mail($usuario, $asunto, $texto, $cabecera)) {
			return true;
		} else {
			return false;
		}
	}

}
