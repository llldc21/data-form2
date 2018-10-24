<?php
session_start();
include '../back-end/funcoes.php';
?>
<link rel="stylesheet" href="/css/main.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!--
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
-->
<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="../index.php?logado">DataForm</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
      <li><a href="../back-end/sair.php">Sair</a></li>
    </ul>

    <div class="col-sm-3 col-md-3 nav navbar-right">
        <form class="navbar-form" role="search">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="q">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        </form>
    </div>
  </div><!-- /.navbar-collapse -->
</nav>


<div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
          <br>
          <?php
            $dados = DadosUsuario($_SESSION['cd']);
            while ($dado = $dados->fetch_array()) {
              echo '<img src="'.$dado['IMG_USUARIO'].'" class="img-responsive" alt="">';
            };
          ?>
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?php
              $dados = DadosUsuario($_SESSION['cd']);
              while ($dado = $dados->fetch_array()) {
                echo "<h3><b>".$dado['NM_USUARIO']."</b></h3>";
              };
            ?>
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Seguir</button>
					<button type="button" class="btn btn-danger btn-sm">Mensagem</button>
				</div>
				<!-- END SIDEBAR BUTTONS -->
        <br>
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="nav-item">
							<a href="#">
							<i class="glyphicon glyphicon-user"></i>
							Configuração de conta </a>
						</li>
						<li class="nav-item">
							<a href="forms.php?criar">
							<i class="glyphicon glyphicon-ok"></i>
							Criar Formulário </a>
						</li>
						<li class="nav-item">
							<a href="#">
							<i class="glyphicon glyphicon-flag"></i>
							Manual </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content">
              <br>
              <h2>Meus Formulários</h2>
              <hr>
			           <div class="row">
                   <?php
                   $forms = DadosFormulario($_SESSION['cd']);
                   while ($form = $forms->fetch_array()) {
                     echo '
                     <div class="col-md-4" id="card">
                      <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h3 class="card-title">'.$form['NM_FORMULARIO'].'</h3>
                          <p class="card-text">'.$form['DS_FORMULARIO'].'</p>
                          <a href="#" class="btn btn-block btn-success">Editar</a>
                          <a href="#" class="btn btn-block btn-danger">Apagar</a>
                         </div>
                       </div>
                     </div>';
                   };
                   ?>
                 </div>
            </div>
		</div>
	</div>
</div>
<style media="screen">
  #card{
    margin-top: 10px;
  }
</style>
