<?php

class CalculadorOperacoes
{
    /**
     * Calcula o saldo da operação.
     * 
     * @param $valorAcao
     * @param $quantidadeAcoes
     * @param $mediaPonderada
     * @return float
     */
    protected function calcularSaldoOperacao($valorAcao, $quantidadeAcoes, $mediaPonderada)
    {
        // O saldo é composto pela diferença entre o valor da ação e a média ponderada, multiplicada pela quantidade de ações na operação.
        $saldo = ($valorAcao - $mediaPonderada) * $quantidadeAcoes;

        // Retorna o saldo calculado ($saldo > 0 = lucro e $saldo < 0 = prejuízo).
        return $saldo;
    }

    /**
     * Calcula imposto pago pela operação.
     * 
     * @param $valorTotal
     * @param $saldo
     * @return float
     */
    protected function calcularImpostoOperacao($valorTotal, $saldo)
    {
        $imposto = 0; // Imposto pago na operação.

        // Caso o valor total da operação seja menor ou igual a 20000 ou a operação tenha prejuízo ($saldo < 0), não é pago imposto.
        if ($valorTotal > 20000 && $saldo > 0) {
            // O imposto cobrado é de 20% do lucro da operação.
            $imposto = $saldo * 0.2;
        }

        // Retorna o imposto pago pela operação, arredondado na segunda casa decimal.
        return round($imposto, 2);
    }

    /**
     * Calcula a média ponderada do valor das ações compradas.
     * 
     * @param $quantidadeAcoesCompradas
     * @param $mediaPonderadaAtual
     * @param $quantidadeAcoes
     * @param $valorAcao
     * @return float
     */
    protected function calcularMediaPonderada($quantidadeAcoesCompradas, $mediaPonderadaAtual, $quantidadeAcoes, $valorAcao)
    {
        // Caso não haja ações compradas, a média ponderada é o valor unitário pago nessa operação.
        if ($quantidadeAcoesCompradas === 0) {
            $novaMediaPonderada = $valorAcao;
        } else {
            // A média ponderada é composta pela soma do valor pago nessa operação e o valor pago nas operações anteriores, dividida pela soma da quantidade de ações compradas anteriormente e a quantidade de ações compradas nessa operação.
            $novaMediaPonderada = (($quantidadeAcoesCompradas * $mediaPonderadaAtual) + ($quantidadeAcoes * $valorAcao)) / ($quantidadeAcoesCompradas + $quantidadeAcoes);
        }

        // Retorna a média ponderada calculada, arredondada na segunda casa decimal.
        return round($novaMediaPonderada, 2);
    }
}
