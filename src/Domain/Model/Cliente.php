<?php 

	namespace Weliton\Login\Domain\Model;

class Cliente
{
	private string $cliente;

	public function __construct(string $cliente)
	{
		$this->cliente = $cliente;
	}

	public function getCliente()
	{
		return $this->cliente;
	}
}