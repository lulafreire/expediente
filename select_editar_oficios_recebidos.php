<?

// Pesquisa os dados e inclui os nomes no formulário (SELECT)
$ac=mysql_query("select * from oficios_recebidos where emissor = '$interessado' and resposta = '' order by data asc");
echo"<link rel='stylesheet' href='css/geral.css' type='text/css'>";
echo "<select name='resposta' size='1'>";
echo "<option value='0'>Nenhum</option>";

if($idResp2!='') {

	$bc=mysql_query("select * from oficios_recebidos where id = '$idResp2'");
	while($b=mysql_fetch_array($bc)) {
	
		$num1  = $b['num'];
		$ass1  = $b['assunto'];
		$data1 = $b['data'];
		$id_oficio_recebido1 = $b['id'];
		
		// Converte a data
		$d1 = explode("-", $data1);
		$dia1 = $d1[2];
		$mes1 = $d1[1];
		$ano1 = $d1[0];
		$ndata1 = "$dia1/$mes1/$ano1";
		
		echo "<option value='$idResp2' selected>Ofício nº $num1, de $ndata1 (Ass.: $ass1)</option>";
	
	}	
	
}

    while($a=mysql_fetch_array($ac)) 
	{
		$num  = $a['num'];
		$ass  = $a['assunto'];
		$data = $a['data'];
		$id_oficio_recebido = $a['id'];
		
		// Converte a data
		$d = explode("-", $data);
		$dia = $d[2];
		$mes = $d[1];
		$ano = $d[0];
		$ndata = "$dia/$mes/$ano";
		
		echo"<option value='$id_oficio_recebido'>Ofício nº $num, de $ndata (Ass.: $ass)</option>";
	}
	echo"</select>";

?>