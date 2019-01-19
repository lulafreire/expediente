<?

include("config.php");

// Pesquisa os dados do ofício selecionado
$oficioID = $_GET['oficioID'];
$tipo     = $_GET['tipo'];

switch($tipo) {

	case 1: $banco = "oficios_recebidos"; $resp = "oficios_emitidos"; $tipo2 = '2'; break;
	case 2: $banco = "oficios_emitidos"; $resp = "oficios_recebidos"; $tipo2 = '1'; break;

}

// Verifica se possui anexo inicial
$sql = mysql_query("Select * from $banco where id = '$oficioID'");
while($a = mysql_fetch_array($sql)) {
	
	$anexo = $a['anexo'];
	$num   = $a['num'];
	$data  = $a['data'];
	
	// Formata a data
	$d = explode("-", $data);
	$dia = $d[2];
	$mes = $d[1];
	$ano = $d[0];
	$ndata = "$dia/$mes/$ano";
	
	if($tipo == 1) {
	
		$interessado = $a['emissor'];
		$numero      = "$num";
	
	} else {
	
		$interessado = $a['destinatario'];
		$numero      = "$num/$ano/APSIRECE/INSS";
	
	}
		
	if($anexo!='') {
		
		unlink ("anexos/$anexo");
			
	}
	
}

// Pesquisa se possui anexos extras
$sqlAnexos = mysql_query("select * from anexos where id = '$oficioID'");
$resAnexos = mysql_num_rows($sqlAnexos);
if ($resAnexos!='') {
	
	while($b=mysql_fetch_array($sqlAnexos)) {
		
		$anexo = $b['anexo'];
		// Apaga os anexos da pasta no computador
		unlink ("anexos/$anexo");
	
	}
	// Apaga os anexos extras no banco de dados
	$deletaAnexos = mysql_query("Delete from anexos where id = '$oficioID'");

}	

// Apaga o registo no banco de dados específico	
$deletaOficio = mysql_query("Delete from $banco where id = '$oficioID'");

echo "
			<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
				<tr>
					<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
					<td valign='middle' align='center' height='60' class='vde16'>O Ofício nº <b>$numero</b>, de <b>$interessado</b> foi excluído com sucesso!<br><img src='img/branco.gif' height='5'></td>
				</tr>
			</table>";

?>