<?
include ("config.php");


// Recupera dados do formulÃ¡rio
	$num         = $_POST['num'];
	$sipps       = $_POST['sipps'];
	$nomeTitular = $_POST['nomeTitular'];
	$origem      = $_POST['origem'];
	$demanda     = $_POST['demanda'];
	$fase        = $_POST['fase'];
	$obs         = $_POST['obs'];
	$duplicar    = $_POST['duplicar'];
	
	
	// Retira pontos e traços dos dados numéricos
	$pt = array(".","-");
	$num = str_replace ($pt, "", $num);
	
	// Verifica se jÃ¡ existe no banco de dados
	$sql = mysql_query("Select * from mob where nb = '$num'");
	$res = mysql_num_rows($sql);
	
	// Converte os caracteres para MAIÚSCULAS
	$nomeTitular = strtoupper($nomeTitular);
	
	if($res!='0' and $duplicar=='')
	{
		echo "
		<center>
		<table width='800' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr><form method='post' action='index.php?conteudo=gravar_arquivo.php'>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
			<td valign='middle' align='center' height='60' width='740' class='ver16'>
			
			Já existe um cadastro para o NB <b>$num</b>, confirma o novo registro?
			<br><img src='img/branco.gif' height='5'><br>
			<input type='hidden' name='num' value='$num'>
			<input type='hidden' name='sipps' value='$sipps'>
			<input type='hidden' name='origem' value='$origem'>
			<input type='hidden' name='nomeTitular' value='$nomeTitular'>
			<input type='hidden' name='demanda' value='$demanda'>
			<input type='hidden' name='fase' value='$fase'>
			<input type='hidden' name='obs' value='$obs'>
			<input type='hidden' name='duplicar' value='Sim'>
			<input type='submit' value='Sim'>&nbsp;<input type='button' value='Cancelar' onclick='javascript:history.back()'>
			
			</td>
		  </tr></form>
		</table>		
		</center><p>&nbsp;<p>";
		
	}
	else
	{
		
		// Grava no banco de dados
		$grava = mysql_query("insert into mob (nb, nome, fase, sipps, origem, demanda, dtCad, dtAtu, obs) values ('$num','$nomeTitular','$fase','$sipps','$origem','$demanda',curdate(), curdate(), '$obs')");
				
		echo "
		<center>
		<table width='800' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='740' class='vde16'>O processo de <b>$nomeTitular id $id</b> foi cadastrado com sucesso!</td>
		  </tr>
		</table>		
		</center>
		<p>&nbsp;<p>";
		
		include("cad_arquivo.php");
	}
	
?>