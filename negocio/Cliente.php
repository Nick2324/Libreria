<?php

namespace Usuarios;

require_once ('Usuario.php');

use Usuarios;

class Cliente extends Usuario{

	private $idCliente;

	function __construct(){
	}

	function __destruct(){}

	public function calcularIdCliente(){
	}

	public function getIdCliente(){
            return $this->idCliente;
	}

	public function setIdCliente($idCliente){
            $this->idCliente = $idCliente;
	}

}
?>