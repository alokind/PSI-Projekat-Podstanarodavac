<?php
/*
 * 
 * Opis:    - Klasa kontrolera za akcije podstanara
 *          - Obuhvata sledece akcije:
 *              o Zakup stana
 *              o Sklapanje ugovora
 *              o Placanje racuna
 *              o Prijava kvara
 *              o Kacenje obavestenja
 * 
 */
class Podstanar extends CI_Controller{
    
    private $aktivanKorisnik=null;
    
    //Konstruktor
    public function __construct() { 
        parent::__construct();
        
        if ($this->session->userdata('korisnik') != NULL) {
            $this->load->model("ModelKorisnik");
            $this->load->model("ModelKvar");
            $this->load->model("ModelObavestenje_Opomena");
            $this->load->model("ModelOglasnaTabla");
            $this->load->model("ModelRacun");
            $this->load->model("ModelZakup");
            $this->load->library('form_validation');
        } else {
            redirect('Gost');
        }
    }
    
    //Indeks metoda
    public function index(){
        $data['korisnik'] = $this->session->userdata('korisnik');
        redirect("Podstanar/naProfil");
    }
    
    //Redirekcije://----------------------------------------------------------------------------
    public function naPocetnu(){
        $this->load->view("index.php");
    }
    
    public function naUloge(){
        $this->naProfil();
    }
    
    public function naOglasnu($data=null){
        $vlasnikId = $this->ModelZakup->dohvatiIdVlasnika($this->session->userdata("korisnik")->IDK);
        $data['stvariNaOglasnojTabli'] = $this->ModelOglasnaTabla->dohvatiObavestenjaIDVlasnika($vlasnikId);
        $this->load->view('Podstanar/oglasnaTabla.php', $data);
    }
    
	/*
		Proveravam da li je ugovor prihvacen:
			-Ako jeste, vracam TRUE
			-Ako nije, vracam FALSE i ne mogu da vidim ostale funkcionalnosti
	*/
    public function naProfil() {
        $korisnik = $this->session->userdata('korisnik');
        $data['korisnik'] = $korisnik;
        $ugovorPrihvacen = $this->ModelZakup->ugovorPrihvacen($this->session->userdata('korisnik')->IDK);
        if($ugovorPrihvacen){
           $data['sklopljenUgovor'] = "true"; 
        }else{
           $data['sklopljenUgovor'] = "false"; 
        }
        $this->load->view('Podstanar/profil.php', $data);
    }
    
    //Redirekcije na uloge podstanara://-----------------------------------------------------------
	/*
		Zakup stana:
		Proveravam da li je ugovor prihvacen:
			-Ako jeste, vracam TRUE
			-Ako nije, vracam false i ne mogu da vidim ostale funkcionalnosti
		Nakon te provere, proveravam da li je Vlasnik kreirao ugovor za mene:
			-Ako ne postoji, dobijam poruku o tome
			-Ako postoji, dobijam 2 dugmeta kako bih mogao da ga prihvatim ili ne.
		Nakon te provere, klikom na neko od 2 dugmeta ce mi se u bazi izmeniti polje PRIHVACEN.
		Svakim sledecim klikom na zakup stana ja cu dobiti poruku da sam vec prihvatio ugovor.
	*/
    public function zakupiStanRedirect($data=null){
        $korisnik = $this->session->userdata('korisnik');
        $data['korisnik'] = $korisnik;
        $ugovorPrihvacen = $this->ModelZakup->ugovorPrihvacen($this->session->userdata('korisnik')->IDK);
        if($ugovorPrihvacen){
           $data['sklopljenUgovor'] = "true"; 
        }else{
           $data['sklopljenUgovor'] = "false"; 
        }
        $postojiUgovor = $this->ModelZakup->postojiUgovorZaStanara($this->session->userdata('korisnik')->IDK);
        if($postojiUgovor == false){
            $data['mozeDaPrihvati']='false';
            $data['poruka']="Stanodavac još uvek nije kreirao zahtev za zakupom stana. Kontaktirajte ga da to uradi.";
            $this->load->view("podstanar/zakupStana.php",$data);
        }
        else{
            $ugovorPrihvacen = $this->ModelZakup->ugovorPrihvacen($this->session->userdata('korisnik')->IDK);
            if($ugovorPrihvacen == false){
                $data['mozeDaPrihvati']='true';
                $data['poruka']="Stanodavac je kreirao zahtev za zakup. Da li želite da ga prihvatite?";
                $this->load->view("podstanar/zakupStana.php",$data);
            }else
            {
                $data['mozeDaPrihvati']='false';
                $data['poruka']="Već ste prihvatili zahtev za zakup stana.";
                $this->load->view("podstanar/zakupStana.php",$data);
            }
            
        }
    }
    /*
		Za sklapanje ugovora 
	*/
    public function sklopiUgovorRedirect(){
        $korisnik = $this->session->userdata('korisnik');
        $data['korisnik'] = $korisnik;
        $ugovorPrihvacen = $this->ModelZakup->ugovorPrihvacen($this->session->userdata('korisnik')->IDK);
        if($ugovorPrihvacen){
           $data['sklopljenUgovor'] = "true"; 
        }else{
           $data['sklopljenUgovor'] = "false"; 
        }
        $this->load->view("podstanar/sklopiUgovor.php",$data);
    }
    
