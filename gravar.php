<link rel="stylesheet" type="text/css" href="css/textos.css" />
<?
include("config.php");

if($opcao=='0') // Atualizar o próprio perfil
{
    $idUser     = $_POST['idUser'];
    $matUser    = $_POST['mat'];
    $nomeUser   = $_POST['nomeUsr'];
    $cargoUser  = $_POST['cargo'];
    $emailUser  = $_POST['email'];
    $senha      = $_POST['senha'];

    $grava = mysql_query("update usr set mat = '$matUser', nome = '$nomeUser', cargo = '$cargoUser', email = '$emailUser', where id = '$idUser'");

    if($senha !='')
    {
        $senhaUser = $senha;
        $chaveUser = md5($senhaUser);
        $editar = mysql_query("update usr set chave = '$chaveUser' where id = '$idUser'");
        $msgReset = "<font class='cinza12'>Sua senha foi alterada.</font>";
    }

        // Emite mensagem de gravação com sucesso
        echo "<table width='700'>";
        echo "<tr>";
        echo "<td align='center' width='700' height='300' class='azul16'><img src='img/54.jpg' valign='middle'>&nbsp;Usuário atualizado com sucesso! $msgReset</td>";
        echo "</tr>";
        echo "</table>";
}

if($opcao=='1') // Cadastrar Usuários
{
    $matUser    = $_POST['mat'];
    $nomeUser   = $_POST['nomeUsr'];
    $cargoUser  = $_POST['cargo'];
    $emailUser  = $_POST['email'];
    $perfilUser = $_POST['perfil'];
    $senhaUser  = $matUser;
    $chaveUser  = md5($senhaUser);
    

    // Verifica se o usuário já está cadastrado
    $sql = mysql_query("Select * from usr where mat = '$matUser'");
    $resultado = mysql_num_rows($sql);
    
    // Se o resultado for positivo, exibe alerta na tela
    if($resultado!='')
    {
        echo "<table width='700'>";
        echo "<tr>";
        echo "<td align='center' width='700' height='300' class='ver16'><img src='img/alert.png' valign='middle'>&nbsp;Já existe um usuário cadastrado com esta matrícula!</td>";
        echo "</tr>";
        echo "</table>";
    }
    else
    {
        $gravar = mysql_query("Insert into usr (nome, mat, cargo, email, perfil, chave) values ('$nomeUser','$matUser','$cargoUser','$emailUser','$perfilUser','$chaveUser')");
		$gravarFavoritos = mysql_query("Insert into favoritos (mat, fav01, fav02, fav03, fav04, fav05, fav06, fav07, fav08, fav09, fav10, fav11, fav12, fav13, fav14, fav15, fav16, fav17, fav18, fav19, fav20) values ('$matUser','s29','s23','s7','s12','s23','s26','s28','s2','f1','f2','f3','f4','f9','f11','f12','f13','l2','l8','l3','l6')");
        
        // Emite mensagem de gravação com sucesso
        echo "<table width='700'>";
        echo "<tr>";
        echo "<td align='center' width='700' height='300' class='azul16'><img src='img/54.jpg' valign='middle'>&nbsp;Usuário cadastrado com sucesso!</td>";
        echo "</tr>";
        echo "</table>";
    }
}

if($opcao=='2') // Editar Usuários
{
    $idUser     = $_POST['idUser'];
    $matUser    = $_POST['mat'];
    $nomeUser   = $_POST['nomeUsr'];
    $cargoUser  = $_POST['cargo'];
    $emailUser  = $_POST['email'];
    $perfilUser = $_POST['perfil'];
    $reset      = $_POST['reset'];
    
    $grava = mysql_query("update usr set mat = '$matUser', nome = '$nomeUser', cargo = '$cargoUser', email = '$emailUser', perfil = '$perfilUser' where id = '$idUser'");

    if($reset =='1')
    {
        $senhaUser = $matUser;
        $chaveUser = md5($senhaUser);
        $editar = mysql_query("update usr set chave = '$chaveUser' where id = '$idUser'");
        $msgReset = "<font class='cinza12'>A senha do usuário foi resetada.</font>";
    }

        // Emite mensagem de gravação com sucesso
        echo "<table width='700'>";
        echo "<tr>";
        echo "<td align='center' width='700' height='300' class='azul16'><img src='img/54.jpg' valign='middle'>&nbsp;Usuário atualizado com sucesso! $msgReset</td>";
        echo "</tr>";
        echo "</table>";
}

