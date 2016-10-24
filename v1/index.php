<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = (dirname(__DIR__)) . $ds;
	include_once ("{$base_dir}v1\src\controller\ipWeb_controller.php");
?>
<!DOCTYPE html>
<html lang="br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IP Web</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>

    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h3 class="text-muted text-left">
			Tabela IP Admin/OCS Web
			</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							IP
						</th>
						<th>
							Host
						</th>
						<th>
							MAC
						</th>
						<th>
							Flag
						</th>
						<th>
							Data de vencimento
						</th>
					</tr>
				</thead>
			<?php
			
			$controll = new IpWeb_controller();
			$rows = $controll->getModelIpAdmin();
			$json = json_decode($rows);
			foreach ($json as $key => $value) {

		 	?>
				<tbody>
					<tr>
						<td>
							IP Admin
						</td>
						<td>
							<?php echo $value->ip; ?>
						</td>
						<td>
							<?php echo $value->host; ?>
						</td>
						<td>
							<?php echo $value->mac; ?>
						</td>
						<td>
							<?php echo $value->flag; ?>
						</td>
						<td>
							<?php echo $value->data_vencimento; ?>
						</td>
					</tr>
					<tr>
						<td>
							OCS Web
						</td>
						<td>
							<?php echo $value->ip_ocs; ?>
						</td>
						<td>
							<?php echo $value->host_ocs; ?>
						</td>
						<td>
							<?php echo $value->mac_ocs; ?>
						</td>
						<td>
							<?php echo $value->flag_ocs; ?>
						</td>
						<td>
							<?php echo $value->data_vencimento_ocs; ?>
						</td>
					</tr>
					<tr class="warning">
						<td>
							Resultado
						</td>
						<td>
							<?php echo $value->result_ip; ?>
						</td>
						<td>
							<?php echo $value->result_host; ?>
						</td>
						<td>
							<?php echo $value->result_mac; ?>
						</td>
						<td>
							<?php echo $value->result_flag; ?>
						</td>
						<td>
							<?php echo $value->result_data_vencimento; ?>
						</td>
					</tr>
			<!--		 <tr> 
						<td></td>
					</tr>-->
				</tbody> 
		 	 <?php } ?> 
			</table>
		</div>
	</div>
</div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>