    public function platiRacunRedirect($data=null){ //---------------------------------------------------------------------------------------
        $neplaceniRacuni = $this->ModelRacun->dohvatiRacune($this->session->userdata("korisnik")->IDK);
        $data['neplaceniRacuni'] = $neplaceniRacuni;
        $this->load->view("podstanar/platiRacun.php", $data);
    }
    
    public function uplataRacunaRedirect(){
        $this->load->view("podstanar/uplata.php");
    }
    
    public function prijaviKvarRedirect(){
        $this->load->view("podstanar/prijaviKvar.php");
    }
    
    public function okaciObavestenjeRedirect($data=null){
        $this->load->view("podstanar/okaciteNaOglasnuTablu.php",$data);
    }
    
    //Main funckije://--------------------------------------------------------------------------
 
    /* Stize mi obavestenje da je vlasnik generisao ugovor.
       Potvrdujem -> u bazu dodajem ugovor sa oznakom da je PRIHVACEN
       Odbijem -> u bazu dodajem ugovor sa oznakom da je ODBIJEN
    */
    public function zakupiStan(){
        $podstanarID = $this->session->userdata("korisnik")->IDK;
        
        if($this->ModelZakup->kreiranZahtev($podstanarID)){
            if(isset($_POST['confirm'])){
                $this->ModelZakup->zakupiStan($podstanarID, 1);
            }
            else if(isset($_POST['refuse'])){
                $this->ModelZakup->zakupiStan($podstanarID,0);
            }
        }
        redirect("Podstanar/naUloge");
    }
    
