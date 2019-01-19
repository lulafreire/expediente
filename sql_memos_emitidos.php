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

// Pesquisa os of�cios recebidos
$sqlRecebidos = mysql_query("Select * from memos_emitidos");
$total_registros = mysql_num_rows($sqlRecebidos);

// Pesquisa os of�cios recebidos para realizar a pagina��o
$sqlRec = mysql_query("Select * from memos_emitidos order by num desc LIMIT $inicio,$limite");

// Tabela com os resultados
echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td valign='middle' align='center' width='40' height='40' background='img/cinza.gif'><img src='img/enviados.png' height='32' width='32'></td>
		<td width='900' valign='middle' align='left' class='azul14'>&nbsp;&nbsp;<b>$total_registros Memorandos Emitidos</b></td>
	</tr>
</table><img src='img/branco.gif' height='5'><br>";

echo "
<table width = '940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='90' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>N�</b></td>
		<td width='90' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>DATA</b></td>
		<td width='220' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>DESTINAT�RIO</b></td>
		<td width='380' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>ASSUNTO</b></td>
		<td colspan = '4' width='120' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>OP��ES</b></td>
	</tr>";

while($r = mysql_fetch_array($sqlRec)) {

	$id           = $r['id'];
	$numero       = $r['num'];
	$destinatario = $r['destinatario'];
	$data         = $r['data'];
	$assunto      = $r['assunto'];
	
	// Formata data
	$d = explode("-", $data);
	$dia = $d[2];
	$mes = $d[1];
	$ano = $d[0];
	$ndata = "$dia/$mes/$ano";
	
	echo "
	
	<tr>
		<td width='90' height='30' valign = 'middle' align='center' class='azul10'>$numero</td>
		<td width='90' height='30' valign = 'middle' align='center' class='azul10'>$ndata</td>
		<td width='220' height='30' valign = 'middle' align='center' class='azul10'>$destinatario</td>
		<td width='380' height='30' valign = 'middle' align='center' class='azul10'>$assunto</td>
		<td width='30' height='30' valign = 'middle' align='center' class='azul10'><a href='memo_pdf.php?id=$id' title='Baixar o of�cio n� $numero em PDF. Detalhe para ver se h� outros anexos.'><img src='img/pdf.png' border='0'></a></td>
		<td width='30' height='30' valign = 'middle' align='center' class='azul10'><a href='index.php?conteudo=detalha_memo.php&id=$id&tipo=2' title='Ver detalhes' target='_parent'><img src='img/txt.png' border='0'></a></td>
		<td width='30' height='30' valign = 'middle' align='center' class='azul10'><a href='index.php?conteudo=editar.php&id=$id&tipo=2' title='Editar' target='_parent'><img src='img/edit.png' border='0'></a></td>
		<td width='30' height='30' valign = 'middle' align='center' class='azul10'><a href='index.php?conteudo=excluir.php&id=$id&tipo=2' title='Excluir' target='_parent'><img src='img/delete.png' border='0'></a></td>
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
		<td width='100' height='35' valign='middle' align='center' class='azul12'><b><a href='sql_memos_emitidos.php?pag=' class='linkazul'><< Primeira</a></b></td>";		
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
			<td valign='middle' align='center' width='35' class='cza14'><a href='sql_memos_emitidos.php?pag=$i' class='linkcza'>$i</a></td>";
		}
	}
}
echo "<td width='100' valign='middle' align='center' width='35' class='azul12'><a href='sql_memos_emitidos.php?pag=$total' class='linkazul'><b>�ltima >></b></a></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>
</center>";

?>

</body>
</html>