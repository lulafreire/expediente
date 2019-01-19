<?

include("config.php");

// Pesquisa os dados do destinatario selecionado
$sqlDest = mysql_query("Select * from destinatarios where id = $id");
while ($d = mysql_fetch_array($sqlDest)) {
	
	$nome   = $d['nome'];
	$cargo  = $d['cargo'];
	$orgao  = $d['orgao'];
	$end    = $d['end'];
	$cep    = $d['cep'];
	$cidade = $d['cidade'];
	$tel    = $d['telefone'];
	$email  = $d['email'];
	
	// Verifica a quantidade de ofícios recebidos deste destinatário
	$sqlOfRec = mysql_query("select * from oficios_recebidos where emissor = '$nome'");
	$qtOfRec  = mysql_num_rows($sqlOfRec);
	
	// Verifica a quantidade de ofícios enviados para o destinatário
	$sqlOfEnv = mysql_query("Select * from oficios_emitidos where destinatario = '$nome'");
	$qtOfEnv  = mysql_num_rows($sqlOfEnv);
	
}

// Exibe os detalhes

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='300' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>NOME</b></td>
		<td width='220' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>CARGO</b></td>
		<td width='300' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>ÓRGAO</b></td>
		<td width='120' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>TEL</b></td>
	</tr>
	<tr>
		<td width='300' height='30' valign = 'middle' align='center' class='azul12'>$nome</td>
		<td width='220' height='30' valign = 'middle' align='center' class='azul12'>$cargo</td>
		<td width='300' height='30' valign = 'middle' align='center' class='azul12'>$orgao</td>
		<td width='120' height='30' valign = 'middle' align='center' class='azul12'>$tel</td>
	</tr>
</table><img src='img/branco.gif' height='2'><br>";

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='520' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>ENDEREÇO</b></td>
		<td width='100' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>CEP</b></td>
		<td width='320' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>CIDADE</b></td>
	</tr>
	<tr>
		<td width='520' height='30' valign = 'middle' align='center' class='azul12'>$end</td>
		<td width='100' height='30' valign = 'middle' align='center' class='azul12'>$cep</td>
		<td width='320' height='30' valign = 'middle' align='center' class='azul12'>$cidade</td>
	</tr>
</table><img src='img/branco.gif' height='2'><br>";

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='520' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>EMAIL</b></td>
		<td width='200' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>RECEBIDOS</b></td>
		<td width='200' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>ENVIADOS</b></td>
	</tr>
	<tr>
		<td width='520' height='30' valign = 'middle' align='center' class='azul12'>$email</td>
		<td width='210' height='30' valign = 'middle' align='center' class='azul14'><b>$qtOfRec</b></td>
		<td width='210' height='30' valign = 'middle' align='center' class='azul14'><b>$qtOfEnv</b></td>
	</tr>
</table>";

?>