<?

include("config.php");
$ano = date('Y');

// Verifica o número do último ofício
$sqlNum = mysql_query("select num from cartas_emitidas WHERE data like '$ano%' order by num desc limit 1");
		$resNum = mysql_num_rows($sqlNum);
		
		if($resNum =='') {
		
			$numero = "1";
		
		} else {
		
			while($n = mysql_fetch_array($sqlNum)) {
		
			$num = $n['num'];
			$numero  = $num + 1;
		
			}
		
		}

$destinatario = strtoupper($destinatario);

// Grava o registro
$grava = mysql_query("Insert into cartas_emitidas (emitente, destinatario, end, cep, cidade, assunto, tratamento, texto, num, resposta, data, subtitulo, fundLegal) values ('$emitente','$destinatario','$end','$cep','$cidade','$assunto','$tratamento','$texto','$numero', '', curdate(), '$subtitulo', '$fundLegal')");
$id_carta_emitida = mysql_insert_id();
$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$id_carta_emitida','cartas_emitidas','Carta cadastrada')");


echo "
			<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
				<tr>
					<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
					<td valign='middle' align='center' height='60' class='vde16'>A Carta nº <b>$numero/$ano/APSIRECE/INSS</b>, destinada a <b>$destinatario</b> foi emitida com sucesso!<br><img src='img/branco.gif' height='5'><br><font class='cza12'><i><a href='carta_pdf.php?id=$id_carta_emitida' class='linkcza'>Clique aqui para abrir e imprimir</a></td>
				</tr>
			</table>";	