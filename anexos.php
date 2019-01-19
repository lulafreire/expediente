<?
include("config.php");

$txtNome = $_POST['txtNome'];

if($txtNome=='')
{
    include("frm_incluir_anexo.php");
}
else
{
//$nb = preg_replace("#\D#",'',$txtNome);
$n = explode("-", $txtNome);
$num = $n[0];
$emissor = $n['1'];

// Pesquisa os dados da propriedade
$sqlNb = mysql_query("Select * from oficios_recebidos where num = '$num' and emissor = '$emissor'");
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
    $id            = $n['id'];
	$numero        = $n['num'];
	$emissor       = $n['emissor'];
	$interessado   = $n['interessado'];
	$data          = $n['data'];
	$assunto       = $n['assunto'];
	$resposta      = $n['resposta'];
	$anexo         = $n['anexo'];
	$tam           = $n['tam'];
	$descricao     = $n['descricao'];
	
}
	
	
	
		// Formata Datas		
		$dtA01 = substr($data, 8, 2);
		$dtA02 = substr($data, 5, 2);
		$dtA03 = substr($data, 0, 4); 
	

	
echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='40' height='40' background='img/cinza.gif' valign='middle' align='center'><img src='img/anexo.png' height='32' width='32'></td>
		<td valign='middle' align='left' class='azul16'>&nbsp;&nbsp;<b>Anexos</b> <font class='cza12'><i>Incluir, alterar ou excluir anexos</i></font></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>";
	
echo "
<table width='940' cellpadding='0' cellspacing='0'>
  <tr><form method='post' action='index.php?conteudo=editar_anexos.php'>
    <td valign='middle' align='right' width='200' class='azul12'><b>Nº:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$num, de $dtA01/$dtA02/$dtA03</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Assunto:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$assunto</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Emissor:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$emissor</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr></form>
</table>";

// Anexo inicial
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='300' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>ANEXO</b></td>
			<td width='460' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>DESCRIÇÃO</b></td>
			<td width='100' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>TAM</b></td>
			<td width='80' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>AÇÕES</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>";
	
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>";
		if($anexo !='') {
		echo "
		<tr><form method='post' action='index.php?conteudo=editar_anexos.php&opcao=1&id=$id'>
			<td width='300' height='40' valign='middle' align='center' class='azul12'>$anexo</td>
			<td width='460' height='40' valign='middle' align='center' class='azul12'><input type='text' name='descricao' value='$descricao' size='65' class='azul12'></td>
			<td width='100' height='40' valign='middle' align='center' class='azul12'>$tam Mb</td>
			<td width='40' height='40' valign='middle' align='center' class='azul12'><input type='image' name='edit' src='img/edit.png'></form></td>
			<form method='post' action='index.php?conteudo=editar_anexos.php&opcao=2&id=$id'>
			<td width='40' height='40' valign='middle' align='center' class='azul12'><input type='hidden' name='anexo' value='$anexo'><input type='image' name='delete' src='img/delete.png'></td>
		</tr></form>";
		}
	
	// Verifica se há anexos complementares
	$sqlAnexos = mysql_query("Select * from anexos where id = '$id' and origem = 'ARQUIVO' order by dtEnvio asc");
	$resAnexos = mysql_num_rows($sqlAnexos);
	
	if($anexo =='' and $resAnexos =='') {
		
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
			
			// Formata Datas
			$dtE01 = substr($dtEnvio, 8, 2);
			$dtE02 = substr($dtEnvio, 5, 2);
			$dtE03 = substr($dtEnvio, 0, 4);
			
			echo "			
			<tr><form method='post' action='index.php?conteudo=editar_anexos.php&opcao=3&id=$id'>
			<td width='300' height='40' valign='middle' align='center' class='azul12'>$anexo2</td>
			<td width='460' height='40' valign='middle' align='center' class='azul12'><input type='text' name='descricao' value='$descricao2' size='65' class='azul12'></td>
			<td width='100' height='40' valign='middle' align='center' class='azul12'>$tam2 Mb</td>
			<td width='40' height='40' valign='middle' align='center' class='azul12'><input type='hidden' name='anexo' value='$anexo2'><input type='image' name='edit' src='img/edit.png'></form></td>
			<form method='post' action='index.php?conteudo=editar_anexos.php&opcao=4&id=$id'>
			<td width='40' height='40' valign='middle' align='center' class='azul12'><input type='hidden' name='anexo' value='$anexo2'><input type='image' name='delete' src='img/delete.png'></td>
		</tr></form>";			
		
		}
	
	
	} echo "</table><img src='img/branco.gif' height='5'><br>";
	
	echo "
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td width='940' height='40' background='img/cinza.gif' valign='middle' align='center' class='azul10'><b>NOVO ANEXO</b></td>
		</tr>
	</table>
	<img src='img/branco.gif' height='5'><br>";
?>
	
	<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr><form method="post" action="index.php?conteudo=atualiza_upload.php" enctype="multipart/form-data">
			<td valign='top' align='center'>
				<table class='semborda'>
					<tr>
						<td width='450' height='40' valign='middle' align='center' class='azul10'><input type="file" name="arquivo" /></td>
						<td width='450' height='40' valign='middle' align='center' class='azul10'><input type='text' name='descricao' size='65'><input type='hidden' name='id' value='<? echo "$id"; ?>'></td>
						<td width='140' height='40' valign='middle' align='center' class='azul10'><input type='submit' value='Anexar'></td>
					</tr>
				</table>
			</td>
		</tr></form>
	</table>
<?
}
}
?>


