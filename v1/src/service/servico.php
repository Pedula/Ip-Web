<?php

class Servico{


public function verificaTag($tag){
	if ($tag == 0){
		return "Off-line";
	}elseif ($tag == 1) {
		return "On-line";
	}elseif ($tag == 2) {
		return "Temporario";
	}elseif ($tag == 4) {
		return "Teste";
	}elseif ($tag == 5) {
		return "Jetdirect";
	}elseif ($tag == 6) {
		return "Migrado";
	}elseif ($tag == 99) {
		return "observação";
	}
	return "Não cadastrado.";
	}
}