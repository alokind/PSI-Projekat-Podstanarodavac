<?php

tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$obj_pdf->SetCreator(PDF_CREATOR);
$title = "UGOVOR O ZAKUPU";
$obj_pdf->SetTitle($title);
//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
//$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 12);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start(); ?>
    <html>
        <head>
            <title>Ugovor o zakupu</title>
        </head>
        <body>
            <h1 align='center'>UGOVOR O ZAKUPU STANA </h1>
            <p>
                Zaključen datuma: <?php echo date("Y-m-d");?> između: <br>
                1. <?php echo $imeV;?> , ulica: <?php echo $ulicaV;?> <br>
                (u daljem tekstu: <b>Vlasnik</b> <br>
                2. <?php echo $imeP;?> , ulica: <?php echo $ulicaP;?> <br>
                (u daljem tekstu: <b>Podstanar</b> <br>
            </p>
            <br>
            <h3> Član 1</h3>
            <br>
            <p>
                Vlasnik izdaje Podstanaru u zakup stan, povšine <?php echo $kvadratura;?> m2, <br>
                u ulici <?php echo $adresa;?>,počevši od <?php echo $datum;?>, <br>
                u trajanju od <?php echo $trajanje;?>.
            </p>    
            <br>
            <h3> Član 2</h3>
            <p>
                Vlasnik se obavezuje da Podstanaru dana <?php echo $datum;?> preda stan u stanju <br>
                podobnom za stanovanje. <br><br>
                Podstanar se obavezuje da Vlasniku, odmah po ulasku u stan, odjednom isplati<br>
                <?php echo $kirija;?> evra za kiriju, da stan koristi kao dobar <br>
                domaćin, snosi sve troškove potrebne za njegovo redovno održavanje i da<br>
                Vlasnika obaveštava o važnim okolnostima vezanim za stan.<br>
            </p>   
            <h3> Član 3</h3>
            <p>
                Ovaj ugovor sačinjen je u 2 istovetna primerka, po 2 za svaku ugovornu <br>
                stranu.
            </p>
            <br>
            <p>
                VLASNIK:  <?php echo $imeV;?> 
                PODSTANAR: <?php echo $imeP;?>
            </p>
        </body>
    </html>
   
            <?php
    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('UgovorOZakupu.pdf', 'D');
