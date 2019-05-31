<?php

tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$title = "Ugovor o zakupu stana";
$obj_pdf->SetTitle($title);
//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
//$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('freeserif', '', 10);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();


 $html =
                '
		<h2 align="center">UGOVOR O ZAKUPU STANA</h2>
			<p><br><br></p>
			
			<h3 align="center">Član 1</h3>
		<p align="justify">
			Zaključen dana '.date("d.m.Y.").' godine između:<br><br>
			1. '.$imeV.' '.$prezimeV.' sa adresom '.$ulicaV.'<br>
			(dalje: Zakupodavac), i<br><br>
			2. '.$imeP.' '.$prezimeP.' sa adresom '.$ulicaP.'<br>
			(dalje: Zakupac).<br><br>
			Ugovorne strane su se sporazumele o sledećem:
		</p>
			<h3 align="center">Član 2</h3>
		<p align="justify">
			Zakupodavac se obavezuje da Zakupcu dana '.date('d.m.Y.', strtotime($datum)).' godine preda stan u stanju
			podobnom za stanovanje.<br><br>
			Zakupac se obavezuje da Zakupodavcu, odmah po ulasku u stan, odjednom isplati
			zakupninu u ukupnom iznosu od '.$kirija.' dinara, da stan koristi kao
			dobar domaćin, snosi sve troškove potrebne za redovno održavanje stana i da Zakupodavca
			obaveštava o važnim okolnostima vezanim za stan.<br><br>
			Zakupac je obavezan da snosi sve troškove koji nastanu upotrebom stana (telefon, struja, voda,
			smeće itd).<br><br>
			Porez i vanredne troškove održavanja stana snosi Zakupodavac, a redovne Zakupac.
		</p>
			<h3 align="center">Član 3</h3>
		<p align="justify">
			Zakupac ne može bez pristanka Zakupodavca menjati namenu prostorija ili izvoditi radove
			kojima bi se promenila dispozicija odnosno veličina prostorija niti deo prostorija ili ceo stan
			izdati u podzakup. Ako bi Zakupac takve radove preduzeo ili prostorije drugom izdao,
			Zakupodavac je ovlašćen da za ubuduće jednostrano raskine ugovor.
		</p>
			<h3 align="center">Član 4</h3>
		<p align="justify">
			Ovaj ugovor prestaje istekom vremena na koji je zaključen, o čemu će Zakupodavac, jedan
			mesec pre isteka roka, obavestiti Zakupca. On se može produžiti samo na osnovu posebnog
			ugovora ugovornih strana.
		</p>
			<h3 align="center">Član 5</h3>
		<p align="justify">
			Ovaj ugovor sačinjen je u dva istovetna primerka, po jedan za svaku ugovornu
			stranu.
		</p>
                <p><br><br></p>
                <p><br><br></p>
                <p><br><br></p>
		<div align="justify">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    ZAKUPODAVAC 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;
                    ZAKUPAC
                </div>
                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_________________________ 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    _________________________
                </div>
		<br>
		<br>';
$obj_pdf->writeHTML($html, true, false, true, false, '');
$obj_pdf->Output('UgovorOZakupu.pdf', 'I');

