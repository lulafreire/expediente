<?
include "config.php";

$q=strtolower ($_GET["q"]);

$sql = "SELECT * FROM destinatarios WHERE nome like '%" . $q . "%' group by nome";

$query = mysql_query($sql);// or die ("Erro". mysql_query());

while($reg=mysql_fetch_array($query)){
		

	//if (srtpos(strtolower($reg['nom_lista']),$q !== false){
		echo " " .$reg["id"]. "-" .$reg["nome"]. "\n";
//	}
}
?>
