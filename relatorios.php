<?

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td valign='middle' align='center' width='40' height='40' background='img/cinza.gif'><img src='img/grafico.png' width='32'></td>
		<td valign='middle' class='azul16'>&nbsp;&nbsp;<b>Resumo dos Processos Cadastrados</td>
	</tr>
</table><img src='img/branco.gif' height='10'><br>";

include("config.php");

// Pesquisa a quantidade de processos de origem APS
$sqlOrigemAps = mysql_query("select * from mob where origem = 'APS'");
$qtOrigemAps  = mysql_num_rows($sqlOrigemAps);

$sqlOrigemCmoben = mysql_query("select * from mob where origem = 'CMOBEN'");
$qtOrigemCmoben  = mysql_num_rows($sqlOrigemCmoben);

// Pesquisa por fase
$sqlApsInicial = mysql_query("Select * from mob where origem = 'APS' and fase = 'INICIAL'");
$sqlApsConvocacao = mysql_query("Select * from mob where origem = 'APS' and fase = 'CONVOCAÇÃO'");
$sqlApsDefesa = mysql_query("Select * from mob where origem = 'APS' and fase = 'DEFESA'");
$sqlApsRecurso = mysql_query("Select * from mob where origem = 'APS' and fase = 'RECURSO'");
$sqlApsCobrancaAdm = mysql_query("Select * from mob where origem = 'APS' and fase = 'COBRANÇA ADM'");
$sqlApsCobrancaJud = mysql_query("Select * from mob where origem = 'APS' and fase = 'COBRANÇA JUD'");
$sqlApsCadin = mysql_query("Select * from mob where origem = 'APS' and fase = 'CADIN'");
$sqlApsSofc = mysql_query("Select * from mob where origem = 'APS' and fase = 'SOFC'");
$sqlApsApe = mysql_query("Select * from mob where origem = 'APS' and fase = 'APE'");
$sqlApsGexPf = mysql_query("Select * from mob where origem = 'APS' and fase = 'GEXPF'");
$sqlApsConcluido = mysql_query("Select * from mob where origem = 'APS' and fase = 'CONCLUÍDO'");

$sqlCmobenInicial = mysql_query("Select * from mob where origem = 'CMOBEN' and fase = 'INICIAL'");
$sqlCmobenConvocacao = mysql_query("Select * from mob where origem = 'CMOBEN' and fase = 'CONVOCAÇÃO'");
$sqlCmobenDefesa = mysql_query("Select * from mob where origem = 'CMOBEN' and fase = 'DEFESA'");
$sqlCmobenRecurso = mysql_query("Select * from mob where origem = 'CMOBEN' and fase = 'RECURSO'");
$sqlCmobenCobrancaAdm = mysql_query("Select * from mob where origem = 'CMOBEN' and fase = 'COBRANÇA ADM'");
$sqlCmobenCobrancaJud = mysql_query("Select * from mob where origem = 'CMOBEN' and fase = 'COBRANÇA JUD'");
$sqlCmobenCadin = mysql_query("Select * from mob where origem = 'CMOBEN' and fase = 'CADIN'");
$sqlCmobenSofc = mysql_query("Select * from mob where origem = 'CMOBEN' and fase = 'SOFC'");
$sqlCmobenApe = mysql_query("Select * from mob where origem = 'CMOBEN' and fase = 'APE'");
$sqlCmobenGexPf = mysql_query("Select * from mob where origem = 'CMOBEN' and fase = 'GEXPF'");
$sqlCmobenConcluido = mysql_query("Select * from mob where origem = 'CMOBEN' and fase = 'CONCLUÍDO'");

// Quantidades 
$qtApsInicial = mysql_num_rows($sqlApsInicial);
$qtApsConvocacao = mysql_num_rows($sqlApsConvocacao);
$qtApsDefesa = mysql_num_rows($sqlApsDefesa);
$qtApsRecurso = mysql_num_rows($sqlApsRecurso);
$qtApsCobrancaAdm = mysql_num_rows($sqlApsCobrancaAdm);
$qtApsCobrancaJud = mysql_num_rows($sqlApsCobrancaJud);
$qtApsCadin = mysql_num_rows($sqlApsCadin);
$qtApsSofc = mysql_num_rows($sqlApsSofc);
$qtApsApe = mysql_num_rows($sqlApsApe);
$qtApsGexPf = mysql_num_rows($sqlApsGexPf);
$qtApsConcluido = mysql_num_rows($sqlApsConcluido);

$qtCmobenInicial = mysql_num_rows($sqlCmobenInicial);
$qtCmobenConvocacao = mysql_num_rows($sqlCmobenConvocacao);
$qtCmobenDefesa = mysql_num_rows($sqlCmobenDefesa);
$qtCmobenRecurso = mysql_num_rows($sqlCmobenRecurso);
$qtCmobenCobrancaAdm = mysql_num_rows($sqlCmobenCobrancaAdm);
$qtCmobenCobrancaJud = mysql_num_rows($sqlCmobenCobrancaJud);
$qtCmobenCadin = mysql_num_rows($sqlCmobenCadin);
$qtCmobenSofc = mysql_num_rows($sqlCmobenSofc);
$qtCmobenApe = mysql_num_rows($sqlCmobenApe);
$qtCmobenGexPf = mysql_num_rows($sqlCmobenGexPf);
$qtCmobenConcluido = mysql_num_rows($sqlCmobenConcluido);

