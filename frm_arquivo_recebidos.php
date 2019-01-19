<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.bgiframe.min.js"></script>
<script type="text/javascript" src="js/jquery.ajaxQueue.js"></script>
<script type="text/javascript" src="js/thickbox-compressed.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<!--css -->
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css"/>
<link rel="stylesheet" type="text/css" href="css/thickbox.css"/>

 <script type="text/javascript">
   $(document).ready(function(){
      $("#txtNome").autocomplete("completar_arquivo.php", {
         width:500,
         selectFirst: false
      });
   });
 </script>

</head>

<body>

<?

echo "
<table width='940' cellpadding='0' cellspacing='0' class='bordasimples'>
	<tr>
		<td width='40' height='40' background='img/cinza.gif' valign='middle' align='center'><img src='img/editar.png' height='32' width='32'></td>
		<td valign='middle' align='left' class='azul16'>&nbsp;&nbsp;<b>Ofícios Recebidos</b> <font class='cza12'><i>Cadastrar ofícios recebidos</i></font></td>
	</tr>
</table>
<img src='img/branco.gif' height='10'><br>";
?>

<font class='azul16'>Informe o Nome do Emissor</font><br><img src='img/branco.gif' height='10'>
<form method='post' action='index.php?conteudo=oficios_recebidos.php'>
<input type="text" name="txtNome" id="txtNome" size="30" class="pto14"/>&nbsp;&nbsp;<input type='submit' value='Ok!'>
</form>
</body>
</html>
