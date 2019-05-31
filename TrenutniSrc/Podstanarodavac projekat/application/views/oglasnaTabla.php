<html>
	<!--Bojana Krivokapić -->
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<style>
		#wrapper{
						margin:auto;
						width:70%;
						}

#header{
	background-color: #ff6600;
	height:70px;
	text-align:center;
	padding:5px;
	color: white;
}

#image{
	background-image: url("../../public/images/ogl1.png");
	height:300px;
	background-position:center;
	background-repeat:no-repeat;
	background-size: 100%;
	margin-top:5px;
}

#delimiter{
	background-color: #ff6600;
	height:20px;
	margin-top:5px;
}




</style>
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
				
			</ul>
		 </nav>
		 
		  <br/>
		 <a href="<?php echo site_url("Azurator/logout"); ?>">
			<img src="../../public/images/logout.png" alt="odjava"style="width:45px;" align="right">
		</a>
		<a href="profil.html">
			<img src="../../public/images/profil.png" alt="profil"style="width:45px;" align="right">
		</a>
		<br><br><br>
		
		
		<div id='wrapper'>
			<div id='header'><h1>Oglasna tabla</h1></div>
			<div id='image'></div>
			<div id='delimiter'></div>
			<table>
			
                                       <?php 
                                        foreach ($result as $key):
                                               ?>
                            <tr ><td><?php echo $key->Naslov;?></td>
                            <td><?php echo $key->Tekst;?></td></tr>
                                     <?php endforeach;?>
			</table>
			</div>
			
		 <hr>
			<footer>
				<p><i>Copyright 2019, Strašan tim,
				Odsek za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu</i></p>
			</footer>
	</body>
</html>