if($opcao=='3') // Excluir Usuários
{
    $idUser = $_POST['idUser'];
    
    $delete = mysql_query("delete from usr where id ='$idUser'");

        // Emite mensagem de exclusão com sucesso
        echo "<table width='700'>";
        echo "<tr>";
        echo "<td align='center' width='700' height='300' class='azul16'><img src='img/54.jpg' valign='middle'>&nbsp;Usuário excluído com sucesso! $msgReset</td>";
        echo "</tr>";
        echo "</table>";
    
}

if($opcao=='4') // Cadastrar Fazendas
{
    $nb           = $_POST['nb'];
    $req          = $_POST['req'];
    $areaHec      = $_POST['areaHec'];
    $areaTar      = $_POST['areaTar'];
    $prop         = $_POST['prop'];
    $cpf          = $_POST['cpf'];
    $nomeFaz      = $_POST['nomeFaz'];
    $nirf         = $_POST['nirf'];
    $areaTotal    = $_POST['areaTotal'];
	$termo		  = $_POST['termo'];
    
    // Verifica se o NB já está cadastrado com o NIRF
    $sqlNB = mysql_query("select nb from fazendas where nb = '$nb' and nirf = '$nirf'");
    $resNB = mysql_num_rows($sqlNB);
    if($resNB !='')
    {
        echo "<table width='700'>";
        echo "<tr><form method='post' action='adm.php?conteudo=cad_fazendas.php'>";
        echo "<td align='center' width='700' height='300' class='ver16'><input type='hidden' name='txtNome' value='$nirf'><img src='img/alert.png' valign='middle'>&nbsp;Já existe um cadastro para o benefício <b>$nb</b> junto à fazenda <b>$nomeFaz</b>. Verifique!<p><input type='submit' value='Voltar!'></td>";
        echo "</tr></form>";
        echo "</table>";
    }
    
    else
    
    {

    // Converte area de tarefas para hectares
    if($areaTar!='')
    {
        $areaCont = $areaTar * 0.43;
        $areaContrato = round($areaCont, 2);
    }
    else
    {
        $areaContrato = $areaHec;
    }
    
    // Verifica se algum campo deixou de ser preenchido
    if($nb=='' or $req=='' or $areaContrato=='' or $prop=='' or $cpf=='' or $nomeFaz=='' or $nirf=='' or $areaTotal=='')
    {
        echo "<table width='700'>";
        echo "<tr><form method='post' action='adm.php?conteudo=cad_fazendas.php'>";
        echo "<td align='center' width='700' height='300' class='ver16'><input type='hidden' name='txtNome' value='$nirf'><img src='img/alert.png' valign='middle'>&nbsp;Você deixou algum campo em branco!<p><input type='submit' value='Voltar!'></td>";
        echo "</tr></form>";
        echo "</table>";
    }
    else
    {
        // Grava os dados
        $gravar = mysql_query("Insert into fazendas (nb, req, areaContrato, cpf, nirf, proprietario, nomeFazenda, areaTotal, termo) values ('$nb','$req','$areaContrato','$cpf','$nirf','$prop','$nomeFaz','$areaTotal','$termo')");
    
        // Exibe mensagem de cadastro com sucesso
		echo "
		<center>
		<table width='500' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='440' class='ver16'>Contrato cadastrado com sucesso!</td>
		  </tr>
		</table>		
		<center>
		<p>&nbsp;<p>";
	
	include("cad_fazendas.php");
    }
    }
    
}

if($opcao=='5') // Editar Fazendas
{
    $idFaz        = $_POST['idFaz'];
    $nb           = $_POST['nb'];
    $req          = $_POST['req'];
    $areaHec      = $_POST['areaHec'];
    $areaTar      = $_POST['areaTar'];
    $prop         = $_POST['prop'];
    $cpf          = $_POST['cpf'];
    $nomeFaz      = $_POST['nomeFaz'];
    $nirf         = $_POST['nirf'];
    $areaTotal    = $_POST['areaTotal'];

    // Converte area de tarefas para hectares
    if($areaTar!='')
    {
        $areaCont = $areaTar * 0.43;
        $areaContrato = round($areaCont, 2);
    }
    else
    {
        $areaContrato = $areaHec;
    }

        $grava = mysql_query("update fazendas set nb='$nb', req='$req', areaContrato='$areaContrato', proprietario='$prop', cpf='$cpf', nomeFazenda='$nomeFaz', nirf='$nirf', areaTotal='$areaTotal' where id='$idFaz'");// Exibe mensagem de cadastro com sucesso
        
		echo "
		<center>
		<table width='500' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='440' class='ver16'>Contrato atualizado com sucesso!</td>
		  </tr>
		</table>		
		</center>
		<p>&nbsp;<p>";

}

