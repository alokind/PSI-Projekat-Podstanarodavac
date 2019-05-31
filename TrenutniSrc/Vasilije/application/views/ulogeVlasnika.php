<html>
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
				</li> <!-- href u PHP kontroler -->
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('Gost/naPrijavu') ?>">Prijava</a>
				</li> <!-- href u PHP kontroler -->
				
			</ul>
			
			
		 </nav>
		 <br/> <a href="<?php echo site_url("Stanodavac/uzmiObavestenje"); ?>">
			<img src="ot.png" alt="tabla"style="width:60px;" align="left">
		</a>
                 
		<!-- DEBAGOVANJE -->
		<a href="<?php echo('Stanodavac/odjava');       ?>">
			<img src="logout.png" alt="odjava"style="width:45px;" align="right">
		</a>
                
                 <!-- Link -->
		<a href="<?php echo site_url('Stanodavac/naProfil') ?>"> <!-- Putanja u PHP kontroler -->
			<img src="profil.png" alt="profil"style="width:45px;" align="right">
		</a>
                 
		<br><br><br>
		<p>&nbsp;&nbsp;&nbsp;&nbsp; Poštovani vlasniče, dobrodošli!</p> 
		<div class="list-group">
			<a href="izdajteStan.html" class="list-group-item">Izdajte stan</a>
			<a href="generisiteUgovor.html" class="list-group-item">Generišite ugovor o zakupu stana</a>
			<a href="<?php echo site_url("Stanodavac/otvoriUnesiRacun"); ?>" class="list-group-item">Unesite račun za podstanara</a>
			<a href="potvrditeUplatu.html" class="list-group-item">Potvrdite uplatu računa</a>
			<a href="posaljiteObavestenjePodstanaru.html" class="list-group-item">Pošaljite obaveštenje/opomenu podstanaru</a>
			<a href="<?php echo site_url("Stanodavac/okaciNaOglasnuV"); ?>" class="list-group-item">Okačite obaveštenje na oglasnu tablu</a>
			
		</div>
		
		 <hr>
			<footer>
				<p><i>Copyright 2019, Strašan tim,
				Odsek za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu</i></p>
			</footer>
	</body>
</html>

