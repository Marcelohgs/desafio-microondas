<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Microondas</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <!-- Styles -->
    </head>
    <body>
    <style>
        .alert-success {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            width: auto;
            max-width: 300px
            padding: 10px 20px;
        }

    </style>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <script>
        @if(session('success'))
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert-success').fadeOut('slow');
            }, 4000);
        });
        @endif
    </script>
    <div class="microwave">
        <!-- Porta do Microondas -->
        <div class="door">
            <div class="door-window"></div>
            <div class="handle"></div>
        </div>

        <!-- Painel de Controle -->
        <div class="control-panel">
            <div class="inline">
            <p>Tempo</p>
                <input class="display" id="display" type="time" placeholder="00:00" />
            <p>Potencia</p>
                <input class="display" id="potencia-display"  maxlength="2" type="number" min="1" max="10"  placeholder="00" oninput="validarMaxLength(this)" />
            </div>

            <div id="buttons-control" class="controls">
                <button id="add" type="button" class="btn btn-primary">Criar Potência</button>
                <button id="btnPipoca" class="button">Pipoca</button>
                <button id="btnLeite" class="button">Leite</button>
                <button id="btnCarnes" class="button">Carnes</button>
                <button id="btnFrango" class="button">Frango</button>
                <button id="btnFeijao" class="button">Feijão</button>

                @foreach($programasAquecimento as $programa)
                    <button id="btn{{ $programa->nome }}" class="button" style="color: yellow" onclick="AbrirInstrucoes({{$programa}})">
                        <i>{{ $programa->nome }}</i>
                    </button>
                @endforeach
            </div>

            <br>
            <div class="controls">
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
                <button id="start" class="button start" onClick="iniciarContador()" >Iniciar</button>
                <button id="stop" class="button stop" onClick="pararContador()">Parar</button>
                <button id="restart" class="button restart">Reiniciar</button>
            </div>
        </div>
    </div>

    <div id="panel-programa" class="panel-programa" style="display: none">
        <div class="input-group mb-3">
            <input id="input-nome" type="text" class="form-control" placeholder="Nome" maxlength="10" required>
        </div>
        <div class="input-group mb-3">
            <input id="input-alimento" type="text" class="form-control" placeholder="Alimento" required>
        </div>
        <div class="input-group mb-3">
            <input id="input-tempo" type="time" class="form-control" placeholder="Tempo" required>
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
    <div id="instructions" class="instructions" style="display: none"></div>
    <script src="js/script.js"></script>
    </body>
</html>

