<html>
<head>
	<meta charset="UTF-8">
</head>
<title>.:: Expediente - APS Irecê/BA ::.</title>
<link rel="stylesheet" href="css/geral.css" type="text/css">

<body topmargin='0' leftmargin='0'>

<?
$ip = $REMOTE_ADDR;

$conteudo = $_GET['conteudo'];

if($conteudo=='') {
	
	$conteudo = "sql_oficios.php";	
	
}
?>

<!-- Tabela Menu Atalhos -->
<table width='100%' cellpadding='0' cellspacing='0'>
  <tr>
    <td valign='middle' align='right' background='img/fundo_menu_topo.png' height='34'>&nbsp;</td>
	<td valign='middle' align='right' background='img/fundo_menu_topo.png' width='960' height='34' class='cza12'><? include("data.php"); ?></td>
	<td valign='middle' align='right' background='img/fundo_menu_topo.png' height='34'>&nbsp;</td>
  </tr>
</table>

<!-- Tabela Central -->
<table width='100%' height='158' cellpadding='0' cellspacing='0' background='img/fundo_azul_topo.png'>
	<tr>
		<td valign='middle' align='right' height='50'>&nbsp;</td>
		<td width='100' valign='middle' align='middle'><img src='img/if_references_47050.png'></td>
		<td width='300' valign='middle' align='left' class='bco20'>&nbsp;<i>expediente</i> <b>APS IRECÊ/BA</b></td>
		<td width='560' valign='middle' align='right'><? include("frm_busca.php"); ?></td>
		<td valign='middle' align='right' height='50'>&nbsp;</td>
	</tr>
</table>

<!-- Tabela Menu Opções -->
<table width='100%' cellpadding='0' cellspacing='0'>
  <tr>
    <td valign='middle' align='right' background='img/fundo_menu_topo2.png' height='50'>&nbsp;</td>
	<td valign='middle' align='right' background='img/fundo_menu_topo2.png' width='50' height='50'><a href='index.php' title='Voltar para a Página Inicial'><img src='img/home.png' border='0'></a></td>
	<td valign='middle' align='left' background='img/fundo_menu_topo2.png' width='940' height='50' class='pto12' >&nbsp;&nbsp;<a href='index.php?conteudo=oficios_recebidos.php' class='linkpto'>RECEBER OFÍCIO</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='index.php?conteudo=emitir.php' class='linkpto'>EMITIR OFÍCIO</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='index.php?conteudo=memos_recebidos.php' class='linkpto'>RECEBER MEMORANDO</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='index.php?conteudo=memorando.php' class='linkpto'>EMITIR MEMORANDO</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='index.php?conteudo=anexos.php' class='linkpto'>ANEXOS</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='index.php?conteudo=modelos.php' class='linkpto'>MODELOS</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='index.php?conteudo=destinatarios.php' class='linkpto'>DESTINATÁRIOS</a></td>
	<td valign='middle' align='right' background='img/fundo_menu_topo2.png' height='50'>&nbsp;</td>
  </tr>
</table>

<!-- Tabela Conteúdo -->
<table width='100%' height='100%' cellpadding='0' cellspacing='0'>
	<tr>
	    <td valign='middle' align='right' background='img/background.png'>&nbsp;</td>
		<td background='img/branco.gif' width='960' valign='top' align='center'><img src='img/branco.gif' height='10'><br><? include("$conteudo"); ?></td>
		<td valign='middle' align='right' background='img/background.png'>&nbsp;</td>
	</tr>
</table>

<!-- Tabela base -->
<table width='100%' height='98' cellpadding='0' cellspacing='0' background='img/background_base.png'>
	<tr>
		<td>&nbsp;</td>
		<td width='340'><img src='img/logo_previdencia.png'></td>
		<td width='560' class='cza12' valign='middle'>
		<b>AGÊNCIA DA PREVIDÊNCIA SOCIAL EM IRECÊ/BA</b>
		<br><B>END:</B> Rua Trinta e Três, s/n - Lot Novo Horizonte - CEP 44900-000 - Irecê/BA
		<br><B>TEL:</B> (74) 3641-3166 <B>VOIP:</B> 3074-1061 / 3074-1062
		<br><B>EMAIL:</B> aps04024020@inss.gov.br</td>
		<td>&nbsp;</td>
	</tr>
</table>




</body>
</html>