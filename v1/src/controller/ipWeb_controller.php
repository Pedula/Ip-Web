<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = (dirname(__DIR__)) . $ds;
require_once("{$base_dir}model\OcsWeb.php");
require_once("{$base_dir}model\TableTemp.php");

class IpWeb_controller{

	public function getModelIpAdmin(){
		$OcsWeb = new OCSWeb();
		$rowsOcs = $OcsWeb->getOcsWeb();

		$temp = new TempTable();
		$temp->insertTempTable($rowsOcs);
		$rowsTemp = $temp->json_to_dic();

		return $rowsTemp;
	}
}