    /* 
       Klikom na dugme meni se iz baze dovlace svi podaci
       potrebni za ugovor.To sve dohvatam na osnovu svog IDja.
	   Nakon toga dobijam mogucnost da preuzmem ugovor.
    */
     public function generisiUgovor(){
        $stanarId = $this->session->userdata("korisnik")->IDK;
        $vlasnikId = $this->ModelKorisnik->dohvatiVlasnika($stanarId);
        
        $vlasnik = $this->ModelKorisnik->dohvatiKorisnikaById($vlasnikId);
        $stanar = $this->ModelKorisnik->dohvatiKorisnikaById($stanarId);
        $zakup = $this->ModelZakup->dohvatiZakupById($vlasnikId, $stanarId);
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
        $pdf->SetTitle('Ugovor o zakupu stana');
        $pdf->SetFont('freeserif');
        $pdf->SetTopMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Podstanarodavac');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->AddPage();
        $html =
                '
                <h2 align="center">UGOVOR O ZAKUPU STANA</h2>
                        <p><br><br></p>
                        <h3 align="center">Član 1</h3>
                <p align="justify">
                        Zaključen dana '.date("d.m.Y.").' godine između:<br><br>
                        1. '.$vlasnik->Ime.' '.$vlasnik->Prezime.' sa adresom '.$vlasnik->Adresa.'<br>
                        (dalje: Zakupodavac), i<br><br>
                        2. '.$stanar->Ime.' '.$stanar->Prezime.' sa adresom '.$stanar->Adresa.'<br>
                        (dalje: Zakupac).<br><br>
                        Ugovorne strane su se sporazumele o sledećem:
                </p>
                        <h3 align="center">Član 2</h3>
                <p align="justify">
                        Zakupodavac se obavezuje da Zakupcu dana '.date('d.m.Y.', strtotime($zakup->DatumPocetkaZakupa)).' godine preda stan u stanju
                        podobnom za stanovanje.<br><br>
                        Zakupac se obavezuje da Zakupodavcu, odmah po ulasku u stan, odjednom isplati
                        zakupninu u ukupnom iznosu od '.$zakup->Kirija.' dinara, da stan koristi kao
                        dobar domaćin, snosi sve troškove potrebne za redovno održavanje stana i da Zakupodavca
                        obaveštava o važnim okolnostima vezanim za stan.<br><br>
                        Zakupac je obavezan da snosi sve troškove koji nastanu upotrebom stana (telefon, struja, voda,
                        smeće itd).<br><br>
                        Porez i vanredne troškove održavanja stana snosi Zakupodavac, a redovne Zakupac.
                </p>
                        <h3 align="center">Član 3</h3>
                <p align="justify">
                        Zakupac ne može bez pristanka Zakupodavca menjati namenu prostorija ili izvoditi radove
                        kojima bi se promenila dispozicija odnosno veličina prostorija niti deo prostorija ili ceo stan
                        izdati u podzakup. Ako bi Zakupac takve radove preduzeo ili prostorije drugom izdao,
                        Zakupodavac je ovlašćen da za ubuduće jednostrano raskine ugovor.
                </p>
                        <h3 align="center">Član 4</h3>
                <p align="justify">
                        Ovaj ugovor prestaje istekom vremena na koji je zaključen, o čemu će Zakupodavac, jedan
                        mesec pre isteka roka, obavestiti Zakupca. On se može produžiti samo na osnovu posebnog
                        ugovora ugovornih strana.
                </p>
                        <h3 align="center">Član 5</h3>
                <p align="justify">
                        Ovaj ugovor sačinjen je u dva istovetna primerka, po jedan za svaku ugovornu
                        stranu.
                </p>
                <p><br><br></p>
                <p><br><br></p>
                <p><br><br></p>
                <div align="justify">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    ZAKUPODAVAC 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;
                    ZAKUPAC
                </div>
                <div>_________________________ 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    _________________________
                </div>
                <br>
                <br>';
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Ugovor o zakupu stana.pdf', 'D');
     }
    
      /* Biram iz liste racuna koji racun hocu.
       Mogu da ga platim ili ne.
       Ako ga platim, izbacim ga iz liste i dodam
       u bazu oznacenog kao placenog 
    */
    
    public function potvrditeUplatu(){
        $racuni=$this->input->post('racuni');
        if ($racuni != null){
            foreach ($racuni as $racun) {
                $this->ModelRacun->oznaciRacun($racun);
            }
            $data['tipPoruke']= 'success';
            $data['poruka']= 'Uspešno ste platili račun!';
        }
        else{
            $data['tipPoruke']= 'warning';
            $data['poruka']= 'Nije odabran ni jedan račun.';
        }
        $this->platiRacunRedirect($data);
    }
    
    
    /*  
     * Iz forme dohvatam naslov i opis. Iz sesije idPodstanara.
     * Iz Ugovora idVlasnika.
     * Nakon toga dodajem Kvar u bazu.
     */
    public function prijaviKvar(){
        $this->form_validation->set_rules('naslovKvara','Naslov', 'required|max_length[20]');
        $this->form_validation->set_rules('opisKvara','Opis', 'required|max_length[300]');
        $data = [];
        
        if($this->form_validation->run()==FALSE){ //Ako je korisnik ostavio neko polje prazno
            $poruka = "Popunite prazna polja!";
            $data['poruka'] = $poruka;
            $this->session->set_flashdata('error_login_msg',$poruka);
        }
        else{
            //Prvo dohvatam iz forme naslov i opis kvara:
            $naslov = $this->input->post("naslovKvara");
            $opis = $this->input->post("opisKvara");
            //Nakon toga dohvatam id podstanara:
            $podstanarID = $this->session->userdata("korisnik")->IDK;
            $this->ModelKvar->dodajKvar($podstanarID,$naslov,$opis);
        }
        redirect("Podstanar/naUloge");
    }
    
