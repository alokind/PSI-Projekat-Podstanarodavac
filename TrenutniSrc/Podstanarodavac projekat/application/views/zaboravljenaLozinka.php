<html>
	<!--  Vasilije Becić -->
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
		  <a class="navbar-brand" href="naPocetnu">
			<img src="../../public/images/logo.png" alt="logo" style="width:40px;">
		  </a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
			  <li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('Gost/naPocetnu') ?>">
                                    <span class="octicon octicon-home" aria-hidden="true"></span>
					Početna
				</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('Gost/naPrijavu') ?>">
					<span class="octicon octicon-sign-in" aria-hidden="true"></span>
					Prijava
				</a>
			  </li>
			</ul>
		  </div>
		</div>
	</nav>
            <br><br><br><br>
            <div class="container">
                  <div class="row">
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                          <div class="card card-signin my-5">
                            <div class="card-body" align="left">
                                    <h5 class="card-title text-center">Unesite podatke za dobijanje nove lozinke: </h5><hr><br>
                                    <form name="login_forma" method=post action="<?php echo site_url('Gost/proslediLozinku')?>" >
                                               <table bgcolor="#ff944d" align="center">
                                                       <input type="text" name="email" class="form-control" placeholder="E mail" required> <br>
                                                       <input class="btn btn-lg btn-success btn-block text-uppercase"  type="submit" name="zahtevajLozinku" value="Pošalji lozinku na mail">
                                               </table>
                                    </form>
                                    <div>
                                        <?php
                                                $greska = $this->session->flashdata('error_no_email');
                                                if (isset($greska)) {
                                                    echo '<div class="alert alert-warning" align="center">';
                                                    echo $greska;
                                                    echo '</div>';
                                                }
                                        ?>
                                    </div>
                            </div>
                          </div>
                    </div>
                  </div>
            </div> 
		 
        <br><br><br><br>
		
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
