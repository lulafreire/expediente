<?

include("config.php");

// Recupera dados do formulário
$tipo     = $_POST['tipo'];
$oficioID = $_POST['oficioID'];

switch($tipo) {

	case 1: $banco = "oficios_recebidos"; $resp = "oficios_emitidos"; $tipo2 = '2'; break;
	case 2: $banco = "oficios_emitidos"; $resp = "oficios_recebidos"; $tipo2 = '1'; break;

}

// Verifica se houve alteração nos campos relativos ao destinatário
$sqlDest1 = mysql_query("select * from $banco where id = '$oficioID'");
while($de=mysql_fetch_array($sqlDest1)) {

	if($tipo == 1) {
	
		$interessado = $de['emissor'];
	
	} else {
	
		$interessado = $de['destinatario'];
	
	}
	
	$cargoAtual        = $de['cargo'];
	$orgaoAtual        = $de['orgao'];
	$endAtual          = $de['end'];
	$cepAtual          = $de['cep'];
	$cidadeAtual       = $de['cidade'];

}

if($destinatarioAtual != $interessado or $cargoAtual != $cargo or $orgaoAtual != $orgao or $endAtual != $endereco or $cepAtual != $cep or $cidadeAtual != $cidade) {

	//echo "Alterou o destinatário, deve alterar todos os dados.";
	
	// Altera os dados na tabela DESTINATÁRIOS
	$upDest = mysql_query("Update destinatarios set nome = '$interessado', cargo = '$cargo', orgao = '$orgao', end = '$endereco', cep = '$cep', cidade = '$cidade' where nome = '$destinatarioAtual'");

}


// Alterações no campo "Resposta ao Ofício"
$sqlResposta = mysql_query("Select * from $resp where resposta = '$oficioID'");
$qtResposta  = mysql_num_rows($sqlResposta);
while($r = mysql_fetch_array($sqlResposta)) {

	$idRespostaAtual = $r['id'];

}

if($qtResposta ==0) { // Não é resposta de nenhum ofício

	
	if($resposta!=0) {
	
		$upResp = mysql_query("Update $resp set resposta = '$oficioID' where id = '$resposta'"); // Só faz a alteração se for escolhido um ofício para ser resposta
		$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$resposta','$resp','Ofício respondido')");
			
	}
	

} else { // Já foi indicado como resposta de algum ofício

	
	if($resposta==0) {
	
		$upResp = mysql_query("Update $resp set resposta = '' where id = '$idRespostaAtual'"); // Apaga o campo resposta do ofício anteriormente indicado
		$gravaEvento = mysql_query("delete from eventos where id = '$idRespostaAtual' and descricao = 'Ofício Respondido'");
	
	} else {
	
		if($resposta != $idRespostaAtual) {
		
			$upResp1 = mysql_query("Update $resp set resposta = '' where id = '$idRespostaAtual'"); // Apaga o campo resposta do ofício anteriormente indicado
			$gravaEvento = mysql_query("delete from eventos where id = '$idRespostaAtual' and descricao = 'Ofício Respondido'");
			
			$upResp2 = mysql_query("Update $resp set resposta = '$oficioID' where id = '$resposta'"); // Inclui o ofício selecionado como resposta do ofício indicado
			$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$resposta','$resp','Ofício respondido')");
		
		}
	
	}

}


// Atualiza os demais dados do ofício

if($tipo == 2) {

$up  = mysql_query("Update $banco set emitente = '$emitente', destinatario = '$interessado', assunto = '$assunto', tratamento = '$tratamento', texto = '$texto' where id = '$oficioID'");
$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$oficioID','oficios_emitidos','Ofício atualizado')");

} else {

$up  = mysql_query("Update $banco set emissor = '$interessado', assunto = '$assunto', where id = '$oficioID'");
$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$oficioID','oficios_recebidos','Ofício atualizado')");	

}

if($tipo == '2') {

echo "
			<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
				<tr>
					<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
					<td valign='middle' align='center' height='60' class='vde16'>O Ofício nº <b>$num/$ano/APSIRECE/INSS</b>, destinado a <b>$interessado</b> foi atualizado com sucesso!<br><img src='img/branco.gif' height='5'><br><font class='cza12'><i><a href='pdf.php?id=$oficioID' class='linkcza'>Clique aqui para abrir e imprimir</a></td>
				</tr>
			</table>";

} else {

echo "
			<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
				<tr>
					<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
					<td valign='middle' align='center' height='60' class='vde16'>O Ofício nº <b>$num</b>, de <b>$interessado</b> foi atualizado com sucesso!<br><img src='img/branco.gif' height='5'></td>
				</tr>
			</table>";

}