	/*
		Metoda kojom ispisujem obavestenja
	*/
    public function prikaziObavestenja(){
        $stanarId = $this->session->userdata("korisnik")->IDK;
        $data['obavestenja'] = $this->ModelObavestenje_Opomena->dohvatiObavestenjaIDStanara($stanarId);
        $this->load->view('podstanar/obavestenja_opomene.php', $data);
    }
    /*
		Klikom na dugme, brise mi se obavestenje iz baze
	*/
    public function obrisiteObavestenje(){
        $stanarId = $this->session->userdata("korisnik")->IDK;
        $IDO = $this->input->post('obrisi');
        $this->ModelObavestenje_Opomena->obrisiObavestenje($IDO);
        $data['obavestenja'] = $this->ModelObavestenje_Opomena->dohvatiObavestenjaIDStanara($stanarId);
        $this->load->view('podstanar/obavestenja_opomene.php', $data);
    }
    
    /*Sadrzaj koji kacimo na oglasnu tablu treba da bude ispravan (zato je na pocetku izvrsena provera) u slucaju neke 
     * neregularnosti ispisuje se adekvatna greska. Ukoliko je sve u redu prosledjuju se uneti podaci naslov i tekst u metodu
     * iz odgovarajuceg modela (ModelOglasnaTabla->cuvajObavestenjeStanar) gde se zapravo sacuvaju uneti podaci.
    */
     public function okaciteNaOglasnuTablu(){
        
        $this->form_validation->set_message('max_length', 'Polje {field} može imati najviše {param} karaktera.');
        $this->form_validation->set_message('required', 'Polje {field} je obavezno.');
        
        $this->form_validation->set_rules('naslov','Naslov', 'required|max_length[18]');
        $this->form_validation->set_rules('tekst','Tekst','required|max_length[108]');
        
        if($this->form_validation->run()==FALSE){
            $data['tipPoruke']= 'warning';
            $data['poruka']= 'validation';
            $this->okaciObavestenjeRedirect($data);
        }
        else{
            
            $naslov = $this->input->post("naslov");
            $tekst = $this->input->post("tekst");
            
            $stanarId = $this->session->userdata("korisnik")->IDK;
            $this->ModelOglasnaTabla->cuvajObavestenjeStanar($naslov, $tekst, $stanarId);
            
            $data['tipPoruke']= 'success';
            $data['poruka']= 'Uspešno ste okačili na oglasnu tablu';
            $this->okaciObavestenjeRedirect($data);
        }
    }
	
    /*Funkcija koja ja zasluzna za prikaz oglasne table, da bi je nasli moram da nadjem koji je vlasnik mog stanara
       * Funkcija koja dohvata Stvari na oglasnoj tabli za ulogovanog Stanodavca
     * i prosledjuje ih view-u
     */
    public function oglasnaTabla($data=NULL){
        $vlasnikId = $this->ModelZakup->dohvatiIdVlasnika($this->session->userdata("korisnik")->IDK);
        $data['stvariNaOglasnojTabli'] = $this->ModelOglasnaTabla->dohvatiObavestenjaIDVlasnika($vlasnikId);
        $this->load->view('Podstanar/oglasnaTabla.php', $data);
    }
    
    //Logout
    public function logout(){
        $this->session->unset_userdata('korisnik');
        $this->session->sess_destroy();
        redirect('Gost');
    }
}
