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
		  <a href="oglasnaTabla.html">
			<img src="ot.png" alt="tabla"style="width:60px;" align="left">
		</a>
                 
                <!-- DEBAGOVANJE -->
		<a href="<?php echo site_url('Azurator/odjava'); ?>">
			<img src="logout.png" alt="odjava"style="width:45px;" align="right">
		</a>
		<br><br><br>
		
                <!-- Ubaceno da se podaci ucitavaju iz sesije trenutnog korisnika -->
		<div class="container" id="home" align="center">
			<h2>
                            <?php
                                $korisnik = $this->session->userdata('korisnik');
                                $puno_ime = $korisnik->Ime . " " . $korisnik->Prezime;
                                echo $puno_ime;
                            ?>
                        </h2>
			<hr>
			<img  src="profil.png" style="width:120px" >
			<br><br><br><br>
			<table>
                            <tr>
                                <td>Ime: </td>
                                <td>
                                    <?php
                                        $korisnik = $this->session->userdata('korisnik');
                                        $ime = $korisnik->Ime;
                                        echo $ime;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Prezime: </td>
                                <td>
                                    <?php
                                        $korisnik = $this->session->userdata('korisnik');
                                        $prezime = $korisnik->Prezime;
                                        echo $prezime;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>E-mail: </td>
                                <td>
                                    <?php
                                        $korisnik = $this->session->userdata('korisnik');
                                        $email = $korisnik->Mail;
                                        echo $email;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Telefon: </td>
                                <td>
                                    <?php
                                        $korisnik = $this->session->userdata('korisnik');
                                        $telefon = $korisnik->BrojTelefona;
                                        echo $telefon;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Adresa: </td>
                                <td>
                                    <?php
                                        $korisnik = $this->session->userdata('korisnik');
                                        $adresa = $korisnik->Adresa;
                                        echo $adresa;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Pol: </td>
                                <td>
                                    <?php  
                                        $korisnik = $this->session->userdata('korisnik');
                                        $pol = $korisnik->Pol;
                                        echo $pol;
                                    ?>
                                </td>
                            </tr>	
			</table>
		</div> 
		<br>
                
                <!-- Skakanje na azurator zarad azuriranja lozinke -->
		<p align="center">
                    <a href="<?php echo site_url('Azurator/naAzuriranje'); ?>">
			<img src="azuriraj.png" alt="azuriraj" style="width:100px;" align="center">
                    </a>
                </p>
                
		<br><br><br>
		 <hr>
			<footer>
				<p><i>Copyright 2019, Strašan tim,
				Odsek za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu</i></p>
			</footer>
	</body>
</html>
