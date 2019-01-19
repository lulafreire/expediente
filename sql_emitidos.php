<?

// Arquivo de configuração de conexão ao banco de dados
include("config.php");

// Verifica a data atual
$hoje = date('Y-m-d');

// Transforma com a opção strtotime
$timestamp1 = strtotime($hoje);

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

// Quando pesquisar por termo específico, muda os critérios da pesquisa

	$pesquisa = "Select * from oficios_emitidos order by data asc LIMIT $inicio,$limite";
	$total_registros = mysql_num_rows($pesquisa);
	$msgZero  = "Não localizamos nenhum registro com o termo <b>$termo</b>";

// Exibe tabela com opção de pesquisa
echo "
<table width='900' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td valign='middle' align='center' width='60' height='60' background='img/cinza.gif'><a href='pdf.php?opcao=$opcao&servidor=$servidor&motivo=$motivoGet&especie=$especie&codUnid=$codUnid&setor=$setor' title='Gerar PDF'><img src='img/pdf.png' height='32'></a></td>
		<td valign='middle' align='center'>
		<table width='840' class='semborda' cellpadding='0' cellspacing='0'>
			<tr><form method='get' action='index.php'>
				<td valign='middle' align='left' width='400' class='azul20'>&nbsp;&nbsp;<b>$total_registros Processos</b><br>&nbsp;&nbsp;<font class='cza12'><i>$descricao</i></font><br></td>
				<td valign='middle' align='right' width='200' class='azul10'>Pesquisar por Nome, NB ou Motivo&nbsp;&nbsp;</td>
				<td valign='middle' align='center' width='200'><input type='hidden' name='conteudo' value='sql_geral.php'><input type='text' name='termo' size='30'></td>
				<td valign='middle' align='center' width='40'><input type='image' src='img/search_button.png'></td>
			</tr></form>
		</table>
		</td>
	</tr>
</table><img src='img/branco.gif' height='5'><br>";

// Topo da tabela de resultados
echo"
	<table width='900' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td height='30' width='50' valign='middle' align='center' background='img/cinza.gif' class='azul10'><b>ESP</b></td>
			<td height='30' width='100' valign='middle' align='center' background='img/cinza.gif' class='azul10'><b>NB</b></td>
			<td height='30' width='250' valign='middle' align='center' background='img/cinza.gif' class='azul10'><b>NOME</b></td>
			<td height='30' width='250' valign='middle' align='center' background='img/cinza.gif' class='azul10'><b>MOTIVO</b></td>
			<td height='30' width='50' valign='middle' align='center' background='img/cinza.gif' class='azul10'><b>DIAS</b></td>
			<td height='30' width='100' valign='middle' align='center' background='img/cinza.gif' class='azul10'><b>SERVIDOR</b></td>
			<td height='30' width='50' valign='middle' align='center' background='img/cinza.gif' class='azul10'><b>EDITAR</b></td>
			<td height='30' width='50' valign='middle' align='center' background='img/cinza.gif' class='azul10'><b>EXCLUIR</b></td>
		</tr>
	</table><img src='img/branco.gif' height='5'><br>";

// Tabela com os resultados
echo "
<img src='img/branco.gif' height='2'><table width='900' cellpadding='0' cellspacing='0' class='bordasimples'>";

