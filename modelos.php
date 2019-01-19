<?

include("config.php");

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='40' height='40' background='img/cinza.gif' valign='middle' align='center'><img src='img/modelos.png' height='32' width='32'></td>
		<td valign='middle' align='left' class='azul16'>&nbsp;&nbsp;<b>Modelos</b> <font class='cza12'><i>Utilizar modelos prontos para emitir um novo documento.</i></font></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>";

// Pesquisar os modelos existentes
$sqlMod = mysql_query("Select * from modelos order by descricao asc");
$qtMod  = mysql_num_rows($sqlMod);

if($qtMod=='') {

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
	    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
		<td valign='middle' align='center' height='60' width='740' class='ver16'>Nenhum modelo cadastrado.</td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>";	

} else {

	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='240' height='40' background='img/fundo_menu_topo2.png' valign='middle' align='center' class='azul10'><b>TIPO</b></td>
			<td width='610' height='40' background='img/fundo_menu_topo2.png' valign='middle' align='center' class='azul10'><b>DESCRIÇÃO</b></td>
			<td width='90' colspan='3' height='40' background='img/fundo_menu_topo2.png' valign='middle' align='center' class='azul10'><b>OPÇÕES</b></td>
		</tr>";

	while($m = mysql_fetch_array($sqlMod)) {
	
		$idMod     = $m['id'];
		$tipo      = $m['tipo'];
		$descricao = $m['descricao'];
		$texto     = $m['texto'];
		
		switch($tipo) {
		
			case "OFÍCIO": $url = "usar_modelo.php"; break;
			case "CARTA": $url = "emitir_carta.php"; break;
		
		}

		echo "
			<tr>
				<td width='240' height='30' valign='middle' align='center' class='azul12'>$tipo</td>
				<td width='610' height='30' valign='middle' align='center' class='azul12'>$descricao</td>
				<td width='30' height='30' valign='middle' align='center'><a href='index.php?conteudo=detalha_modelo.php&idMod=$idMod' title='Viualizar'><img src='img/txt.png' border='0'></a></td>
				<td width='30' height='30' valign='middle' align='center'><a href='index.php?conteudo=$url&idMod=$idMod' title='Usar este modelo'><img src='img/sucesso.png' width='16' border='0'></a></td>
				<td width='30' height='30' valign='middle' align='center'><a href='index.php?conteudo=deleta_modelo.php&idMod=$idMod' title='Apagar'><img src='img/delete.png' border='0'></a></td>
			</tr>";
	
	}
	echo "</table><img src='img/branco.gif' height='10'><br>";

}

?>