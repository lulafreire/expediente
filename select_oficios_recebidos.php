<?

// Pesquisa os dados e inclui os nomes no formulário (SELECT)
$ac=mysql_query("select * from oficios_recebidos where emissor = '$destinatario' and resposta = '' order by data asc");

echo"<link rel='stylesheet' href='css/geral.css' type='text/css'>";
echo "<select name='resposta' size='1'>";
echo"<option value='0'>Nenhum</option>";
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