// Tabela de Resultados
echo "
<table width='700' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td valign='middle' align='center' width='500' height='40' background='img/cinza.gif' class='azul10'><B>FASE</b></td>
		<td valign='middle' align='center' width='100' height='40' background='img/cinza.gif' class='azul10'><B>APS</b></td>
		<td valign='middle' align='center' width='100' height='40' background='img/cinza.gif' class='azul10'><B>CMOBEN</b></td>
	</tr>
</table><img src='img;branco.gif' height='5'><br>

<table width='700' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td valign='middle' align='center' width='500' height='30' class='azul12'>INICIAL</td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=INICIAL&origem=APS' class='linkazul'>$qtApsInicial</a></td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=INICIAL&origem=CMOBEN' class='linkazul'>$qtCmobenInicial</a></td>
	</tr>
	<tr>
		<td valign='middle' align='center' width='500' height='30' class='azul12'>CONVOCAÇÃO</td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=CONVOCACAO&origem=APS' class='linkazul'>$qtApsConvocacao</a></td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=CONVOCACAO&origem=CMOBEN' class='linkazul'>$qtCmobenConvocacao</a></td>
	</tr>
	<tr>
		<td valign='middle' align='center' width='500' height='30' class='azul12'>DEFESA</td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=DEFESA&origem=APS' class='linkazul'>$qtApsDefesa</a></td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=DEFESA&origem=CMOBEN' class='linkazul'>$qtCmobenDefesa</a></td>
	</tr>
	<tr>
		<td valign='middle' align='center' width='500' height='30' class='azul12'>RECURSO</td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=RECURSO&origem=APS' class='linkazul'>$qtApsRecurso</a></td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=RECURSO&origem=CMOBEN' class='linkazul'>$qtCmobenRecurso</a></td>
	</tr>
	<tr>
		<td valign='middle' align='center' width='500' height='30' class='azul12'>COBRANÇA ADM</td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=COBRANCA&origem=APS' class='linkazul'>$qtApsCobrancaAdm</a></td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=COBRANCA&origem=CMOBEN' class='linkazul'>$qtCmobenCobrancaAdm</a></td>
	</tr>
	<tr>
		<td valign='middle' align='center' width='500' height='30' class='azul12'>COBRANÇA JUD</td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=COBRANCA%20JUD&origem=APS' class='linkazul'>$qtApsCobrancaJud</a></td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=COBRANCA%20JUD&origem=CMOBEN' class='linkazul'>$qtCmobenCobrancaJud</a></td>
	</tr>
	<tr>
		<td valign='middle' align='center' width='500' height='30' class='azul12'>CADIN</td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=CADIN&origem=APS' class='linkazul'>$qtApsCadin</a></td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=CADIN&origem=CMOBEN' class='linkazul'>$qtCmobenCadin</a></td>
	</tr>
	<tr>
		<td valign='middle' align='center' width='500' height='30' class='azul12'>GEX-PF</td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=GEXPF&origem=APS' class='linkazul'>$qtApsGexPf</a></td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=GEXPF&origem=CMOBEN' class='linkazul'>$qtCmobenGexPf</a></td>
	</tr>
	<tr>
		<td valign='middle' align='center' width='500' height='30' class='azul12'>APE</td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=APE&origem=APS' class='linkazul'>$qtApsApe</a></td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=APE&origem=CMOBEN' class='linkazul'>$qtCmobenApe</a></td>
	</tr>
	<tr>
		<td valign='middle' align='center' width='500' height='30' class='azul12'>SOFC</td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=SOFC&origem=APS' class='linkazul'>$qtApsSofc</a></td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=SOFC&origem=CMOBEN' class='linkazul'>$qtCmobenSofc</a></td>
	</tr>
	<tr>
		<td valign='middle' align='center' width='500' height='30' class='azul12'>CONCLUÍDO</td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=CONCLUIDO&origem=APS' class='linkazul'>$qtApsConcluido</a></td>
		<td valign='middle' align='center' width='100' height='30' class='azul12'><a href='index.php?conteudo=sql_registros.php&fase=CONCLUIDO&origem=CMOBEN' class='linkazul'>$qtCmobenConcluido</a></td>
	</tr>
	<tr>
		<td valign='middle' align='center' width='500' height='40' background='img/cinza.gif' class='azul12'><B>TOTAIS</b></td>
		<td valign='middle' align='center' width='100' height='40' background='img/cinza.gif' class='azul12'><B>$qtOrigemAps</b></td>
		<td valign='middle' align='center' width='100' height='40' background='img/cinza.gif' class='azul12'><B>$qtOrigemCmoben</b></td>
	</tr>
</table><img src='img;branco.gif' height='5'><br>";	