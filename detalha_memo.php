<?

include("config.php");

// Pesquisa os detalhes do registro selecionado
$id     = $_GET['id'];
$tipo         = $_GET['tipo'];
$ano_emissao  = date('Y');

switch($tipo) {

	case 1: $banco = "memos_recebidos"; $resp = "memos_emitidos"; $tipo2 = '2'; $img = "recebidos.png"; $tipoTxt = "Memorando Recebido"; break;
	case 2: $banco = "memos_emitidos"; $resp = "memos_recebidos"; $tipo2 = '1'; $img = "enviados.png"; $tipoTxt = "Memorando Emitido"; break;

}

$sql = mysql_query("select * from $banco where id = '$id'");
while($r = mysql_fetch_array($sql)) {

	if($tipo == '1') { // --------------------------------------------------- Ofícios Recebidos
	
	$id            = $r['id'];
	$numero        = $r['num'];
	$emissor       = $r['emissor'];
	$interessado   = $r['interessado'];
	$data          = $r['data'];
	$assunto       = $r['assunto'];
	$resposta      = $r['resposta'];
	$anexo         = $r['anexo'];
	$tam           = $r['tam'];
	$descricao     = $r['descricao'];

	$destinatario_emissor = $emissor;
	
	// Formata data
	$d     = explode("-", $data);
	$dia   = $d[2];
	$mes   = $d[1];
	$ano   = $d[0];
	$ndata = "$dia/$mes/$ano";
	
	$numeroCompleto = "$numero";
	
	// Verifica se o ofício foi respondido
	if ($resposta=='') {
	
		$respostaTxt = "Memorando não respondido";
		$flag = "flag_ver.png";
		$flagTxt = "Não respondido";
		
	} else {
		
		// Pesquisa os dados do Memorando de resposta
		$sqlResp = mysql_query("Select * from $resp where id = '$resposta'");
		while($r = mysql_fetch_array($sqlResp)) {
		
			$idResp     = $r['id'];
			$numeroResp = $r['num'];
			$dataResp   = $r['data'];
			
			// Formata data
			$dR = explode("-", $dataResp);
			$diaR = $dR[2];
			$mesR = $dR[1];
			$anoR = $dR[0];
			$dataR = "$diaR/$mesR/$ano";
			
			$respostaTxt = "<a href='index.php?conteudo=detalha_memo.php&id=$idResp&tipo=$tipo2' class='linkazul' title='Clique para baixar o Memorando nº $numeroResp'>Memorando nº $numeroResp/$anoR/APSIRECE/INSS, de $dataR</a>";
		}
		
		$flag = "flag_vde.png";
		$flagTxt = "Respondido";
	
	}
	
	// Verifica se o Memorando foi emitido em resposta a algum outro
	$sqlResp2 = mysql_query("Select * from $resp where resposta = '$id'");
	$qtResp2  = mysql_num_rows($sqlResp2);
	if($qtResp2=='') {
		
		$respostaTxt2 = "Memorando inicial, não responde nenhum outro.";		
		
	} else {
		
			while($r2 = mysql_fetch_array($sqlResp2)) {
		
			$idResp2     = $r2['id'];
			$numeroResp2 = $r2['num'];
			$dataResp2   = $r2['data'];
			$emissor2    = $r2['emissor'];
			
			// Formata data
			$dR2    = explode("-", $dataResp2);
			$diaR2  = $dR2[2];
			$mesR2  = $dR2[1];
			$anoR2  = $dR2[0];
			$dataR2 = "$diaR2/$mesR2/$anoR2";
			
			$respostaTxt2 = "<a href='index.php?conteudo=detalha.php&id=$idResp2&tipo=$tipo2' class='linkazul' title='Ver detalhes'>Memorando nº $numeroResp2, emitido em $dataR2</a>";
			}
	}
	
	
	// Pesquisa os dados do destinatario
	$sqlDest = mysql_query("Select * from destinatarios where nome = '$destinatario' or nome = '$emissor'");
	while ($dadosDest = mysql_fetch_array($sqlDest)) {
		
		$idDest    = $dadosDest['id'];
		$nomeDest  = $dadosDest['nome'];
		$cargo     = $dadosDest['cargo'];
		$orgao     = $dadosDest['orgao'];
		$end       = $dadosDest['end'];
		$cep       = $dadosDest['cep'];
		$cidade    = $dadosDest['cidade'];
		$telefone  = $dadosDest['telefone'];
		$email     = $dadosDest['email'];
	
	
	}
	
	} else { // -------------------------------------------------------------------- Memorandos Emitidos
	
	$id           = $r['id'];
	$numero       = $r['num'];
	$destinatario = $r['destinatario'];
	$interessado  = $r['interessado'];
	$data         = $r['data'];
	$assunto      = $r['assunto'];
	$resposta     = $r['resposta'];
	$anexo        = $r['anexo'];
	$tam          = $r['tam'];
	$descricao    = $r['descricao'];

	$destinatario_emissor = $destinatario;
	
	// Formata data
	$d     = explode("-", $data);
	$dia   = $d[2];
	$mes   = $d[1];
	$ano   = $d[0];
	$ndata = "$dia/$mes/$ano";
	
	$numeroCompleto = "$numero/$ano/APSIRECE/INSS";
	
	if ($resposta=='') {
	
		$respostaTxt = "Memorando não respondido";
		$flag = "flag_ver.png";
		$flagTxt = "Não respondido";
		
	} else if ($resposta == '0') {
	
		$respostaTxt = "Memorando não necessita de resposta";
	
	} else {
		
		// Pesquisa os dados do Memorando de resposta
		$sqlResp = mysql_query("Select * from $resp where id = '$resposta'");
		while($r = mysql_fetch_array($sqlResp)) {
		
			$idResp     = $r['id'];
			$numeroResp = $r['num'];
			$dataResp   = $r['data'];
			$emissor    = $r['emissor'];
			
			// Formata data
			$dR = explode("-", $dataResp);
			$diaR = $dR[2];
			$mesR = $dR[1];
			$anoR = $dR[0];
			$dataR = "$diaR/$mesR/$ano";
			
			$respostaTxt = "<a href='memo_pdf.php?id=$idResp' class='linkazul' title='Clique para baixar o Memorando nº $numeroResp'>Memorando nº $numeroResp, de $emissor, emitido em $dataR</a>";
		}
		
		$flag = "flag_vde.png";
		$flagTxt = "Respondido";
	
	}
	
	// Verifica se o Memorando foi emitido em resposta a algum outro
	$sqlResp2 = mysql_query("Select * from $resp where resposta = '$id'");
	$qtResp2  = mysql_num_rows($sqlResp2);
	if($qtResp2=='') {
		
		$respostaTxt2 = "Memorando inicial, não responde nenhum outro.";		
		
	} else {
	while($r2 = mysql_fetch_array($sqlResp2)) {
		
			$idResp2     = $r2['id'];
			$numeroResp2 = $r2['num'];
			$dataResp2   = $r2['data'];
			$emissor2    = $r2['emissor'];
			
			// Formata data
			$dR2    = explode("-", $dataResp2);
			$diaR2  = $dR2[2];
			$mesR2  = $dR2[1];
			$anoR2  = $dR2[0];
			$dataR2 = "$diaR2/$mesR2/$anoR2";
			
			$respostaTxt2 = "<a href='index.php?conteudo=detalha_memo.php&id=$idResp2&tipo=$tipo2' class='linkazul' title='Ver detalhes'>Memorando nº $numeroResp2, emitido em $dataR2</a>";
		}
	}
		
		// Pesquisa os dados do destinatario
	$sqlDest = mysql_query("Select * from destinatarios where nome = '$destinatario' or nome = '$emissor'");
	while ($dadosDest = mysql_fetch_array($sqlDest)) {
		
		$idDest    = $dadosDest['id'];
		$nomeDest  = $dadosDest['nome'];
		$cargo     = $dadosDest['cargo'];
		$orgao     = $dadosDest['orgao'];
		$end       = $dadosDest['end'];
		$cep       = $dadosDest['cep'];
		$cidade    = $dadosDest['cidade'];
		$telefone  = $dadosDest['telefone'];
		$email     = $dadosDest['email'];
	
	
	}
	
	}

}

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='40' height='40' background='img/fundo_menu_topo2.png' valign='middle' align='center'><img src='img/$img' width='32'></td>
		<td width='820' valign='middle' align='left' class='azul16'>&nbsp;&nbsp;<i>Detalhes do Memorando nº <b>$numeroCompleto</b>, de $ndata</i>&nbsp;<font class='cza10'>[ $tipoTxt ]</font></td>
		<td width='40' height='30' valign = 'middle' align='center' class='azul10'><a title='$flagTxt'><img src='img/$flag' height='16'></a></td>
		<td width='40' height='30' valign = 'middle' align='center' class='azul10'><a href='index.php?conteudo=editar.php&id=$id&tipo=$tipo' title='Editar' target='_parent'><img src='img/edit.png' border='0'></a></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>";

echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='270' height='40' background='img/fundo_menu_topo2.png' valign='middle' align='center' class='azul10'><b>DESTINATÁRIO</b></td>
			<td width='270' height='40' background='img/fundo_menu_topo2.png' valign='middle' align='center' class='azul10'><b>INTERESSADO</b></td>			
			<td width='400' height='40' background='img/fundo_menu_topo2.png' valign='middle' align='center' class='azul10'><b>ASSUNTO</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='2'><br>";

		
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='270' height='30' valign='middle' align='center' class='azul12'>$destinatario_emissor</td>
			<td width='270' height='30' valign='middle' align='center' class='azul12'>$interessado</td>
			<td width='400' height='30' valign='middle' align='center' class='azul12'>$assunto</td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>";

	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='200' height='40' background='img/fundo_menu_topo2.png' valign='middle' align='center' class='azul10'><b>CARGO</b></td>
			<td width='340' height='40' background='img/fundo_menu_topo2.png' valign='middle' align='center' class='azul10'><b>ÓRGÃO</b></td>
			<td width='200' height='40' background='img/fundo_menu_topo2.png' valign='middle' align='center' class='azul10'><b>TELEFONE</b></td>
			<td width='200' height='40' background='img/fundo_menu_topo2.png' valign='middle' align='center' class='azul10'><b>E-MAIL</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='2'><br>";
	
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='200' height='30' valign='middle' align='center' class='azul12'>$cargo</td>
			<td width='340' height='30' valign='middle' align='center' class='azul12'>$orgao</td>
			<td width='200' height='30' valign='middle' align='center' class='azul12'>$telefone</td>
			<td width='200' height='30' valign='middle' align='center' class='azul12'>$email</td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>";
	
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='470' height='40' background='img/fundo_menu_topo2.png' valign='middle' align='center' class='azul10'><b>EMITIDO EM RESPOSTA AO Memorando</b></td>
			<td width='470' height='40' background='img/fundo_menu_topo2.png' valign='middle' align='center' class='azul10'><b>RESPONDIDO PELO Memorando</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='2'><br>";
	
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='470' height='60' valign='middle' align='center' class='azul12'>$respostaTxt2</td>
			<td width='470' height='60' valign='middle' align='center' class='azul12'>$respostaTxt</td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>";
	
	// Anexo inicial
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='940' height='40' background='img/fundo_menu_topo2.png' valign='middle' align='center' class='azul10'><b>ANEXOS</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='2'><br>";
	
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>";
		
		if($tipo =='2' and $anexo =='') {
		echo "
		<tr>
			<td width='40' height='40' valign='middle' align='center'><a href='pdf.php?id=$id' class='linkazul' title='Abrir o Memorando nº $numeroCompleto'><img src='img/download.png' width='32' border='0'></a></td>
			<td width='880' height='40' valign='middle' align='left' class='azul12'>&nbsp;<a href='memo_pdf.php?id=$id' class='linkazul' title='Abrir o Memorando nº $numeroCompleto'><b>Memorando nº $numeroCompleto</b></a></td>
		</tr>";			
			
		}
		
		if($anexo !='') {
		echo "
		<tr>
			<td width='40' height='40' valign='middle' align='center'><a href='download.php?url=$anexo' class='linkazul' title='Baixar anexo $anexo'><img src='img/download.png' width='32' border='0'></a></td>
			<td width='880' height='40' valign='middle' align='left' class='azul12'>&nbsp;<a href='download.php?url=$anexo' class='linkazul' title='Baixar anexo $anexo'><b>$descricao</b></a> [$tam Mb]</td>
		</tr>";
		} 
		
		
	
	// Verifica se há anexos complementares
	$sqlAnexos = mysql_query("Select * from anexos where id = '$id' and origem = 'MOB' order by dtEnvio asc");
	$resAnexos = mysql_num_rows($sqlAnexos);
	
	    if($anexo =='' and $resAnexos =='' and $tipo=='1') {
		
		echo "
		<tr>
			<td width='40' height='40' valign='middle' align='center'><img src='img/download.png' width='32' border='0'></td>
			<td width='880' height='40' valign='middle' align='left' class='cza12'>&nbsp;&nbsp;<i>Não há anexos para este processo.</i></td>
		</tr>";		
		
		}
	
	
	if($resAnexos !='') {
	
		while($a = mysql_fetch_array($sqlAnexos)) {
		
			$anexo2      = $a['anexo'];
			$tam2        = $a['tam'];
			$descricao2  = $a['descricao'];
			$dtEnvio     = $a['dtEnvio'];
			
			if($descricao2 == '') {
	
				$descricao2 = "Anexo não identificado";
	
			}
			
			// Formata Datas
			$dtE01 = substr($dtEnvio, 8, 2);
			$dtE02 = substr($dtEnvio, 5, 2);
			$dtE03 = substr($dtEnvio, 0, 4);
			
			echo "
			
				<tr>
					<td width='40' height='40' valign='middle' align='center'><a href='download.php?url=$anexo2' class='linkazul' title='Baixar anexo $anexo2'><img src='img/download.png' width='32' border='0'></a></td>
					<td width='880' height='40' valign='middle' align='left' class='azul12'>&nbsp;<a href='download.php?url=$anexo2' class='linkazul' title='Baixar anexo $anexo2'><b>$descricao2</b></a> [$tam2 Mb]</td>
				</tr>";			
		
		}
	
	
	} echo "</table><img src='img/branco.gif' height='5'><br>";
	
	include("historico.php");


		
?>