if($opcao=='6')
{
    $idFaz = $_POST['idFaz'];

    $delete = mysql_query("Delete from fazendas where id = $idFaz");
    echo "<table width='700'>";
    echo "<tr>";
    echo "<td align='center' width='700' height='300' class='azul16'><img src='img/54.jpg' valign='middle'>&nbsp;Registro excluído com sucesso!</td>";
    echo "</tr>";
    echo "</table>";

}

if($opcao=='7') // Cadastrar sistema corporativo
{
    $nomeSis = $_POST['nome'];
    $urlSis  = $_POST['url'];
    
    $grava = mysql_query("insert into sistemas (titulo, url) values ('$nomeSis','$urlSis')");
    
	echo "
		<center>
		<table width='500' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='440' class='ver16'>Sistema $nomeSis cadastrado com sucesso!</td>
		  </tr>
		</table>		
		</center>
		<p>&nbsp;<p>";
    
}

if($opcao=='8') // Editar Sistema corporativo
{
    $sisID   = $_POST['sisID'];
    $sisNome = $_POST['sisNome'];
    $sisUrl  = $_POST['sisUrl'];
    
    $grava = mysql_query("update sistemas set titulo='$sisNome', url = '$sisUrl' where id = '$sisID'");

    // Exibe mensagem de sucesso
    echo "<table width='700'>";
    echo "<tr>";
    echo "<td align='center' width='700' height='300' class='azul16'><img src='img/54.jpg' valign='middle'>&nbsp;Sistema atualizado com sucesso!</td>";
    echo "</tr>";
    echo "</table>";
}

if($opcao=='9') // Excluir sistemas
{
    $sisID = $_POST['sisID'];
    
    $delete = mysql_query("delete from sistemas where id = '$sisID'");
    // Exibe mensagem de sucesso
    echo "<table width='700'>";
    echo "<tr>";
    echo "<td align='center' width='700' height='300' class='azul16'><img src='img/54.jpg' valign='middle'>&nbsp;Sistema excluído com sucesso!</td>";
    echo "</tr>";
    echo "</table>";
}

if($opcao=='10') // Cadastrar links
{
    $tituloLink = $_POST['titulo'];
    $urlLink  = $_POST['url'];

    $grava = mysql_query("insert into links (titulo, url) values ('$tituloLink','$urlLink')");
    echo "
		<center>
		<table width='500' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='440' class='ver16'>O link <b>$tituloLink</b> foi cadastrado com sucesso!</td>
		  </tr>
		</table>		
		</center>
		<p>&nbsp;<p>";
	
	include("cad_links.php");
}

if($opcao=='11') // Editar links
{
    $linkID     = $_POST['linkID'];
    $linkTitulo = $_POST['linkTitulo'];
    $linkUrl    = $_POST['linkUrl'];

    $grava = mysql_query("update links set titulo='$linkTitulo', url = '$linkUrl' where id = '$linkID'");

    // Exibe mensagem de sucesso
    echo "<table width='700'>";
    echo "<tr>";
    echo "<td align='center' width='700' height='300' class='azul16'><img src='img/54.jpg' valign='middle'>&nbsp;Link atualizado com sucesso!</td>";
    echo "</tr>";
    echo "</table>";
}

if($opcao=='12') // Excluir links
{
    $linkID = $_POST['linkID'];

    $delete = mysql_query("delete from links where id = '$linkID'");
    // Exibe mensagem de sucesso
    echo "<table width='700'>";
    echo "<tr>";
    echo "<td align='center' width='700' height='300' class='azul16'><img src='img/54.jpg' valign='middle'>&nbsp;Link excluído com sucesso!</td>";
    echo "</tr>";
    echo "</table>";
}

