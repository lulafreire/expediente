<?
include ("config.php");

$id = $_POST['id'];

// Pesquisa se possui anexo inicial
$sqlAnexo = mysql_query("select * from mob where id = '$id'");
while($an=mysql_fetch_array($sqlAnexo)) {
		
		$anexo1 = $an['anexo'];
		// Apaga o anexo inicial da pasta no computador
		if($anexo1!='') {
		
			unlink ("anexos/$anexo1");
			
		}
	
	}


// Pesquisa se possui anexos extras
$sqlAnexos = mysql_query("select * from anexos where id = '$id'");
$resAnexos = mysql_num_rows($sqlAnexos);
if ($resAnexos!='') {
	
	while($a=mysql_fetch_array($sqlAnexos)) {
		
		$anexo = $a['anexo'];
		// Apaga os anexos da pasta no computador
		unlink ("anexos/$anexo");
	
	}
	// Apaga os anexos extras no banco de dados
	$deletaAnexos = mysql_query("Delete from anexos where id = '$id'");

}

$deleta = mysql_query("delete from mob where id = '$id'");
$deletaEventos = mysql_query("delete from eventos where id = '$id'");

	
		
		echo "
		<center>
		<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' class='vde16'>O registro foi excluído com sucesso!</td>
		  </tr>
		</table>		
		</center>
		<p>&nbsp;<p>";
	
	
?>