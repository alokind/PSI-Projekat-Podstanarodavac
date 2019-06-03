<html>
	<!--  Bojana Krivokapić -->
	<head>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            
            <!-- Glyphicons -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css">
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
            	         
            <!-- Bootstrap core JavaScript -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

            <style>
		  .col{
			display:flex;
		  }
		  .carousel-item {
			  height: 65vh;
			  min-height: 350px;
			  background: no-repeat center center scroll;
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
		  }
            </style>
	</head>
	
	<body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
		  <a class="navbar-brand" href="naPocetnu">
			<img src="<?php echo $this->config->item('base_url'); ?>/public/images/logo.png" alt="logo" style="width:40px;">
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
                <header>
		  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
			  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner" role="listbox">
			  <!-- Slide One - Set the background image for this slide in the line below -->
			  <div class="carousel-item active" style="background-image: url('<?php echo $this->config->item('base_url'); ?>/public/images/prva.jpg')">
				<!--<div class="carousel-caption d-none d-md-block">
				  <h3 class="display-4">First Slide</h3>
				  <p class="lead">This is a description for the first slide.</p>
				</div> -->
			  </div>
			  <!-- Slide Two - Set the background image for this slide in the line below -->
			  <div class="carousel-item" style="background-image: url('<?php echo $this->config->item('base_url'); ?>/public/images/druga.jpg')">
				<!--<div class="carousel-caption d-none d-md-block">
				  <h3 class="display-4">Second Slide</h3>
				  <p class="lead">This is a description for the second slide.</p>
				</div> -->
			  </div>
			  <!-- Slide Three - Set the background image for this slide in the line below -->
			  <div class="carousel-item" style="background-image: url('<?php echo $this->config->item('base_url'); ?>/public/images/treca.jpg')">
				<!--<div class="carousel-caption d-none d-md-block">
				  <h3 class="display-4">Third Slide</h3>
				  <p class="lead">This is a description for the third slide.</p>
				</div> -->
			  </div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				  <span class="sr-only">Previous</span>
				</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				  <span class="carousel-control-next-icon" aria-hidden="true"></span>
				  <span class="sr-only">Next</span>
				</a>
		  </div>
		</header>
		<!-- Page Content -->
		<section class="py-5">
                    <div class="container">
                          <h1 class="font-weight-light">O aplikaciji</h1>
                          <p class="lead" align="justify">Ako vlasnik stana u kojem živite ne živi blizu Vas, a želite da imate koncizan pregled svake Vaše saradnje,
                          ili ako jednostavno želite da izbegnete ličnu komunikaciju sa njim ovo je pravo mesto za Vas! Bez čekanja, nepotrebnog
                          zvanja telefonom i svakako podsećanja na obaveze podstanara, ovo je vrlo korisna aplikacija i za stanodavce.
                          Zato ne gubite vreme i već danas se registrujte!</p>
                    </div>
                    <div>
                        <?php
                                $greska = $this->session->flashdata('succ_reg');
                                if (isset($greska)) {
                                    echo '<div class="alert alert-warning" align="center">';
                                    echo $greska;
                                    echo '</div>';
                                }
                         ?>
                    </div>
		</section>
                
        <br><br>
        <footer class="py-3 bg-dark fixed-bottom">
          <div class="container">
            <p class="m-0 text-center text-white">Copyright © 2019, Kakav tim - strašan tim, Odsek za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu
            <a href="http://etf.bg.ac.rs">
               <img src="public/images/etf_logo.png" height='30px' width='30px'>
            </a>
                </p>
          </div>
        </footer>
	</body>
</html>




