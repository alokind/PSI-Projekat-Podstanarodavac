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
        
        <a href="<?php echo site_url('Podstanar/naOglasnu') ?>">
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
            <a href="<?php echo site_url('Podstanar/zakupiStanRedirect')?>" class="list-group-item">Zakup stana</a>
            <a href="<?php echo site_url('Podstanar/sklopiUgovorRedirect')?>"  class="list-group-item">Sklapanje ugovora</a>
            <a href="<?php echo site_url('Podstanar/platiRacunRedirect')?>"  class="list-group-item">Plaćanje računa</a>
            <a href="<?php echo site_url('Podstanar/prijaviKvarRedirect')?>"  class="list-group-item">Prijava kvara vlasniku</a>
            <a href="<?php echo site_url('Podstanar/okaciObavestenjeRedirect')?>"  class="list-group-item">Okačite obaveštenje na oglasnu tablu</a>
        </div>

        <hr>
        
        <footer>
            <p><i>Copyright 2019, Strašan tim,
            Odsek za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu</i></p>
        </footer>
    </body>
</html>

