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
		 <br>
		 <br>
		 <h3 align=center>REGISTRACIJA</h3>
		 <table width="70%" align="center">
			
			<tr>
				<td height="400px" width="20%">
					<img src="sl1.png" width="100%" height="120%">
				</td>
				<td bgcolor="#ffaa80" height="400px" align="center">
					
					<form name="registracija_forma" method=post action="<?php echo site_url('Gost/registrujSe')?>">
						<table cellpadding="10px">
							<tr>
								<td>
									<b>Ime:</b>
								</td>
								<td>
									<input type="text" name="name">
								</td>
							</tr>
							<tr>
								<td>
									<b>Prezime:</b>
								</td>
								<td>
									<input type="text" name="lastname">
								</td>
							</tr>							
							<tr>
								<td>
									<b>E-mail:</b>
								</td>
								<td>
									<input type="text" name="mail">
								</td>
							</tr>
							<tr>
								<td>
									<b>Lozinka:</b>
								</td>
								<td>
									<input type="password" name="password">
								</td>
							</tr>
							<tr>
								<td>
									<b>JMBG:</b>
								</td>
								<td>
									<input type="text" maxlength="13" name="jmbg">
								</td>
							</tr>
							<tr>
								<td>
									<b>Broj telefona:</b>
								</td>
								<td>
									<input type="text" id="phone" name="phone">
								</td>
							</tr>
							<tr>
								<td>
									<b>Adresa:</b>
								</td>
								<td>
									<input type="text" id="adress" name="adress">
								</td>
							</tr>
							<tr>
								<td>
									<b>Pol:</b>
								</td>
								<td>
									<b>Ženski</b>:<input type="radio" value="zenski" name="pol">
									<b>Muški</b>:<input type="radio" value="muski" name="pol">
								</td>
							</tr>
							<tr>
								<td>
									<b>Uloga:</b>
								</td>
								<td>
									<select name="role">
										<option>Vlasnik</option>
										<option>Stanar</option>
									</select>
								</td>
							</tr>
							<tr><td>
							<input type="checkbox" name="terms" required>Slažem se sa uslovima korišćenja
							</td>
							</tr>
							<tr>								
								<td colspan="2" align="center">
									<input type="submit" name="registruj" value="Potvrdi">
                                                                        
                                                                        <!-- DODATO DOLE KADA JE NEUSPESNA REGISTRACIJA -->
                                                                        <!-- kasnije ce se doradjivati po potrebi (pored konkretnog polja da pise greska) -->
                                                                        <br/>
                                                                        <p style="color:red"><?php $greska = $this->session->flashdata('error_reg_msg'); if ($greska) echo $greska; ?></p>
								</td>
							</tr>
							
						</table>
					</form>
				</td>
				<td height="400px" width="20%">
					<img src="sl2.png" width="100%" height="120%">
				</td>
			</tr>
			<tr bgcolor="#ff7733">
				<td colspan="3" height="50px" align="center">
					<b><i>&nbsp;</i></b>
				</td>
			</tr>
		</table>
		 
		 
		 <hr>
			<footer>
				<p><i>Copyright 2019, Strašan tim,
				Odsek za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu</i></p>
			</footer>
	</body>
</html>
