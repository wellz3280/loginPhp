<?php

use Weliton\Login\Domain\Model\Email;
use Weliton\Login\Infra\Persistence\Connection;
use Weliton\Login\Infra\Repository\QueryBuilder;

require 'vendor/autoload.php';

	if($_SERVER['REQUEST_METHOD']=== 'POST'){
		
		$conn = Connection::ConnSqlite('login');

		$email = new Email($_POST['email']);
		if($email->validaEmail($_POST['email'],$_POST['redigiteEmail'])){
			$query = new QueryBuilder($conn);

			$data = [
				'idUser' => 1,
				'nome' => $_POST['nome'],
				'sobrenome' => $_POST['sobrenome'],
				'email' => $_POST['email'],
				'senha' => $_POST['senha']
			];
		
			$query->parameters($data)
			->from('users')
			->get('insert');
		 
			header('Location:index.php');

		}else{
			 $email->getEmail();
		
		}
		
	}

?>
<!Doctype html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="media/css/reset.css">
	<link rel="stylesheet" type="text/css" href="media/css/style.css">
	<title>Login </title>
</head>
<body>

	<header id="cadastrar">
       
	   <h1>Acesse o Repositório <a href="https://github.com/wellz3280/loginPhp">Git</a> deste Formulário </h1>
		
	</header>
	<main >
		<div class="formloginCadastrar">
		
			<form action="Cadastrar.php" method="post">

				<label for="nome"></label>
				<input type="text" id="nome" name="nome" placeholder="Nome" required>

				<label for="sobrenome"> </label>
				<input type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome" required>

				<label for="email"> </label>
				<input type="email" id="email" name="email" placeholder="Email" required>
				
				<label for="redigiteEmail"> </label>
				<input type="email" id="redigiteEmail" name="redigiteEmail" placeholder="Confirmar Email " required>

				<label for="senha"> </label>
				<input type="password" id="senha" name="senha" placeholder="Senha" required>

				<label for="contrasenha"> </label>
				<input type="password" id="contrasenha" name="contrasenha" placeholder="Confirmar Senha " required>
				
				<button type="submit">Cadastrar</button>

				
					
			</form>
		</div>

		
	</main>
	<footer>
		
	</footer>

</body>
</html>