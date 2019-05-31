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
		 <h4 align="center">Unesite račun za podstanara:</h4>
		 <br/>
		 <table align='center' width='40%' bgcolor='black'>
			<tr bgcolor='ffaa80' height="50px">
				<td colspan='2'>&nbsp;</td>
			</tr>
			<tr height="350px">
				<td colspan='2' bgcolor='white' align='center' width='50%'>
                                <div class="card-body">   
                                    <h5 class="card-title text-center"> Unesite račun </h5><hr><br>
                                    <form class="form" name="unesiteRacun" action="<?php echo site_url('Stanodavac/unesiteRacun') ?>" method="post">
                                        <select class="form-control" name = "podstanar">
                                            <option value="" disabled selected>Odaberite podstanara</option>
                                            <?php
                                                if (isset($podstanariIme)) {
                                                    for($i =0; $i<count($podstanariIme); $i++){
                                                        echo '<option value="'.$podstanariValue[$i].'" >';
                                                        echo $podstanariIme[$i];
                                                        echo '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <br>
                                        <input type="text" name="svrhaUplate" class="form-control" placeholder="Svrha uplate" value="<?php echo set_value('svrhaUplate') ?>"> <br>
                                        <input type="text" name="pozivNaBroj" class="form-control" placeholder="Poziv na broj" value="<?php echo set_value('pozivNaBroj') ?>"> <br>
                                        <input type="text" name="brRacuna" class="form-control" placeholder="Broj računa za uplatu" value="<?php echo set_value('brRacuna') ?>"> <br>
                                        <input type="number" name="iznosRacuna" class="form-control" placeholder="Iznos računa u dinarima" value="<?php echo set_value('iznosRacuna') ?>"> <br>
                                        <hr>
                                        <button class="btn btn-md btn-success btn-block text-uppercase" type="submit">Potvrdi</button>
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
