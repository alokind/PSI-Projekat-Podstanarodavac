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
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url('Gost/naPrijavu') ?>">Prijava</a>
				</li>
			
			</ul>
			
			
		 </nav>
		 <br/>
		<a href="<?php echo site_url("Podstanar/uzmiObavestenje"); ?>">
			<img src="ot.png" alt="tabla"style="width:60px;" align="left">
		</a>
                 
		<!-- DEBAGOVANJE -->
		<a href="<?php echo('Podstanar/odjava');       ?>">
			<img src="logout.png" alt="odjava"style="width:45px;" align="right">
		</a>
                 
                <!-- Link -->
		<a href="<?php echo site_url('Podstanar/naProfil') ?>"> <!-- Putanja u PHP kontroler -->
			<img src="profil.png" alt="profil"style="width:45px;" align="right">
		</a>
                
		<br><br><br>
		<p>&nbsp;&nbsp;&nbsp;&nbsp; Poštovani stanaru, dobrodošli!</p> 
		<div class="list-group">
			<a href="zakupStana.html" class="list-group-item">Zakup stana</a>
			<a href="sklopiUgovor.html" class="list-group-item">Sklapanje ugovora</a>
			<a href="platiRacun.html" class="list-group-item">Plaćanje računa</a>
			<a href="prijaviKvar.html" class="list-group-item">Prijava kvara vlasniku</a>
			<a href="<?php echo site_url("Podstanar/okaciNaOglasnuP"); ?>" class="list-group-item">Okačite obaveštenje na oglasnu tablu</a>
			
		</div>
		
		 <hr>
			<footer>
				<p><i>Copyright 2019, Strašan tim,
				Odsek za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu</i></p>
			</footer>
	</body>
</html>
