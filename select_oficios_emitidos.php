<?

// Pesquisa os dados e inclui os nomes no formul�rio (SELECT)
$ac=mysql_query("select * from oficios_emitidos where destinatario = '$emissor' and resposta = '' order by data asc");

echo"<link rel='stylesheet' href='css/geral.css' type='text/css'>";
echo "<select name='resposta' size='1'>";
echo"<option value='0'>Nenhum.</option>";
    while($a=mysql_fetch_array($ac)) 
	{
		$num  = $a['num'];
		$ass  = $a['assunto'];
		$data = $a['data'];
		$id_oficio_emitido = $a['id'];
		
		// Converte a data
		$d = explode("-", $data);
		$dia = $d[2];
		$mes = $d[1];
		$ano = $d[0];
		$ndata = "$dia/$mes/$ano";
		
		echo"<option value='$id_oficio_emitido'>Of�cio n� $num/$ano/APSIRECE/INSS, de $ndata (Ass.: $ass)</option>";
	}
	echo"</select>";
?>