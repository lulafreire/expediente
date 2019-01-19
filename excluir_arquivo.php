<?
include("config.php");

$txtNome = $_POST['txtNome'];

if($txtNome=='')
{
    include("frm_excluir_arquivo.php");
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
    $nb          = $n['nb'];
	$nomeTitular = $n['nome'];
	$fase	     = $n['fase'];

}
	switch ($origem)
	{
	case "CTC": $ctc = "checked"; break;
	case "CNIS": $cnis = "checked"; break;
	case "INSS DIGITAL": $inssdigital = "checked"; break;
	case "Atualizações": $atu = "checked"; break;
	case "JUD": $jud = "checked"; break;
	case "TBM": $tbm = "checked"; break;
	}

	$bloqueia = "class='desabilitado' readonly"; // Bloqueia o formulário
	
echo "
		<center>
		<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
			<td valign='middle' align='center' height='60' class='ver16'><B>Confira os dados do registro antes de excluir!</td>
		  </tr>
		</table>
			<img src='img/branco.gif' height='10'><br>
		</center>";
		
		echo "
		
<table width='940' cellpadding='0' cellspacing='0'>
  <tr><form method='post' action='index.php?conteudo=deletar_arquivo.php'>
    <td valign='middle' align='right' width='200' class='azul12'><b>NB:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='pto12'>$nb</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Nome Completo:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='pto12'>$nomeTitular</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Fase:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='pto12'>$fase</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'></td>
    <td valign='middle' align='left'><input type='hidden' name='id' value='$id'><input type='submit' value='Excluir...'></td>
  </tr></form>
</table>";

}
}

?>
