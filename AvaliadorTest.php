<?php

require_once "Avaliador.php";
require_once "ConstrutorDeLeilao.php";

class AvaliadorTest extends PHPUnit\Framework\TestCase
{

    private $leiloeiro;

    public function setUp(){
        $this->leiloeiro = new Avaliador();
    }

    public function testGetLancesGrandesEmOrdemCrescente(){

        $leilao = new Leilao("ps4");

        $user1 = new Usuario("user1");
        $user2 = new Usuario("user2");
        $user3 = new Usuario("user3");

        $leilao->propoe(new lance($user3,250));
        $leilao->propoe(new lance($user1,350));
        $leilao->propoe(new lance($user2,400));


        $this->leiloeiro->avalia($leilao);

        $maiorEsperado = 400;
        $menorEsperado = 250;
        $this->assertEquals($maiorEsperado,$this->leiloeiro->getMaiorLance());
        $this->assertEquals($menorEsperado,$this->leiloeiro->getMenorLance());
    }

    public function testDeveAceitarApenasumLance() {

        $leilao = new Leilao("xbox");

        $user1 = new Usuario("user1");

        $leilao->propoe(new lance($user1,2000));

        $this->leiloeiro->avalia($leilao);

        $maiorEsperado = 2000;
        $menorEsperado = 2000;

        $this->assertEquals($maiorEsperado,$this->leiloeiro->getMaiorLance());
        $this->assertEquals($maiorEsperado,$this->leiloeiro->getMenorLance());
    }
    public function testDevePegarOsTresMaiores() {


        $user1 = new Usuario("user1");
        $user2 = new Usuario("user2");

        $construtor = new ConstrutorDeLeilao();


        $leilao = $construtor->para("teste")->lance($user1,500)
            ->lance($user2,400)->lance($user1,300)->lance($user1,200)->constroi();
        //$leilao->propoe(new lance($user1,200));
        //leilao->propoe(new lance($user2,300));
        //$leilao->propoe(new lance($user1,400));
        //$leilao->propoe(new lance($user2,500));

        $this->leiloeiro->avalia($leilao);


        $this->assertEquals(3,count($this->leiloeiro->getMaiores()));
        $this->assertEquals(500,$this->leiloeiro->getMaiores()[0]->getValor());
        $this->assertEquals(400,$this->leiloeiro->getMaiores()[1]->getValor());
        $this->assertEquals(300,$this->leiloeiro->getMaiores()[2]->getValor());

    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDeveRecusarLeilaoSemLances(){
            $construtor = new ConstrutorDeLeilao();
            $leilao = $construtor->para("teste")->constroi();

            $this->leiloeiro->avalia($leilao);




    }
}