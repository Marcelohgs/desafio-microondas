
var data = new Object;
function setConfiguracoes(potencia,  tempoAquecimento, inicioRapido = false){
    let display = $('#display');
    data.potencia = potencia;
    data.tempo = tempoAquecimento;

    if (inicioRapido){
        let minutos = tempoAquecimento.slice(0, 2);
        let segundos = tempoAquecimento.slice(2, 4);
    }
    else{
        display.val(tempoAquecimento);
    }

}

function setInicioRapido(){
    setConfiguracoes(10 , "0030", true);
}

function DisabledControls(){
    console.log('desativar edições');
}

$(document).ready(function() {
    let display = $('#display');
    let tempo = '';

    $('#add').on('click', function () {
        $('#panel-programa').toggle();
    })

    $('#fechar-div-programa').on('click', function () {
        $('#panel-programa').toggle();
    })

    $('#cadastrar-programa').on('click',function () {
        let body = new Object();
        body.nome = $('#input-nome').val();
        body.alimento = $('#input-alimento').val();
        body.tempo =  $('#input-tempo').val();
        body.potencia = $('#input-potencia').val();
        body.instrucoes = $('#input-instrucoes').val();

        $.ajax({
            method : "POST",
            url: "http://127.0.0.1:8000/api/create",
            data: body,
            beforeSend: function () {
                console.log('enviando....');
            }
            })
            .done(function (msg) {
                if (msg.success){
                    alert('Programa de aquecimento cadastrado com sucesso');
                    $('#panel-programa').toggle();
                    window.location.href = '/';
                }else{
                   alert(msg);
                }
            })
            .fail(function (jqXHR, textSatus, msg) {
                var message = jqXHR.responseJSON.data;
                alert(message);
            });
    })
    $('#display').on('input', function() {
        let inputValue = $(this).val();

        console.log(inputValue)
    });

        $('.button').filter('#restart, #btn0, #btn1, #btn2 , #btn3,  #btn4, #btn5, #btn6, #btn7,#btn8, #btn9').click(function() {
            try {
                let value = $(this).text();

                tempo = tempo+ value;
                console.log(tempo)
                if (tempo.length > 4){
                    display.val('');
                    tempo = '';
                    return;
                }
                console.log(tempo)


                if (value === 'Reiniciar'){
                    tempo = '0000';
                    display.val('00:00');
                    return;
                }

                if (tempo.length === 1){
                    value = tempo+'0:00';
                }
                if (tempo.length === 2){
                    value = tempo+':00';
                }
                if (tempo.length === 3){
                    value = tempo.slice(0,2) +':'+ tempo.slice(2,3);
                    value = value+'0';
                }
                if (tempo.length === 4){
                    value = tempo.slice(0,2) +':'+ tempo.slice(2,4);
                }

                var tempoInteger = parseInt(value.slice(0,2));
                if (tempoInteger > 2){
                    alert('Tempo não permitido. Maior que 2 minutos!!!');
                    display.val('00:00');
                    tempo = '';
                    tempoInteger = '';
                    return;
                }

                display.val(value);
            } catch (error) {
                display.val('00:00');
            }
    });

   document.getElementById('btnPipoca').addEventListener('click', function() {$('.instructions').show();
    setConfiguracoes(7, '03:00'); // Potência 7 e 3 minutos
    document.getElementById('instructions').innerHTML = `
        <h2>Pipoca</h2>
        <p><strong>Alimento:</strong> Pipoca (de micro-ondas)</p>
        <p><strong>Tempo:</strong> 3 minutos</p>
        <p><strong>Potência:</strong> 7</p>
        <p><strong>Instruções:</strong></p>
        <p>Observar o barulho de estouros do milho,</p>
        <p>caso houver um intervalo de mais de 10 segundos entre um estouro e outro</p>
        <p>interrompa o aquecimento</p>
    `;
    DisabledControls();
});

document.getElementById('btnLeite').addEventListener('click', function() {
    $('.instructions').show();
    setConfiguracoes(5, '05:00'); // Potência 5 e 5 minutos
    document.getElementById('instructions').innerHTML = `
        <h2>Leite</h2>
        <p><strong>Alimento:</strong> Leite</p>
        <p><strong>Tempo:</strong> 5 minutos</p>
        <p><strong>Potência:</strong> 5</p>
        <p><strong>Instruções:</strong></p>
        <p>Cuidado com aquecimento de líquidos</p>
        <p>O choque térmico aliado ao movimento do recipiente pode causar fervura imediata</p>
        <p>causando risco de queimaduras</p>
    `;
    DisabledControls();
});

document.getElementById('btnCarnes').addEventListener('click', function() {
    $('.instructions').show();
    setConfiguracoes(4, '14:00'); // Potência 4 e 14 minutos
    document.getElementById('instructions').innerHTML = `
        <h2>Carnes de boi</h2>
        <p><strong>Alimento:</strong> Carne em pedaço ou fatias</p>
        <p><strong>Tempo:</strong> 14 minutos</p>
        <p><strong>Potência:</strong> 4</p>
        <p><strong>Instruções:</strong></p>
        <p>Interrompa o processo na metade</p>
        <p>e vire o conteúdo com a parte de baixo para cima</p>
        <p>para o descongelamento uniforme</p>
    `;
    DisabledControls();
});

document.getElementById('btnFrango').addEventListener('click', function() {
    $('.instructions').show();
    setConfiguracoes(7, '08:00'); // Potência 7 e 8 minutos
    document.getElementById('instructions').innerHTML = `
        <h2>Frango</h2>
        <p><strong>Alimento:</strong> Frango (qualquer corte)</p>
        <p><strong>Tempo:</strong> 8 minutos</p>
        <p><strong>Potência:</strong> 7</p>
        <p><strong>Instruções:</strong></p>
        <p>Interrompa o processo na metade</p>
        <p>e vire o conteúdo com a parte de baixo para cima</p>
        <p>para o descongelamento uniforme</p>
    `;
    DisabledControls();
});

document.getElementById('btnFeijao').addEventListener('click', function() {
    $('.instructions').show();
    setConfiguracoes(9, '08:00');
    document.getElementById('instructions').innerHTML = `
        <h2>Feijão</h2>
        <p><strong>Alimento:</strong> Feijão congelado</p>
        <p><strong>Tempo:</strong> 8 minutos</p>
        <p><strong>Potência:</strong> 9</p>
        <p><strong>Instruções:</strong></p>
        <p>Deixe o recipiente destampado</p>
        <p>e em casos de plástico, cuidado ao retirar o recipiente</p>
        <p>pois o mesmo pode perder resistência em altas temperaturas</p>
    `;
    DisabledControls();
});

});

