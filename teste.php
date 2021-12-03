<?php 

use Weliton\Login\Domain\Model\{Mesa,Cliente, Email, Senha};
use Weliton\Login\Infra\Persistence\Connection;
use Weliton\Login\Infra\Repository\CadastraCliente;
use Weliton\Login\Infra\Repository\QueryBuilder;

require 'vendor/autoload.php';

$conexao = Connection::ConnSqlite('login');


$cad = new CadastraCliente($conexao);

// $email = new Email('reisergio@cantor.com.br','reisergio@cantor.com.br');

// $cad->verifyEmail($email)
// 	->data(['sergio ','reis'],$email,new Senha('Senha1234','Senha1234'))
// 	->get()
// 	;



//$sql = "DROP TABLE IF EXISTS users";

/*
$create = "
	CREATE TABLE IF NOT EXISTS users (
		idUser INTEGER PRIMARY KEY,
		nome TEXT NOT NULL,
		sobrenome TEXT NOT NULL,
		email TEXT NOT NULL,
		senha TEXT NOT NULL
	 );
";
var_dump($conexao->exec($create));

$query = new QueryBuilder($conexao);

//SELECT 
$result = $query
->columns(['*'])
//->columns(['email','idCliente'])
->from("users")
//->where('where','idEmail',2)
->get('select');


foreach($result as  $content){
	echo "#id: ".$content['idUser']. PHP_EOL;
	echo "nome: ".$content['nome']. PHP_EOL;
	echo "sobrenome: ".$content['sobrenome']. PHP_EOL;
	echo "email: ".$content['email']. PHP_EOL;
	echo "mensagem: ".$content['mensagem']. PHP_EOL;
}

*/