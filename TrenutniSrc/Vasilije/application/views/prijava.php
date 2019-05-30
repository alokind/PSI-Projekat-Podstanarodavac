<html>
	<!--  Bojana Krivokapić -->
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
		 
		 <br><br><br><br><br><br>
		 <form name="login_forma" method=post action="<?php echo site_url('Gost/ulogujSe')?>" >
			<table bgcolor="#ff944d" align="center">
				<tr>
					<td>E-mail:</td>
					<td><input type=text name=email></td>
				</tr>
				<tr>
					<td>Lozinka:</td>
					<td><input type=password name=passwd></td>
				</tr>
				<tr>
					<td></td>
					<td><p><a href="resetSifre.html">Zaboravili ste šifru?</a></p></td>
				</tr>
				
				<tr>
					<td colspan=2 align=center>
                                            <input type="submit" class="btn btn-success" value="Prijavi se">
					</td>
				</tr>
			</table>
		</form>
		<p align="center"><a href="<?php echo site_url('Gost/naRegistraciju') ?>">Niste registrovani?</a></p>
                
                <!-- DODATO DOLE ZA PORUKU O NEUSPESNOM PRIJAVLJIVANJU -->
		<br/>
                <p align="center" style="color:red"><?php $greska = $this->session->flashdata('error_login_msg'); if ($greska) echo $greska; ?></p>
		
		 <hr>
			<footer>
				<p><i>Copyright 2019,Strašan tim,
				Odsek za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu</i></p>
				
				<p><b>U originalnoj verziji će postojati samo jedno prijavi koje će na osnovu baze podataka prepoznati da li je vlasnik ili stanar u pitanju.
				Kako je ovo prototip, ova funkcionalnost koja treba da se odradi u narednoj fazi nedostaje, a radi preglednosti i potpune kompaktnosti samog 
				prototipa ovde je prikazano sa dve opcije.</b></p>
			</footer>
	</body>
</html>
