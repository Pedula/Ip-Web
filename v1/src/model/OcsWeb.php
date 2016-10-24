<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = (dirname(__DIR__)) . $ds;
require_once("{$base_dir}..\conf\BD.php");

class OCSWeb{

   public function __construct(){

      $link = new Conf();

      $db_selected = mysql_select_db('ocsweb_prod', $link->conexao());
      if (!$db_selected) {
         die ('Não foi possível selecionar o banco de dados.' . mysql_error());

      }
   }

   public function getOcsWeb(){
    
      $sql = "       
         select h.NAME, h.IPSRC, n.MACADDR
         from hardware h,networks n where n.hardware_id=h.id 
         AND h.IPSRC IS NOT NULL";
      
      $rows = mysql_query($sql);

      if (!$rows){
         die("A consulta não obteve resposta.". mysql_error());
      }

      $i = 0;
      $vet  = array('ocs' => array());
    
      while ($row = mysql_fetch_assoc($rows)){
         $vet['ocs'.$i]['ip_ocs']    = $row['IPSRC'];
         $vet['ocs'.$i]['host_ocs']    = $row['NAME'];
         $vet['ocs'.$i]['mac_ocs']  = $row['MACADDR'];
         $vet['ocs'.$i]['data_vencimento_ocs'] ='04/05/1989'.$i; // $row['data_vencimento'];
         $vet['ocs'.$i]['descricao_ocs']  = 'TESTE descricao'.$i; // $row['descricao'];
         $vet['ocs'.$i]['flag_ocs']  = 'Online'.$i; // $row['flag'];
         
         $i++;
      }
      return json_encode($vet);
   }
}
   