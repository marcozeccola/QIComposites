<?php
require(dirname(__FILE__).'/../../../fpdf/fpdf.php');
class quickPDF extends FPDF
{
    /*
            FUNZIONI 'PrimaTabella' e 'SecondaTabella':
            -Per creare la tabella 'particolare' della prima pagina ho dovuto separare
            la prima tabella in due set di contenuti, in modo da raggruppare le prime quattro 
            su due sole righe.
            -Per creare celle di grandezza eterogenea ho verificato la divisibilità per due
            delle posizioni degli array 'prima' e 'seconda'
            -Non sono sicuramente le soluzioni migliori esistenti: se ne trovi di più carine che ben vengano :)
            Per cambiare FOOTER ed HEADER:
            -Occhio alle distanze che trovi negli Ln(), il footer della prima pagine non è
            riconosciuto come un Footer ma come un normale insieme di celle.
    */ 


    public $ispezione; 
    public $idOperatoreCapo;
    public function __construct($ispezione) {
        parent::__construct();
        $this->ispezione = $ispezione;
        $this->idOperatoreCapo = 1;
    }


    //'Header' che compare soltanto nella prima pagina
    function Apertura(){
          $this->SetFont('Arial','',10);
          $this->Cell(190,5,'Q.I. Composites S.r.l. is granted acceptance for Mechanical and analytical testing, in accordance with Class',0,0,'C');
          $this->Ln();
          $this->Cell(190,5,'Programme DNVGL-CP-0484 by DNV - Certificate no. AOSSOOOOFWF Rev.1',0,0,'C');          
          $this->Ln();
          $this->Cell(190, 30, '', 'T', 0 , 'C');
          $this->Ln();
          $this->Image(PUBLICROOT.'/assets/img/pdf/logo.png',10,25,35);
          $this->Image(PUBLICROOT.'/assets/img/pdf/logo2.png',50,27,20);  
          $this->SetFont('Arial','B',10);
          $this->SetTextColor(0,0,255);
          $this->Cell(0, -50, 'https://approvalfinder.dnv.com/#approval/AOSS0000FWF', 0, 0, 'R', false, 'https://approvalfinder.dnv.com/#approval/AOSS0000FWF');
          $this->SetTextColor(0,0,0);
          $this->Ln(1);


          $this->Ln(30);
          $this->SetFont('Arial','B',20);
          $this->Cell(250, -35, 'Non-destructive Analysis Results', 0, 0, 'C');
          $this->Ln(10);
          $this->SetFont('Arial','I',15);
          $this->Cell(250, -35, 'Q.I. Composites ND Quality Control System', 0, 0, 'C');
    }

    //Footer globale per logo in basso a dx
    function Footer(){
          $this->SetY(-15);
          // Select Arial italic 8
          $this->SetFont('Arial', 'I', 10);
         
          // Print centered page number
          $this->Cell(0, 10, "Report id:  ".$this->ispezione->idCustom, 0, 0, 'L');
          $this->Cell(0, 10, $this->PageNo(), 0, 0, 'R');
          $this->Image(PUBLICROOT.'/assets/img/pdf/favicon.png', 184, 279, 12);
    }

    //Footer della prima pagina
    function FooterUnico(){
        $this->SetFont('Arial','',8);
        $this->Ln(60);
        $this->Cell(185, 5, '', 'T', 0 , 'C');
        $this->Ln(1);
        $this->Cell(185, 5, 'This report contains confidential information intended only for the recipient(s) mentioned above and is protected by law. Any disclosure,' );
        $this->Ln();
        $this->Cell(185, 3, 'distribution and/or copying of this document by any subject different from the named recipient(s) is strictly prohibited by law. Any unauthorised' );
        $this->Ln();
        $this->Cell(185, 3, 'use of the contents of this document constitutes a violation of the Law.', );
    }

    //Tabella della prima pagina
    function PrimaTabella( $dati){
        $this->SetFont('Arial','',12); 

        $grandezza = array(45, 145);
 
        $this->Ln(5);
        
        for($x = 0; $x < count($dati); $x++){
            if($dati[$x] != 'Imgs'){

               //se è nella prima colonna lo mette in grassetto
               if($x%2 == 0){ 
                    $this->SetFont('Arial','B',12);
                    $this->Cell(($x % 2 == 0)? $grandezza[0] : $grandezza[1], 8, $dati[$x], 1, 0, 'D');
               }else{ 
                    $this->SetFont('Arial','',12); 
                    $this->MultiCell(  $grandezza[1], 8, $dati[$x],1,'l');
               }
               
                

            }else{ 


               $imgs = array();
               $dirIspezione = PUBLICROOT."/ispezioni/costruzione/".$this->ispezione->idIspezioneCostruzione;
 
               $files = array();
               if(is_dir($dirIspezione)){
                    $files = array_diff(scandir($dirIspezione), array('.', '..')); 
               }
               if(count($files)>0){

                    $this->Ln(3); 
                    foreach ($files as $file) {  
                         array_push($imgs, $dirIspezione."/".$file);   
                    } 
                    
                    $this->tabellaImmagini($imgs);
               }
            }

            if($x % 2 == 1) $this->Ln(0);
        } 
        
    }

