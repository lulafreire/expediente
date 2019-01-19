<?

include("config.php");

$sql = mysql_query("Select id, dtCad from mob");
while($s = mysql_fetch_array($sql)) {

	$id = $s['id'];
	$dt = $s['dtCad'];
	
	$grava = mysql_query("insert into eventos (data, id, origem, descricao) values ('$dt','$id','MOB','Processo cadastrado')");

}