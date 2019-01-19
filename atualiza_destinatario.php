<?

include("config.php");

// Letras maiúsculas para o nome
$nome = strtoupper($nome);

// Verifica o nome atual do destinatário, caso tenha sido alterado, deverá alterar também nos ofícios recebidos e enviados.
$sqlNome = mysql_query("Select nome from destinatarios where id = '$id'");
while($n=mysql_fetch_array($sqlNome)) {
	
	$nomeAtual = $n['nome'];

	if($nomeAtual != $nome) {
		
		$atualizaOficiosRecebidos = mysql_query("Update oficios_recebidos set emissor = '$nome' where emissor = '$nomeAtual'");	
		$atualizaOficiosEmitidos  = mysql_query("Update oficios_emitidos set destinatario = '$nome' where destinatario = '$nomeAtual'");
		
	}
	
	$atualizaDestinatario = mysql_query("Update destinatarios set nome = '$nome', cargo = '$cargo', orgao = '$orgao', end = '$end', cep = '$cep', cidade = '$cidade', tel = '$tel', email = '$email' where id = '$id'");
	
}

echo "
			<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
				<tr>
					<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
					<td valign='middle' align='center' height='60' class='vde16'>O destinatario $nome</b> foi atualizado com sucesso!<br><img src='img/branco.gif' height='5'><br><font class='cza12'><i><a href='pdf.php?id=$id_oficio_emitido' class='linkcza'>Clique aqui para abrir e imprimir</a></td>
				</tr>
			</table>";