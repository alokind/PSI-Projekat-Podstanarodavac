<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   
        <style type="text/css">
           #hide {
               display: none;
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
                            <a class="nav-link" href="<?php echo site_url('Podstanar/naPocetnu') ?>">Početna</a>
                    </li>
                    <!-- <li class="nav-item">
                            <a class="nav-link" href="prijava.html">Prijava</a>
                    </li> -->
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
        
        <br><br><br>
        
        <h4 align="center">Generišite ugovor o zakupu stana:</h4>
        
        <br/>
        
        <table align='center' width='30%' bgcolor='black'>
            <tr bgcolor='ffaa80' height="50px">
                <td colspan='2'>&nbsp;</td>
            </tr>
            <tr height="150px">
                <td colspan='2' bgcolor='white' align='center' width='50%'>
                    <br/><br/>
                    <form>
                        <table>
                            <p align="center">Ako želite da sklopite uglovor sa vlasnikom pritisnite dugme:</p>
                            <tr align='center'>		
                                <td colspan='2'>
                                    <br/>
                                    <form></form> 
                                    <form name="generisi" action="<?php echo site_url('Podstanar/generisiUgovor') ?>" method="post" align='center'>
                                        <button type="submit" class="btn btn-success">Generisi ugovor</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </form>	
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
