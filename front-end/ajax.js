$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})

$(document).ready(function () {
  $('#pergunta').hide();
})

var cd_form = 0;
$(document).on('click', '#cadastraForm', function () {
    //var dados = $('#meu').serialize();
    var nome_form = $('#name').val();
    var desc_form = $('#descricao').val();
    var data_abertura = $('#abertura').val();
    var categoria = $('#categoria').val();
    var data_fechamento = $('#fechamento').val();
    var cd_usuario = $('#id_usuario').val();
    cd_form = $('#id_form').val();

    console.log({
      nome_form,
      desc_form,
      data_abertura,
      data_fechamento,
      categoria,
      cd_usuario,
      cd_form
    });

    $.ajax({
        type: "POST",
        url: '../back-end/ajax.php',
        data: {
            "nome_form":nome_form,
            "desc_form":desc_form,
            "data_abertura":data_abertura,
            "categoria":categoria,
            "data_fechamento":data_fechamento,
            "cd_usuario":cd_usuario,
            "cd_form":cd_form
        },
        success: function (back) {
            alert(back)
        }
    });
    $('#form').hide();

    $('#pergunta').show();
});


// Pegando perguntas que o usuario cadastrar
var cd = 0;

// Define o codigo da pergunta
function set(id) {
    cd = id;
}

// Insere o codigo da pergunta
function get() {
    return cd;
}

function GravaPergunta(pergunta, id_tipo_pergunta, id_formulario) {
  console.log('Ok');
    $.ajax({
        type: "POST",
        url: '../back-end/ajax.php',
        data: {
            pergunta,
            id_tipo_pergunta,
            id_formulario
        },
        success: function (back) {
            set(back);
            console.log(get());
        }
    });
}

var curta = '';
var longa = '';
var m_escolha = '';
var c_selecao = '';
$(document).on('click', '#finalizar', function(){
  window.location.href = "exibe_form.php?logado";
})

$(document).on('click', '.campo', function () {
    var campo = "";
    var tipo = $(this).attr('val');

    switch (parseInt(tipo)) {
        case 1:
            curta = prompt('Qual é a pergunta?');
            if (curta.length <= 2) {
                alert(`Pergunta muito curta...`);
            } else {
                alert(`Pergunta salva!`);
                campo = '<div class="row pps"><form method="post" action="../back_end/processa.php"><h5 class="h5 text-left">' + curta + '</h5><div class="row"><input type="text" name="campo[]" class="form-control perguntasc" placeholder="' + curta + '" disabled></div></div><br>';
                GravaPergunta(curta, tipo, cd_form);
                setTimeout(function () {
                    GravaAlternativa(tipo, get());
                }, 3000);
            }
            break;
        case 2:
            longa = prompt('Qual é a pergunta?');
            if (longa.length <= 2) {
                alert(`Pergunta muito curta...`);
            } else {
                alert(`Pergunta salva!`);
                campo = '<div class="row"><h5 class="h5 text-left">' + longa + '</h5><div class="row pps"><textarea class="form-control perguntasl" name="campo[]" placeholder="' + longa + '" disabled></textarea></div></div><br>';
                GravaPergunta(longa, tipo, cd_form);
                setTimeout(function () {
                   GravaAlternativa(tipo, get());
                }, 3000);
            }
            break;
        case 3:
            m_escolha = prompt("Qual é a pergunta?");
            if (m_escolha.length <= 2) {
                alert(`Pergunta obrigatoria`);
            } else {
                alert(`Pergunta salva!`);
                campo = '<h5 class="h5 text-left">' + m_escolha + '</h5>';
              GravaPergunta(m_escolha, tipo, cd_form);
            }
            var qtd_me = parseInt(prompt('Quantas escolhas deseja?'));
            campo+='<div class="pps">'
            for (let i = 1; i <= qtd_me; i++) {
                var alternativa_me = prompt(`Digite a escolha ${i}:`);
                campo += '<div class="row ppz"><input type="radio" class="text-center" name="campo[]" disabled>' + alternativa_me[i] + '</div>';
                GravaAlternativa(alternativa_me, get());
            }
            campo+= '</div>'
            break;

        case 4:
            c_selecao = prompt("Qual é a pergunta?");
            if (c_selecao.length <= 2) {
                alert(`Pergunta obrigatoria`);
            } else {
                alert(`Pergunta salva!`);
                campo = '<h5 class="h5 text-left">' + c_selecao + '</h5>';
                GravaPergunta(c_selecao, tipo, cd_form);
            }
            var qtd_cx = parseInt(prompt('Quantas alternativas deseja?'));
            campo+='<div class="pps">'
            for (let i = 1; i <= qtd_cx; i++) {
                var alternativa_cx = prompt(`Digite a alternativa ${i}:`);
                campo += '<div class="row ppz"><input type="checkbox" class="text-left" name="campo[]" disabled>' + alternativa_cx[i] + '</div>';
                GravaAlternativa(alternativa_cx, get());
            }
            campo+= '<div>'
            break;
        default:
            break;
    };
    $('#conteudo').append(campo);
});

function GravaAlternativa(alternativa, id_pergunta) {
  console.log('ok');
    $.ajax({
        type: "POST",
        url: '../back-end/ajax.php',
        data: {
            "alternativa": alternativa,
            "id_pergunta": id_pergunta
        },
        success: function (back) {
            alert(back);
        }
    });
}
