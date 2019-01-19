<?

include("config.php");
$ano = date('Y');

// Verifica o número do último ofício
$sqlNum = mysql_query("select num from oficios_emitidos WHERE data like '$ano%' order by num desc limit 1");
		$resNum = mysql_num_rows($sqlNum);
		
		if($resNum =='') {
		
			$numero = "1";
		
		} else {
		
			while($n = mysql_fetch_array($sqlNum)) {
		
			$num = $n['num'];
			$numero  = $num + 1;
		
			}
		
		}

		
// Verifica se o destinatário já existe no banco de dados
$sqlDestinatario = mysql_query("Select * from destinatarios where nome = '$destinatario'");
$qtDestinatario  = mysql_num_rows($sqlDestinatario);

if($qtDestinatario =='') {

	$gravaDestinatario = mysql_query("Insert into destinatarios (nome, cargo, orgao, end, cep, cidade, email, telefone) values ('$destinatario','$cargo','$orgao','$endereco','$cep','$cidade','$email','$telefone')");

}

// Grava o registro
$grava = mysql_query("Insert into oficios_emitidos (emitente, destinatario, assunto, tratamento, texto, num, resposta, data) values ('$emitente','$destinatario','$assunto','$tratamento','$texto','$numero', '', curdate())");
$id_oficio_emitido = mysql_insert_id();
$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$id_oficio_emitido','oficios_emitidos','Ofício cadastrado')");

// Caso seja resposta a um ofício recebido, faz a gravação
if($resposta !='0') {

	$atualiza = mysql_query("Update oficios_recebidos set resposta = '$id_oficio_emitido' where id = $resposta");
	$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$resposta','oficios_recebidos','Ofício respondido')");

}



echo "
			<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
				<tr>
					<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
					<td valign='middle' align='center' height='60' class='vde16'>O Ofício nº <b>$numero/$ano/APSIRECE/INSS</b>, destinado a <b>$destinatario</b> foi emitido com sucesso!<br><img src='img/branco.gif' height='5'><br><font class='cza12'><i><a href='pdf.php?id=$id_oficio_emitido' class='linkcza'>Clique aqui para abrir e imprimir</a></td>
				</tr>
			</table>";	