if($opcao=='13') // Cadastrar formulários
{
    // Captura os dados do formulário
    $file = $_FILES["arquivo"];
    $titulo = $_POST['titulo'];
    
    // Define a pasta onde será gravado o arquivo
    $dir = "arquivos/";

    // Move o arquivo da pasta temporaria de upload para a pasta de destino
    if (move_uploaded_file($file["tmp_name"], "$dir/".$file["name"]))
   {
   $nFile      = md5($file["name"]);
   $x          = explode(".", $file["name"]);
   $ext        = "$x[1]";
   $diaDoAno   = date('z');
   $hms        = date('His');

   $nomeArq    = "$nFile"."dia$diaDoAno"."hms$hms.$ext";

   // Renomeia os arquivos
   rename ("$dir".$file["name"],"$dir".$nomeArq);
   
   $grava = mysql_query("insert into forms (titulo, url, tipo) values ('$titulo','$dir$nomeArq','$ext')");
   
   echo "
		<center>
		<table width='500' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='440' class='ver16'>O formulário <b>$titulo</b> foi cadastrado com sucesso!</td>
		  </tr>
		</table>		
		</center>
		<p>&nbsp;<p>";
		
		include("cad_forms.php");
   
   }
}

if($opcao=='14') // Editar formulários
{

}

if($opcao=='15') // Excluir formulários
{

}

//if($opcao='16') // Cadastrar eventos
//{
    // Recupera dados do formulário
//    $titulo = $_POST['titulo'];
//    $texto  = $_POST['texto'];

    // Grava no banco de dados
//    $grava = mysql_query("insert into albuns (titulo, texto, data, hora) values ('$titulo','$texto',curdate(), curtime())");

    // Verifica o ID da inserção
//    $sql = mysql_query("select id from albuns where titulo = '$titulo' and data = curdate() and hora = curtime()");
//    while($s=mysql_fetch_array($sql))
//    {
//        $albumID = $s['id'];
        
//    }
//}
//if($opcao=='17') // Editar eventos
//{

//}

//if($opcao=='18') // Excluir eventos
//{

//}

if($opcao=='19') // Cadastrar MOB/CMOBEN
{
    // Recupera dados do formulário
    $esp    = $_POST['esp'];
    $nb     = $_POST['nb'];
	$nome   = $_POST['nome'];
	$fase   = $_POST['fase'];
	$cx	    = $_POST['cx'];
	$origem = $_POST['origem'];
	$obs    = $_POST['obs'];

    // Verifica se já existe no banco de dados
	$sql = mysql_query("Select nb from mob where nb = '$nb' and origem='$origem'");
	$res = mysql_num_rows($sql);
	
	if($res!='0')
	{
		echo "
		<center>
		<table width='500' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
			<td valign='middle' align='center' height='60' width='440' class='ver16'>O benefício <b>$nb</b> já foi cadastrado no $origem! Verifique a digitação e tente novamente.</td>
		  </tr>
		</table>		
		</center>";
	}
	else
	{
		// Grava no banco de dados
		$grava = mysql_query("insert into mob (especie, nb, nome, fase, caixa, origem, obs, dtCad) values ('$esp','$nb','$nome','$fase','$cx','$origem','$obs',curdate())");
		
		echo "
		<center>
		<table width='500' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='440' class='ver16'>O benefício <b>$nb</b> foi cadastrado com sucesso!</td>
		  </tr>
		</table>		
		</center>
		<p>&nbsp;<p>";
		
		include("cad_mob.php");
	}
}

