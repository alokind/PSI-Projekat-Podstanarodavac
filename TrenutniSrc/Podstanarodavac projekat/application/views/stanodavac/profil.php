<html>
	<head>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            
            <!-- Glyphicons -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css">
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
            	         
            <!-- Bootstrap core JavaScript -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	</head>
	<body>
		
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
		  <a class="navbar-brand" href="<?php echo site_url('Stanodavac/naProfil') ?>">
			<img src="../../public/images/logo.png" alt="logo" style="width:40px;">
		  </a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
			  <li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('Stanodavac/naProfil') ?>">
					  <span class="fa fa-user" aria-hidden="true"></span>
					Moj profil
				</a>
			  </li>
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Meni</a>
				<div class="dropdown-menu">
				<a class="dropdown-item" href="<?php echo site_url('Stanodavac/izdajteStanPg') ?>">Izdajte stan</a>
				<a class="dropdown-item" href="<?php echo site_url('Stanodavac/generisiteUgovorPg') ?>">Generišite ugovor o zakupu stana</a>
				<a class="dropdown-item" href="<?php echo site_url('Stanodavac/unesiteRacunPg') ?>">Unesite račun za podstanara</a>
				<a class="dropdown-item" href="<?php echo site_url('Stanodavac/potvrditeUplatuPg') ?>">Potvrdite uplatu računa</a>
				<a class="dropdown-item" href="<?php echo site_url('Stanodavac/posaljiteObavestenjePodstanaruPg') ?>">Pošaljite obaveštenje ili opomenu podstanaru</a>
				<a class="dropdown-item" href="<?php echo site_url('Stanodavac/okaciteNaOglasnuTabluPg') ?>"> Okačite obaveštenje na oglasnu tablu</a>
				<a class="dropdown-item" href="<?php echo site_url('Stanodavac/prikaziKvarove') ?>">Prikažite prijavljene kvarove</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('Stanodavac/oglasnaTabla') ?>">
					<span class="octicon octicon-comment-discussion" aria-hidden="true"></span>
					Oglasna tabla
				</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('Stanodavac/logout') ?>">
					<span class="octicon octicon-sign-out" aria-hidden="true"></span>
					Izloguj se
				</a>
			  </li>
			</ul>
		  </div>
		</div>
	</nav> 
            <br>
            <br>
            <br>
            <br>

            <div class ='container'>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="card text-white bg-dark my-3 mx-5">
                            <div class="card-body">
                                <h3 class="card-title">
                                    <?php
                                        $korisnik = $this->session->userdata('korisnik');
                                        $ime = $korisnik->Ime;
                                        $prezime = $korisnik->Prezime;
                                        echo $ime;
                                        echo ' ';
                                        echo $prezime;
                                    ?>
                                </h3><hr>
                                <div class="card-text">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 my-auto mx-auto" align="center" style=" display: table;">
                                            <img src="../../public/images/profil.png" alt="logo" style="width:80%;" >   
                                            <br><br>
                                        </div>
                                        <div class="col-lg-8 col-md-12">
                                            <p><strong>Mejl: </strong> 
                                                <?php
                                                    $korisnik = $this->session->userdata('korisnik');
                                                    $email = $korisnik->Mail;
                                                    echo $email;
                                                ?>
                                            </p><hr>
                                            <p><strong>Telefon: </strong> 
                                                <?php
                                                    $korisnik = $this->session->userdata('korisnik');
                                                    $telefon = $korisnik->BrojTelefona;
                                                    echo $telefon;
                                                ?>
                                            </p><hr>
                                            <p><strong>Adresa: </strong>
                                                <?php
                                                    $korisnik = $this->session->userdata('korisnik');
                                                    $adresa = $korisnik->Adresa;
                                                    echo $adresa;
                                                ?>
                                            </p><hr>
                                            <p><strong>Pol: </strong>
                                                <?php
                                                    $korisnik = $this->session->userdata('korisnik');
                                                    $pol = $korisnik->Pol;
                                                    if ($pol = "M"){
                                                        echo "Muški";
                                                    }
                                                    else echo "Ženski"
                                                ?>
                                            </p><hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>
                <br><hr><br>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <h3 align="center"> Promenite lozinku </h3>
                        <!-- Ažuriranje lozinke -->
                        <p align="center">
                        <form action="<?php echo site_url('Azurator/azuriraj') ?>" method="post">

                             <input type="password" name="lozinka" class="form-control" placeholder="Nova lozinka" pattern=".{5,}" required title="Unesite najmanje 5 karaktera"> <br>
                             <input class="btn btn-md btn-success btn-block text-uppercase" type="submit"  name="azuriranje" value="AŽURIRAJ">
                        </form>
                        <div>
                            <?php
                                $greska = $this->session->flashdata('succ_change');
                                if (isset($greska)) {
                                    echo '<div class="alert alert-warning" align="center">';
                                    echo $greska;
                                    echo '</div>';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>
                <br><br><br><br>
            </div>
 
                
        <footer class="py-3 bg-dark fixed-bottom">
          <div class="container">
            <p class="m-0 text-center text-white">Copyright © 2019, Kakav tim - strašan tim, Odsek za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu
            <a href="http://etf.bg.ac.rs">
               <img src="../../public/images/etf_logo.png" height='30px' width='30px'>
            </a>
                </p>
          </div>
        </footer>
  
	</body>
</html>
