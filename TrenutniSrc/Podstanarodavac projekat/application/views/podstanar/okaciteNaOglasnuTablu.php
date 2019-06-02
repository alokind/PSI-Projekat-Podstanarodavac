<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	</head>
	<body>
		<header>
			<h1 align="center"><img src="../../public/images/logo.png" alt="Logo" style="width:200px;"></h1>
		</header>
		
		 <nav class="navbar navbar-expand-md bg-dark navbar-dark">
			<a class="navbar-brand" href="pocetna.html">
				<img src="../../public/images/logo2.png" alt="logo" style="width:40px;">
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
		
		  <br/> <a href="oglasnaTabla.html">
			<img src="../../public/images/ot.png" alt="tabla"style="width:60px;" align="left">
		</a>
		 <a href="pocetna.html">
			<img src="../../public/images/logout.png" alt="odjava"style="width:45px;" align="right">
		</a>
		<a href="profil.html">
			<img src="../../public/images/profil.png" alt="profil"style="width:45px;" align="right">
		</a>
		<br><br><br>
		 <table align='center' width='40%' bgcolor='black'>
			<tr bgcolor='ffaa80' height="50px">
				<td colspan='2'>&nbsp;</td>
			</tr>
			<tr height="350px">
                            <td colspan='2' bgcolor='white' align='center' width='50%'>
                                <div class="card-body">  
                                        <?php
                                           if (isset($poruka)) {
                                               echo "<br>";
                                               echo '<div class="alert alert-' . $tipPoruke . '" role="alert">';
                                               if ($poruka == "validation")
                                                   echo validation_errors();
                                               else 
                                                   echo $poruka;
                                               echo '</div>';
                                               echo "<br>";
                                           }
                                       ?>
                                    <h5 class="card-title text-center"> Okačite na oglasnu tablu </h5><hr><br>
                                    <form class="form" name="obavestenje" action="<?php echo site_url('Podstanar/okaciteNaOglasnuTablu') ?>" method="post">

                                        <input type="text" name="naslov" class="form-control" placeholder="Naslov" value="<?php echo set_value('naslov') ?>"> <br>
                                        <input type="text" name="tekst" class="form-control" placeholder="Tekst" value="<?php echo set_value('tekst') ?>"> <br>
                                        <br>
                                        <input class="btn btn-md btn-success btn-block text-uppercase" type="submit"  name="tip" value="OKAČI">

                                    </form>
                                </div>
                            </td>				
			</tr>
			
			<tr bgcolor='#ffaa80' height="50px">
				<td colspan='2'>&nbsp;</td>
			</tr>
		</table>
		 <hr>
			<footer>
				<p><i>Copyright 2019, Strašan tim,
				Odsek za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu</i></p>
			</footer>
	</body>
</html>
