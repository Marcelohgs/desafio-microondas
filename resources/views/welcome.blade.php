<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Styles -->
    </head>
    <body>
    <div class="microwave">
        <!-- Pezinhos -->
        <div class="foot left-foot"></div>
        <div class="foot right-foot"></div>

        <!-- Porta do Microondas -->
        <div class="door">
            <div class="door-window"></div>
            <div class="handle"></div>
        </div>

        <!-- Painel de Controle -->
        <div class="control-panel">
            <div class="inline"> 
            <p>Tempo</p>
            <input class="display" id="display" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="00:00" />
            <p>Potencia</p>
            <!-- <input class="display" id="potencia-display"  maxlength="2" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="00" /> -->
            <input class="display" id="potencia-display"  maxlength="2" type="number" min="1" max="10"  placeholder="00" oninput="validarMaxLength(this)" />

            </div>
            
            <div id="buttons-control" class="controls">
                <button id="add" type="button" class="btn btn-primary">Criar Potência</button>
                <button id="btnPipoca" class="button">Pipoca</button>
                <button id="btnLeite" class="button">Leite</button>
                <button id="btnCarnes" class="button">Carnes</button>
                <button id="btnFrango" class="button">Frango</button>
                <button id="btnFeijao" class="button">Feijão</button>
            </div>

            <br>
            <div  class="controls">
                <button id="btn1" class="button">1</button>
                <button id="btn2" class="button">2</button>
                <button id="btn3" class="button">3</button>
                <button id="btn4" class="button">4</button>
                <button id="btn5" class="button">5</button>
                <button id="btn6" class="button">6</button>
                <button id="btn7" class="button">7</button>
                <button id="btn8" class="button">8</button>
                <button id="btn9" class="button">9</button>
                <button id="btn0" class="button">0</button>
                <button id="start" class="button start">Iniciar</button>
                <button id="stop" class="button stop">Parar</button>
                <button id="restart" class="button restart">Reiniciar</button>
  
            </div>
        </div>
    </div>

    <div id="panel-programa" class="panel-programa" style="display: none">
        <div class="input-group mb-3">
            <input id="input-nome" type="text" class="form-control" placeholder="Nome" required>
        </div>
        <div class="input-group mb-3">
            <input id="input-alimento" type="text" class="form-control" placeholder="Alimento" required>
        </div>
        <div class="input-group mb-3">
            <input id="input-tempo" type="text" class="form-control" placeholder="Tempo" required>
        </div>
        <div class="input-group mb-3">
            <input id="input-potencia" type="number" class="form-control" min="0" max="10" placeholder="Potência" required>
        </div>
        <div class="input-group mb-3">
            <input id="input-instrucoes" type="text" class="form-control" placeholder="Instruções">
        </div>

        <button id="cadastrar-programa" type="button" class="btn btn-primary button-programa">Criar Programa</button>
        <button id="fechar-div-programa" type="button" class="btn btn-danger button-programa">Cancelar</button>

    </div>
    <div id="instructions" class="instructions"></div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    </body>
</html>

<script>
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
                url: "http://localhost:8000/api/create",
                data: body,
                beforeSend: function () {
                    console.log('enviando....');
                }
            })
                .done(function (msg) {
                    console.log(msg);
                    if (msg.success){
                        console.log('Programa de aquecimento cadastrado com sucesso');
                        alert('Programa de aquecimento cadastrado com sucesso');
                        ListarNovoProgramaAquecimento(msg.data);
                    }else{
                        console.log(msg);
                    }
                })
                .fail(function (jqXHR, textSatus, msg) {
                    var message = jqXHR.responseJSON.data;
                    console.log(message);
                });
        })

    function AutenticarUsuario() {

    }

    function ListarNovoProgramaAquecimento(body) {
    // Verificando se o parâmetro "body" possui dados
    if (body && body.alimento && body.nome) {
        // Usando template literal para incluir dados no conteúdo do botão
        var button = `<button id="restart" class="button" style="color: yellow">
                      <i>${body.nome}</i>
                      </button>`;
        
        // Adicionando o botão ao elemento com id "controls"
        $("#buttons-control").append(button);
        console.log('criou button');
    } else {
        console.error("Dados incompletos para criar o botão.");
    }
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

</script>
