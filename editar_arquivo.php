<?
include("config.php");

$txtNome = $_POST['txtNome'];

if($txtNome=='')
{
    include("frm_arquivo.php");
}
else
{
//$nb = preg_replace("#\D#",'',$txtNome);
$n = explode("-", $txtNome);
$id = $n[0];

// Pesquisa os dados da propriedade
$sqlNb = mysql_query("Select * from mob where id = '$id'");

$resNb = mysql_num_rows($sqlNb);

if($resNb =='') {

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
	    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
		<td valign='middle' align='center' height='60' width='740' class='ver16'>Nenhum registro foi selecionado selecionado!</td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>
<input type='button' value='Voltar' onClick='history.back()'>";


} else {

while($n=mysql_fetch_array($sqlNb))
{
    $esp         = $n['especie'];
	$nb          = $n['nb'];
	$nomeTitular = $n['nome'];
	$sipps       = $n['sipps'];
	$origem      = $n['origem'];
	$caixa       = $n['caixa'];
	$demanda     = $n['demanda'];
	$fase	     = $n['fase'];
	$obs         = $n['obs'];
	$dtCad       = $n['dtCad'];
	$dtAtu       = $n['dtAtu'];
}

switch ($fase)
	{
	case "INICIAL": $ini = "selected"; break;
	case "DEFESA": $def = "selected"; break;
	case "RECURSO": $rec = "selected"; break;
	case "COBRANÇA ADM": $cob1 = "selected"; break;
	case "COBRANÇA JUD": $cob2 = "selected"; break;
	case "CADIN": $cad = "selected"; break;
	case "CONVOCAÇÃO": $conv = "selected"; break;
	case "GEXPF": $gexpf = "selected"; break;
	case "SOFC": $sofc = "selected"; break;
	case "APE": $ape = "selected"; break;
	case "CONCLUIDO": $con = "selected"; break;
	}
	
switch($origem) {

	case "APS": $aps = "checked"; break;
	case "CMOBEN": $cmoben = "checked"; break;

}
	

echo "
<table width='700' cellpadding='0' cellspacing='0'>
  <tr><form method='post' action='index.php?conteudo=atualizar_arquivo.php'>
    <td valign='middle' align='right' width='200' class='azul12'><b>ESP / NB:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='esp' size='2' value='$esp'>&nbsp;&nbsp;<input type='text' name='num' size='20' value='$nb'>&nbsp;&nbsp;<font class='ver09'>Apenas números</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Protocolo SIPPS:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='sipps' size='40' maxlength='17' value='$sipps'>&nbsp;&nbsp;<font class='ver09'>Apenas números</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Nome Completo:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='nomeTitular' size='60' value='$nomeTitular'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Origem:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'><input type='radio' name='origem' value='APS' $aps> APS - Controle Interno &nbsp;&nbsp;<input type='radio' name='origem' value='CMOBEN' $cmoben>CMOBEN</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Demanda:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='demanda' size='60' value='$demanda'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <td valign='middle' align='right' width='200' class='azul12'><b>Fase:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>
	<select name='fase'>
		<option value='INICIAL' $ini>Inicial</option>
		<option value='DEFESA' $def>Defesa</option>
		<option value='CONVOCAÇÃO' $conv>Convocação</option>
		<option value='RECURSO' $rec>Recurso</option>
		<option value='COBRANÇA ADM' $cob1>Cobrança Administrativa</option>
		<option value='COBRANÇA JUD' $cob2>Cobrança Judicial</option>
		<option value='CADIN' $cad>Inclusão no CADIN</option>
		<option value='SOFC' $sofc>Enviado à SOFC</option>
		<option value='APE' $ape>Enviado à APE</option>
		<option value='GEXPF' $gexpf>Enviado à GEX-PF</option>
		<option value='CONCLUÍDO' $con>Concluído</option>
	</select>
	</td>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Caixa:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='caixa' size='10' value='$caixa'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Observações:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><textarea name='obs' rows='3' cols='45'>$obs</textarea></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'></td>
    <td valign='middle' align='left'><input type='hidden' name='id' value='$id'><input type='submit' value='Continuar...'></td>
  </tr></form>
</table>";

}
}

?>
