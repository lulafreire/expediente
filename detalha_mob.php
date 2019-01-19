<?

include("config.php");

// Pesquisa os detalhes do NB selecionado
$nb = $_GET['nb'];

echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='400' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>NOME</b></td>
			<td width='200' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>NB</b></td>
			<td width='130' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>FASE</b></td>
			<td width='80' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>DATA DE CADASTRO</b></td>
			<td width='80' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>ATUALIZADO EM</b></td>
			<td width='50' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>OBS</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>
	
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>";

$sql = mysql_query("select * from mob where nb = '$nb'");
while($dados = mysql_fetch_array($sql)) {

	$id      = $dados ['id'];
	$nome    = $dados ['nome'];
	$sipps   = $dados ['sipps'];
	$origem  = $dados ['origem'];
	$demanda = $dados ['demanda'];
	$fase    = $dados ['fase'];
	$obs     = $dados ['obs'];
	$dtCad   = $dados ['dtCad'];
	$dtAtu   = $dados ['dtAtu'];
	
	if($obs=='') {
		
		$obs = "Não há observações.";
		
	}
		
		// Formata Datas
		$dtC01 = substr($dtCad, 8, 2);
		$dtC02 = substr($dtCad, 5, 2);
		$dtC03 = substr($dtCad, 0, 4);
		
		$dtA01 = substr($dtAtu, 8, 2);
		$dtA02 = substr($dtAtu, 5, 2);
		$dtA03 = substr($dtAtu, 0, 4);
		
		echo "
		<tr>
			<td width='400' height='30' valign='middle' align='center' class='azul10'><a href='index.php?conteudo=detalhar_mob.php&nb=$nb' class='linkazul' title='Detalhar registro'>$nome</a></td>
			<td width='200' height='30' valign='middle' align='center' class='azul10'><a href='index.php?conteudo=detalhar_mob.php&nb=$nb' class='linkazul' title='Detalhar registro'>$nb</a></td>
			<td width='130' height='30' valign='middle' align='center' class='azul10'><a href='index.php?conteudo=detalhar_mob.php&nb=$nb' class='linkazul' title='Detalhar registro'>$fase</a></td>
			<td width='80' height='30' valign='middle' align='center' class='azul10'><a href='index.php?conteudo=detalhar_mob.php&nb=$nb' class='linkazul' title='Detalhar registro'>$dtC01/$dtC02/$dtC03</a></td>
			<td width='80' height='30' valign='middle' align='center' class='azul10'><a href='index.php?conteudo=detalhar_mob.php&nb=$nb' class='linkazul' title='Detalhar registro'>$dtA01/$dtA02/$dtA03</a></td>
			<td width='50' height='30' valign='middle' align='center' class='azul10'><a href='index.php?conteudo=detalhar_mob.php&nb=$nb' class='linkazul' title='$obs'><img src='img/txt.gif'></a></td>
		</tr>";

}

echo"</table>";		
		
		
?>