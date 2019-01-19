<?

// Definindo o tipo de arquivo (Ex: msexcel, msword, pdf ...)
header("Content-type: application/msword");
 
// Formato do arquivo (Ex: .xls, .doc, .pdf ...)
header("Content-Disposition: attachment; filename=MeuArquivo.doc");

$numOficio = "45";
$hoje      = date('d/m/Y');


// Conteúdo
$html = "Ofício nº $numOficio/INSS/APSIRECE, em $hoje";
$html .= "$texto";
 
// Jogando o conteúdo para o arquivo    
print($html);

?>