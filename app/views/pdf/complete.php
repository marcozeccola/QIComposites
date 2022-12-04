<?php
require(dirname(__FILE__).'/../../../fpdf/fpdf.php');
class completePDF extends FPDF
{ 


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
          $this->Cell(0, 10, "Report N ".$this->ispezione->idCustom, 0, 0, 'L');
          $this->Cell(0, 10, $this->PageNo(), 0, 0, 'R');
          $this->Image(PUBLICROOT.'/assets/img/pdf/favicon.png', 180, 275, 20);
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
        $this->SetFont('Arial','',15);
        $this->Ln(5);

        $grandezza = array(45, 145);
 
        $this->Ln(15);
        
        for($x = 0; $x < count($dati); $x++){
            if($dati[$x] != 'Imgs'){
                $this->Cell(($x % 2 == 0)? $grandezza[0] : $grandezza[1], 15, $dati[$x], 1, 0, 'D');
            }else{ 


               $imgs = array();
               $dirIspezione = PUBLICROOT."/ispezioni/costruzione/".$this->ispezione->idIspezioneCostruzione;

               $files = array();

               if(is_dir($dirIspezione)){
                    $files = array_diff(scandir($dirIspezione), array('.', '..')); 
               }
               if(count($files)>0){
                    $this->Cell(190, 15, 'Pics', 0, 0, 'C');
                    $this->Ln();
                    foreach ($files as $file) {  
                         array_push($imgs, $dirIspezione."/".$file);   
                    } 
                    
                    $this->tabellaImmagini($imgs);
               }
            }

            if($x % 2 == 1) $this->Ln();
        } 
        
    }

    function inspectionProcedure(){
  
          $distanzaDaSx = 10;
          $this->AddPage();
          $this->SetFont('Arial', 'B', 20);
          $this->Cell(190, 15, 'General Inspection Procedure', 0, 0, 'C');
          $this->Ln();
          $this->SetFont('Arial', 'B', 15);
          $this->SetXY( $distanzaDaSx  ,  $this->GetY()  );
          $this->MultiCell(70, 15,"Reference Procedures for the inspection, as approved by DNV", 1, 'l');
          $this->SetXY( 80, $this->GetY()-45 );
          $this->SetFont('Arial', '', 12);
          $this->MultiCell(120, 15,"QI.C1817 - Standard Practice for UT on composite spars\nQI.C1908 - Standard Practice for UT of flat composite panels (solid and sandwich)", 1, 'l');
          $this->SetFont('Arial', 'B', 15);
          $this->SetXY( $distanzaDaSx  ,  $this->GetY()  );
          $this->MultiCell(70, 15,"Monolithic / Skins\n\n", 1, 'l');
          $this->SetXY( 80, $this->GetY()-30 );
          $this->SetFont('Arial', '', 12);
          $this->MultiCell(120, 15,"Thickness measurement, evaluation of laminate quality and compaction, according to the inspection grid described.", 1, 'l');

     }

    function TabellaAnomalie($prima, $seconda, $anomalia){
          $this->SetFont('Arial','',15);
          $this->Ln(5);

          $distanzaDaSx = 10;
          $grandezza = array(45, 145);

          for($x = 0; $x < count($prima); $x++){
               $this->Cell(($x % 2 == 0)? 45 : 50, 15,$prima[$x],1,0,'D');
               if($x == 3) 
                    $this->Ln();
          }
     
          $this->Ln(15); 

          for($i = 0; $i < count($seconda); $i++){
               if($seconda[$i] != 'Imgs'){
                    $this->SetXY(($i % 2 == 0)? $distanzaDaSx : $grandezza[0]+$distanzaDaSx,
                                   ($i % 2 == 0)? $this->GetY() : $this->GetY()-15 );
                    $this->MultiCell(($i % 2 == 0)? $grandezza[0] : $grandezza[1], 15, $seconda[$i], 1, 'l');
               }else{ 

                    $this->Cell(190, 15, 'Pics', 0, 0, 'C');
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
            $this->Image($immagini[$x],50, null,  100);
            $this->Ln();
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


     function validity(){ 
        $this->SetFont('Arial', 'B', 17);
        $this->Cell(190, 15, 'Validity of this Analysis & Certificates', 0, 0, 'C');
        $this->SetFont('Arial', '', 13);
        $this->Ln();
        $this->MultiCell(190, 7, "Although the present check was carried out with the maximum care, it's not possible to declare to have discovered every anomaly or defect present in the structure at the moment of the inspection. Backing film residues are difficult to detect with ultrasonic testing or other NDT methods. Therefore, this report cannot give an explicit or implicit guarantee concerning the structure.", 1);
        $this->MultiCell(190, 7, 'Q.I. Composites S.r.l., Piverone, Italy, is granted acceptance for mechanical and analytical testing in accordance with Class Programme DNVGL-CP-0484 (Certificate No: AOSS0000FWF Revision No: 1).', 1);
        $this->MultiCell(190, 7, "Q.I. Composites S.r.l. has an internal Responsible Level III certified in UT method according to ISO 9712 and ASNT. Q.I. Composites NDT operators are trained and examined by Responsible Level III, following SNT-TC-1A Written Practice.\nQ.I. Composites S.r.l. has been found to conform to the Quality Management System standard ISO 9001:2015. The certificate (10000454078-MSC-ACCREDIA-ITA) is valid for Non-destructive testing and lab chemical tests on composite and metallic materials for the nautical, automotive, aerospace, eolic fields, and various composite material products.", 1);
        
     }

     function tabella33($mat){ 
          $distanzaDaSx = 10;
          $grandezza = array(30, 90,70);

          
          $this->SetFont('Arial', '', 10);

          $currY= $this->GetY();

          for($i = 0; $i < count($mat); $i++){ 
               if((($i+1)%3)==0){

                    $x=$grandezza[0]+$grandezza[1]+$distanzaDaSx;
                    
                    $y=$currY;
                    $wTab = $grandezza[2];

               }elseif($i%3==0){  
                    $currY=$this->GetY();
                    $x=$distanzaDaSx ;
                    $y=$currY;
                    $wTab = $grandezza[0];

               }else{

                    $x=$distanzaDaSx+$grandezza[0] ;
                    
                    $y=$currY;
                    $wTab = $grandezza[1];

               }
                    $this->SetXY($x , $y );
                    $this->MultiCell($wTab, 10,  $mat[$i], 1, 'l');
          }
     }
     function appendix(){ 
          $this->SetTextColor(21,38,57);
          $this->SetFont('Arial', 'B', 17);
          $this->Cell(190, 15, 'Validity of this Analysis & Certificates', 0, 0, 'C');
          $this->SetFont('Arial', 'B', 12);
          $this->Ln();
          $this->Cell(190, 15, 'Ultrasonic analysis (UT)', 0, 0, 'L');
          $this->SetFont('Arial', '', 12);
          $this->Ln();
          $this->MultiCell(190, 7, "It enables to define the condition of a structure looking in depth into the material. The operator puts the transducer on the surface of the structure to be analysed and, looking at the ultrasonic beam propagation, can understand the state of structure in that point.\nThis kind of analysis gives an immediate and detailed picture of the actual condition of the analysed structures, mapping dimension and type of anomalies present.", 1);
          
          $this->SetFont('Arial', 'I', 13);
          $this->Cell(190, 15, 'Defects detectable on composite materials', 0, 0, 'L');
          $this->Ln();

          

          $tabella =array("Defect/Laminate classification", "UT identification\n\n", "Physical description\n\n",


                         "Delamination\n\n\n", 
                         "The backwall echo (BWE) is partially or completely lost. A clear echo appears at a certain thickness of the laminate.", 
                         "Two next plies are not adherent (fig.1).\n\n\n",
                         
                         "High volume porosity\n\n\n\n", 
                         "The BWE is completely lost. Instead of the BWE, several similar echoes appear at different thicknesses.\n\n\n\n", 
                         "Several voids are trapped between the layers; void content estimation is higher than 3%, when scattered in the whole volume of ultrasonic beam inside material (fig.2). ",
                         
                         "Interlaminar porosity\n\n", 
                         "The BWE is considerably low, but it does appear. The energy lost by the BWE appears as intermediate echoes.", 
                         "Void content estimate between 1% and 3% in the volume of ultrasonic beam inside material.",
                         
                         "Compact laminate", 
                         "A perfect BWE is obtained with no intermediate echoes.\n\n\n", 
                         "Void content lower than 1% of volume in the ultrasonic beam inside material.",
                         
                         "Crack", 
                         "None.", 
                         "Fibre interruption.",
                         
                         "Core debond/ weak bond\n", 
                         "Ultrasonic signal changes in amplitude and shape.\n\n", 
                         "No or weak adhesive strength between skin and core (the skin peels off without damage to the core).",
                         
                         "Blister\n\n", 
                         "As debond or as delamination.\n\n", 
                         "Delamination with deflection of one surface.",
                         
                         "Void", 
                         "As porosity or delamination, according to its dimension.", 
                         "Air inclusion between adjacent layers."
                         );

          $this->tabella33($tabella);
          
          $this->Image(PUBLICROOT.'/assets/img/pdf/figs.jpg',10,80,150);
          
     }

    //Pagina finale
    function Chiusura($operatore){
          $this->SetFont('Arial', '', 13);  
          $this->Cell(150, 15, 'firma'  , 0, 0, 'R');
          $this->Ln();
          $this->SetFont('Arial', 'B', 17); 

          /* Se c'è un operatore valido lo setta altrimente mette l'id di Beltrando */
          if($operatore){
               $idOp = $operatore->idOperatore;
          }else{
               $idOp = $this->idOperatoreCapo;
          }
          
          $this->stampaFirma($idOp);
          

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

$pdf = new completePDF($data["ispezione"]);
 
$grandezza = array(45, 145);
//Contenuto del resto della prima tabella
$seconda = array('Date of analysis', $data["ispezione"]->data,
                 'Operators',  $data["ispezione"]->operatori,
                 'Purchaser',  $data["ispezione"]->cliente,
                'Place of analysis',  $data["ispezione"]->luogo,
                'Instrument used',  $data["ispezione"]->sonde." - ". $data["ispezione"]->reticoli,
                'Area of the boat',   $data["ispezione"]->macroArea." - ". $data["ispezione"]->sottoArea . " ". $data["ispezione"]->nomeArea,
                'Main goal',  $data["ispezione"]->obiettivo,
                'Status',  $data["ispezione"]->stato,
                'Revisioned',  $data["ispezione"]->obiettivo == 1 ?"Yes" : "No",
                'Imgs');

$lorem = 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur, mollitia non porro aspernatur dignissimos suscipit ullam nulla alias, quisquam at quis esse quod? Deleniti, quia quasi minus eligendi esse tempora?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur, mollitia non porro aspernatur dignissimos suscipit ullam nulla alias, quisquam at quis esse quod? Deleniti, quia quasi minus eligendi esse tempora?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur, mollitia non porro aspernatur dignissimos suscipit ullam nulla alias, quisquam at quis esse quod? Deleniti, quia quasi minus eligendi esse tempora?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur, mollitia non porro aspernatur dignissimos suscipit ullam nulla alias, quisquam at quis esse quod? Deleniti, quia quasi minus eligendi esse tempora?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur, mollitia non porro aspernatur dignissimos suscipit ullam nulla alias, quisquam at quis esse quod? Deleniti, quia quasi minus eligendi esse tempora?Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur, mollitia non porro aspernatur dignissimos suscipit ullam nulla alias, quisquam at quis esse quod? Deleniti, quia quasi minus eligendi esse tempora?';

$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->Apertura();

$pdf->PrimaTabella($seconda);

$pdf->SetY(200); 
$pdf->FooterUnico();

$pdf->inspectionProcedure();

if($data["anomalie"]){ 

     $pdf->SetFont('Arial', 'B', 20);
     $pdf->Cell(190, 15, 'Anomalies Observed', 0, 0, 'C');
     $pdf->Ln();
     foreach($data["anomalie"] as $anomalia){
          $pAnomalia = array('Localization', $anomalia->localizzazione,
                              'Extension', $anomalia->estensione,
                              'Depth', $anomalia->profondita,
                              'Type', $anomalia->anomalia);

          $sAnomalia = array(
                              'State', $anomalia->stato,
                              'Comments', $anomalia->commenti,
                               'Imgs');
          if( isset($anomalia->riparazione) && $anomalia->riparazione != "no" && $anomalia->riparazione != ""  ){
               array_unshift($sAnomalia, "Reparation", $anomalia->riparazione);
          }
          $pdf->TabellaAnomalie($pAnomalia, $sAnomalia, $anomalia);
     }
}
$pdf->AddPage();  
$pdf->validity();
$pdf->AddPage();  
$pdf->Chiusura($data["idOperatorePrincipale"]);

$pdf->AddPage();  
$pdf->appendix();
$pdf->Output();

?>