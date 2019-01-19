<?
include("config.php");

// Recupera os dados do formulário
$num     = $_POST['num'];
$data    = $_POST['data'];
$emissor = $_POST['emissor'];
$cargo   = $_POST['cargo'];
$orgao   = $_POST['orgao'];
$end     = $_POST['end'];
$cep     = $_POST['cep'];
$cidade  = $_POST['cidade'];
$assunto = $_POST['assunto'];
$interessado = $_POST['interessado'];
$resposta= $_POST['resposta'];

// Converte os caracteres para MAIÚSCULAS
$emissor = strtoupper($emissor);
$interessado = strtoupper($interessado);

// Converte a data
$d = explode("/", $data);
$dia = $d[0];
$mes = $d[1];
$ano = $d[2];
$ndata = "$ano-$mes-$dia";

// Evita cadastro de campos em branco
if(empty($_POST['emissor']) or empty($_POST['num']) or empty($_POST['orgao']) or empty($_POST['end'])) {

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
	    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
		<td valign='middle' align='center' height='60' width='740' class='ver16'>Todos os campos são obrigatórios</td>
	</tr>
</table>";

} else {

	// Verifica se houve envio de anexo
	if($_FILES['arquivo']['error']== 4) { // Nenhum anexo enviado, grava apenas os dados do processo

	$msg = "Não houve envio de anexo";	

	$grava = mysql_query("insert into memos_recebidos (num, emissor, data, assunto, interessado) values ('$num','$emissor','$ndata','$assunto','$interessado')");
	$id_memo_recebido = mysql_insert_id();
	$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$id_memo_recebido','memos_recebidos','Ofício cadastrado')");
	
	// Verifica se o emissor já está cadastrado, caso não esteja, cadastra.
	$id_emissor = $_POST['id_emissor'];
	if($id_emissor=='') {
	
		$gravaEmissor = mysql_query("Insert into destinatarios (nome, cargo, orgao, end, cep, cidade) values ('$emissor','$cargo','$orgao','$end','$cep','$cidade')");
	
	}

	echo "
	<table width='800' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='740' class='vde16'>O Memorando nº $num de <b>$emissor</b> foi cadastrado com sucesso!<br><img src='img/branco.gif' height='5'><br><font class='cza12'><i>$msg</i></font><br></td>
		</tr>
	</table>";


	} else {

		// Verifica o tamanho do arquivo
		$t = $_FILES['arquivo']['size'];
		$tMb = $t / 1048000;
		$tamMb = round($tMb, 2);
		$anexo = $_FILES['arquivo']['name'];
		
		// Tamanho máximo do arquivo (em Bytes)
		$_UP['tamanho'] = 1024 * 1024 * 15; // 15Mb
	
		// Caso o tamanho exceda 15Mb, grava apenas os dados do processo e exibe mensagem de erro para o anexo
		if ($_UP['tamanho'] < $_FILES['arquivo']['size'] or $_FILES['arquivo']['size'] == 0) {
		
			$msg = "<font class='ver12'><i>O arquivo <b>$anexo</b> não foi enviado pois excede o tamanho máximo permitido de <b>15Mb</b></i></font>.";	

			$grava = mysql_query("insert into memos_recebidos (num, emissor, data, assunto) values ('$num','$emissor','$ndata','$assunto')");
			$id_memo_recebido = mysql_insert_id();
			$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$id_memo_recebido','memos_recebidos','Ofício cadastrado')");
	
			// Verifica se o emissor já está cadastrado, caso não esteja, cadastra.
			$id_emissor = $_POST['id_emissor'];
			if($id_emissor=='') {
	
			$gravaEmissor = mysql_query("Insert into destinatarios (nome, cargo, orgao, end, cep, cidade) values ('$emissor','$cargo','$orgao','$end','$cep','$cidade')");
	
			}
			echo "
			<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
				<tr>
					<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
					<td valign='middle' align='center' height='60' class='vde16'>O Ofício nº $num de <b>$emissor</b> foi cadastrado com sucesso!<br><img src='img/branco.gif' height='5'><br>$msg<br></td>
				</tr>
			</table>";		
			
		
		} else {
		
		
			// Pasta para onde devem ser enviados os anexos
			$_UP['pasta'] = 'anexos/';
			
			// Data completa, utilizada para renomear os arquivos
			$dataCompleta  = date("dmYHis");
			
			// Identifica a extensão do arquivo
			$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
			
			// Move da pasta temporária para a pasta ANEXOS
			$nome_final = $_FILES['arquivo']['name'];
			move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final);
			
			// Renomeia o arquivo para evitar quebra de link e nomes iguais
			$ext      = strtolower($extensao);
			$novoNome = "expediente_"."$dataCompleta.".$ext;

			rename ("anexos/".$nome_final,"anexos/".$novoNome);
			
			// Caso não tenha sido identificado o anexo no campo DESCRIÇÃO
			if($descricao == '') {
			
				$descricao = "$nome_final";
			
			}
			
			$grava = mysql_query("insert into memos_recebidos (num, emissor, data, assunto, interessado, anexo, tam, descricao) values ('$num','$emissor','$ndata','$assunto','$interessado','$novoNome','$tamMb','$descricao')");
			$id_memo_recebido = mysql_insert_id();
			$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$id_memo_recebido','memos_recebidos','Ofício cadastrado')");
	
			// Verifica se o emissor já está cadastrado, caso não esteja, cadastra.
			$id_emissor = $_POST['id_emissor'];
			if($id_emissor=='') {
	
			$gravaEmissor = mysql_query("Insert into destinatarios (nome, cargo, orgao, end, cep, cidade) values ('$emissor','$cargo','$orgao','$end','$cep','$cidade')");
	
			}
			

			echo "
			<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
				<tr>
					<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
					<td valign='middle' align='center' height='60' class='vde16'>O Memorando nº $num de <b>$emissor</b> foi cadastrado com sucesso!<br><img src='img/branco.gif' height='5'><br><font class='cza12'><i>O arquivo $anexo foi anexado e renomeado para \"<a href='download.php?url=$novoNome' class='linkcza'>$novoNome</a>\" com $tamMb Mb</td>
				</tr>
			</table>";		
			
		}


	}
	
} // Fim da verificação de campos em branco