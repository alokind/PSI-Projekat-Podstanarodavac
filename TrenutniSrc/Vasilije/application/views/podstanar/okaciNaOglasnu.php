<html>
    <!-- Bojana Krivokapić-->
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>
    
    <body>
        <header>
            <h1 align="center"><img src="../../public/images/logo.png" alt="Logo" style="width:200px;"></h1>
        </header>
        
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a class="navbar-brand" href="#">
                <img src="../../public/images/logo2.png" alt="logo" style="width:40px;">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('Podstanar/naUloge') ?>">Meni</a>
                </li>
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
        
        <br><br><br><br>
        
        <table align='center' width='40%' bgcolor='black'>
            <tr bgcolor='ffaa80' height="50px">
                <td colspan='2'>&nbsp;</td>
            </tr>
            <tr height="350px">
                <td colspan='2' bgcolor='white' align='center' width='50%'>
                    <br/>
                    <h3>Okačite obaveštenje na oglasnu tablu:</h3></h3>
                    <br/>
                   <form id='okaciNaOglasnuTablu'  action="<?php 
                                        echo site_url('Podstanar/okaciNaOglasnuP')?>" method="POST">
                        <table>
                            <tr>
                                <td>Naziv obaveštenja:</td>
                                <td><input type='text' name='naslovObav'></td>
                            </tr>
                            <tr>
                                <td>Opis obaveštenja:</td>
                                <td colspan='2'>
                                    <br/>
                                    <textarea rows="4" cols="50" name="obavestenje"></textarea>
                                </td>
                            </tr>
                            <tr align='center'>		
                                <td colspan='2'>
                                    <br/>
                                    <button type="button" class="btn btn-success">Potvrdi kačenje obaveštenja na oglasnu tablu</button>
                                    <br/>
                                </td>
                            </tr>
                            <tr>		
                                <td colspan='2'>
                                    <br/>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <hr/>
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