    function calcolaRighe($stringa){
          $nRighe=0;
          $lStringa = strlen($stringa);
          $nRighe = round($lStringa/23);
          if($nRighe == 0){
               $nRighe = 1;
          }
          return $nRighe;
    }

    function TabellaAnomalie($prima, $seconda, $anomalia, $nAnomalia){
          $this->SetFont('Arial','B',14);
          $this->Cell(190, 15, $nAnomalia.".", 0, 0, 'L');
          $this->Ln(20);
          $this->SetFont('Arial','',12); 

          $distanzaDaSx = 10;
          $grandezza = array(45, 145);


          //inizio riga
          $this->SetXY( $distanzaDaSx ,  $this->GetY()-8 );
          $this->SetFont('Arial','B',12);

          $this->MultiCell( 45, 8,$prima[0],1,'l');


                    
          $this->SetXY( $distanzaDaSx + 45 ,  $this->GetY()-8*$this->calcolaRighe($prima[0]) );
          $this->MultiCell( 50, 8,$prima[1],1,'l');

          $this->SetXY( $distanzaDaSx +  95 ,  $this->GetY()-8*$this->calcolaRighe($prima[1]) );
          $this->MultiCell( 45, 8,$prima[2],1,'l');

          $this->SetXY( $distanzaDaSx +  140 ,  $this->GetY()-8*$this->calcolaRighe($prima[2])  );
          $this->MultiCell( 50, 8,$prima[3],1,'l');
          $this->Ln();


          //inizio riga
          $maxRows = 0;
          for($x=4;$x<8;$x++){
               $righe = $this->calcolaRighe($prima[$x]);
               if( $righe> $maxRows ){
                    $maxRows = $righe;
               }
          }
  
          $this->SetXY( $distanzaDaSx ,  $this->GetY()-8 );
          $this->SetFont('Arial','',12);

          $this->MultiCell( 45, 8,$prima[4],1,'l');

          
          $this->SetXY( $distanzaDaSx + 45 ,  $this->GetY()-8*$this->calcolaRighe($prima[4])  );
          $this->MultiCell( 50, 8,$prima[5],1,'l');

          $this->SetXY( $distanzaDaSx +  95 ,  $this->GetY()-8*$this->calcolaRighe($prima[5])  ) ;
          $this->MultiCell( 45, 8,$prima[6],1,'l');

          $this->SetXY( $distanzaDaSx +  140 ,  $this->GetY()-8*$this->calcolaRighe($prima[6]));
          $this->MultiCell( 50, 8,$prima[7],1,'l');
 
               
          $this->Ln(8*$maxRows); 
 
          for($i = 0; $i < count($seconda); $i++){
               if($seconda[$i] != 'Imgs'){
                    
                    if($seconda[$i]=='Reparation'){ 
                         $this->SetFont('Arial','B',12);
                         $this->SetXY( $distanzaDaSx ,  $this->GetY()-8   );
                         $this->Cell(190, 8,'Reparation comments',1,0,'D');
                         
                         $this->SetFont('Arial','',12);
                         $this->SetXY(  $distanzaDaSx,  $this->GetY() + 8);
                         $this->MultiCell(190, 8, $seconda[$i], 1, 'l');
                         $i++;
                    }else{ 
                         $this->SetFont('Arial','B',12);
                         $this->SetXY( $distanzaDaSx ,  $this->GetY()    );
                         $this->Cell(190, 8,'Comments',1,0,'D');
                         
                         $this->SetFont('Arial','',12);
                         $this->SetXY(  $distanzaDaSx,  $this->GetY() + 8);
                         $this->MultiCell(190, 8, $seconda[$i], 1, 'l');
                         $i++;
                    }
               }else{ 
 
                    $this->Ln();

                    $imgs = array();
                    $dirAnomalia = PUBLICROOT."/anomalie/costruzione/".$anomalia->idAnomaliaCostruzione;
     
                    if(is_dir($dirAnomalia)){
                         $files = array_diff(scandir($dirAnomalia), array('.', '..')); 
                    }

                    foreach ($files as $file) {  
                         array_push($imgs, $dirAnomalia."/".$file);   
                    } 
                    
                    $this->tabellaImmagini($imgs);
               }
     
          } 
        
    }

    function tabellaImmagini ($immagini){ 
        for($x = 0; $x < count($immagini); $x++){ 
            $this->Image($immagini[$x],50, null, null  , 60);
            $this->Ln(1);
        }
    }  


     function stampaFirma($idOp){
          //stampa la firma dell'operatore
          $dirFirma = PUBLICROOT.'/firme/'.$idOp;
          $files = array();
          
          if(is_dir($dirFirma)){
               $files = array_diff(scandir($dirFirma), array('.', '..')); 
          }

          if(!(count($files)>0)){
               $this->stampaFirma($this->idOperatoreCapo);
          }

          foreach ($files as $file) {   
               $this->Image( $dirFirma."/".$file, 130, 25, 50); 
          }  
     }