// Pesquisa no banco de dados
$processos = mysql_query("$pesquisa");
$resultado = mysql_num_rows($processos);
if($resultado =='')
{
	echo "
		    <tr>
			<td valign='middle' align='center' height='60' width='50' background='img/cinza.gif'><img src='img/alert.png'></td>
			<td valign='middle' align='center' height='60' width='850' class='ver16'>$msgZero</td>
			</tr>
		 ";
}
else
{	
	while($r = mysql_fetch_array($processos))
	{
		$id         = $r['id'];
		$esp        = $r['esp'];
		$nb         = $r['nb'];
		$nit	    = $r['nit'];
		$nome       = $r['nome'];
		$der        = $r['der'];
		$motivo     = $r['motivo'];
		$obs        = $r['obs'];
		$servidor   = $r['servidor'];
		$dtSolucao  = $r['dtSolucao'];
		
	include("config_acesso.php");
	
	// Pesquisa o nome do servidor responsável
	$sqlResp=mysql_query("select * from usr where mat = '$servidor'");
	$qtResp = mysql_num_rows($sqlResp);
	
	if($qtResp=='0') {
		
		$nomeResp = "Servidor não cadastrado. Utilize o CadFérias para cadastrar ou atribua a responsabilidade do processo a um servidor cadastrado.";		
		
	} else {
		
		while($a=mysql_fetch_array($sqlResp)){
		
			$nomeResp  = $a['nome'];
	
		}
	}
	
	$data_inicial = $der;
	$data_final   = $hoje;
	$data_solucao = $dtSolucao;

	// Calcula a diferença em segundos entre as datas
	if($dtSolucao==0000-00-00) {
	
		$diferenca = strtotime($data_final) - strtotime($data_inicial); // Processos não concluídos
	
	} else {
	
		$diferenca = strtotime($data_solucao) - strtotime($data_inicial); // Processos concluídos
		
	}
	

	//Calcula a diferença em dias
	$dias = floor($diferenca / (60 * 60 * 24));
	
	// Condiciona a cor da tabela pelos dias de represamento
	if($dias<='30')
	{
		$color = "#FFFFFF";
	}
	elseif ($dias<='44')
	{
		$color = "#C1FFC1";
	}
	elseif ($dias<='74')
	{
		$color = "#EEE8AA";
	}
	elseif ($dias<='99')
	{
		$color = "#FFFF00";
	}
	elseif ($dias>'99')
	{
		$color = "#FA8072";
	}
		
	echo"
	<table width='900' cellpadding='0' cellspacing='0' class='bordasimples'>
		<tr>
			<td bgcolor = '$color' height='30' width='50' valign='middle' align='center' class='azul10'><a title='$obs'>$esp</a></td>
			<td bgcolor = '$color' height='30' width='100' valign='middle' align='center' class='azul10'><a title='$obs'>$nb</a></td>
			<td bgcolor = '$color' height='30' width='250' valign='middle' align='center' class='azul10'><a title='$obs'>$nome</a></td>
			<td bgcolor = '$color' height='30' width='250' valign='middle' align='center' class='azul10'><a title='$obs'>$motivo</a></td>
			<td bgcolor = '$color' height='30' width='50' valign='middle' align='center' class='azul10'><a title='$obs'>$dias</a></td>
			<td bgcolor = '$color' height='30' width='100' valign='middle' align='center' class='azul10'><a title='$nomeResp'>$servidor</a></td>
			<td bgcolor = '$color' height='30' width='50' valign='middle' align='center' class='azul10'><a href='index.php?conteudo=editar.php&nb=$nb' title='Editar'><img src='img/bt_editar.png' border='0'></a></td>
			<td bgcolor = '$color' height='30' width='50' valign='middle' align='center' class='azul10'><a href='index.php?conteudo=excluir.php&nb=$nb' title='Excluir'><img src='img/bt_deletar.png' border='0'></a></td>
		</tr>
	</table>";
	}
}
echo "</table><img src='img/branco.gif' height='10'><br>";

// Paginação
//Define o total de páginas a serem mostradas baseadana divisão do total de registros pelo limite de registros a serem mostrados
$total_paginas = Ceil($total_registros / $limite); 

echo "
<table cellpadding='0' cellspacing='0' class='bordasimples' height='35'>
	<tr>
		<td width='100' height='35' valign='middle' align='center' class='azul12'><b><a href='index.php?conteudo=sql_geral.php&termo=$termo&opcao=$opcao&servidor=$servidor&motivo=$motivoGet&especie=$especie&setor=$setor&codAPS=$codAPS&pag=' class='linkazul'><< Primeira</a></b></td>";		
//paginação
$total = $total_paginas;// total de páginas

$max_links = 20;// número máximo de links da paginação

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
			<td valign='middle' align='center' width='35' class='cza14'><a href='index.php?conteudo=sql_geral.php&pag=$i&termo=$termo&opcao=$opcao&servidor=$servidor&motivo=$motivoGet&especie=$especie&setor=$setor&codAPS=$codAPS' class='linkcza'>$i</a></td>";
		}
	}
}
echo "<td width='100' valign='middle' align='center' width='35' class='azul12'><a href='index.php?conteudo=sql_geral.php&pag=$total&termo=$termo&opcao=$opcao&servidor=$servidor&motivo=$motivoGet&especie=$especie&setor=$setor&codAPS=$codAPS' class='linkazul'><b>Última >></b></a></td>
	</tr>
</table><img src='img/branco.gif' height='10'><br>";


?>