if($opcao=='20') //Cadastrar arquivo Sabi/PJ/Web/CTC/Cnis
{
	// Recupera dados do formulário
	$num         = $_POST['num'];
	$nomeTitular = $_POST['nomeTitular'];
	$origem      = $_POST['origem'];
	$cx          = $_POST['cx'];
	
	// Verifica se já existe no banco de dados
	$sql = mysql_query("Select * from arquivo where num = '$num' and origem='$origem'");
	$res = mysql_num_rows($sql);
	
	if($res!='0')
	{
		echo "
		<center>
		<table width='500' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/alert.png'></td>
			<td valign='middle' align='center' height='60' width='440' class='ver16'>Já existe um cadastro para o número <b>$num</b> com origem <b>$origem</b>. Verifique!</td>
		  </tr>
		</table>		
		</center>";
	}
	else
	{
		// Grava no banco de dados
		$grava = mysql_query("insert into arquivo (num, nome, cx, origem, dtCad) values ('$num','$nomeTitular','$cx','$origem',curdate())");
		
		echo "
		<center>
		<table width='500' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='440' class='ver16'>O processo de <b>$nomeTitular</b> foi cadastrado com sucesso!</td>
		  </tr>
		</table>		
		</center>
		<p>&nbsp;<p>";
		
		include("cad_arquivo.php");
	}
	
	
}
if($opcao=='21') // Atualizar Arquivo
{
	// Recupera dados do formulário
	$num         = $_POST['num'];
	$nomeTitular = $_POST['nomeTitular'];
	$origem      = $_POST['origem'];
	$cx          = $_POST['cx'];
	$idArq		 = $_POST['idArq'];
	
	// Grava no banco de dados
	$grava = mysql_query("Update arquivo set num='$num', nome='$nomeTitular', origem='$origem', cx='$cx' where id = '$idArq'");
	
	echo "
		<center>
		<table width='500' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='440' class='ver16'>O processo de <b>$nomeTitular</b> foi alterado com sucesso!</td>
		  </tr>
		</table>	
		<p>&nbsp;<p>";
		
		include("editar_arquivo.php");
}

if($opcao=='22') // Excluir MOB
{
// Identifica o registro a ser excluido
$idMob    = $_POST['idMob'];
$nbMob    = $_POST['nb'];
$nomeMob  = $_POST['nome'];

// Exclui o registro
$excluir = mysql_query("DELETE from mob where id = '$idMob'");

// Exibe a mensagem
echo "
		<center>
		<table width='700' cellpadding='0' cellspacing='0' class='bordasimples'>
		  <tr>
		    <td valign='middle' align='center' height='60' width='60' background='img/cinza.gif'><img src='img/sucesso.png'></td>
			<td valign='middle' align='center' height='60' width='640' class='azul14'>O registro de <b>$nome</b> (NB $nb) foi excluído com sucesso!</td>
		  </tr>
		</table>	
		<p>&nbsp;<p>";
}

if($opcao=='23') // Gravar Agenda Perícia Manual
{

	// Recupera dados do formulário
    $esp    	 = $_POST['esp'];
    $nb     	 = $_POST['nb'];
	$nomeSeg	 = $_POST['nomeSeg'];
	$telefone	 = $_POST['telefone'];
	$resp  		 = $_POST['resp'];
	$nit  	     = $_POST['nit'];
	$req    	 = $_POST['req'];
	$perito 	 = $_POST['perito'];
	$data_dia    = $_POST['data_dia'];
	$data_mes	 = $_POST['data_mes'];
	$data_ano	 = $_POST['data_ano'];
	$horaInicial = $_POST['horaInicial'];
	$horaFinal	 = $_POST['horaFinal'];
	$motivo	     = $_POST['motivo'];
	$obs	     = $_POST['obs'];
	
	if($horaFinal!=''){
		$horario = "$horaInicial a $horaFinal";
	} else {
		$horario = "$horaInicial";
	}
	
	if($telefone==''){
		$telefone = "Não informado";
	}
	
	// Formata Data
	$hoje = date('Y-m-d');
	$data = "$data_ano-$data_mes-$data_dia";
	
	// Grava no banco de dados
	$grava = mysql_query("insert into agenda (esp, nb, nome, tel, resp, nit, req, perito, data, hora, hora2, motivo, obs, usr, data_cad) values ('$esp','$nb','$nomeSeg','$telefone','$resp','$nit','$req','$perito','$data','$horaInicial','$horaFinal','$motivo','$obs','$nomeAdm - Mat.: $mat','$hoje')");
	$id = mysql_insert_id();
		
	echo "
		<table width='700' cellpadding='0' cellspacing='0'>
			<tr>
				<td valign='middle' align='center' height='100' class='vde14'><img src='img/sucesso.png'><br><b>Dados gravados com sucesso!</b><br><font class='cza12'>Imprima o comprovante e dê ciência ao interessado ou representante legal</td>
			</tr>
		</table><hr size='1' width='700'>";
		
	echo "
	<table width='700' cellpadding='0' cellspacing='0'>
  <tr><form method='post' action='comprovante_agenda_pdf.php' target='_blanc'>
    <td valign='middle' align='right' width='200' class='azul12'><b>Nome Completo:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$nomeSeg<input type='hidden' name='nomeSeg' value='$nomeSeg'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>DDD/TELEFONE(S) DE CONTATO:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'><input type='hidden' name='telefone' value='$telefone'> $telefone</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>RESPONSÁVEL:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'><input type='hidden' name='resp' value='$resp'>$resp</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>  
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>ESP/NB:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$esp / $nb<input type='hidden' name='esp' value='$esp'><input type='hidden' name='nb' value='$nb'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>NIT:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$nit<input type='hidden' name='nit' value='$nit'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>REQUERIMENTO:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$req<input type='hidden' name='req' value='$req'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>DATA BLOQUEADA:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$data_dia/$data_mes/$data_ano<input type='hidden' name='data_dia' value='$data_dia'><input type='hidden' name='data_mes' value='$data_mes'><input type='hidden' name='data_ano' value='$data_ano'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>HORÁRIO:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$horario<input type='hidden' name='horario' value='$horario'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>PERITO:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$perito<input type='hidden' name='perito' value='$perito'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>MOTIVO:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$motivo<input type='hidden' name='motivo' value='$motivo'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>OBS.:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$obs<input type='hidden' name='obs' value='$obs'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'><input type='hidden' name='servidor' value='$nomeAdm'><input type='hidden' name='mat' value='$mat'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'></td>
    <td valign='middle' align='left'><input type='submit' value='Imprimir comprovante'></td>
  </tr></form>
<table>";

}
		

