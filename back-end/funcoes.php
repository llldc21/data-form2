<?php
include('conexao.php');

// Funcões de cadastro/Login
function CadastraUsuario($nome, $email, $nascimento, $senha, $img_usuario) {
    if ($img_usuario) {
        // Modificando a data
        $n_nascimento = @date('Y/m/d', strtotime($nascimento));
        // Encryptando senha
        $encriptada = Encriptar($senha);
        // Salvando foto do usuario
        if (isset($img_usuario)) {
            $ext = explode('.', $img_usuario['name']);
            $novo_nome = $email.'.'.$ext[1];
            $caminho = '../back-end/fotos/'.$novo_nome;
            move_uploaded_file($img_usuario['tmp_name'], $caminho); //Faz upload do arquivo
        };
        $sql = 'INSERT INTO `TB_USUARIO`(`CD_USUARIO`, `NM_USUARIO`, `DS_EMAIL`, `DT_NASCIMENTO`, `DS_SENHA`, `DS_EMAIL_RECUPERACAO`, `IMG_USUARIO`) VALUES (null, "'.$nome.'", "'.$email.'", "'.$n_nascimento.'", "'.$encriptada.'", "'.$email.'","'.$caminho.'")';
        $res = $GLOBALS['conn']->query($sql);
        if ($res) {
            echo alert('Cadastro realizado!');
            echo "<script> window.location='login.php' </script>";
        }else{
            echo alert('Erro ao cadastrar!');
            echo "<script> window.location='cadastro.php' </script>";
        };
    };

};
function Login($email, $senha){
    // Dencryptando a senha
    $encriptada = Encriptar($senha);
    $sql = 'SELECT *  FROM `TB_USUARIO` WHERE `DS_EMAIL` = "'.$email.'" AND `DS_SENHA` = "'.$encriptada.'"';
    echo $sql;
    $res = $GLOBALS['conn']->query($sql);
    if($res->num_rows>0){
        $usuario = $res->fetch_array();
        // Abrindo sessão
        $_SESSION['UsuarioLog'] = true;
        $_SESSION['email'] = $usuario ['DS_EMAIL'];
        $_SESSION['cd'] = $usuario ['CD_USUARIO'];
        $_SESSION['senha'] = $usuario['DS_SENHA'];
        header("location: user.php");
    }else{
        echo alert('Erro ao logar-se!');
    };
};
function CadastrarFormulario(){
  $sql = 	'INSERT INTO TB_FORMULARIO VALUES (null, "Meu form", null, null, '.$_SESSION['cd'].', 1, "Descreva...")';
	$res = $GLOBALS['conn']->query($sql);
	if($res){
    $_SESSION['form'] = $GLOBALS['conn']->insert_id;
  }else{
	  echo "Erro ao cadastrar";
	}
};
function CadastraPerguntas($pergunta, $id_tipo_pergunta, $id_form){
    $sql = 'INSERT INTO `TB_PERGUNTA` VALUES (null,"'.$pergunta.'" ,"'.$id_tipo_pergunta.'","'.$id_form.'")';
    $res = $GLOBALS['conn']->query($sql);
    if($res){
        echo $GLOBALS['conn']->insert_id;
    }else{
        echo 'Erro';
    }
};
function CadastrarAlternativa($alternativa, $id_pergunta){
    $sql = 'INSERT INTO `TB_ALTERNATIVA` VALUES (null,"'.$alternativa.'",'.$id_pergunta.')';
    $res = $GLOBALS['conn']->query($sql);
    if ($res) {
        // echo 'OK';
    }else{
        echo $sql;
    }
}


// Funcões para atualizar
function AtualizaForm($nome_form, $data_abertura, $data_fechamento, $id_categoria, $ds_form, $id_usuario, $cd_form){
    $data_abertura = @date('Y/m/d', strtotime($data_abertura));
    $data_fechamento = @date('Y/m/d', strtotime($data_fechamento));
    $sql = "UPDATE `TB_FORMULARIO` SET `NM_FORMULARIO`= '$nome_form', `DT_ABERTURA_FORM`= '$data_abertura', `DT_FECHAMENTO_FORM`='$data_fechamento', `ID_CATEGORIA` = '$id_categoria', `DS_FORMULARIO`= '$ds_form' WHERE `ID_USUARIO` = '$id_usuario' AND `CD_FORMULARIO` = '$cd_form'";
    $res = $GLOBALS['conn']->query($sql);
    if ($res) {
        echo 'Cadastrado com sucesso!';
    }else{
        echo '<script> alert("Erro"); </script>';
    }
};

// Funções para listar
function DadosUsuario($id_usuario){
  $sql = "SELECT * FROM `TB_USUARIO` WHERE `CD_USUARIO`=".$id_usuario;
  $res = $GLOBALS['conn']->query($sql);
  return $res;
}
function DadosFormulario($id_usuario){
  $sql = "SELECT * FROM `TB_FORMULARIO` WHERE `ID_USUARIO` =".$id_usuario;
  $res = $GLOBALS['conn']->query($sql);
  return $res;
}
function DadosCategoria(){
  $sql = 'SELECT * FROM `TB_CATEGORIA`';
  $res = $GLOBALS['conn']->query($sql);
  return $res;
}
function DadosTipoPergunta(){
  $sql = "SELECT * FROM `TB_TIPO_PERGUNTA`";
  $res = $GLOBALS['conn']->query($sql);
  return $res;
}
function DadosGeraisFormulario($id_usuario){
  $sql = "SELECT TB_FORMULARIO.NM_FORMULARIO, TB_FORMULARIO.DT_ABERTURA_FORM, TB_FORMULARIO.DT_FECHAMENTO_FORM, TB_FORMULARIO.DS_FORMULARIO, TB_PERGUNTA.NM_PERGUNTA, TB_ALTERNATIVA.NM_ALTERNATIVA FROM TB_FORMULARIO, TB_PERGUNTA, TB_ALTERNATIVA, TB_USUARIO WHERE TB_USUARIO.CD_USUARIO = TB_FORMULARIO.ID_USUARIO AND TB_FORMULARIO.CD_FORMULARIO = TB_PERGUNTA.ID_FORMULARIO AND TB_PERGUNTA.CD_PERGUNTA = TB_ALTERNATIVA.CD_ALTERNATIVA AND TB_USUARIO.CD_USUARIO=".$id_usuario;
  $res = $GLOBALS['conn']->query($sql);
  return $res;
}

# Administração
function Encriptar($valor){
  $encriptada = md5($valor);
  return $encriptada;
};
function alert($mensagem){
  echo '<script>alert("'.$mensagem.'")</script>';
}
?>