//Funcions globais
function AbrirInstrucoes(body) {
    $('.instructions').show();
    setConfiguracoes(body.potencia, body.tempo); // Potência 7 e 3 minutos
    document.getElementById('instructions').innerHTML = `
        <h2>${body.nome}</h2>
        <p><strong>Alimento:</strong> ${body.alimento}</p>
        <p><strong>Tempo:</strong> ${body.tempo}</p>
        <p><strong>Potência:</strong> ${body.potencia}</p>
        <p><strong>Instruções:</strong> ${body.instrucoes}</p>
        <p> ${body.nome}</p>
        <button id="btn-excluir" class="btn btn-danger" onclick="ExcluirPrograma(${body.id })">Excluir</button>
        <button id="btn-fechar" class="btn btn-success" onclick="FecharModal()">Fechar</button>
    `;
    DisabledControls();
}

function AutenticarUsuario() {
    var body = new Object;
    body.email = 'marcello_ike@hotmail.com';
    body.password = '1234';
    $.ajax({
        method: 'post',
        url: "http://127.0.0.1:8000/api/auth/login",
        data : body
    })
    .done(function(msg){
        console.log('autenticou');
        console.log(msg);
    })
    .fail(function (jqXHR, textSatus, msg) {
        console.log('nao autenticou');
        console.log(jqXHR);
    })
}

function validarMaxLength(input) {
    if (input.value.length > 2) {
        input.value = input.value.slice(0, 2);
    }
    let valor = input.value;

    if (valor < 10 && valor.length === 1) {
        input.value = valor;
    }

    if (valor > 10) {
        input.value = '10';
    }

    if (valor < 1) {
        input.value = '01';
    }
}

function FecharModal() {
    $('.instructions').toggle();
}

function ExcluirPrograma(id) {
    if (confirm('Tem certeza que deseja excluir o programa?')) { // Usando confirm()
        $.ajax({
            method: 'DELETE',
            url: "http://127.0.0.1:8000/api/delete/" + id,
        })
        .done(function (msg) {
            console.log(msg);
            if (msg.success) {
                alert('Programa de aquecimento Deletado com sucesso');
                window.location.href = '/';
            } else {
                alert('Erro ao deletar Programa de aquecimento');
            }
        })
        .fail(function (jqXHR, textSatus, msg) {
            var message = jqXHR.responseJSON.data;
            console.log(message);
        });
    } else {

        alert('Exclusão cancelada pelo usuário.');
    }
}

var intervalo = '';
function iniciarContador() {
    const inputContador = document.getElementById('display');
    let tempo = inputContador.value;
    function atualizarContador() {
      let minutos = parseInt(tempo.split(':')[0]);
      let segundos = parseInt(tempo.split(':')[1]);

      if (segundos === 0) {
        if (minutos === 0) {
          clearInterval(intervalo);
          return;
        }
        minutos--;
        segundos = 59;
      } else {
        segundos--;
      }

      const minutosFormatados = minutos.toString().padStart(2, '0');
      const segundosFormatados = segundos.toString().padStart(2, '0');
      tempo = `${minutosFormatados}:${segundosFormatados}`;
      inputContador.value = tempo;
    }

    intervalo = setInterval(atualizarContador, 1000);
  }

  function pararContador(){
    clearInterval(intervalo);
  }
