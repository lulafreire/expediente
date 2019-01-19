<?
include("config.php");

if($idMod!='') {

	// Caso esteja utilizando um modelo, pesquisa o texto
	$sqlMod = mysql_query("Select * from modelos where id = '$idMod'");
	while($t = mysql_fetch_array($sqlMod)) {

		$texto     = $t['texto'];
		$descricao = $t['descricao'];
		$tipo      = $t['tipo'];

	}
	
	$descricao = "Utilizando o modelo <b>$descricao</b>";
	$icone     = "modelos.png";

} else {

	$descricao = "Criar, cadastrar e imprimir novo memorando";
	$icone     = "editar.png";

}

$txtNome = $_POST['txtNome'];

if($txtNome=='')
{
    include("frm_arquivo_memo.php");
}
else
{
//$nb = preg_replace("#\D#",'',$txtNome);
$n = explode("-", $txtNome);
$id = $n[0];

// Pesquisa os dados da propriedade
$sqlNb = mysql_query("Select * from destinatarios where id = '$id'");

$resNb = mysql_num_rows($sqlNb);

if($resNb =='') {

$destinatario = strtoupper("$txtNome");

}

while($n=mysql_fetch_array($sqlNb))
{

	$destinatario = $n['nome'];
	$cargo        = $n['cargo'];
	$orgao        = $n['orgao'];
	$endereco     = $n['end'];
	$cep          = $n['cep'];
	$cidade       = $n['cidade'];
}
	
echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='40' height='40' background='img/cinza.gif' valign='middle' align='center'><img src='img/$icone' height='32' width='32'></td>
		<td valign='middle' align='left' class='azul16'>&nbsp;&nbsp;<b>Emitir Memorando</b> <font class='cza12'><i>$descricao</i></font></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>";

?>
<table width='940' cellpadding='0' cellspacing='0'>
  <tr><form method='post' action='index.php?conteudo=grava_memo.php'>
    <td valign='middle' align='right' width='200' class='azul12'><b>Emitente:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'>
		<select name='emitente' size='1'>
			<option value='1'>Luiz Alberto Freire de Oliveira</option>
			<option value='2'>Leonardo Sampaio dos Santos</option>
		</select>
	</td>
  </tr>
  <tr><!-- Condicionais para ofício de reconstituição -->
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'><input type='hidden' name='subtitulo' value='<? echo "$subtitulo"; ?>'><input type='hidden' name='fundLegal' value='<? echo "$fundLegal"; ?>'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Destinatário:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='destinatario' size='60' value='<? echo "$destinatario"; ?>'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Cargo:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='cargo' size='60' value='<? echo "$cargo"; ?>'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Setor:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='orgao' size='60' value='<? echo "$orgao"; ?>'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Endereço:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='endereco' size='60' value='<? echo "$endereco"; ?>'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>CEP - Cidade/UF:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='cep' size='15' value='<? echo "$cep"; ?>'>&nbsp;<input type='text' name='cidade' size='15' value='<? echo "$cidade"; ?>'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Interessado:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='interessado' size='60'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Assunto:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='assunto' size='60' value=''>&nbsp;</td>
  </tr>
   <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>  
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Resposta ao memorando:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><? include("select_memos_recebidos.php"); ?></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
 </table>
 <table width='940' cellpadding='0' cellspacing='0'>
  <tr>
    <td valign='middle' align='center'>
	<textarea name='texto' cols='100' rows='18'><? echo "$texto"; ?></textarea>
  </tr>
  <tr>
    <td valign='middle' width='940'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='left'><input type='hidden' name='id' value='$id'><input type='submit' value='Salvar'></td>
  </tr></form>
</table><img src='img/branco.gif' height='15'><br>

<?

}

?>
