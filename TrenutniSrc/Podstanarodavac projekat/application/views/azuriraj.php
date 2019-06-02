<html>
<!-- Bojana Krivokapić-->
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
                 
		<!-- DEBAGOVANJE -->
		<a href="<?php echo('Azurator/odjava');       ?>">
			<img src="logout.png" alt="odjava"style="width:45px;" align="right">
		</a>
		<br><br><br>
                
                <!-- Kozmetika i nova forma -->
                <form name="azuriranje_forma" method=post action="<?php echo site_url('Azurator/azuriraj')?>">
                    <table align="center">
                        <tr>
                            <td>
                                <p align="center">Nova lozinka:</p>
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <p align="center">
                                    <input type="password" name="lozinka">
                                </p>
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td>
                                <p align="center">
                                    <a href="profil.html">
                                        <input type="submit" name="azuriranje" value="Ažuriraj">
                                    </a>
                                </p>
                            </td>
                        </tr>
                    </table>
                </form>
		
		 <hr>
			<footer>
				<p><i>Copyright 2019,Strašan tim,
				Odsek za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu</i></p>
			</footer>
	</body>
</html>
