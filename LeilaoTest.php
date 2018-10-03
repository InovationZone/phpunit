<?php
require_once "Usuario.php";
require_once "Lance.php";
require_once "Leilao.php";


class LeilaoTest extends PHPUnit\Framework\TestCase
{
    public function testDeveProporUmLance(){
        $leilao = new Leilao("teste caro");


        $user1 = new Usuario("user1");

        $leilao->propoe(new Lance($user1,2000));

        $this->assertEquals(1,count($leilao->getLances()));
        $this->assertEquals(2000,$leilao->getLances()[0]->getValor());

    }

    public function testDeveBarrarDoisLancesSeguidos(){
        $leilao = new Leilao("teste");

        $user1 = new Usuario("user1");

        $leilao->propoe(new Lance($user1,2000));
        $leilao->propoe(new Lance($user1,2000));

        $this->assertEquals(1,count($leilao->getLances()));
        $this->assertEquals(2000,$leilao->getLances()[0]->getValor());
    }

    public function testNaoPodeDarCincoLancesNoMesmoLeilao(){
        $leilao = new Leilao("teste");

        $user1 = new Usuario("user1");
        $user2 = new Usuario("user2");

        $leilao->propoe(new lance($user1,1000));
        $leilao->propoe(new lance($user2,2000));

        $leilao->propoe(new lance($user1,3000));
        $leilao->propoe(new lance($user2,4000));

        $leilao->propoe(new lance($user1,5000));
        $leilao->propoe(new lance($user2,6000));

        $leilao->propoe(new lance($user1,7000));
        $leilao->propoe(new lance($user2,8000));

        $leilao->propoe(new lance($user1,9000));
        $leilao->propoe(new lance($user2,1000));

        $leilao->propoe(new lance($user1,2000));

        $this->assertEquals(10,count($leilao->getLances()));
        $this->assertEquals(1000 , $leilao->getLances()[9]->getValor());

    }

}