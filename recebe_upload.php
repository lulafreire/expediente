<link rel="stylesheet" href="css/geral.css" type="text/css">
<center>
		
<?php

// Dados do formul�rio
$num         = $_POST['num'];
$sipps       = $_POST['sipps'];
$nomeTitular = $_POST['nomeTitular'];
$origem      = $_POST['origem'];
$demanda     = $_POST['demanda'];
$fase        = $_POST['fase'];
$obs         = $_POST['obs'];
$descricao   = $_POST['descricao'];
$anexo       = $_FILES['arquivo'];

$t = $_FILES['arquivo']['size'];
$tMb = $t / 1048000;
$tamMb = round($tMb, 2);

$msg = "anexo com $tamMb Mb";

// Para diferencia��o do anexo
$dataCompleta  = date("dmYHis");

// Converte os caracteres para MAI�SCULAS
$nomeTitular = strtoupper($nomeTitular);

// Retira pontos e tra�os dos dados num�ricos
$pt = array(".","-");
$num = str_replace ($pt, "", $num);

// Formata NB
$nb01 = substr($nb, 0, 3);
$nb02 = substr($nb, 3, 3);
$nb03 = substr($nb, 6, 3);
$nb04 = substr($nb, 9, 1);

// Caso n�o tenha enviado anexo
if($arquivo!='') {

// Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = 'anexos/';

// Tamanho m�ximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 25; // 25Mb

// Array com as extens�es permitidas
$_UP['extensoes'] = array('jpg', 'pdf', 'zip', 'tif', 'tiff');

// Renomeia o arquivo? (Se true, o arquivo ser� salvo como .jpg e um nome �nico)
$_UP['renomeia'] = false;

// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'N�o houve erro';
$_UP['erros'][1] = 'O arquivo ultrapassa o limite de tamanho de 25Mb';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho de 25Mb';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
//$_UP['erros'][4] = 'N�o foi feito o upload do arquivo';

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
if ($_FILES['arquivo']['error'] != 0) {
die("
<center>
<table width='400' cellpadding='5' cellspacing='0' class='bordasimples'>
	<tr>
		<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
		<td valign='middle' align='center' height='60' width='340' class='ver16'>N�o foi poss�vel fazer o upload!<br /><b>" . $_UP['erros'][$_FILES['arquivo']['error']]); echo "</b></td>
	 </tr>
</table>		
</center>
<p><input type='button' value='Voltar' onClick='history.back()'>";
 
exit; // Para a execu��o do script
}

// Caso script chegue a esse ponto, n�o houve erro com o upload e o PHP pode continuar

// Faz a verifica��o da extens�o do arquivo
$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
if (array_search($extensao, $_UP['extensoes']) === false) {
echo "
<center>
<table width='400' cellpadding='5' cellspacing='0' class='bordasimples'>
	<tr>
		<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
		<td valign='middle' align='center' height='60' width='340' class='ver16'>N�o foi poss�vel fazer o upload!<br /><b>Arquivo do tipo $extensao n�o permitido.</b></td>
	 </tr>
</table>		
</center>
<p><input type='button' value='Voltar' onClick='history.back()'>";
}

// Faz a verifica��o do tamanho do arquivo
else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {

echo "
<center>
<table width='400' cellpadding='5' cellspacing='0' class='bordasimples'>
	<tr>
		<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
		<td valign='middle' align='center' height='60' width='340' class='ver16'>N�o foi poss�vel fazer o upload!<br /><b>Envie arquivos com no m�ximo 25Mb.</b></td>
	 </tr>
</table>		
</center>
<p><input type='button' value='Voltar' onClick='history.back()'>";
}

// O arquivo passou em todas as verifica��es, hora de tentar mov�-lo para a pasta
else {
// Primeiro verifica se deve trocar o nome do arquivo
if ($_UP['renomeia'] == true) {
// Cria um nome baseado no UNIX TIMESTAMP atual e com extens�o .jpg
$nome_final = time().'.jpg';
} else {
// Mant�m o nome original do arquivo
$nome_final = $_FILES['arquivo']['name'];
}

// Depois verifica se � poss�vel mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {

// Renomeia o arquivo para evitar quebra de link e nomes iguais
$ext      = strtolower($extensao);
$novoNome = "mob_"."$dataCompleta.".$ext;

rename ("anexos/".$nome_final,"anexos/".$novoNome);

// Formata o tamanho para Mb
$t = $_FILES['arquivo']['size'];
$tMb = $t / 1048000;
$tamMb = round($tMb, 2);

// Grava as informa��es no banco de dados
include("config.php");

$grava = mysql_query("insert into mob (nb, nome, fase, sipps, origem, demanda, dtCad, dtAtu, obs, anexo, tam, descricao) values ('$num','$nomeTitular','$fase','$sipps','$origem','$demanda',curdate(), curdate(), '$obs', '$novoNome','$tamMb','$descricao')");

echo "
		<center>
		<table width='800' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='740' class='vde16'>1. O processo de <b>$nomeTitular</b> foi cadastrado com sucesso!<br><img src='img/branco.gif' height='5'><br><font class='cza12'><i>Inclu�do o anexo \"<a href='download.php?url=$novoNome' class='linkcza'>$novoNome</a>\" com $tamMb Mb</td>
		  </tr>
		</table>		
		</center>
		<p>&nbsp;<p>";

} else {
// N�o foi poss�vel fazer o upload, provavelmente a pasta est� incorreta
echo "
<center>
		<table width='400' cellpadding='5' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
			<td valign='middle' align='center' height='60' width='340' class='ver16'>N�o foi poss�vel enviar o arquivo, tente novamente!</td>
		  </tr>
		</table>		
		<center>
		<p><input type='button' value='Voltar' onClick='history.back()'>";
}

}

} else {

// Grava as informa��es no banco de dados sem o anexo
include("config.php");

$grava = mysql_query("insert into mob (nb, nome, fase, sipps, origem, demanda, dtCad, dtAtu, obs, anexo, tam, descricao) values ('$num','$nomeTitular','$fase','$sipps','$origem','$demanda',curdate(), curdate(), '$obs', '$novoNome','$tamMb','$descricao')");
echo "
		<center>
		<table width='800' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='740' class='vde16'>2. O processo de <b>$nomeTitular</b> foi cadastrado com sucesso!<br><img src='img/branco.gif' height='5'>$msg</td>
		  </tr>
		</table>		
		</center>
		<p>&nbsp;<p>";


}
?>