<?

include("config.php");

// Pesquisa os detalhes do registro selecionado
$id = $_GET['id'];

$sql = mysql_query("select * from mob where id = '$id'");
while($dados = mysql_fetch_array($sql)) {

	$id      = $dados ['id'];
	$nb      = $dados ['nb'];
	$nome    = $dados ['nome'];
	$sipps   = $dados ['sipps'];
	$origem  = $dados ['origem'];
	$caixa   = $dados ['caixa'];
	$demanda = $dados ['demanda'];
	$fase    = $dados ['fase'];
	$obs     = $dados ['obs'];
	$dtCad   = $dados ['dtCad'];
	$dtAtu   = $dados ['dtAtu'];
	$anexo   = $dados ['anexo'];
	$tam     = $dados ['tam'];
	$descricao = $dados ['descricao'];
	
	if($descricao == '') {
	
		$descricao = "Anexo não identificado";
	
	}
	
	if($obs=='') {
		
		$obs = "Não há observações.";
		
	}
		
	// Formata NB
	$nb01 = substr($nb, 0, 3);
	$nb02 = substr($nb, 3, 3);
	$nb03 = substr($nb, 6, 3);
	$nb04 = substr($nb, 9, 1);
	$nbFormatado   = "$nb01.$nb02.$nb03-$nb04";
	
	if($sipps =='') {
	
		$sippsFormatado = "<font class='cza12'><i>Não cadastrado</i></font>";
	
	} else {
	
	// Formata SIPPS
	$s01 = substr($sipps, 0, 5);
	$s02 = substr($sipps, 5, 6);
	$s03 = substr($sipps, 11, 4);
	$s04 = substr($sipps, 15, 2);
	$sippsFormatado   = "$s01.$s02/$s03-$s04";
	
	}
	
		// Formata Datas
		$dtC01 = substr($dtCad, 8, 2);
		$dtC02 = substr($dtCad, 5, 2);
		$dtC03 = substr($dtCad, 0, 4);
		
		$dtA01 = substr($dtAtu, 8, 2);
		$dtA02 = substr($dtAtu, 5, 2);
		$dtA03 = substr($dtAtu, 0, 4);

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='40' height='40' background='img/cinza.gif' valign='middle' align='center'><img src='img/doc.png'></td>
		<td valign='middle' align='left' class='azul16'>&nbsp;&nbsp;<i>Detalhes do registro.</i> <b>NB: $nbFormatado</b></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>";

echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='400' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>NOME</b></td>
			<td width='200' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>NB</b></td>
			<td width='130' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>FASE</b></td>
			<td width='100' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>DATA DE CADASTRO</b></td>
			<td width='100' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>ÚLTIMA ATUALIZAÇÃO</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>";

		
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='400' height='30' valign='middle' align='center' class='azul12'>$nome</td>
			<td width='200' height='30' valign='middle' align='center' class='azul12'>$nbFormatado</td>
			<td width='130' height='30' valign='middle' align='center' class='azul12'>$fase</td>
			<td width='100' height='30' valign='middle' align='center' class='azul12'>$dtC01/$dtC02/$dtC03</td>
			<td width='100' height='30' valign='middle' align='center' class='azul12'>$dtA01/$dtA02/$dtA03</td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>";
	
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='400' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>PROTOCOLO SIPPS</b></td>
			<td width='100' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>ORIGEM</b></td>
			<td width='100' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>CAIXA</b></td>
			<td width='330' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>DEMANDA</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>";
	
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='400' height='30' valign='middle' align='center' class='azul12'>$sippsFormatado</td>
			<td width='100' height='30' valign='middle' align='center' class='azul12'>$origem</td>
			<td width='100' height='30' valign='middle' align='center' class='azul12'>$caixa</td>
			<td width='330' height='30' valign='middle' align='center' class='azul12'>$demanda</td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>";
	
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='940' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>OBSERVAÇÕES</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>";
	
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='940' height='60' valign='middle' align='center' class='azul12'>$obs</td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>";
	
	// Anexo inicial
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='940' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>ANEXOS</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>";
	
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>";
		if($anexo !='') {
		echo "
		<tr>
			<td width='40' height='40' valign='middle' align='center'><a href='download.php?url=$anexo' class='linkazul' title='Baixar anexo $anexo'><img src='img/download.png' width='32' border='0'></a></td>
			<td width='880' height='40' valign='middle' align='left' class='azul12'>&nbsp;<a href='download.php?url=$anexo' class='linkazul' title='Baixar anexo $anexo'><b>$descricao</b></a> [$tam Mb] <font class='cza09'><i>enviado em $dtC01/$dtC02/$dtC03</i></a></td>
		</tr>";
		} 
		
		
	
	// Verifica se há anexos complementares
	$sqlAnexos = mysql_query("Select * from anexos where id = '$id' and origem = 'MOB' order by dtEnvio asc");
	$resAnexos = mysql_num_rows($sqlAnexos);
	
	    if($anexo =='' and $resAnexos =='') {
		
		echo "
		<tr>
			<td width='40' height='40' valign='middle' align='center'><img src='img/download.png' width='32' border='0'></td>
			<td width='880' height='40' valign='middle' align='left' class='cza12'>&nbsp;&nbsp;<i>Não há anexos para este processo.</i></td>
		</tr>";		
		
		}
	
	
	if($resAnexos !='') {
	
		while($a = mysql_fetch_array($sqlAnexos)) {
		
			$anexo2      = $a['anexo'];
			$tam2        = $a['tam'];
			$descricao2  = $a['descricao'];
			$dtEnvio     = $a['dtEnvio'];
			
			if($descricao2 == '') {
	
				$descricao2 = "Anexo não identificado";
	
			}
			
			// Formata Datas
			$dtE01 = substr($dtEnvio, 8, 2);
			$dtE02 = substr($dtEnvio, 5, 2);
			$dtE03 = substr($dtEnvio, 0, 4);
			
			echo "
			
				<tr>
					<td width='40' height='40' valign='middle' align='center'><a href='download.php?url=$anexo2' class='linkazul' title='Baixar anexo $anexo2'><img src='img/download.png' width='32' border='0'></a></td>
					<td width='880' height='40' valign='middle' align='left' class='azul12'>&nbsp;<a href='download.php?url=$anexo2' class='linkazul' title='Baixar anexo $anexo2'><b>$descricao2</b></a> [$tam2 Mb] <font class='cza09'><i>enviado em $dtE01/$dtE02/$dtE03</i></a></td>
				</tr>";			
		
		}
	
	
	} echo "</table><img src='img/branco.gif' height='5'><br>";
	
	include("historico.php");

}
		
?>