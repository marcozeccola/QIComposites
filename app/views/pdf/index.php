<?php /*
require(dirname(__FILE__).'/../../../fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();  
$pdf->SetFont('Arial','',24);

$pdf->Cell(40,10,$data["progetto"]->nome);

$pdf->Ln(10);
$pdf->SetFont('Arial','',14);
$pdf->Cell(40,10,"Inizio: ". $data["progetto"]->inizio);

$pdf->Ln(5);
$pdf->Cell(40,10,"Nome del progettista: ". $data["progetto"]->progettista);

$pdf->Ln(10);*/
/*

foreach($data["ispezioniCostruzione"] as $ispezione){
     
     $pdf->Ln(5);
     $pdf->Cell(40,10,"Ispezione del: ". $ispezione->data);
     $pdf->Ln(5);
     $pdf->Cell(40,10,"Effettuata a : ". $ispezione->luogo);
     $pdf->Ln(5);
     $pdf->Cell(40,10,"da : ". $ispezione->nomeOperatore ." " .$ispezione->cognomeOperatore );
     $pdf->Ln(5);
     $pdf->Cell(40,10,"Area di riferimento : ". $ispezione->area); 
     
     
     $pdf->Ln(25);
     $pdf->Cell(40,10,"Anomalie"); 
     foreach($data["anomalieCostruzione"] as $anomalia){
          if($anomalia->fk_idIspezioneCostruzione == $ispezione->idIspezioneCostruzione){ 
               $pdf->Ln(5);
               $pdf->Cell(40,10,"Tipo di anomalia : ". $anomalia->anomalia); 
          }
     }
}/


$pdf->Output();*/
?>