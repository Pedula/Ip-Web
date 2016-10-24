<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = (dirname(__DIR__)) . $ds;
require_once("{$base_dir}..\conf\BD.php");
require_once("{$base_dir}service\servico.php");


class TempTable{

  public function __construct(){

    $link = new Conf();

    $db_selected = mysql_select_db('ip_admin', $link->conexao());
    if (!$db_selected) {
       die ('Não foi possível selecionar o banco de dados.' . mysql_error());
    }
  }

  public function insertTempTable($json){
     $maketemp = "
        CREATE TEMPORARY TABLE IF NOT EXISTS temp_table (
       `ip_ocs` varchar(65) NULL,
       `mac_ocs` varchar(65) NULL,
       `host_ocs` varchar(65) NULL,
       `data_vencimento_ocs` varchar(65) NULL,
       `flag_ocs` varchar(65) NULL,
       `descricao_ocs` varchar(65) NULL
     )"; 

     $bool = mysql_query($maketemp) or die("erro ao criar a tabela temporaria: ".mysql_error());


    $jsonRow = json_decode($json, true);

    foreach ($jsonRow as $key=>$valueOcs){
      if (isset($valueOcs['ip_ocs'])){

        $ip_ocs = $valueOcs['ip_ocs'];
        $mac_ocs = $valueOcs['mac_ocs'];
        $host_ocs = $valueOcs['host_ocs'];
        $data_vencimento_ocs = $valueOcs['data_vencimento_ocs'];
        $flag_ocs = $valueOcs['flag_ocs'];
        $descricao_ocs = $valueOcs['descricao_ocs'];

      $inserttemp = "
         INSERT INTO temp_table
            (   `ip_ocs`,
                `mac_ocs`,
                `host_ocs`,
                `data_vencimento_ocs`,
                `flag_ocs`,
                `descricao_ocs`)
            values(
                 '$ip_ocs',
                 '$mac_ocs',
                 '$host_ocs',
                 '$data_vencimento_ocs',
                 '$flag_ocs',
                 '$descricao_ocs')
         ";

       $retorno = mysql_query($inserttemp) or die("erro ao inserir os dados na tabela temporaria: ".mysql_error());
      }
    }
  }

  public function json_to_dic(){
     $sql = "select ip.id_ip_admin, ip.flag, ip.descricao, ip.host, ip.mac, ip.IP, ip.data_vencimento, ip.observacao, tmp.* from ipAdmin ip
            inner join temp_table tmp on tmp.ip_ocs = ip.IP group by ip.IP";

     $rows = mysql_query($sql) or die("erro ao fazer o join. ".mysql_error());
     $i=0;
      while ($row = mysql_fetch_assoc($rows)){

         $verifica = new Servico();

         if ($row['IP'] != NULL){
            
            $vet['temp'.$i]['ip']   = $row['IP'];
            $vet['temp'.$i]['ip_ocs']    = $row['ip_ocs'];
            $vet['temp'.$i]['result_ip'] = '<font color="blue">OK</font>';

            //redundancia.
            // if (strcasecmp($row['ip_ocs'],$row['IP']) == 0){
            //   $vet['temp'.$i]['result_ip'] = '<font color="blue">OK</font>';
            // }else{
            //   $vet['temp'.$i]['result_ip'] = '<font color="red">Diferente</font>';
            // }

            $vet['temp'.$i]['host'] = $row['host'];
            $vet['temp'.$i]['host_ocs']    = $row['host_ocs'];
            if (strcasecmp($row['host_ocs'],$row['host']) == 0){
              $vet['temp'.$i]['result_host'] = '<font color="blue">OK</font>';
            }else{
              $vet['temp'.$i]['result_host'] = '<font color="red">Diferente</font>';
            }

            $vet['temp'.$i]['mac']  = $row['mac'];
            $vet['temp'.$i]['mac_ocs']  = $row['mac_ocs'];
            if (strcasecmp($row['mac_ocs'],$row['mac'])==0){
              $vet['temp'.$i]['result_mac'] = '<font color="blue">OK</font>';
            }else{
              $vet['temp'.$i]['result_mac'] = '<font color="red">Diferente</font>';
            }
            
            $vet['temp'.$i]['descricao']  = $row['descricao'];
            $vet['temp'.$i]['descricao_ocs']  = $row['descricao_ocs'];
            if (strcasecmp($row['descricao'],$row['descricao_ocs'])==0){
              $vet['temp'.$i]['result_descricao'] = '<font color="blue">OK</font>';
            }else{
              $vet['temp'.$i]['result_descricao'] = '<font color="red">Diferente</font>';
            }
      
            $vet['temp'.$i]['flag']  = $verifica->verificaTag($row['flag']);
            $vet['temp'.$i]['flag_ocs']  = $row['flag_ocs'];
            if ($row['flag_ocs'] == $row['flag']){
              $vet['temp'.$i]['result_flag'] = '<font color="blue">OK</font>';
            }else{
              $vet['temp'.$i]['result_flag'] = '<font color="red">Diferente</font>';
            }
            
            $vet['temp'.$i]['data_vencimento'] = $row['data_vencimento'];
            $vet['temp'.$i]['data_vencimento_ocs'] = $row['data_vencimento_ocs'];
            if ($row['data_vencimento_ocs'] == $row['data_vencimento']){
              $vet['temp'.$i]['result_data_vencimento'] = '<font color="blue">OK</font>';
            }else{
              $vet['temp'.$i]['result_data_vencimento'] = '<font color="red">Diferente</font>';
            }
         }
         $i++;
      }
      return json_encode($vet);
  }
}

