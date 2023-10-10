<?php

require_once 'CalculadorOperacoes.php';

class CalculadorImpostos extends CalculadorOperacoes
{
    private array $impostos = []; // Array de impostos processados.
    private int $quantidadeAcoesCompradas = 0; // Quantidade de ações compradas.
    private float $mediaPonderadaAtual = 0; // Média ponderada do valor pago nas ações já compradas.
    private float $saldoTotal = 0; // Saldo total das operações ($saldoTotal > 0 = lucro, $saldoTotal < 0 = prejuízo).

    /**
     * Calcula impostos cobrados nas operações.
     * 
     * @param array $operacoes Lista de operações a terem o imposto calculado.
     * @return array
     */
    public function calcularImpostosCobrados($operacoes)
    {
        // Processar operações.
        foreach ($operacoes as $operacao) {
            // Declaração de variáveis.
            $imposto = 0; // Imposto pago na operação.
            $saldo = 0; // Saldo da operação ($saldo > 0 = lucro, $saldo < 0 = prejuízo).
            $tipoOperacao = $operacao['operation']; // Tipo de operação ('buy' = compra, 'sell' = venda).
            $quantidadeAcoes = $operacao['quantity']; // Quantidade de ações negociadas na operação.
            $valorAcao = $operacao['unit-cost']; // Preço unitário da ação (o valor respeita a regra de duas casas decimais).
            $valorTotal = ($valorAcao * $quantidadeAcoes); // Valor total pago na operação.

            // Caso a operação seja uma compra ('buy'), a média ponderada é calculada e a quantidade total de ações compradas é acrescida.
            if ($tipoOperacao === 'buy') {
                // Calcula nova média ponderada.
                $this->mediaPonderadaAtual = $this->calcularMediaPonderada($this->quantidadeAcoesCompradas, $this->mediaPonderadaAtual, $quantidadeAcoes, $valorAcao);

                // Acrescenta quantindade total de ações compradas.
                $this->quantidadeAcoesCompradas += $quantidadeAcoes;
            }
            // Caso a operação seja uma venda, o saldo é calculado e a quantidade total de ações é subtraída.
            else if ($tipoOperacao === 'sell') {
                // Calcula o saldo da operação ($saldo > 0 = lucro, $saldo < 0 = prejuízo).
                $saldo = $this->calcularSaldoOperacao($valorAcao, $quantidadeAcoes, $this->mediaPonderadaAtual);

                // Subtrai a quantidade total de ações compradas.
                $this->quantidadeAcoesCompradas -= $quantidadeAcoes;

                // Caso exista prejuízo anterior, o saldo é acrescido.
                if ($this->saldoTotal < 0) {
                    $saldo += $this->saldoTotal;
                }

                // Atualiza saldo total das operações
                $this->saldoTotal = $saldo;
            }

            // Calcula imposto pago pela operação.
            $imposto = $this->calcularImpostoOperacao($valorTotal, $saldo);

            // Estrutura e armazena o valor pago na operação.
            $this->impostos[] = $this->estruturarResposta($imposto);
        }

        // Retorna lista de impostos pagos nas operações.
        return $this->impostos;
    }

    /**
     * Estrutura resposta de acordo com o esperado.
     * 
     * @param $imposto Valor do imposto
     * @return array 
     */
    private function estruturarResposta($imposto)
    {
        // Retorna imposto na estrutura esperada.
        return ['tax' => $imposto];
    }
}
