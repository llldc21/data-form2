<?php
if (isset($_GET['logado'])) {
  session_start();
}

include '../back-end/funcoes.php';
?>


<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Formulario</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  </head>
  <body>
    <form class="" action="index.html" method="post">
      <div class="container">
        <div class="col-md-12 text-center">
          <?php
            $geral = DadosGeraisFormulario($_SESSION['cd']);
            $g = $geral->fetch_assoc();
            echo '<h3 class="h3">'.$g['NM_FORMULARIO'].'</h3><br>';
            echo '<h2 class="h2">'.$g['DS_FORMULARIO'].'</h2><br>';
            echo '<h2 class="h2">'.$g['DT_ABERTURA_FORM'].'</h2><br>';
            echo '<h2 class="h2">'.$g['DT_FECHAMENTO_FORM'].'</h2><br>';
            // Falta pergunta e alternativa
          ?>
        </div>

      </div>
    </form>
  </body>
</html>
