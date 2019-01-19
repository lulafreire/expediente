<?

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='40' height='40' background='img/cinza.gif' valign='middle' align='center'><img src='img/ocorrencias.png' height='32' width='32'></td>
		<td valign='middle' align='left' class='azul16'>&nbsp;&nbsp;<b>Cadastrar</b> <font class='cza12'><i>incluir dados do processos</i></font></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>";

?>

<table width='700' cellpadding='0' cellspacing='0'>
  <tr><form method="post" action="index.php?conteudo=grava_registro.php" enctype="multipart/form-data">
    <td valign='middle' align='right' width='200' class='azul12'><b><font class='ver12'>ESP / NB *:</font>&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='esp' size='2' maxlength='2'>&nbsp;&nbsp;<input type='text' name='num' size='20' maxlength='10'>&nbsp;&nbsp;<font class='ver09'>Apenas números </td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Protocolo SIPPS:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='sipps' size='40' maxlength='17'>&nbsp;&nbsp;<font class='ver09'>Apenas números</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b><font class='ver12'>Nome Completo *:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='nomeTitular' size='60'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b><font class='ver12'>Origem *:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'><input type='radio' name='origem' value='APS'> APS - Controle Interno &nbsp;&nbsp;<input type='radio' name='origem' value='CMOBEN'>CMOBEN</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Demanda:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='demanda' size='60'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Fase:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>
	<select name='fase'>
		<option value='INICIAL'>Inicial</option>
		<option value='CONVOCAÇÃO'>Convocação</option>
		<option value='DEFESA'>Defesa</option>
		<option value='RECURSO'>Recurso</option>
		<option value='COBRANÇA ADM'>Cobrança Administrativa</option>
		<option value='COBRANÇA JUD'>Cobrança Judicial</option>
		<option value='CADIN'>Inclusão no CADIN</option>
		<option value='SOFC'>Enviado à SOFC</option>
		<option value='APE'>Enviado à APE</option>
		<option value='GEXPF'>Enviado à GEX-PF</option>		
		<option value='CONCLUÍDO'>Concluído</option>
	</select>
	</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Caixa:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='text' name='caixa' size='10'>&nbsp;</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Observações:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><textarea name='obs' rows='3' cols='45'></textarea></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>Anexo:&nbsp;&nbsp;<br><img src='img/branco.gif' height='10'><br>Descrição:&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type="file" name="arquivo" size='60' /><br><img src='img/branco.gif' height='5'><br><input type='text' name='descricao' size='60'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><font class='ver12'><i>(*) Dados obrigatórios</i>&nbsp;&nbsp;</td>
    <td valign='middle' align='left'><input type='submit' value='Gravar'></td>
  </tr></form>
</table>
