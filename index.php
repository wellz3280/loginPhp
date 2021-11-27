<?php
	if($_SERVER['REQUEST_METHOD']=== 'POST'){
		if($_POST['usuario'] == "wellz3280" && $_POST['senha']== "well1006")
		{
			echo "Bem vindo {$_POST['usuario']}";
		}else{
			echo "usuario ou senha invalidos";
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

	<header>
		<h1>Acesse o Repositório <a href="https://github.com/wellz3280/loginPhp">Git</a> deste Formulário </h1>
	</header>
	<main>
		<div class="formlogin">
			<h1>Login </h1>
			<form action="index.php" method="post">

				<label for="usuario"></label>
				<input type="text" id="usuario" name="usuario" placeholder="Email ou Usuário" required>

				<label for="senha"> </label>
				<input type="password" id="senha" name="senha" placeholder="Senha" required>

				<button type="submit">Entrar</button>

					<p>
						
						<a href="Cadastrar.php">Cadastre -se </a>
					
					</p>
				
					
			</form>
		</div>

		
	</main>
	<footer>
		
	</footer>

</body>
</html>