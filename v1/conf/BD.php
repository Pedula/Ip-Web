<?php
class Conf{
	
	public function conexao(){

		$servidor = '127.0.0.1';
		$usuario = 'root';
		$senha = '';
		
  		$link = mysql_connect($servidor, $usuario, $senha);

		if (!$link) {
			die('Não foi possível se conectar.' . mysql_error());
		}

		return $link;
	}
}