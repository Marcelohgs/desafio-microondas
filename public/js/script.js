
var data = new Object;
function setConfiguracoes(potencia,  tempoAquecimento, inicioRapido = false){
    let display = $('#display');    
    data.potencia = potencia;
    data.tempo = tempoAquecimento;

    if (inicioRapido){
        let minutos = tempoAquecimento.slice(0, 2);

        let segundos = tempoAquecimento.slice(2, 4);   
        console.log(minutos + ':' + segundos);
        display.val(minutos + ':' + segundos);   
    }
    else{
        display.val(tempoAquecimento.toString().padStart(2, '0') + ':00');
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
    let timer = null;
    let seconds = 0;
    let minutes = 0;

    // Adiciona número ao display
    let tempo = '';  // Inicializa a variável como uma string vazia


    $('#display').on('input', function() {
        let inputValue = $(this).val();
        
        let minutes = tempo.slice(0, 2);
        let seconds = tempo.slice(2, 4);

        let currentText = minutes + ':' + seconds;  // Formato final (minutos:segundos)
        console.log(currentText)
        //display.val(currentText);
        
    });


    $('.button').not('#start, #stop , #btnPipoca,  #btnLeite, #btnCarnes, #btnFrango, #btnFeijao').click(function() {

        // Ao clicar no botão ou evento que captura os valores
        let value = $(this).text(); 

        if (value == 'Reiniciar'){
            tempo = '';
            display.val('00:00');
            return;
        }

        tempo = tempo + value;
    
        console.log(tempo);
        let minutes = tempo.slice(0, 2);
        let seconds = tempo.slice(2, 4);

        let currentText = minutes + ':' + seconds;  // Formato final (minutos:segundos)
    
        display.val(currentText);  // Substitui o texto da tela
    });


   document.getElementById('btnPipoca').addEventListener('click', function() {
    setConfiguracoes(7, 3); // Potência 7 e 3 minutos
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
    setConfiguracoes(5, 5); // Potência 5 e 5 minutos
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
    setConfiguracoes(4, 14); // Potência 4 e 14 minutos
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
    setConfiguracoes(7, 8); // Potência 7 e 8 minutos
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
    setConfiguracoes(9, 8);
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
