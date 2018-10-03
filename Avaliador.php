<?php
/**
 * Created by PhpStorm.
 * User: joao-silva
 * Date: 28/08/18
 * Time: 10:15
 */

class Avaliador
{
    //declaro o valor como -infinito, não existe valor menor do que ele.
    public $maiorValor = -INF;
    //declaro o valor como o maior possível para poder descobrir quais são menores que ele
    public $menorValor = INF;

    public function avalia(Leilao $leilao) {

        if(count($leilao->getLances()) == 0) {
            throw new InvalidArgumentException("Sem lances");
        }
        //verifico os lances e pego o maior
        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->maiorValor) {
                $this->maiorValor = $lance->getValor();
            }
            if ($lance->getValor() < $this->menorValor) {
                $this->menorValor = $lance->getValor();
            }
        }

        $this->pegaOsMaioresno($leilao);
    }

    public function pegaOsMaioresno(Leilao $leilao) {
        $lances = $leilao->getLances();

        //ordena os itens do array conforme o meus critérios
        usort($lances, function($a , $b) {
            if($a->getValor() == $b->getValor()) return 0;
            return $a->getValor() < $b->getValor() ? 1 : -1;

        });

        //funcao que pega os 3 maiores
        $this->maiores = array_slice($lances , 0,3);
    }

    public function getMaiorLance(){
        return $this->maiorValor;

    }

    public function getMenorLance(){
        return $this->menorValor;

    }

    public function getMaiores(){
        return $this->maiores;

    }


}