    //Pagina finale
    function Chiusura($operatore){

          /* Se c'è un operatore valido lo setta altrimente mette l'id di Beltrando */
          if($operatore){
               $this->SetFont('Arial', '', 13);  
               $this->Cell(150, 15, 'firma'  , 0, 0, 'R');
               $this->Ln();
               $this->SetFont('Arial', 'B', 17); 
               $idOp = $operatore->idOperatore;
               $this->stampaFirma($idOp);
          }
          
          

          $this->Ln(15);
          $this->SetFont('Arial', '', 15);
          $this->Cell(190, 15, 'NDT Operator - Q.I. Composites S.r.l.', 0, 0, 'L');
          $this->Ln(25);
          $this->SetFont('Arial', 'UI', 17);
          $this->Cell(165, 10, 'www.qicomposites.com', 0, 0, 'L');
          $this->SetFont('Arial', '', 13);
          $this->Ln();
          $this->Cell(165, 10, 'Q.I. Composites S.r.l. Unipersonale', 0, 0, 'L');
          $this->Ln();
          $this->Cell(165, 10, 'Strada per Viverone 61 - 10010 Piverona (TO) - ITALIA', 0, 0, 'L');
          $this->Ln();
          $this->Cell(165, 10, 'Tel. +39 0125 643287 - email info@qicomposites.com', 0, 0, 'L');
     }

}

$pdf = new quickPDF($data["ispezione"]);
 
 $separatoreArea = $data["ispezione"]->nomeArea != ""?",": "";

 
$grandezza = array(45, 145);
$macroarea = isset($data["ispezione"]->macroArea) ? $data["ispezione"]->macroArea : ""; 

$sottoarea = isset($data["ispezione"]->sottoArea) ? $data["ispezione"]->sottoArea : "";
$sottoarea = $sottoarea != "" ? " - ". $sottoarea : "";
$sottoarea =  $sottoarea." ";

$area =  $macroarea . $sottoarea . " ". $data["ispezione"]->nomeArea;
$DatiIspezione = array('date of analysis', $data["ispezione"]->data,
               'ID report', $data["ispezione"]->idCustom,
                 'operators',  $data["ispezione"]->operatori,
                 'purchaser',  $data["ispezione"]->cliente,
                'Place of analysis',  $data["ispezione"]->luogo,
                'Scope of work',  $data["ispezione"]->obiettivo,
                'Inspected area',   $area,
                'Status',  $data["ispezione"]->stato,
                'Revisioned',  $data["ispezione"]->obiettivo == 1 ?"Yes" : "No",
                'Instrument used',  $data["ispezione"]->sonde." - ". $data["ispezione"]->reticoli." - ". $data["ispezione"]->strumenti,
                'In brief', $data["ispezione"]->riassunto,
                'Imgs');

$lorem = 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur, mollitia non porro aspernatur dignissimos suscipit ullam nulla alias, quisquam at quis esse quod? Deleniti, quia quasi minus eligendi esse tempora?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur, mollitia non porro aspernatur dignissimos suscipit ullam nulla alias, quisquam at quis esse quod? Deleniti, quia quasi minus eligendi esse tempora?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur, mollitia non porro aspernatur dignissimos suscipit ullam nulla alias, quisquam at quis esse quod? Deleniti, quia quasi minus eligendi esse tempora?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur, mollitia non porro aspernatur dignissimos suscipit ullam nulla alias, quisquam at quis esse quod? Deleniti, quia quasi minus eligendi esse tempora?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur, mollitia non porro aspernatur dignissimos suscipit ullam nulla alias, quisquam at quis esse quod? Deleniti, quia quasi minus eligendi esse tempora?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur, mollitia non porro aspernatur dignissimos suscipit ullam nulla alias, quisquam at quis esse quod? Deleniti, quia quasi minus eligendi esse tempora?';

$pdf->SetFont('Arial','',14);
$pdf->AddPage(); 
$pdf->Apertura();
$pdf->PrimaTabella($DatiIspezione);
$pdf->SetY(200);
$pdf->FooterUnico();

if($data["anomalie"]){
     $pdf->AddPage();

     $pdf->SetFont('Arial', 'B', 20);
     $pdf->Cell(190, 15, 'Anomalies Observed', 0, 0, 'C');
     $pdf->Ln();
     $contAnomalie = 1;
     foreach($data["anomalie"] as $anomalia){

          $pAnomalia = array('Type', 'Localization',  'Dimensions (mm)',  'Depth (mm)', 
                                $anomalia->anomalia,
                               $anomalia->localizzazione,
                               $anomalia->estensione,
                               $anomalia->profondita,);

          $sAnomalia = array('Comments', $anomalia->commenti,
                               'Imgs');
          if( isset($anomalia->riparazione) && $anomalia->riparazione != "no" && $anomalia->riparazione != ""  ){
               array_unshift($sAnomalia, "Reparation", $anomalia->riparazione);
          }
          $pdf->TabellaAnomalie($pAnomalia, $sAnomalia, $anomalia, $contAnomalie);
          $contAnomalie++;
     }
}
$pdf->AddPage();  
$pdf->Chiusura($data["idOperatorePrincipale"]);

$pdf->Output();

?>