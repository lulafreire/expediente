<?

echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='940' height='40' background='img/fundo_menu_topo2.png' valign='middle' align='center' class='azul10'><b>HISTÓRICO DE EVENTOS</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='2'><br>
	
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>";

// Verifica o histórico de eventos do processo
$sqlHistorico = mysql_query("select * from eventos where id = '$id' and origem = '$banco' order by data desc");
while($h = mysql_fetch_array($sqlHistorico)) {

	$data      = $h['data'];
	$descricao = $h['descricao'];
	
	// Formata Datas
		$dtE01 = substr($data, 8, 2);
		$dtE02 = substr($data, 5, 2);
		$dtE03 = substr($data, 0, 4);
	
	echo "
	
		<tr>
			<td width='100' height='30' valign='middle' align='center' class='azul12'>$dtE01/$dtE02/$dtE03</td>
			<td width='840' height='30' valign='middle' align='left' class='azul12'>&nbsp;&nbsp;$descricao</td>
		</tr>";

}   echo "
    </table>
	<img src='img/branco.gif' height='5'><br>";