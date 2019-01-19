<?

// Data
$dia = date("d");
$mes = date("m");
$ano = date("Y");
$diaSemana = date("w");

// Converte mês
switch ($mes)
{
case 1: $mes = "janeiro"; break;
case 2: $mes = "fevereiro"; break;
case 3: $mes = "março"; break;
case 4: $mes = "abril"; break;
case 5: $mes = "maio"; break;
case 6: $mes = "junho"; break;
case 7: $mes = "julho"; break;
case 8: $mes = "agosto"; break;
case 9: $mes = "setembro"; break;
case 10: $mes = "outubro"; break;
case 11: $mes = "novembro"; break;
case 12: $mes = "dezembro"; break;
break;
}

// Converte dia da semana
switch ($diaSemana)
{
case 0: $diaSemana = "domingo"; break;
case 1: $diaSemana = "segunda-feira"; break;
case 2: $diaSemana = "terça-feira"; break;
case 3: $diaSemana = "quarta-feira"; break;
case 4: $diaSemana = "quinta-feira"; break;
case 5: $diaSemana = "sexta-feira"; break;
case 6: $diaSemana = "sábado"; break;
break;
}

echo "<i>Hoje é $diaSemana, <b>$dia de $mes de $ano</b></i>";

?>
