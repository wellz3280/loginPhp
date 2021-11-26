<?php 

	namespace Weliton\Login\Domain\Model;

	use Weliton\Login\Domain\Model\Cliente;
	//use Weliton\Login\Domain\Model\Client;

class Mesa
{
	private int $abreMesa;
	private string $garcon;
	private Cliente $cliente;
	private Produto $pedidos;
	private int $divididoPor;

	public function __construct(int $abreMesa, Cliente $cliente, string $garcon)
	{
	    $this->abreMesa = $abreMesa;
	   	$this->cliente= $cliente;
		$this->garcon = $garcon;
	}

	public function conta(Cliente $cliente, Produto $pedidos):array|string
	{
		echo $cliente->getCliente();

	}

	
	public function getMesa()
	{
	    return $this->abreMesa;
	}


	public function getGarcon()
	{
	    return $this->garcon;
	}

}


