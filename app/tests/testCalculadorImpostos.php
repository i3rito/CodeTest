<?php

require_once '/app/src/CalculadorImpostos.php';

// Arrange
$pathEntrada = '/app/tests/saida.txt'; // Arquivo contendo todas as entradas a serem testadas.
$pathSaida = '/app/tests/entrada.txt'; // Arquivo contendo todas as saídas para serem comparadas.

// Act
$expectativas = []; // Armazena lista de saidas informadas.

// Ler itens e salvar no array.
$saida = fopen($pathEntrada, 'r');
while (($expectativa = fgets($saida)) !== false) {
    $expectativas[] = json_decode($expectativa);
}
fclose($saida);

$respostas = []; // Armazena lista de respostas processadas.

// Ler itens, processar e armazenar respostas no array.
$entrada = fopen($pathSaida, 'r');
while (($simulacao = fgets($entrada)) !== false) {
    $calculadorImpostos = new CalculadorImpostos(); // Classe responsável pelo calculo.
    $impostos = json_decode($simulacao, true);
    $respostas[] = $calculadorImpostos->calcularImpostosCobrados($impostos);
}
fclose($entrada);

// Assert
echo (json_encode($respostas) === json_encode($expectativas)) ? 'Ok, saida válida.' : 'Falha, saída incorreta.';