<?
 include("config.php");
 
// Recupera dados do formulário
	$id          = $_POST['id'];
	$esp         = $_POST['esp'];
	$nb          = $_POST['num'];
	$nomeTitular = $_POST['nomeTitular'];
	$sipps       = $_POST['sipps'];
	$origem      = $_POST['origem'];
	$caixa       = $_POST['caixa'];
	$demanda     = $_POST['demanda'];
	$fase        = $_POST['fase'];
	$obs         = $_POST['obs'];
	
	// Verifica os campos que foram atualizados
	$sql = mysql_query("select * from mob where id = '$id'");
	while($dados = mysql_fetch_array($sql)) {

	$nb_atual      = $dados ['nb'];
	$nome_atual    = $dados ['nome'];
	$sipps_atual   = $dados ['sipps'];
	$origem_atual  = $dados ['origem'];
	$caixa_atual   = $dados ['caixa'];
	$demanda_atual = $dados ['demanda'];
	$fase_atual    = $dados ['fase'];
	$obs_atual     = $dados ['obs'];
	
		if($fase != $fase_atual) {
	
			$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$id','MOB','Alterada a fase de $fase_atual para $fase')");
	
		}
		
		if($caixa != $caixa_atual) {
	
			$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$id','MOB','Alterada a caixa de $caixa_atual para $caixa')");
	
		}
		
		if($nb_atual != $nb or nome_atual != $nomeTitular or sipps_atual != $sipps or $origem_atual != $origem or $demanda_atual != $demanda or $obs_atual != $obs) {
		
			if($nb_atual != $nb) { $nb_alterado = "ESP/NB";}
			if($nome_atual != $nomeTitular) { $nome_alterado = "NOME";}
			if($sipps_atual != $sipps) { $sipps_alterado = "SIPPS";}
			if($origem_atual != $origem) { $origem_alterado = "ORIGEM";}
			if($demanda_atual != $demanda) { $demanda_alterado = "DEMANDA";}
			if($obs_atual != $obs) {$obs_alterado = "OBSERVA��O";}
			
			$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$id','MOB','Alterados dados cadastrais do processo: $nb_alterado $nome_alterado $sipps_alterado $origem_alterado $demanda_alterado $obs_alterado')");	
		
		}
	
	}
	
	// Retira pontos e traços dos dados numéricos
	$pt = array(".","-");
	$num = str_replace ($pt, "", $num);
	
	// Converte os caracteres para MAIÚSCULAS
	$nomeTitular = strtoupper($nomeTitular);
	
	// Grava no banco de dados
	$grava = mysql_query("Update mob set especie = '$esp', nb='$nb', nome='$nomeTitular', sipps='$sipps', origem='$origem', caixa = '$caixa', demanda='$demanda', fase='$fase', obs='$obs', dtAtu = curdate() where id = '$id'");
	
	echo "
		<center>
		<table width='800' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='740' class='vde16'>O processo de <b>$nomeTitular</b> foi alterado com sucesso!</td>
		  </tr>
		</table>	
		<p>&nbsp;<p>";
		
?>