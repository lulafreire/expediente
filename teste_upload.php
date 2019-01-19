<?
include("config.php");

// Recupera os dados do formul�rio
$num         = $_POST['num'];
$sipps       = $_POST['sipps'];
$nomeTitular = $_POST['nomeTitular'];
$origem      = $_POST['origem'];
$demanda     = $_POST['demanda'];
$fase        = $_POST['fase'];
$obs         = $_POST['obs'];
$descricao   = $_POST['descricao'];

// Evita cadastro de campos em branco
if(empty($_POST['num']) or empty($_POST['nomeTitular']) or empty($_POST['origem'])) {

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
	    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
		<td valign='middle' align='center' height='60' width='740' class='ver16'>Os campos <b>NB</b>, <b>Nome Completo</b> e <b>Origem</b> s�o obrigat�rios</td>
	</tr>
</table>";

} else {

	// Verifica se houve envio de anexo
	if($_FILES['arquivo']['error']== 4) { // Nenhum anexo enviado, grava apenas os dados do processo

	$msg = "N�o houve envio de anexo";	

	$grava = mysql_query("insert into mob (nb, nome, fase, sipps, origem, demanda, dtCad, dtAtu, obs, anexo, tam, descricao) values ('$num','$nomeTitular','$fase','$sipps','$origem','$demanda',curdate(), curdate(), '$obs', '$novoNome','$tamMb','$descricao')");
	echo "
	<table width='800' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='740' class='vde16'>O processo de <b>$nomeTitular</b> foi cadastrado com sucesso!<br><img src='img/branco.gif' height='5'><br><font class='cza12'><i>$msg</i></font><br></td>
		</tr>
	</table>";


	} else {

		// Verifica o tamanho do arquivo
		$t = $_FILES['arquivo']['size'];
		$tMb = $t / 1048000;
		$tamMb = round($tMb, 2);
		$anexo = $_FILES['arquivo']['name'];
		
		// Tamanho m�ximo do arquivo (em Bytes)
		$_UP['tamanho'] = 1024 * 1024 * 15; // 15Mb
	
		// Caso o tamanho exceda 15Mb, grava apenas os dados do processo e exibe mensagem de erro para o anexo
		if ($_UP['tamanho'] < $_FILES['arquivo']['size'] or $_FILES['arquivo']['size'] == 0) {
		
			$msg = "<font class='ver12'><i>O arquivo <b>$anexo</b> n�o foi enviado pois excede o tamanho m�ximo permitido de <b>15Mb</b></i></font>.";	

			$grava = mysql_query("insert into mob (nb, nome, fase, sipps, origem, demanda, dtCad, dtAtu, obs, anexo, tam, descricao) values ('$num','$nomeTitular','$fase','$sipps','$origem','$demanda',curdate(), curdate(), '$obs', '$novoNome','$tamMb','$descricao')");
			echo "
			<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
				<tr>
					<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
					<td valign='middle' align='center' height='60' class='vde16'>O processo de <b>$nomeTitular</b> foi cadastrado com sucesso!<br><img src='img/branco.gif' height='5'><br>$msg<br></td>
				</tr>
			</table>";		
			
		
		} else {
		
		
			// Pasta para onde devem ser enviados os anexos
			$_UP['pasta'] = 'anexos/';
			
			// Data completa, utilizada para renomear os arquivos
			$dataCompleta  = date("dmYHis");
			
			// Identifica a extens�o do arquivo
			$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
			
			// Move da pasta tempor�ria para a pasta ANEXOS
			$nome_final = $_FILES['arquivo']['name'];
			move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final);
			
			// Renomeia o arquivo para evitar quebra de link e nomes iguais
			$ext      = strtolower($extensao);
			$novoNome = "mob_"."$dataCompleta.".$ext;

			rename ("anexos/".$nome_final,"anexos/".$novoNome);
			
			// Caso n�o tenha sido identificado o anexo no campo DESCRI��O
			if($descricao == '') {
			
				$descricao = "Anexo n�o identificado";
			
			}
			
			// Grava todos os dados
			$grava = mysql_query("insert into mob (nb, nome, fase, sipps, origem, demanda, dtCad, dtAtu, obs, anexo, tam, descricao) values ('$num','$nomeTitular','$fase','$sipps','$origem','$demanda',curdate(), curdate(), '$obs', '$novoNome','$tamMb','$descricao')");

			echo "
			<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
				<tr>
					<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
					<td valign='middle' align='center' height='60' class='vde16'>O processo de <b>$nomeTitular</b> foi cadastrado com sucesso!<br><img src='img/branco.gif' height='5'><br><font class='cza12'><i>O arquivo $anexo foi anexado e renomeado para \"<a href='download.php?url=$novoNome' class='linkcza'>$novoNome</a>\" com $tamMb Mb</td>
				</tr>
			</table>";		
			
		}


	}
	
} // Fim da verifica��o de campos em branco