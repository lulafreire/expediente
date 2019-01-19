<?

include("config.php");

// Termo da busca
$termo = $_POST['termo'];

if($termo =='') {

	$termo = $_GET['termo'];

}

// Condicional para buscar pelo NB incluindo os pontos e traço
if(is_numeric($termo)) {

	$numCaracteres = strlen($termo);
	
	if($numCaracteres == 10) {
	
		$n01 = substr($termo, 0, 3);
		$n02 = substr($termo, 3, 3);
		$n03 = substr($termo, 6, 3);
		$n04 = substr($termo, 9, 1);
		$nb  = "$n01.$n02.$n03-$n04";
		$sqlNb = "or texto like '%$nb%'";
	
	}
	
}


echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='40' height='40' background='img/cinza.gif' valign='middle' align='center'><img src='img/lupa.png'></td>
		<td valign='middle' align='left' class='azul16'>&nbsp;&nbsp;<i>Resultado da Busca pelo termo</i> <b>$termo</b> em <b>Memorandos Emitidos</b></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>";

// Pesquisa pelo termo escolhido em Memorandos Emitidos
$sql = mysql_query("Select * from memos_emitidos where num like '%$termo%' or destinatario like '%$termo%' or assunto like '%$termo%' or texto like '%$termo%' $sqlNb");
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
			<td width='100' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>NÚMERO</b></td>
			<td width='300' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>DESTINATÁRIO</b></td>
			<td width='440' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>ASSUNTO</b></td>
			<td width='100' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>DATA</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>
	
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>";

	// Pesquisa os dados do registro localizado
	while($dados = mysql_fetch_array($sql)) {
	
		$id           = $dados['id'];
		$numero       = $dados['num'];
		$destinatario = $dados['destinatario'];
		$assunto      = $dados['assunto'];
		$data         = $dados['data'];
		
		// Formata Datas
		$dt01 = substr($data, 8, 2);
		$dt02 = substr($data, 5, 2);
		$dt03 = substr($data, 0, 4);
		
				
		echo "
		<tr>
			<td width='100' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha_memo.php&id=$id&tipo=2' class='linkazul' title='Detalhar registro'>$numero/$dt03</a></td>
			<td width='300' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha_memo.php&id=$id&tipo=2' class='linkazul' title='Detalhar registro'>$destinatario</a></td>
			<td width='440' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha_memo.php&id=$id&tipo=2' class='linkazul' title='Detalhar registro'>$assunto</a></td>
			<td width='100' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha_memo.php&id=$id&tipo=2' class='linkazul' title='Detalhar registro'>$dt01/$dt02/$dt03</a></td>
		</tr>";
	
	}
	
	echo"</table><img src='img/branco.gif' height='10'><br>";

}

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='40' height='40' background='img/cinza.gif' valign='middle' align='center'><img src='img/lupa.png'></td>
		<td valign='middle' align='left' class='azul16'>&nbsp;&nbsp;<i>Resultado da Busca pelo termo</i> <b>$termo</b> em <b>Memorandos Recebidos</b></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>";

// Pesquisa pelo termo escolhido em Memorandos Recebidos
$sql2 = mysql_query("Select * from memos_recebidos where num like '%$termo%' or interessado like '%$termo%' or emissor like '%$termo%' or assunto like '%$termo%'");
$qt2  = mysql_num_rows($sql2);

if($qt2 =='') {

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
			<td width='100' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>NÚMERO</b></td>
			<td width='300' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>EMISSOR</b></td>
			<td width='440' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>ASSUNTO</b></td>
			<td width='100' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>DATA</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>
	
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>";

	// Pesquisa os dados do registro localizado
	while($dados2 = mysql_fetch_array($sql2)) {
	
		$id2          = $dados2['id'];
		$numero2      = $dados2['num'];
		$emissor      = $dados2['emissor'];
		$assunto2     = $dados2['assunto'];
		$data2        = $dados2['data'];
		
		// Formata Datas
		$dt201 = substr($data2, 8, 2);
		$dt202 = substr($data2, 5, 2);
		$dt203 = substr($data2, 0, 4);
		
				
		echo "
		<tr>
			<td width='100' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha_memo.php&id=$id2&tipo=1' class='linkazul' title='Detalhar registro'>$numero2</a></td>
			<td width='300' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha_memo.php&id=$id2&tipo=1' class='linkazul' title='Detalhar registro'>$emissor</a></td>
			<td width='440' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha_memo.php&id=$id2&tipo=1' class='linkazul' title='Detalhar registro'>$assunto2</a></td>
			<td width='100' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha_memo.php&id=$id2&tipo=1' class='linkazul' title='Detalhar registro'>$dt201/$dt202/$dt203</a></td>
		</tr>";
	
	}
	
	echo"</table>
	<img src='img/branco.gif' height='10'><br>";

}

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='40' height='40' background='img/cinza.gif' valign='middle' align='center'><img src='img/lupa.png'></td>
		<td valign='middle' align='left' class='azul16'>&nbsp;&nbsp;<i>Resultado da Busca pelo termo</i> <b>$termo</b> em <b>Ofícios Emitidos</b></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>";

