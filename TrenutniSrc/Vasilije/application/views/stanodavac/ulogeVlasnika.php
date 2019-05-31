<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	</head>
	<body>
		<header>
			<h1 align="center"><img src="../public/images/logo.png" alt="Logo" style="width:200px;"></h1>
		</header>
		
		 <nav class="navbar navbar-expand-md bg-dark navbar-dark">
			<a class="navbar-brand" href="pocetna.html">
				<img src="../public/images/logo2.png" alt="logo" style="width:40px;">
			</a>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="pocetna.html">Početna</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="prijava.html">Prijava</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="ulogeVlasnika.html">Meni</a>
				</li>
		
			</ul>
		 </nav>
		
		<br/>
                
                <a href="oglasnaTabla.html">
			<img src="../public/images/ot.png" alt="tabla"style="width:60px;" align="left">
		</a>
		 <a href="pocetna.html">
			<img src="../public/images/logout.png" alt="odjava"style="width:45px; height:45px;" align="right">
		</a>
		<a href="profil.html">
			<img src="../public/images/profil.png" alt="profil"style="width:45px; height:45px;" align="right">
		</a>
                <div style="float: right">
                    Autor: <?php echo $korisnik->Ime . " " . $korisnik->Prezime . " "; ?>
                </div>
		<br><br><br>
		<p>&nbsp;&nbsp;&nbsp;&nbsp; Poštovani vlasniče, dobrodošli!</p> 
		<div class="list-group">
			<a href="<?php echo site_url('Stanodavac/izdajteStanPg') ?>" class="list-group-item">Izdajte stan</a>
			<a href="<?php echo site_url('Stanodavac/generisiteUgovorPg') ?>" class="list-group-item">Generišite ugovor o zakupu stana</a>
			<a href="<?php echo site_url('Stanodavac/unesiteRacunPg') ?>" class="list-group-item">Unesite račun za podstanara</a>
			<a href="<?php echo site_url('Stanodavac/potvrditeUplatuPg') ?>" class="list-group-item">Potvrdite uplatu računa</a>
			<a href="<?php echo site_url('Stanodavac/posaljiteObavestenjePodstanaruPg') ?>" class="list-group-item">Pošaljite obaveštenje/opomenu podstanaru</a>
			<a href="<?php echo site_url('Stanodavac/okaciteNaOglasnuTabluPg') ?>" class="list-group-item">Okačite obaveštenje na oglasnu tablu</a>
			
		</div>
		
		 <hr>
			<footer>
				<p><i>Copyright 2019, Strašan tim,
				Odsek za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu</i></p>
			</footer>
	</body>
</html>
