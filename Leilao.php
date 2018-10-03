<?php
	class Leilao {
		private $descricao;
		private $lances;
		
		function __construct($descricao) {
			$this->descricao = $descricao;
			$this->lances = array();
		}
		
		public function propoe(Lance $lance) {

		    if(count($this->lances) == 0 || $this->PodeDarLance($lance->getUsuario()))
			    $this->lances[] = $lance;
		}

		private function PodeDarLance(Usuario $usuario){
            $total = $this->ContaLancesDoUsuario($usuario);
		    return $this->PegaUltimoLance()->getUsuario() != $usuario && $total < 5;

        }

		private function ContaLancesDoUsuario(Usuario $usuario){
            $total = 0;
            foreach ($this->lances as $lanceAtual) {
                if($lanceAtual->getUsuario() == $usuario) $total++;
            }

            return $total;

        }

		public  function PegaUltimoLance(){
            return $this->lances[count($this->lances) - 1];

        }

		public function getDescricao() {
			return $this->descricao;
		}

		public function getLances() {
			return $this->lances;
		}
	}
?>