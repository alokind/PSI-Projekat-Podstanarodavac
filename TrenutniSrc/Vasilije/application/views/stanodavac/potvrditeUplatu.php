<html>
	<head>
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
		 <h4 align="center">Potvrdite uplatu računa:</h4>
		 <br/>
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
                                        echo $poruka;
                                        echo '</div>';
                                        echo "<br>";
                                    }
                                    ?>
                                    <h5 class="card-title text-center"> Potvrdite uplatu računa </h5><hr><br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <form class="form" name="generisiteUgovor" action="<?php echo site_url('Stanodavac/potvrditeUplatu') ?>" method="post">
                                                    <h5>Plaćeni računi</h5>
                                                    <select class="form-control" id ="racuni" name = "racuni[]" multiple>
                                                        <?php
                                                            if (isset($racuni)) {
                                                                echo $racuni;
                                                            }
                                                        ?>
                                                    </select>
                                                    <br>
                                                    <button class="btn btn-md btn-success btn-block text-uppercase" type="submit">Potvrdite plaćanje računa</button>
                                                </form>
                                            </div>
                                            <div class="col-sm-6">
                                                <h5>Neplaćeni računi</h5>
                                                <br>
                                                        <?php
                                                            if (isset($neplaceniRacuni)) {
                                                                echo $neplaceniRacuni;
                                                            }
                                                        ?>
                                            </div>
                                        </div>
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
