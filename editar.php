<?
include("config.php");

// Pesquisa os dados do ofício selecionado
$oficioID = $_GET['oficioID'];
$tipo     = $_GET['tipo'];

switch($tipo) {

	case 1: $banco = "oficios_recebidos"; $resp = "oficios_emitidos"; $tipo2 = '2'; break;
	case 2: $banco = "oficios_emitidos"; $resp = "oficios_recebidos"; $tipo2 = '1'; break;

}

$sqlOficio = mysql_query("Select * from $banco where id = '$oficioID'");
while($o = mysql_fetch_array($sqlOficio)) {	
	
	if($tipo == 1) {
	
		$numero       = $o['num'];
		$data         = $o['data'];
		$assunto      = $o['assunto'];
		$resposta     = $o['resposta'];
		$interessado  = $o['emissor'];
		
		// Formata a data
		$d = explode("-", $data);
		$dia = $d[2];
		$mes = $d[1];
		$ano = $d[0];
		$ndata = "$dia/$mes/$ano";
	
	} else {
	
		$numero       = $o['num'];
		$assunto      = $o['assunto'];
		$resposta     = $o['resposta'];
		$interessado  = $o['destinatario'];
		$texto        = $o['texto'];
		$tratamento   = $o['tratamento'];
	
	}
	
	switch($tratamento) {
	
		case 'Exmo(a) Sr(a)': $t1 = "selected"; break;
		case 'Ilmo(a) Sr(a)': $t2 = "selected"; break;
		case 'Prezado(a) Sr(a)': $t3 = "selected"; break;
	
	}

	// Verifica os dados do destinatario
	$sqlNb = mysql_query("Select * from destinatarios where nome = '$interessado'");
	while($n=mysql_fetch_array($sqlNb)) {

	$cargo        = $n['cargo'];
	$orgao        = $n['orgao'];
	$endereco     = $n['end'];
	$cep          = $n['cep'];
	$cidade       = $n['cidade'];
	
	}
	
	// Verifica se o ofício foi emitido em resposta a algum outro
	$sqlResp2 = mysql_query("Select * from $resp where resposta = '$oficioID'");
	$qtResp2  = mysql_num_rows($sqlResp2);
	if($qtResp2=='') {
		
		$respostaTxt2 = "Ofício inicial, não responde nenhum outro.";		
		
	} else {
		
			while($r2 = mysql_fetch_array($sqlResp2)) {
		
			$idResp2     = $r2['id'];
			$numeroResp2 = $r2['num'];
			$dataResp2   = $r2['data'];
			$emissor2    = $r2['emissor'];
			$ass2        = $r2['assunto'];
			
			// Formata data
			$dR2    = explode("-", $dataResp2);
			$diaR2  = $dR2[2];
			$mesR2  = $dR2[1];
			$anoR2  = $dR2[0];
			$dataR2 = "$diaR2/$mesR2/$anoR2";
			
			$respostaTxt2 = "Ofício nº $numeroResp2, emitido em $dataR2 (Ass.: $ass2)";
			}
	}
	

}
	
echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='40' height='40' background='img/cinza.gif' valign='middle' align='center'><img src='img/editar.png' height='32' width='32'></td>
		<td valign='middle' align='left' class='azul16'>&nbsp;&nbsp;<b>Editar Ofício</b> <font class='cza12'><i>Alterar dados de ofícios emitidos</i></font></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>
<form method='post' action='index.php?conteudo=altera_oficio.php'>";

if($tipo == 2) {

	echo "
	<table width='940' cellpadding='0' cellspacing='0'>
		<tr>
			<td valign='middle' align='right' width='200' class='azul12'><b>Emitente:&nbsp;&nbsp;</td>
			<td valign='middle' align='left'>
				<select name='emitente' size='1'>
					<option value='1'>Luiz Alberto Freire de Oliveira</option>
					<option value='2'>Leonardo Sampaio dos Santos</option>
				</select>
			</td>
		</tr>
		<tr>
			<td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
			<td valign='middle'><hr size='1' color='#c0c0c0'></td>
		</tr>
	</table>";

}

echo "
<table width='940' cellpadding='0' cellspacing='0'>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Interessado:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='interessado' size='60' value='$interessado'>&nbsp;</td>
  </tr>";
  
if($tipo == 1) {

echo "
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Número:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='num' size='15' value='$numero'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Data de Emissão:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='num' size='15' value='$ndata'>&nbsp;</td>
  </tr>";

}

echo "
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Cargo:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='cargo' size='60' value='$cargo'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Órgão:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='orgao' size='60' value='$orgao'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Endereço:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='endereco' size='60' value='$endereco'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>CEP - Cidade/UF:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='cep' size='15' value='$cep'>&nbsp;<input type='text' name='cidade' size='15' value='$cidade'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Assunto:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='assunto' size='60' value='$assunto'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Em resposta ao ofício:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'>";
	
if($tipo== 2) {

	include("select_editar_oficios_recebidos.php"); 
	
} else {

	include("select_editar_oficios_expedidos.php");

}

echo "</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>";

 
if($tipo == 2) {
echo"
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Tratamento:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'>
		<select name='tratamento' size='1'>
			<option value='Exmo(a) Sr(a)' $t1>Exmo(a) Sr(a)</option>
			<option value='Ilmo(a) Sr(a)' $t2>Ilmo(a) Sr(a)</option>
			<option value='Prezado(a) Sr(a)' $t3>Prezado(a) Sr(a)</option>
		</select>
	</td>
  </tr>
   <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
 </table>
 <table width='940' cellpadding='0' cellspacing='0'>
  <tr>
    <td valign='middle' align='center'>
	<textarea name='texto' cols='100' rows='18'>$texto</textarea>
  </tr>
</table>";
 }

echo "
<table width='940' cellpadding='0' cellspacing='0'>
  <tr>
    <td valign='middle' align='center' height='60'><input type='hidden' name='num' value='$numero'><input type='hidden' name='tipo' value='$tipo'><input type='hidden' name='oficioID' value='$oficioID'><input type='submit' value='Salvar'></td>
  </tr></form>
</table><img src='img/branco.gif' height='15'><br>";

?>