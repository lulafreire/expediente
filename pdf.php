<?php
require('../libraries/fpdf/fpdf.php');

// conecta ao banco de dados
include("config.php");

// Identifica o of�cio
$id = $_GET['id'];

//LOGO QUE SER� COLOCADO NO RELAT�RIO                     
$imagem =  "img/brasao.jpg";

//ENDERE�O DA BIBLIOTECA FPDF                             
$end_fpdf    =  "../libraries/fpdf";

//TIPO DO PDF GERADO                                      
//F-> SALVA NO ENDERE�O ESPECIFICADO NA VAR END_FINAL     
$tipo_pdf    =  "D";

// Pesquisa os dados do ofício
$sqlOficio =mysql_query("Select * from oficios_emitidos where id ='$id'");
while($o = mysql_fetch_array($sqlOficio)) {

	$numero       = $o['num'];
	$emitente     = $o['emitente'];
	$destinatario = $o['destinatario'];
	$assunto      = $o['assunto'];
	$tratamento   = $o['tratamento'];
	$texto        = $o['texto'];
	$data         = $o['data'];
	
	switch($emitente) {
	
		case 1: $nomeEmitente = "Luiz Alberto Freire de Oliveira"; $cargoEmitente = "Gerente da APS Irec�/BA"; $matricula = "1377549"; break;
		case 2: $nomeEmitente = "Leonardo Sampaio dos Santos"; $cargoEmitente = "Gerente Substituto da APS Irec�/BA"; $matricula = "2022319"; break;
	
	}
	
	// Formata data
	$d     = explode("-", $data);
	$dia   = $d[2];
	$mes   = $d[1];
	$ano   = $d[0];
	
	// Converte m�s
	switch ($mes) {
		case 1: $mes = "janeiro"; break;
		case 2: $mes = "fevereiro"; break;
		case 3: $mes = "mar�o"; break;
		case 4: $mes = "abril"; break;
		case 5: $mes = "maio"; break;
		case 6: $mes = "junho"; break;
		case 7: $mes = "julho"; break;
		case 8: $mes = "agosto"; break;
		case 9: $mes = "setembro"; break;
		case 10: $mes = "outubro"; break;
		case 11: $mes = "novembro"; break;
		case 12: $mes = "dezembro"; break;
	}

	$data = "$dia de $mes de $ano.";

	// Pesquisa os dados completos do destinat�rio
	$sqlDest = mysql_query("Select * from destinatarios where nome = '$destinatario'");
	while($d=mysql_fetch_array($sqlDest)) {

		$cargo    = $d['cargo'];
		$end      = $d['end'];
		$orgao    = $d['orgao'];
		$cep      = $d['cep'];
		$cidade   = $d['cidade'];

	}		

}

//ENDERE�O ONDE SER� GERADO O PDF                         
$end_final   =  "Of�cio n� $numero/$ano.pdf";

//M�todo Footer que estiliza o rodap� da p�gina
   function Footer() {

      //posicionamos o rodap� a 1cm do fim da p�gina
      $this->SetY(-10);
      
      //Informamos a fonte, seu estilo e seu tamanho
      $this->SetFont('Arial','I',8);

      //Informamos o tamanho do box que vai receber o conte�do do rodap�
      //e inserimos o n�mero da p�gina atrav�s da fun��o PageNo()
      //al�m de informar se ter� borda e o alinhamento do texto
      $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
   }
class PDF extends FPDF
{
function Footer()
{
    //Go to 1.5 cm from bottom
    $this->SetY(-15);
    //Select Arial italic 8
    $this->SetFont('Arial','B',8);
    //Print centered
	$this->SetDrawColor(169,169,169);
	$this->Line(10, 280, 200, 280);
    $this->Cell(0,4,"AG�NCIA DA PREVID�NCIA SOCIAL EM IREC�/BA",0,1,'C');
	$this->SetFont('Arial','I',7);
	$this->Cell(0,4,"Rua Trinta e Tr�s, s/n - Lot. Novo Horizonte - CEP 44900-000 - Irec�/BA | Tel.: (74) 3641-3166 | E-mail: aps04024020@inss.gov.br",0,1,'C');
}
} 

$pdf = new PDF();
$pdf->AddPage('P','A4');
$pdf->SetAutoPageBreak(true, 25);
$pdf->Image($imagem, 90, 8, 25);
$pdf->Ln(25);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(190,8,"INSTITUTO NACIONAL DO SEGURO SOCIAL", 0,1,'C');
$pdf->SetDrawColor(169,169,169);
$pdf->Line(10, 42, 200, 42);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(190,8,"Of�cio n� $numero/$ano/APSIRECE/INSS", 0, 1);
$pdf->SetFont('Arial','',11);
$pdf->Cell(190,8,"Irec�/BA, em $data", 0, 1, 'R');
$pdf->Ln(5);
$pdf->Cell(190,8,"Ao(�) Sr(a).", 0, 1, 'L');
$pdf->SetFont('Arial','B',11);
$pdf->Cell(190,5,"$destinatario", 0, 1, 'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(190,5,"$cargo", 0, 1, 'L');
$pdf->Cell(190,5,"$orgao", 0, 1, 'L');
$pdf->Cell(190,5,"$end", 0, 1, 'L');
$pdf->Cell(190,5,"$cep - $cidade", 0, 1, 'L');
$pdf->Ln(5);
$pdf->Cell(20,8,"Assunto: ", 0, 0, 'L');
$pdf->SetFont('Arial','B',11);
$pdf->Cell(170,8,"$assunto ", 0, 1, 'L');
$pdf->Ln(10);
$pdf->SetFont('Arial','',11);
$pdf->Cell(190,5,"$tratamento", 0, 1, 'L');
$pdf->Ln(7);
$pdf->MultiCell(190, 5, "$texto", 0, 'J', 0);
$pdf->Ln(5);
$pdf->Cell(170,8,"Atenciosamente, ", 0, 1, 'L');
$pdf->Ln(8);
$pdf->Cell(190,7,"___________________________________________________", 0, 1, 'C');
$pdf->SetFont('Arial','B',11);
$pdf->Cell(190,5,"$nomeEmitente", 0, 1, 'C');
$pdf->SetFont('Arial','',11);
$pdf->Cell(190,5,"$cargoEmitente", 0, 1, 'C');
$pdf->Cell(190,5,"MATR�CULA $matricula", 0, 1, 'C');
$pdf->Ln(1);					
$pdf->Output("$end_final", "$tipo_pdf");
?>