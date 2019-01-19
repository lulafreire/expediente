<?

include("config.php");
include("mascara_data.php");

// Pesquisa os dados do destinatario selecionado
$sqlDest = mysql_query("Select * from destinatarios where id = $id");
while ($d = mysql_fetch_array($sqlDest)) {
	
	$id     = $d['id'];
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
	<tr><form method='post' action='index.php?conteudo=alterar_destinatario.php'> 
		<td width='300' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>NOME</b></td>
		<td width='220' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>CARGO</b></td>
		<td width='300' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>ÓRGAO</b></td>
		<td width='120' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>TEL</b></td>
	</tr>
	<tr>
		<td width='300' height='30' valign = 'middle' align='center' class='azul10'><input type='text' size='43' name='nome' value='$nome' class='azul12'></td>
		<td width='220' height='30' valign = 'middle' align='center' class='azul10'><input type='text' size='30' name='cargo' value='$cargo' class='azul12'></td>
		<td width='300' height='30' valign = 'middle' align='center' class='azul10'><input type='text' size='43' name='orgao' value='$orgao' class='azul12'></td>
		<td width='120' height='30' valign = 'middle' align='center' class='azul10'><input type='text' size='13' name='tel' value='$tel' class='azul12' onkeypress=\"formatar_mascara(this, '##-####-####')\"></td>
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
		<td width='520' height='30' valign = 'middle' align='center' class='azul10'><input type='text' size='80' name='end' value='$end' class='azul12'></td>
		<td width='100' height='30' valign = 'middle' align='center' class='azul10'><input type='text' size='10' name='cep' value='$cep' class='azul12' onkeypress=\"formatar_mascara(this, '#####-###')\"></td>
		<td width='320' height='30' valign = 'middle' align='center' class='azul10'><input type='text' size='46' name='cidade' value='$cidade' class='azul12'></td>
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
		<td width='520' height='30' valign = 'middle' align='center' class='azul10'><input type='text' size='80' name='email' value='$email' class='azul12'></td>
		<td width='210' height='30' valign = 'middle' align='center' class='azul14'><b>$qtOfRec</b></td>
		<td width='210' height='30' valign = 'middle' align='center' class='azul14'><b>$qtOfEnv</b></td>
	</tr>
</table><img src='img/branco.gif' height='5'><br><input type='hidden' name='id' value='$id'><input type='submit' value='Atualizar'>";

?>