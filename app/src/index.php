<?php

require_once 'CalculadorImpostos.php';

$simulacoes = []; // Simulações recebidas.

// Ler entrada até receber uma linha em branco.
while (($line = fgets(STDIN)) !== PHP_EOL) {
  // Transforma a simulação inserida de json para array e armazena.
  $simulacoes[] = json_decode($line, true);
}

// Processar simulações recebidas.
foreach ($simulacoes as $simulacao) {
  $calculadorImpostos = new CalculadorImpostos(); // Classe responsável por processar a simulação e retornar os impostos pagos.
  
  // Calcula impostos pagos nas operações de uma simulação.
  $impostos = $calculadorImpostos->calcularImpostosCobrados($simulacao);
  
  // Transforma lista de impostos pagos de array para json e imprime com quebra de linha.
  echo json_encode($impostos) . PHP_EOL;
}