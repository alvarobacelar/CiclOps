

// faz verificacao das senhas
function verificaSenha() {
    var senha = document.cadastrar.inputSenha.value;
    var senha2 = document.cadastrar.inputSenha2.value;
    if (senha != senha2) {
        document.getElementById('erro-senha').innerHTML = "As senhas não correspondem";
        return false;
    } else
    if (senha == senha2) {
        document.getElementById('erro-senha').innerHTML = "";
        return true;
    }

}

function excluirUsuario(id) {

    var excluir = confirm("Deseja realmente excluir este Usuário?");

    if (excluir) {
        location.href = "includes/controllers/excluirUsuario.php?idExcluirUsuario=" + id;
    }
}

function excluirCidade(id) {

    var excluir = confirm("Deseja realmente excluir esta CIDADE?");

    if (excluir) {
        location.href = "includes/controllers/excluirCidade.php?idExcluirCidade=" + id;
    }
}

function excluirCarro(id) {

    var excluir = confirm("Deseja realmente excluir esse VEÍCULO??");

    if (excluir) {
        location.href = "includes/controllers/excluirCarro.php?idExcluirCarro=" + id;
    }
}

function excluirPipeiro(id) {

    var excluir = confirm("Deseja realmente excluir esse PIPEIRO??");

    if (excluir) {
        location.href = "includes/controllers/excluirPipeiro.php?id=" + id;
    }
}

function excluirRPS(id) {

    var excluir = confirm("Deseja realmente excluir essa RPS??");

    if (excluir) {
        location.href = "includes/controllers/excluirRPS.php?idExcluirRPS=" + id;
    }
}

$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

$('#exemplo').popover(options);

function excluiFileD(id) {

    var excluir = confirm("Tem certeza que deseja excluir o arquivo para deploy?");

    if (excluir) {
        location.href = "includes/controllers/excluirFileD.php?id=" + id;
    }
}

function excluiAgendamento(id) {

    var excluir = confirm("Tem certeza que deseja cancelar o agendamento para esse arquivo?");

    if (excluir) {
        location.href = "includes/controllers/excluirFileD.php?id=" + id;
    }
}