if($opcao=='24') // Atualiza registro na Agenda Perícia Manual
{
	// Recupera dados do formulário
    $esp    	 = $_POST['esp'];
    $nb     	 = $_POST['nb'];
	$nomeSeg	 = $_POST['nomeSeg'];
	$ddd    	 = $_POST['ddd'];
	$tel01  	 = $_POST['tel01'];
	$tel02  	 = $_POST['tel02'];
	$resp  		 = $_POST['resp'];
	$nit  	     = $_POST['nit'];
	$req    	 = $_POST['req'];
	$perito 	 = $_POST['txtNome'];
	$data_dia    = $_POST['data_dia'];
	$data_mes	 = $_POST['data_mes'];
	$data_ano	 = $_POST['data_ano'];
	$hora		 = $_POST['hora'];
	$min		 = $_POST['min'];
	$hora2		 = $_POST['hora2'];
	$min2		 = $_POST['min2'];
	$motivo	     = $_POST['motivo'];
	$obs	     = $_POST['obs'];
	$id	 		 = $_POST['id'];
	
	// Formata Hora
	$horaInicial = "$hora:$min";
	$horaFinal   = "$hora2:$min2";
	
	if($hora2!=''){
		$horario = "$horaInicial a $horaFinal";
	} else {
		$horario = "$horaInicial";
	}
	
	if($tel01==''){
		$telefone = "Não informado";
	}
	
	if($tel02!=''){
		$telefone = "($ddd) $tel01/$tel02";
	} else {
		$telefone = "($ddd) $tel01";
	}
	
	// Formata Data
	$hoje = date('Y-m-d');
	$data = "$data_ano-$data_mes-$data_dia";
	
	// verifica se os dados (DATA/HORÁRIO/PERITO) já foram cadastrados anteriormente
	$sqlData = mysql_query("select * from agenda where data = '$data' and perito = '$perito' and hora = '$horaInicial:00'");
	$resData = mysql_num_rows($sqlData);
	$sqlData2 = mysql_query("select * from agenda where data = '$data' and perito = '$perito' and hora2 = '$horaInicial:00'");
	$resData2 = mysql_num_rows($sqlData2);
	
	if($resData or $resData2!=''){
		
		// Caso encontre algum registro, emite mensagem de alerta
		echo "
		<table width='700' cellpadding='0' cellspacing='0'>
			<tr>
				<td valign='middle' align='center' height='100' class='ver14'><img src='img/alert.png'><br><b>Este horário já foi bloqueado anteriormente!</b><br><font class='cza12'>Verifique os dados digitados e tente novamente</td>
			</tr>
		</table><hr size='1' width='700'>";
		
		include("cad_agenda.php");
		
	
	} else {
	
	// Verifica se já existe um agendamento para o mesmo segurado
	$sqlData3 = mysql_query("select * from agenda where nome='$nomeSeg' and data > '$hoje'");
	$resData3 = mysql_num_rows($sqlData3);
	
	if($resData3!='') {
	
		while ($s = mysql_fetch_array($sqlData3)) {
		
			$dataAgendada = $s['data'];
			$d = explode("-", $dataAgendada);
			$diaAg = $d[2];
			$mesAg = $d[1];
			$anoAg = $d[0];
			$dataAgendada = "$diaAg/$mesAg/$anoAg";
			
		}
		
		// Caso encontre algum registro, emite mensagem de alerta
		echo "
		<table width='700' cellpadding='0' cellspacing='0'>
			<tr>
				<td valign='middle' align='center' height='100' class='ver14'><img src='img/alert.png'><br><b>Já existe uma vaga bloqueada para este segurado em <a href='sql_agenda.php?nomeSeg=$nomeSeg' target='_blanc' class='linkver'><u>$dataAgendada</u></a>!</b><br><font class='cza12'>Verifique os dados digitados e tente novamente</td>
			</tr>
		</table><hr size='1' width='700'>";
		
		include("cad_agenda.php");
	
	} else {
	
	// Atualiza o banco de dados
	$atualiza = mysql_query("UPDATE agenda set esp='$esp', nb='$nb', nome='$nomeSeg', tel='$telefone', resp='$resp', nit='$nit', req='$req', perito='$perito', data='$data', hora='$horaInicial', hora2='$horaFinal', motivo='$motivo', obs='$obs', usr='$nomeAdm - $mat', data_cad='$hoje' where id = '$id'");
	
	echo "<font class='azul20'>Dados gravados com sucesso $id!</font><p>";
	echo "
	<table width='700' cellpadding='0' cellspacing='0'>
  <tr><form method='post' action='comprovante_agenda_pdf.php' target='_blanc'>
    <td valign='middle' align='right' width='200' class='azul12'><b>Nome Completo:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$nomeSeg<input type='hidden' name='nomeSeg' value='$nomeSeg'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>DDD/TELEFONE(S) DE CONTATO:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'><input type='hidden' name='telefone' value='$telefone'> $telefone</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>RESPONSÁVEL:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'><input type='hidden' name='resp' value='$resp'>$resp</td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>  
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>ESP/NB:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$esp / $nb<input type='hidden' name='esp' value='$esp'><input type='hidden' name='nb' value='$nb'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>NIT:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$nit<input type='hidden' name='nit' value='$nit'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>REQUERIMENTO:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$req<input type='hidden' name='req' value='$req'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>DATA BLOQUEADA:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$data_dia/$data_mes/$data_ano<input type='hidden' name='data_dia' value='$data_dia'><input type='hidden' name='data_mes' value='$data_mes'><input type='hidden' name='data_ano' value='$data_ano'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>HORÁRIO:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$horario<input type='hidden' name='horario' value='$horario'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>PERITO:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$perito<input type='hidden' name='perito' value='$perito'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>MOTIVO:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$motivo<input type='hidden' name='motivo' value='$motivo'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'><b>OBS.:&nbsp;&nbsp;</td>
    <td valign='middle' align='left' class='azul12'>$obs<input type='hidden' name='obs' value='$obs'></td>
  </tr>
  <tr>
    <td valign='middle' width='200'><hr size='1' color='#c0c0c0'></td>
    <td valign='middle'><hr size='1' color='#c0c0c0'><input type='hidden' name='servidor' value='$nomeAdm'><input type='hidden' name='mat' value='$mat'></td>
  </tr>
  <tr>
    <td valign='middle' align='right' width='200' class='azul12'></td>
    <td valign='middle' align='left'><input type='submit' value='Imprimir comprovante'></td>
  </tr></form>
<table>";
}
	}
		}


if($opcao=='25')
{

	
	// Define variáveis
	$data = date('Y-m-d');
	$hora = date('H:i:s');
	
	// Recupera dados do formulário
	$nome = $_POST['nome'];
	$nit  = $_POST['nit'];
	$nb   = $_POST['nb'];
	$texto= $_POST['texto'];
	$usr  = $_POST['usr'];
	
	// Grava as informações no banco de dados
	$grava = mysql_query("insert into ocorrencias (nome, nit, nb, texto, data, hora, usr) values ('$nome','$nit','$nb','$texto','$data','$hora','$usr')");
	
	echo "Ocorrência gravada.";
}