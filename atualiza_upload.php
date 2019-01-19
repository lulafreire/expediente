<link rel="stylesheet" href="css/geral.css" type="text/css">
<center>
		
<?php

// Dados do formulário
$id         = $_POST['id'];
$descricao  = $_POST['descricao'];

// Para diferenciação do anexo
$dataCompleta  = date("dmYHis");

// Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = 'anexos/';

// Tamanho máximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 15; // 15Mb

// Array com as extensões permitidas
$_UP['extensoes'] = array('jpg', 'pdf', 'zip', 'tif', 'tiff');

// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
$_UP['renomeia'] = false;

// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo ultrapassa o limite de tamanho de 15Mb';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho de 15Mb';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
if ($_FILES['arquivo']['error'] != 0) {
echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
		<td valign='middle' align='center' height='60' class='ver16'>Não foi possível fazer o upload!<br><b>" . $_UP['erros'][$_FILES['arquivo']['error']]; echo "</b></td>
	 </tr>
</table>		
<img src='img/branco.gif' height='10'><br><input type='button' value='Voltar' onClick='history.back()'>";
 
}

// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

// Faz a verificação da extensão do arquivo
$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
if (array_search($extensao, $_UP['extensoes']) === false) {
echo "
<center>
<table width='940' cellpadding='5' cellspacing='0' class='bordasimples'>
	<tr>
		<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
		<td valign='middle' align='center' height='60' class='ver16'>Não foi possível fazer o upload!<br /><b>Arquivo do tipo $extensao não permitido.</b></td>
	 </tr>
</table>		
</center>
<p><input type='button' value='Voltar' onClick='history.back()'>";
}

// Faz a verificação do tamanho do arquivo
else if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
echo "
<center>
<table width='940' cellpadding='5' cellspacing='0' class='bordasimples'>
	<tr>
		<td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
		<td valign='middle' align='center' height='60' class='ver16'>Não foi possível fazer o upload!<br /><b>Envie arquivos com no máximo 15Mb.</b></td>
	 </tr>
</table>		
</center>
<p><input type='button' value='Voltar' onClick='history.back()'>";
}

// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
else {
// Primeiro verifica se deve trocar o nome do arquivo
if ($_UP['renomeia'] == true) {
// Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
$nome_final = time().'.jpg';
} else {
// Mantém o nome original do arquivo
$nome_final = $_FILES['arquivo']['name'];
}

// Depois verifica se é possível mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {

// Renomeia o arquivo para evitar quebra de link e nomes iguais
$ext      = strtolower($extensao);
$novoNome = "mob_"."$dataCompleta.".$ext;

rename ("anexos/".$nome_final,"anexos/".$novoNome);

if($descricao == '') {
			
	$descricao = "$nome_final";
			
}

// Formata o tamanho para Mb
$t = $_FILES['arquivo']['size'];
$tMb = $t / 1048000;
$tamMb = round($tMb, 2);

// Grava as informações no banco de dados
include("config.php");

$grava = mysql_query("insert into anexos (origem, id, anexo, tam, descricao, dtEnvio) values ('MOB','$id','$novoNome','$tamMb','$descricao', curdate())");

$gravaEvento = mysql_query("insert into eventos (data, id, origem, descricao) values (curdate(),'$id','MOB','Incluído o anexo $novoNome - $descricao')");

echo "
		<center>
		<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' class='vde16'>O processo foi atualizado com sucesso!<br><img src='img/branco.gif' height='5'><br><font class='cza12'><i>Incluído o anexo \"<a href='download.php?url=$novoNome' class='linkcza'>$novoNome</a>\" com $tamMb Mb</td>
		  </tr>
		</table>		
		</center>
		<p>&nbsp;<p>";

} else {
// Não foi possível fazer o upload, provavelmente a pasta está incorreta
echo "
<center>
		<table width='940' cellpadding='5' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
			<td valign='middle' align='center' height='60' class='ver16'>Não foi possível enviar o arquivo, tente novamente!</td>
		  </tr>
		</table>		
		<center>
		<p><input type='button' value='Voltar' onClick='history.back()'>";
}

}
?>