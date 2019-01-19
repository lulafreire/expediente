<?

include("config.php");

$fase   = $_GET['fase'];
$origem = $_GET['origem'];

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='40' height='40' background='img/cinza.gif' valign='middle' align='center'><img src='img/lupa.png'></td>
		<td valign='middle' align='left' class='azul16'>&nbsp;&nbsp;Processo cadastrados na fase <b>$fase</b> Origem <b>$origem</b></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>";

// Pesquisa pelo termo escolhido
$sql = mysql_query("Select * from mob where fase = '$fase' and origem = '$origem' order by nome asc");
$qt  = mysql_num_rows($sql);

if($qt =='') {

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='40' height='40' background='img/cinza.gif' valign='middle' align='center'><img src='img/alert.png'></td>
		<td valign='middle' align='left' class='ver14'>&nbsp;Nenhum resultado encontrado</td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>";

} else {

	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='400' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>NOME</b></td>
			<td width='200' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>NB</b></td>
			<td width='130' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>FASE</b></td>
			<td width='80' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>DATA DE CADASTRO</b></td>
			<td width='80' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>ÚLTIMA ATUALIZAÇÃO</b></td>
			<td width='50' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>OBS</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>
	
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>";

	// Pesquisa os dados do registro localizado
	while($dados = mysql_fetch_array($sql)) {
	
		$id      = $dados ['id'];
		$nb      = $dados ['nb'];
		$nome    = $dados ['nome'];
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
		
		// Formata NB
		$nb01 = substr($nb, 0, 3);
		$nb02 = substr($nb, 3, 3);
		$nb03 = substr($nb, 6, 3);
		$nb04 = substr($nb, 9, 1);
		
				
		echo "
		<tr>
			<td width='400' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalhar_mob.php&id=$id' class='linkazul' title='Detalhar registro'>$nome</a></td>
			<td width='200' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalhar_mob.php&id=$id' class='linkazul' title='Detalhar registro'>$nb01.$nb02.$nb03-$nb04</a></td>
			<td width='130' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalhar_mob.php&id=$id' class='linkazul' title='Detalhar registro'>$fase</a></td>
			<td width='80' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalhar_mob.php&id=$id' class='linkazul' title='Detalhar registro'>$dtC01/$dtC02/$dtC03</a></td>
			<td width='80' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalhar_mob.php&id=$id' class='linkazul' title='Detalhar registro'>$dtA01/$dtA02/$dtA03</a></td>
			<td width='50' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalhar_mob.php&id=$id' class='linkazul' title='$obs'><img src='img/txt.gif'></a></td>
		</tr>";
	
	}
	
	echo"</table>";

}