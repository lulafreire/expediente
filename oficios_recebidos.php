<?

include("config.php");
include("mascara_data.php");

$txtNome = $_POST['txtNome'];

if($txtNome=='') {
    
	include("frm_arquivo_recebidos.php");

} else {

	//$nb = preg_replace("#\D#",'',$txtNome);
	$n = explode("-", $txtNome);
	$id = $n[0];
	$emissor = $n[1];

	// Pesquisa os dados da propriedade
	$sqlNb = mysql_query("Select * from destinatarios where id = '$id'");

	$resNb = mysql_num_rows($sqlNb);
	if($resNb=='') {
	
		$emissor = $txtNome;
	
	}

	while($n=mysql_fetch_array($sqlNb)) {

		$id_emissor   = $n['id'];
		$destinatario = $n['nome'];
		$cargo        = $n['cargo'];
		$orgao        = $n['orgao'];
		$end          = $n['end'];
		$cep          = $n['cep'];
		$cidade       = $n['cidade'];
	}

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='40' height='40' background='img/cinza.gif' valign='middle' align='center'><img src='img/editar.png' height='32' width='32'></td>
		<td valign='middle' align='left' class='azul16'>&nbsp;&nbsp;<b>Ofícios Recebidos</b> <font class='cza12'><i>Cadastrar ofícios recebidos</i></font></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>";

?>

<table width='940' cellpadding='0' cellspacing='0'>
  <tr><form method="post" action="index.php?conteudo=grava_registro.php" enctype="multipart/form-data">
    <td valign='middle' align='right' width='200' class='azul12'><b><font class='azul12'>Nº / Data de Emissão:</font>&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='num' size='10' maxlength='10'>&nbsp;&nbsp;<input type='text' name='data' size='10' maxlength='10' onkeypress="formatar_mascara(this, '##/##/####')"></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Emissor:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='emissor' size='60' value='<? echo "$emissor"; ?>'><input type='hidden' name='id_emissor' value='<? echo "$id_emissor"; ?>'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b><font class='azul12'>Cargo:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='cargo' size='60' value='<? echo "$cargo"; ?>'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b><font class='azul12'>Órgão:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='orgao' size='60' value='<? echo "$orgao"; ?>'></td>
  </tr>
   <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b><font class='azul12'>Endereço:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='end' size='60' value='<? echo "$end"; ?>'></td>
  </tr>  
   <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b><font class='azul12'>CEP - Cidade:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='cep' size='15' value='<? echo "$cep"; ?>'>&nbsp;&nbsp;<input type='text' name='cidade' size='39' value='<? echo "$cidade"; ?>'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b><font class='azul12'>Assunto:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='assunto' size='60'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Resposta ao ofício:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><? include("select_oficios_emitidos.php"); ?></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Anexo:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type="file" name="arquivo" size='60' /></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'>&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='submit' value='Gravar'></td>
  </tr></form>
</table>
<?
}
?>