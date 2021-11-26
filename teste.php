<?php 

use Weliton\Login\Domain\Model\{Mesa,Cliente};
use Weliton\Login\Infra\Persistence\Connection;
use Weliton\Login\Infra\Repository\QueryBuilder;

require 'vendor/autoload.php';

$conexao = Connection::ConnSqlite('login');

/*
$create = "
	CREATE TABLE users (
		idUser INTEGER PRIMARY KEY,
		nome TEXT NOT NULL,
		sobrenome TEXT NOT NULL,
		email TEXT NOT NULL,
		mensagem TEXT
	 );
";
*/

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