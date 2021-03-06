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
		  <a class="navbar-brand" href="<?php echo site_url('Podstanar/naProfil') ?>">
			<img src="../../public/images/logo.png" alt="logo" style="width:40px;">
		  </a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
			  <li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('Podstanar/naProfil') ?>">
					  <span class="fa fa-user" aria-hidden="true"></span>
					Moj profil
				</a>
			  </li>
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Meni</a>
				<div class="dropdown-menu">
				<a class="dropdown-item" href="<?php echo site_url('Podstanar/zakupiStanRedirect') ?>">Potvrdite zakup stana</a>
                                <a class="dropdown-item" href="<?php echo site_url('Podstanar/sklopiUgovorRedirect') ?>">Generišite ugovor o zakupu stana</a>
				<a class="dropdown-item" href="<?php echo site_url('Podstanar/platiRacunRedirect') ?>">Platite račun</a>
				<a class="dropdown-item" href="<?php echo site_url('Podstanar/prijaviKvarRedirect') ?>">Prijavite kvar vlasniku</a>
				<a class="dropdown-item" href="<?php echo site_url('Podstanar/okaciObavestenjeRedirect') ?>">Okačite obaveštenje na oglasnu tablu</a>
				<a class="dropdown-item" href="<?php echo site_url('Podstanar/prikaziObavestenja') ?>">Prikažite obaveštenja</a>
			  </li>
                          <li class="nav-item">
                                  <a class="nav-link" href="<?php echo site_url("Podstanar/oglasnaTabla") ?>">
                                          <span class="octicon octicon-comment-discussion" aria-hidden="true"></span>
                                          Oglasna tabla
                                  </a>
                          </li>
			  <li class="nav-item">
				<a class="nav-link" href="<?php echo site_url("Podstanar/logout") ?>">
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
        
		 <table align='center' width='40%' bgcolor='black'>
			<tr class='bg-dark'  height="50px">
				<td colspan='2'>&nbsp;</td>
			</tr>
			<tr height="350px">
                            <td colspan='2' bgcolor='white' align='center' width='50%'>
                                <div class="card-body">   
                                    <?php
                                    if (isset($poruka)) {
                                        echo "<br>";
                                        echo '<div class="alert alert-' . $tipPoruke . '" role="alert">';
                                        echo $poruka;
                                        echo '</div>';
                                        echo "<br>";
                                    }
                                    ?>
                                    <h5 class="card-title text-center"> Plati račun: </h5><hr><br>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <form class="form" action="<?php echo site_url('Podstanar/potvrditeUplatu') ?>" method="post">
                  
                                                    <select class="form-control" id ="racuni" name = "racuni[]" multiple>
                                                        <?php
                                                            if (isset($neplaceniRacuni)) {
                                                                echo $neplaceniRacuni;
                                                            }
                                                        ?>
                                                    </select>
                                                    <br>
                                                    <button class="btn btn-md btn-success btn-block text-uppercase" type="submit">Potvrdite plaćanje računa</button>
                                                </form>
                                            </div>
        
                                        </div>
                                </div>
                                
                            </td>
			</tr>
			<tr class='bg-dark'  height="50px">
				<td colspan='2'>&nbsp;</td>
			</tr>
		</table>
        
        <hr>
        
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
