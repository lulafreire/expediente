<html>
<head></head>
<title>.:: Expediente - APS Irecê/BA ::.</title>
<link rel="stylesheet" href="css/geral.css" type="text/css">

<body topmargin='0' leftmargin='0'>

<?

include("config.php");

// Define o limite de registros a serem exibidos
$limite = 10; 

// Captura os dados da variável 'pag' vindo da url, onde contém o número da página atual
$pagina = $_GET['pag'];

// Se a variável $pagina não conter nenhum valor,então por padrão ela será posta com o valor 1 (primeira página)
if(!$pagina)
{    
	$pagina = 1;
}

// Define o registro inicial
$inicio = ($pagina * $limite) - $limite;

// Pesquisa os ofícios recebidos
$sqlDest = mysql_query("Select * from destinatarios");
$total_registros = mysql_num_rows($sqlDest);

// Pesquisa os ofícios recebidos para realizar a paginação
$sqlD = mysql_query("Select * from destinatarios order by nome asc LIMIT $inicio,$limite");

// Tabela com os resultados
echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td valign='middle' align='center' width='40' height='40' background='img/cinza.gif'><img src='img/recebidos.png' height='32' width='32'></td>
		<td width='900' valign='middle' align='left' class='azul14'>&nbsp;&nbsp;<b>$total_registros Destinatários Cadastrados</b></td>
	</tr>
</table><img src='img/branco.gif' height='5'><br>";

echo "
<table width = '940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='300' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>NOME</b></td>
		<td width='220' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>CARGO</b></td>
		<td width='300' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>ÓRGAO</b></td>
		<td width='120' height='30' valign = 'middle' align='center' class='azul10' background='img/fundo_menu_topo2.png'><b>OPÇÕES</b></td>
	</tr>
</table><img src='img/branco.gif' height='2'><br>
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>";

while($d = mysql_fetch_array($sqlD)) {

	$id      = $d['id'];
	$nome    = $d['nome'];
	$cargo   = $d['cargo'];
	$orgao   = $d['orgao'];
	
	echo "
	<tr>
		<td width='300' height='25' valign = 'middle' align='center' class='azul10'>$nome</td>
		<td width='220' height='25' valign = 'middle' align='center' class='azul10'>$cargo</td>
		<td width='300' height='25' valign = 'middle' align='center' class='azul10'>$orgao</td>
		<td width='40' height='25' valign = 'middle' align='center' class='azul10'><a href='index.php?conteudo=detalhar_destinatario.php&id=$id' title='Ver detalhes' target='_parent'><img src='img/txt.png' border='0'></a></td>
		<td width='40' height='25' valign = 'middle' align='center' class='azul10'><a href='index.php?conteudo=editar_destinatario.php&id=$id' title='Editar'><img src='img/edit.png' border='0'></a></td>
		<td width='40' height='25' valign = 'middle' align='center' class='azul10'><a href='index.php?conteudo=excluir_destinatario.php&id=$id' title='Excluir'><img src='img/delete.png' border='0'></a></td>
	</tr>";

}
echo "
</table>
<img src='img/branco.gif' height='10'><br>";



// --------------------------------- Paginação ---------------------------------------//
//Define o total de páginas a serem mostradas baseadana divisão do total de registros pelo limite de registros a serem mostrados
$total_paginas = Ceil($total_registros / $limite); 

echo "
<center>
<table cellpadding='0' cellspacing='0' class='bordasimples' height='35'>
	<tr>
		<td width='100' height='35' valign='middle' align='center' class='azul12'><b><a href='index.php?conteudo=destinatarios.php&pag=' class='linkazul'><< Primeira</a></b></td>";		
//paginação
$total = $total_paginas;// total de páginas

$max_links = 10;// número máximo de links da paginação

// calcula quantos links haverá à esquerda e à direita da página corrente
// usa-se ceil() para assegurar que o número será inteiro
$links_laterais = ceil($max_links / 2);

// variáveis para o loop
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
			<td valign='middle' align='center' width='35' class='cza14'><a href='index.php?conteudo=destinatarios.php&pag=$i' class='linkcza'>$i</a></td>";
		}
	}
}
echo "<td width='100' valign='middle' align='center' width='35' class='azul12'><a href='index.php?conteudo=destinatarios.php&pag=$total' class='linkazul'><b>Última >></b></a></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>
</center>";

?>

</body>
</html>