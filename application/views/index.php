<html>
	<!--Bojana Krivokapić-->
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	</head>
	<body>
		<header>
			<h1 align="center"><img src="logo.png" alt="Logo" style="width:200px;"></h1>
		</header>
		
		 <nav class="navbar navbar-expand-md bg-dark navbar-dark">
			<a class="navbar-brand" href="pocetna.html">
				<img src="logo2.png" alt="logo" style="width:40px;">
			</a>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('Gost/naPocetnu') ?>">Početna</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('Gost/naPrijavu') ?>">Prijava</a>
				</li>
				
			</ul>
		 </nav>
		 <div class="container" id="home">
			<div class="row">
				<div class="col-sm-12">
					<div class="media">
						<img src="bbcc.png">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
                                    <!-- DODAT P DOLE ZA PORUKU KADA SE USPESNO REGISTRUJE -->
                                    <p align="center" style="color:green"><?php $uspeh = $this->session->flashdata('succ_reg'); if ($uspeh) echo $uspeh;?></p>
                                    
					<ul class="nav nav-tabs">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#why">Zašto mi?</a>
						</li>
						
					</ul>
					
					
					<div class="tab-content">
						<div class="tab-pane active container" id="why">
							<div class="media">
								<div class="media-left">
									<img class="mr-3" src="upitnik.jpeg" style="width:200px; margin-top:10px;">
								</div>
								<div class="media-body" style="text-align:justify;">
									<h4 class="mt-0">
									Ako vlasnik stana u kojem živite ne živi blizu Vas, a želite da imate koncizan pregled svake Vaše saradnje,
									ili ako jednostavno želite da izbegnete ličnu komunikaciju sa njim ovo je pravo mesto za Vas! Bez čekanja, nepotrebnog
									zvanja telefonom i svakako podsećanja na obaveze podstanara, ovo je vrlo korisna aplikacija i za stanodavce.
									Zato ne gubite vreme i već danas se registrujte!
									</h4>
								</div>
							</div>
						</div>
				</div>
			</div></div></div>
		 <hr>
			<footer>
				<p><i>Copyright 2019, Strašan tim,
				Odsek za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu</i></p>
			</footer>
	</body>
</html>




