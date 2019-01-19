<?

include("config.php");

// Identifica o registro
$id = $_GET['id'];

if($opcao=='1') {

	$descricao = $_POST['descricao'];
	
	$atualiza = mysql_query("update oficios_recebidos set descricao = '$descricao' where id = '$id'");
	
	// Verifica o nome do anexo
	$sqlAnexo = mysql_query("select anexo, descricao from oficios_recebidos where id = '$id'");
	while($a = mysql_fetch_array($sqlAnexo)) {
	
		$anexo = $a['anexo'];
		$descricao = $a['descricao'];
		
	}
	
	$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$id','oficios_recebidos','Alterada a descrição do anexo $anexo - $descricao')");
	
	echo "
		<center>
		<table width='800' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='740' class='vde16'>O anexo foi atualizado com sucesso!</td>
		  </tr>
		</table>		
		</center>
		<p>&nbsp;<p>";

}

if ($opcao=='2') {

	$anexo = $_POST['anexo'];
	
	// Verifica a descricao do anexo
	$sqlAnexo = mysql_query("select descricao from oficios_recebidos where id = '$id'");
	while($a = mysql_fetch_array($sqlAnexo)) {
	
		$descricao = $a['descricao'];
		
	}
	
	$delete = mysql_query("update oficios_recebidos set anexo = '', tam = '', descricao = '' where id = '$id'");
		
	$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$id','oficios_recebidos','Excluído o anexo $anexo - $descricao')");
	
	unlink("anexos/$anexo");
	
	echo "
		<center>
		<table width='800' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='740' class='vde16'>O anexo foi excluído com sucesso!</td>
		  </tr>
		</table>		
		</center>
		<p>&nbsp;<p>";

}

if($opcao=='3') {

	$descricao = $_POST['descricao'];
	$anexo     = $_POST['anexo'];
	
	$atualiza = mysql_query("update anexos set descricao = '$descricao' where anexo = '$anexo'");
	$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$id','oficios_recebidos','Alterada a descrição do anexo $anexo - $descricao')");
	
	echo "
		<center>
		<table width='800' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='740' class='vde16'>O anexo foi atualizado com sucesso!</td>
		  </tr>
		</table>		
		</center>
		<p>&nbsp;<p>";

}

if ($opcao=='4') {

	$anexo = $_POST['anexo'];
	
	// Verifica a descricao do anexo
	$sqlAnexo = mysql_query("select descricao from anexos where anexo = '$anexo'");
	while($a = mysql_fetch_array($sqlAnexo)) {
	
		$descricao = $a['descricao'];
		
	}
	
	$delete = mysql_query("delete from anexos where anexo = '$anexo'");
	
	$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$id','oficios_recebidos','Excluído o anexo $anexo - $descricao')");
	unlink("anexos/$anexo");
	
	echo "
		<center>
		<table width='800' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='740' class='vde16'>O anexo foi excluído com sucesso!</td>
		  </tr>
		</table>		
		</center>
		<p>&nbsp;<p>";

}

?>