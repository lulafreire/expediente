<?
include "config.php";

$q=strtolower ($_GET["q"]);

$sql = "SELECT * FROM oficios_recebidos c OUTER JOIN oficios_emitidos a ON (c.num_oficios = a.num_oficios_emitidos) WHERE num like '%" . $q . "%' group by nome";

$query = mysql_query($sql);// or die ("Erro". mysql_query());

while($reg=mysql_fetch_array($query)){
		

	//if (srtpos(strtolower($reg['nom_lista']),$q !== false){
		echo " " .$reg["id"]. "- Ofício nº" .$reg["num"]. "\n";
//	}
}
?>
