<?
include "config.php";

$q=strtolower ($_GET["q"]);

$sql = "SELECT num, emissor FROM oficios_recebidos WHERE num like '%" . $q . "%' UNION SELECT num, emissor FROM memos_recebidos WHERE num like '%" . $q . "%'";

$query = mysql_query($sql);// or die ("Erro". mysql_query());

while($reg=mysql_fetch_array($query)){
		

	//if (srtpos(strtolower($reg['nom_lista']),$q !== false){
		echo " " .$reg["num"]. "-" .$reg["emissor"]. "\n";
//	}
}
?>
