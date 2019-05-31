<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	</head>

	<body data-toggle="modal" data-target="#poruka" >
		<header>
			<h1 align="center"><img src="../../public/images/logo.png" alt="Logo" style="width:200px;"></h1>
		</header>

            
                <?php if(isset($poruka)){
                echo '<div class="modal fade" id="poruka" role="dialog">';
                    echo '<div class="modal-dialog">';
                        echo '<div class="alert alert-'.$tipPoruke.' alert-dismissible">';
                            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                                echo '<span aria-hidden="false">&times;</span>';
                            echo '</button>';
                            echo $poruka;
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                }
                ?>
            

            
            

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
		 <br/>
		   <a href="oglasnaTabla.html">
			<img src="../../public/images/ot.png" alt="tabla"style="width:60px;" align="left">
		</a>
		 <a href="pocetna.html">
			<img src="../../public/images/logout.png" alt="odjava"style="width:45px;" align="right">
		</a>
		<a href="profil.html">
			<img src="../../public/images/profil.png" alt="profil"style="width:45px;" align="right">
		</a>
		<br><br><br>
		 <h4 align="center">Izdajte stan podstanaru:</h4>
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
                                                        if ($poruka == "validation")
                                                            echo validation_errors();
                                                        else 
                                                            echo $poruka;
                                                        echo '</div>';
                                                        echo "<br>";
                                                    }
                                                    ?>
                                                <h5 class="card-title text-center">Unesite detalje zakupa: </h5><hr><br>
                                                <form class="form" name="izdajteStan" action="<?php echo site_url('Stanodavac/izdajteStan') ?>" method="post">
                                                    <input type="text" name="adresaStana" class="form-control" placeholder="Adresa stana" value="<?php echo set_value('adresaStana') ?>"> <br>
                                                    <input type="number" name="kirija" class="form-control" placeholder="Mesečna kirija u dinarima" value="<?php echo set_value('kirija') ?>"> <br>
                                                    <input type="number" name="duzinaZakupa" class="form-control" placeholder="Dužina trajanja zakupa u mesecima" value="<?php echo set_value('duzinaZakupa') ?>"> <br>
                                                    <input name="datumPocetkaZakupa" placeholder = "Datum početka zakupa" class = "form-control" type = "text" onfocus = "(this.type = 'date')"  onblur="(this.type='text')"> <br>
                                                    <input type="number" name="kvadratura" class="form-control" placeholder="Kvadratura u m&sup2;" value="<?php echo set_value('kvadratura') ?>"> <br>
                                                    <input type="mail" name="mejl" class="form-control" placeholder="Mejl podstanara kome želite da izdate stan" value="<?php echo set_value('mejl') ?>"> <br>
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
