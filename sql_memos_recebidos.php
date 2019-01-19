<html>
<head></head>
<title>.:: Expediente - APS Irec�/BA ::.</title>
<link rel="stylesheet" href="css/geral.css" type="text/css">

<body topmargin='0' leftmargin='0'>

<?

include("config.php");

// Define o limite de registros a serem exibidos
$limite = 5; 

// Captura os dados da vari�vel 'pag' vindo da url, onde cont�m o n�mero da p�gina atual
$pagina = $_GET['pag'];

// Se a vari�vel $pagina n�o conter nenhum valor,ent�o por padr�o ela ser� posta com o valor 1 (primeira p�gina)
if(!$pagina)
{    
	$pagina = 1;
}

// Define o registro inicial
$inicio = ($pagina * $limite) - $limite;

// Condicional para pesquisar apenas os of�cios n�o respondidos
$respondidos = $_GET['respondidos'];

if($respondidos == '0') {
	
	$sqlResp = "where resposta = ''";

}

// Pesquisa os of�cios recebidos
$sqlRecebidos = mysql_query("Select * from memos_recebidos $sqlResp");
$total_registros = mysql_num_rows($sqlRecebidos);

// Pesquisa os of�cios recebidos para realizar a pagina��o
$sqlRec = mysql_query("Select * from memos_recebidos $sqlResp order by data desc LIMIT $inicio,$limite");

// Tabela com os resultados
echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td valign='middle' align='center' width='40' height='40' background='img/cinza.gif'><img src='img/recebidos.png' height='32' width='32'></td>
		<td width='860' valign='middle' align='left' class='azul14'>&nbsp;&nbsp;<b>$total_registros Memorandos Recebidos</b></td>
		<td width='40' height='30' valign = 'middle' align='center' class='azul10'><a title='Exibir of�cios n�o respondidos' href='sql_memos_recebidos.php?respondidos=0'><img src='img/flag_ver.png' height='16'></a></td>
	</tr>
</table><img src='img/branco.gif' height='5'><br>";

echo "
<table width = '940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='20' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><a title='Resposta'><img src='img/flag_vde.png' height='16'></a></td>
		<td width='70' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>N�</b></td>
		<td width='90' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>DATA</b></td>
		<td width='220' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>EMISSOR</b></td>
		<td width='380' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>ASSUNTO</b></td>
		<td colspan = '4' width='160' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>OP��ES</b></td>
	</tr>";

while($r = mysql_fetch_array($sqlRec)) {

	$id      = $r['id'];
	$numero  = $r['num'];
	$emissor = $r['emissor'];
	$data    = $r['data'];
	$assunto = $r['assunto'];
	$anexo   = $r['anexo'];
	$resposta = $r['resposta'];
	
	if($resposta == '') {
	
		$flag = "flag_ver.png";
		$flagTxt = "N�o respondido";
	
	} else {
	
		$flag = "flag_vde.png";
		$flagTxt = "Respondido";
		
	}
	
	// Formata data
	$d = explode("-", $data);
	$dia = $d[2];
	$mes = $d[1];
	$ano = $d[0];
	$ndata = "$dia/$mes/$ano";
	
	if($anexo !='') {
	
		$baixar_anexo = "<a href='download.php?url=$anexo' title='Baixar o anexo inicial. Detalhe para ver se h� outros anexos.'><img src='img/pdf.png' border='0'></a>";
	
	} else {
	
		$baixar_anexo = "<a title='O Memorando n� $numero n�o foi anexado. Detalhe para ver se h� outros anexos'><img src='img/pdf_cza.png' border='0'></a>";
	
	}
	
	echo "
	<tr>
		<td width='20' height='30' valign = 'middle' align='center' class='azul10'><a title='$flagTxt'><img src='img/$flag' height='16'></a></td>
		<td width='90' height='30' valign = 'middle' align='center' class='azul10'>$numero</td>
		<td width='90' height='30' valign = 'middle' align='center' class='azul10'>$ndata</td>
		<td width='220' height='30' valign = 'middle' align='center' class='azul10'>$emissor</td>
		<td width='380' height='30' valign = 'middle' align='center' class='azul10'>$assunto</td>
		<td width='40' height='30' valign = 'middle' align='center' class='azul10'>$baixar_anexo</td>
		<td width='40' height='30' valign = 'middle' align='center' class='azul10'><a href='index.php?conteudo=detalha_memo.php&id=$id&tipo=1' title='Ver detalhes' target='_parent'><img src='img/txt.png' border='0'></a></td>
		<td width='40' height='30' valign = 'middle' align='center' class='azul10'><a href='index.php?conteudo=editar_memo.php&id=$id&tipo=1' title='Editar' target='_parent'><img src='img/edit.png' border='0'></a></td>
		<td width='40' height='30' valign = 'middle' align='center' class='azul10'><a href='index.php?conteudo=excluir_memo.php&id=$id&tipo=1' title='Excluir' target='_parent'><img src='img/delete.png' border='0'></a></td>
	</tr>";

}
echo "
</table>
<img src='img/branco.gif' height='10'><br>";



// --------------------------------- Pagina��o ---------------------------------------//
//Define o total de p�ginas a serem mostradas baseadana divis�o do total de registros pelo limite de registros a serem mostrados
$total_paginas = Ceil($total_registros / $limite); 

echo "
<center>
<table cellpadding='0' cellspacing='0' class='bordasimples' height='35'>
	<tr>
		<td width='100' height='35' valign='middle' align='center' class='azul12'><b><a href='sql_memos_recebidos.php?respondidos=$respondidos&pag=' class='linkazul'><< Primeira</a></b></td>";		
//pagina��o
$total = $total_paginas;// total de p�ginas

$max_links = 10;// n�mero m�ximo de links da pagina��o

// calcula quantos links haver� � esquerda e � direita da p�gina corrente
// usa-se ceil() para assegurar que o n�mero ser� inteiro
$links_laterais = ceil($max_links / 2);

// vari�veis para o loop
$inicio = $pagina - $links_laterais;
$limite = $pagina + $links_laterais;

for ($i = $inicio; $i <= $limite; $i++)
{
	
	if ($i == $pagina)
	{
		echo "<td valign='middle' align='center' width='35' class='azul18' background='img/cinza.gif'><b>" . $i . "</b></td>";
	} 
	else 
	{
		if ($i >= 1 && $i <= $total)
		{
			echo "
			<td valign='middle' align='center' width='35' class='cza14'><a href='sql_memos_recebidos.php?pag=$i&respondidos=$respondidos' class='linkcza'>$i</a></td>";
		}
	}
}
echo "<td width='100' valign='middle' align='center' width='35' class='azul12'><a href='sql_memos_recebidos.php?pag=$total&respondidos=$respondidos' class='linkazul'><b>�ltima >></b></a></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>
</center>";

?>

</body>
</html>