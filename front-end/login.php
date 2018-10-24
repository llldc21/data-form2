<?php
session_start();
include('../back-end/funcoes.php');

if(isset($_SESSION['UsuarioLog'])){
  header("location: user.php");
}

if ($_POST){
	Login($_POST['email'], $_POST['senha']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">
    <form action="login.php" method="post">
        <h2 class="text-center">Log in</h2>
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="E-mail" required="required">
        </div>
        <div class="form-group">
          <input type="password" name="senha" class="form-control" placeholder="Senha" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Entrar!</button>
        </div>
        <div class="clearfix">
            <a href="#" class="pull-right">Esqueceu a senha?</a>
        </div>
    </form>
    <p class="text-center"><a href="#">Criar uma conta</a></p>
</div>
</body>
</html>
