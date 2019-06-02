<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>
    
    <body>
        <header>
            <h1 align="center"><img src="../../public/images/logo.png" alt="Logo" style="width:200px;"></h1>
        </header>

        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a class="navbar-brand" href="../../public/images/pocetna.html">
                <img src="../../public/images/logo2.png" alt="logo" style="width:40px;">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('Podstanar/naPocetnu') ?>">Početna</a>
                </li>
                <!-- <li class="nav-item">
                        <a class="nav-link" href="prijava.html">Prijava</a>
                </li> -->
            </ul>
        </nav>
        
        <br/>
        
        <a href="<?php echo site_url('Podstanar/oglasnaTabla') ?>">
            <img src="../../public/images/ot.png" alt="tabla"style="width:60px;" align="left">
        </a>
        <a href="<?php echo site_url("Podstanar/logout"); ?>">
            <img src="../../public/images/logout.png" alt="odjava"style="width:45px;" align="right">
        </a>
        <a href="<?php echo site_url('Podstanar/naProfil') ?>">
            <img src="../../public/images/profil.png" alt="profil"style="width:45px;" align="right">
        </a>
            
        <br><br><br>
        
        <p>&nbsp;&nbsp;&nbsp;&nbsp; Poštovani stanaru, dobrodošli!</p> 
        <div class="list-group">
            <a href="<?php echo site_url('Podstanar/zakupiStanRedirect')?>" class="list-group-item">Potvrdite zakup stana</a>
            <a href="<?php echo site_url('Podstanar/sklopiUgovorRedirect')?>"  class="list-group-item">Generišite ugovor</a>
            <a href="<?php echo site_url('Podstanar/platiRacunRedirect')?>"  class="list-group-item">Platite račun</a>
            <a href="<?php echo site_url('Podstanar/prijaviKvarRedirect')?>"  class="list-group-item">Prijavite kvar vlasniku</a>
            <a href="<?php echo site_url('Podstanar/okaciObavestenjeRedirect')?>"  class="list-group-item">Okačite obaveštenje na oglasnu tablu</a>
            <a href="<?php echo site_url('Podstanar/prikaziObavestenja')?>"  class="list-group-item">Prikažite obaveštenja</a>
        </div>

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