// Pesquisa pelo termo escolhido em Ofícios Emitidos
$sql = mysql_query("Select * from oficios_emitidos where num like '%$termo%' or destinatario like '%$termo%' or assunto like '%$termo%' or texto like '%$termo%' $sqlNb");
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
			<td width='100' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>NÚMERO</b></td>
			<td width='300' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>DESTINATÁRIO</b></td>
			<td width='440' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>ASSUNTO</b></td>
			<td width='100' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>DATA</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>
	
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>";

	// Pesquisa os dados do registro localizado
	while($dados = mysql_fetch_array($sql)) {
	
		$id           = $dados['id'];
		$numero       = $dados['num'];
		$destinatario = $dados['destinatario'];
		$assunto      = $dados['assunto'];
		$data         = $dados['data'];
		
		// Formata Datas
		$dt01 = substr($data, 8, 2);
		$dt02 = substr($data, 5, 2);
		$dt03 = substr($data, 0, 4);
		
				
		echo "
		<tr>
			<td width='100' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha.php&oficioID=$id&tipo=2' class='linkazul' title='Detalhar registro'>$numero/$dt03</a></td>
			<td width='300' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha.php&oficioID=$id&tipo=2' class='linkazul' title='Detalhar registro'>$destinatario</a></td>
			<td width='440' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha.php&oficioID=$id&tipo=2' class='linkazul' title='Detalhar registro'>$assunto</a></td>
			<td width='100' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha.php&oficioID=$id&tipo=2' class='linkazul' title='Detalhar registro'>$dt01/$dt02/$dt03</a></td>
		</tr>";
	
	}
	
	echo"</table><img src='img/branco.gif' height='10'><br>";

}


echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='40' height='40' background='img/cinza.gif' valign='middle' align='center'><img src='img/lupa.png'></td>
		<td valign='middle' align='left' class='azul16'>&nbsp;&nbsp;<i>Resultado da Busca pelo termo</i> <b>$termo</b> em <b>Ofícios Recebidos</b></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>";

// Pesquisa pelo termo escolhido em Ofícios Recebidos
$sql2 = mysql_query("Select * from oficios_recebidos where num like '%$termo%' or emissor like '%$termo%' or assunto like '%$termo%'");
$qt2  = mysql_num_rows($sql2);

if($qt2 =='') {

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
			<td width='100' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>NÚMERO</b></td>
			<td width='300' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>EMISSOR</b></td>
			<td width='440' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>ASSUNTO</b></td>
			<td width='100' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>DATA</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>
	
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>";

	// Pesquisa os dados do registro localizado
	while($dados2 = mysql_fetch_array($sql2)) {
	
		$id2          = $dados2['id'];
		$numero2      = $dados2['num'];
		$emissor      = $dados2['emissor'];
		$assunto2     = $dados2['assunto'];
		$data2        = $dados2['data'];
		
		// Formata Datas
		$dt201 = substr($data2, 8, 2);
		$dt202 = substr($data2, 5, 2);
		$dt203 = substr($data2, 0, 4);
		
				
		echo "
		<tr>
			<td width='100' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha.php&oficioID=$id2&tipo=1' class='linkazul' title='Detalhar registro'>$numero2</a></td>
			<td width='300' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha.php&oficioID=$id2&tipo=1' class='linkazul' title='Detalhar registro'>$emissor</a></td>
			<td width='440' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha.php&oficioID=$id2&tipo=1' class='linkazul' title='Detalhar registro'>$assunto2</a></td>
			<td width='100' height='30' valign='middle' align='center' class='azul12'><a href='index.php?conteudo=detalha.php&oficioID=$id2&tipo=1' class='linkazul' title='Detalhar registro'>$dt201/$dt202/$dt203</a></td>
		</tr>";
	
	}
	
	echo"</table>";

}