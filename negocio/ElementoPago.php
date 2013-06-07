<?php

namespace Transacciones;

require_once ('Mensaje.php');

use Respuestas;

abstract class ElementoPago
{

	private $codigoElementoPago;
	private $consecutivo;
	private $fechaVencimiento;
	private $nombreElementoPago;

	function __construct()
	{
	}

	function __destruct()
	{
	}



	public function getCodigoElementoPago()
	{
	}

	public function getConsecutivo()
	{
	}

	public function getFechaVencimiento()
	{
	}

	public function getNombreElementoPago()
	{
	}

	/**
	 * 
	 * @param codigoElementoPago
	 */
	public function setCodigoElementoPago(String $codigoElementoPago)
	{
	}

	/**
	 * 
	 * @param consecutivo
	 */
	public function setConsecutivo(String $consecutivo)
	{
	}

	/**
	 * 
	 * @param fechaVencimiento
	 */
	public function setFechaVencimiento(String $fechaVencimiento)
	{
	}

	/**
	 * 
	 * @param nombreElementoPago
	 */
	public function setNombreElementoPago(String $nombreElementoPago)
	{
	}

	public function verificar()
	{
	}

}
?>