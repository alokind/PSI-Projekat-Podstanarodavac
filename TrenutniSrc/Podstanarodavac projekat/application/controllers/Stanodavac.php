<?php
/*
 * @author Nikola Dimitrijević 0597/2016
 * @author Bojana Krivokapić   0323/2016
 * 
 */


/*
 * Stanodavac - klasa koja opslužuje zahteve korisnika registrovanog kao Stanodavac
 * 
 * @version 2.0
 */
class Stanodavac extends CI_Controller {
    private $aktivanKorisnik = null;
    
    //Konstruktor
    public function __construct() {
        parent::__construct();
	if ($this->session->userdata('korisnik') != NULL) {
		$this->load->model("ModelKorisnik");
		$this->load->library('form_validation');
		$this->aktivanKorisnik = $this->session->userdata('korisnik');
		$this->load->model('ModelOglasnaTabla');
		$this->load->model('ModelRacun');
		$this->load->model('ModelZakup');
		$this->load->model('ModelKvar');
		$this->load->model('ModelObavestenje_Opomena');
	} else {
	  	redirect('Gost');	
	}
    }
    
    //GLAVNE METODE
    //--------------------------------------------------------------------------
    //index metoda
    
    //Metoda za odlazak na pocetnu
    public function naPocetnu() {
        $this->load->view('index.php');
    }
    
    //Metoda za prikaz profila
    public function naProfil() {
        $this->load->view('Stanodavac/profil.php');
    }
    
    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------
	
	
	/*
	opis fja : logout
				okaciNaOglasnuV
				uzmiObavestenje
				otvoriUnesiRacun
				unesiRacun
	autor: Bojana Krivokapic
				
	*/
	//fja za odjavljivanje sa sistema pritiskom ikonice logout kada se nalazimo 
	//u nekoj od funkcionalnosti stanodavca
    public function logout(){
        $this->session->unset_userdata('korisnik');
        $this->session->sess_destroy();
        redirect('Gost');
    }
	//fja koja cuva ono sto zelimo da okacimo na oglasnu tablu (unete podatke)
	public function okaciNaOglasnuV(){
        $naslov = $this->input->post('naslovObav');
        $tekst = $this->input->post('tekstObav');
        $this->ModelOglasnaTabla->cuvajObavestenje($naslov,$tekst);
        $this->load->view("okaciNaOglasnuV.php");
    }
	//fja koja sluzi za uzimanje sacuvanih podataka iz prethodne metode kako bi
	//se prikazala  na samoj oglasnoj tabli
    
        //Ovde mora da se trazi po IDVlasnika za tu oglasnu tablu
	public function uzmiObavestenje(){
            $query=$this->db->query("select * from oglasna_tabla");
            $result['result']=$query->result();
             $this->load->view("oglasnaTabla.php", $result);
            
        }
        
        
	/*Funkcija koja treba da se izvrsi pri samom otvaranju stranice unesiteRacun zato
	*sto je njen zadatak da automatski stavi u padajuci meni vlasnikove podstanare.
	*/
	public function otvoriUnesiRacun(){
       
        $stan=$this->session->userdata('korisnik');
        $stanodavac = $stan->IDK;
        $this->db->select('Ime');
        $this->db->from('korisnik');
        $this->db->join('zakup', 'zakup.IDStanara=korisnik.IDK');
        $this->db->where('korisnik.Tip','P');
        $this->db->where('zakup.IDVlasnika',$stanodavac);
        
        $result = $this->db->get();
        $data = [];
        $rs=$result->result();
        $data['result'] = $rs;
        $this->load->view("unesiteRacun.php", $data);
       
        }
	/*Funkcija u kojoj podatke koje unosi stanodavac cuvamo u jedan niz kao parametre i prosledjujemo ih fji iz
	*odgovarajuceg modela ciji je zadatak da ih sacuva u bazu
	*/
    public function unesiRacun(){
        $stan=$this->session->userdata('korisnik');
        $stanodavac = $stan->IDK;
        $podstanar = 0;
       
        $svrha = $this->input->post('svrhaUplate');
        $poziv = $this->input->post('pozivNaBroj');
        $brRacuna = $this->input->post('brRacuna');
        $iznosRacuna = $this->input->post('iznosRacuna');
        
        $data = array( 'IDR'=>'0' ,'SvrhaUplate'=>$svrha,'PozivNaBroj'=> $poziv, 'ZiroRacun'=>$brRacuna, 'Iznos'=>$iznosRacuna,'IDVlasnika'=>$stanodavac,'IDStanara'=>$podstanar );
        $this->ModelRacun->cuvajRacun($data);
        $this->otvoriUnesiRacun();
    }
    
    
    /*
     * 
     * 
     * 
     * ODAVDE
     * JE
     * Nikola
     * 
     * 
     * 
     * 
     * 
     */
    
    /*
     * Funkcija koja preusmerava ulogovanog Stanodavca na početnu stranu - profil
     */
    public function index(){
        $data['korisnik'] = $this->session->userdata('korisnik');
        redirect("Stanodavac/naProfil");
        //$this->load->view('stanodavac/naProfil.php', $data);
    }
    
    /*
     * Funkcija koja obrađuje polja iz forme za unos zakupa stana
     * proverava da li su validni u zavisnosti od čega ih upisuje u bazu
     *  i šalje odgovarajuću povratnu poruku
     */
    public function izdajteStan(){
        
        $this->form_validation->set_message('is_natural_no_zero', 'Polje {field} je obavezno.');
        $this->form_validation->set_message('min_length', 'Polje {field} mora imati najmanje {param} karaktera.');
        $this->form_validation->set_message('max_length', 'Polje {field} može imati najviše {param} karaktera.');
        $this->form_validation->set_message('required', 'Polje {field} je obavezno.');
        $this->form_validation->set_message('valid_email', 'Polje {field} mora sadržati vaildan mejl.');
        
        $this->form_validation->set_rules('adresaStana','Adresa stana', 'required|max_length[45]', 'Adresa nije validna');
        $this->form_validation->set_rules('kirija','Kirija','required|is_natural_no_zero');
        $this->form_validation->set_rules('duzinaZakupa','Dužina zakupa','required|is_natural_no_zero');
        $this->form_validation->set_rules('datumPocetkaZakupa','Datum početka zakupa','required');
        $this->form_validation->set_rules('kvadratura','Kvadratura','required|is_natural_no_zero');
        $this->form_validation->set_rules('mejl','Mejl','required|valid_email');
        
        if($this->form_validation->run()==FALSE){
            $data['tipPoruke']= 'warning';
            $data['poruka']= 'validation';
            $this->izdajteStanPg($data);
        }
        else{
            
            $adresaStana=$this->input->post("adresaStana");
            $kirija=$this->input->post("kirija");
            $duzinaZakupa=$this->input->post("duzinaZakupa");
            $datumPocetkaZakupa=$this->input->post("datumPocetkaZakupa");
            $kvadratura=$this->input->post("kvadratura");
            $vlasnikId=$this->session->userdata("korisnik")->IDK;
            $stanarId =null;
            
            //Provera da li postoji korisnik sa tim mejlom
            if ($this->ModelKorisnik->dohvatiKorisnika($this->input->post('mejl'))) {
                
                //Provera da li je taj korisnik tipa Podstanar
                if ($this->ModelKorisnik->korisnik->Tip == "P"){
                    
                    $stanarId=$this->ModelKorisnik->korisnik->IDK;
                    
                    //Provara da li vec nije izdat stan tom podstanaru
                    if (!$this->ModelZakup->vecIzdatTomPodstanaru($vlasnikId, $stanarId)){
                        $this->ModelZakup->dodaj($vlasnikId, $stanarId, $adresaStana, $kirija, $duzinaZakupa, $datumPocetkaZakupa, $kvadratura);
                        
                        $data['tipPoruke']= 'success';
                        $data['poruka']= 'Uspešno ste poslali zahtev za izdavanje stana drugom korisniku.';
                        $this->izdajteStanPg($data);
                    }
                    else {
                        $data['tipPoruke']= 'warning';
                        $data['poruka']= 'Zahtev za izdavanje stana je već poslat ovom podstanaru, ili ste mu već izdali stan.';
                        $this->izdajteStanPg($data);
                    }
                } 
                else {
                    //Poruka pokusavate da izdate stan korisniku koji nije registrovan kao podstanar
                    $data['tipPoruke']= 'warning';
                    $data['poruka']= 'Ne možete izdati stan korisniku koji nije registrovan kao podstanar.';
                    $this->izdajteStanPg($data);
                }
            } 
            else {
                //Poruka stanar nije pronadjen, kao neka kaze stanaru da se registruje kao stanar...
                $data['tipPoruke']= 'warning';
                $data['poruka']= 'Korisnik sa ovim mejlom nije pronađen. Zamolite podstanara da se registruje na sajtu';
                $this->izdajteStanPg($data);
            }
        }
    }
    
    /*
     * Funkcija koja na osnovu odabranog Podstanara generiše pdf ugovora sa njim
     * sa svim unetim informacijama
     */
    public function generisiteUgovor(){
        $vlasnikId = $this->session->userdata("korisnik")->IDK;
        $stanarId = $this->input->post("podstanar");
        
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
    
    /*
     * Funkcija koja obrađuje polja iz forme za unos računa za Podstanara
     * proverava da li su validni u zavisnosti od čega ih upisuje u bazu
     * i šalje odgovarajuću povratnu poruku
     */
    public function unesiteRacun(){
        
        $this->form_validation->set_message('is_natural_no_zero', 'Polje {field} mora biti broj veći od nule.');
        $this->form_validation->set_message('max_length', 'Polje {field} može imati najviše {param} karaktera.');
        $this->form_validation->set_message('required', 'Polje {field} je obavezno.');
        
        $this->form_validation->set_rules('svrhaUplate','Svrha uplate', 'required|max_length[40]');
        $this->form_validation->set_rules('pozivNaBroj','Poziv na broj','required');
        $this->form_validation->set_rules('brRacuna','Broj računa','required');
        $this->form_validation->set_rules('iznosRacuna','Iznos','required|is_natural_no_zero');
        
        $stan=$this->session->userdata('korisnik');
        $stanodavac = $stan->IDK;
        
        
        if($this->form_validation->run()==FALSE){
            $data['tipPoruke']= 'warning';
            $data['poruka']= 'validation';
            $this->unesiteRacunPg($data);
        }
        else{
            $podstanar =  $this->input->post('podstanar');
            if ($podstanar != null){
                $svrha = $this->input->post('svrhaUplate');
                $poziv = $this->input->post('pozivNaBroj');
                $brRacuna = $this->input->post('brRacuna');
                $iznosRacuna = $this->input->post('iznosRacuna');
                $input = array('SvrhaUplate'=>$svrha,'PozivNaBroj'=> $poziv, 'ZiroRacun'=>$brRacuna, 'Iznos'=>$iznosRacuna,'IDVlasnika'=>$stanodavac,'IDStanara'=>$podstanar );
                $this->ModelRacun->cuvajRacun($input);
                $data['tipPoruke']= 'success';
                $data['poruka']= 'Uspešno ste uneli racun.';
            }
            else{
                $data['tipPoruke']= 'warning';
                $data['poruka']= 'Polje Podstanar je obavezno.';
            }
            $this->unesiteRacunPg($data);
        }
    }
    
    /*
     * Funkcija koja omogućava Stanodavcu da validira uplatu ispostavljenog
     * računa i obriše taj račun iz baze
     */
    public function potvrditeUplatu(){
        $racuni=$this->input->post('racuni');
        if ($racuni != null){
            foreach ($racuni as $racun) {
                $this->ModelRacun->obrisiRacun($racun);
            }
            $data['tipPoruke']= 'success';
            $data['poruka']= 'Uspešno ste potvrdili plaćanje računa.';
        }
        else{
            $data['tipPoruke']= 'warning';
            $data['poruka']= 'Nije odabran ni jedan račun.';
        }
        $this->potvrditeUplatuPg($data);
    }
    
    
    /*
     * Funkcija koja odabranom Podstanaru šalje poruku u vidu Obaveštenja
     * ili opomene. Takođe proverava da li su validni u zavisnosti od čega 
     * ih upisuje u bazu i šalje odgovarajuću povratnu poruku
     */
    public function posaljiteObavestenjePodstanaru(){
        $this->form_validation->set_message('is_natural_no_zero', 'Polje {field} je obavezno.');
        $this->form_validation->set_message('max_length', 'Polje {field} može imati najviše {param} karaktera.');
        $this->form_validation->set_message('required', 'Polje {field} je obavezno.');
        
        $this->form_validation->set_rules('naslov','Naslov', 'required|max_length[18]', 'Adresa nije validna');
        $this->form_validation->set_rules('tekst','Tekst','required|max_length[100]');
        
        if($this->form_validation->run()==FALSE){
            $data['tipPoruke']= 'warning';
            $data['poruka']= 'validation';
            $this->posaljiteObavestenjePodstanaruPg($data);
        }
        else{
            
            $naslov = $this->input->post("naslov");
            $tekst = $this->input->post("tekst");
            $tip = $this->input->post("tip");
            $vlasnikId = $this->session->userdata("korisnik")->IDK;
            $stanarId = $this->input->post("podstanar");
            if ($stanarId != null){
                $this->ModelObavestenje_Opomena->dodajObavestenjeOpomenu($vlasnikId, $stanarId, $naslov, $tekst, $tip);
                $data['tipPoruke']= 'success';
                $data['poruka']= 'Uspešno ste poslali '.$tip.' Vašem podstanaru.';
            }
            else{
                $data['tipPoruke']= 'warning';
                $data['poruka']= 'Polje Podstanar je obavezno.';
            }
            $this->posaljiteObavestenjePodstanaruPg($data);
        }
    }
    
    /*
     * Funkcija koja obrađuje polja iz forme za kačenje na Oglasnu tablu
     * proverava da li su validni u zavisnosti od čega ih upisuje u bazu
     * i šalje odgovarajuću povratnu poruku
     */
    public function okaciteNaOglasnuTablu(){
        
        $this->form_validation->set_message('max_length', 'Polje {field} može imati najviše {param} karaktera.');
        $this->form_validation->set_message('required', 'Polje {field} je obavezno.');
        
        $this->form_validation->set_rules('naslov','Naslov', 'required|max_length[18]');
        $this->form_validation->set_rules('tekst','Tekst','required|max_length[108]');
        
        if($this->form_validation->run()==FALSE){
            $data['tipPoruke']= 'warning';
            $data['poruka']= 'validation';
            $this->okaciteNaOglasnuTabluPg($data);
        }
        else{
            
            $naslov = $this->input->post("naslov");
            $tekst = $this->input->post("tekst");
            
            $vlasnikId = $this->session->userdata("korisnik")->IDK;
            $this->ModelOglasnaTabla->cuvajObavestenje($naslov, $tekst, $vlasnikId);
            
            $data['tipPoruke']= 'success';
            $data['poruka']= 'Uspešno ste okačili na oglasnu tablu';
            $this->okaciteNaOglasnuTabluPg($data);
        }
    }
    
    /*
     * Funkcija koja dohvata Stvari na oglasnoj tabli za ulogovanog Stanodavca
     * i prosledjuje ih view-u
     */
    public function oglasnaTabla($data=NULL){
        $vlasnikId = $this->session->userdata("korisnik")->IDK;
        $data['stvariNaOglasnojTabli'] = $this->ModelOglasnaTabla->dohvatiObavestenjaIDVlasnika($vlasnikId);
        $this->load->view('stanodavac/oglasnaTabla.php', $data);
    }
    
    /*
     * Funkcija koja dohvata prijavljene kvarove od strane Podstanara
     * za ulogovanog Stanodavca i prosledjuje ih view-u
     */
    public function prikaziKvarove(){
        $vlasnikId = $this->session->userdata("korisnik")->IDK;
        $data['kvarovi'] = $this->ModelKvar->dohvatiKvaroveIDVlasnika($vlasnikId);
        $this->load->view('stanodavac/kvarovi.php', $data);
    }
    
    /*
     * Funkcija koja obrađuje brisanje kvara iz baze i sa view-a
     */
    public function obrisiteKvar(){
        $vlasnikId = $this->session->userdata("korisnik")->IDK;
        $IDKvar = $this->input->post('obrisi');
        $this->ModelKvar->obrisiKvar($IDKvar);
        $data['kvarovi'] = $this->ModelKvar->dohvatiKvaroveIDVlasnika($vlasnikId);
        $this->load->view('stanodavac/kvarovi.php', $data);
    }
    
    /*
     * Funkcija koja obrađuje brisanje stvari na Oglasnoj tabli iz baze i sa view-a
     */
    public function obrisiOglas(){
        $vlasnikId = $this->session->userdata("korisnik")->IDK;
        $IDO = $this->input->post('obrisi');
        $this->ModelOglasnaTabla->obrisiOglas($IDO);
        $data['stvariNaOglasnojTabli'] = $this->ModelOglasnaTabla->dohvatiObavestenjaIDVlasnika($vlasnikId);
        $this->load->view('stanodavac/oglasnaTabla.php', $data);
    }
    
    
    /*
     * Funkcija koja prosledjuje neophodne podatke za validno prikazivanje view-a
     * izdajteStan
     */
    public function izdajteStanPg($data=NULL){
        $this->load->view('stanodavac/izdajteStan.php', $data);
    }
    
    /*
     * Funkcija koja prosledjuje neophodne podatke za validno prikazivanje view-a
     * generisiteUgovor
     */
    public function generisiteUgovorPg($data=NULL){
        $podstanari = $this->ModelZakup->dohvatiPodstanare($this->session->userdata("korisnik")->IDK);
        $data['podstanariIme'] = $podstanari['ime'];
        $data['podstanariValue'] = $podstanari['value'];
        $this->load->view('stanodavac/generisiteUgovor.php', $data);
    }
    
    /*
     * Funkcija koja prosledjuje neophodne podatke za validno prikazivanje view-a
     * unesiteRacun
     */
    public function unesiteRacunPg($data=NULL){
        $podstanari = $this->ModelZakup->dohvatiPodstanare($this->session->userdata("korisnik")->IDK);
        $data['podstanariIme'] = $podstanari['ime'];
        $data['podstanariValue'] = $podstanari['value'];
        $this->load->view('stanodavac/unesiteRacun.php', $data);
    }
    
    /*
     * Funkcija koja prosledjuje neophodne podatke za validno prikazivanje view-a
     * potvrditeUplatu
     */
    public function potvrditeUplatuPg($data=NULL){
        $racuni = $this->ModelRacun->dohvatiPlaceneRacune($this->session->userdata("korisnik")->IDK);
        $neplaceniRacuni = $this->ModelRacun->dohvatiNeplaceneRacune($this->session->userdata("korisnik")->IDK);
        $data['racuni'] = $racuni;
        $data['neplaceniRacuni'] = $neplaceniRacuni;
        $this->load->view('stanodavac/potvrditeUplatu.php', $data);
    }
    
    /*
     * Funkcija koja prosledjuje neophodne podatke za validno prikazivanje view-a
     * posaljiteObavestenjePodstanaru
     */
    public function posaljiteObavestenjePodstanaruPg($data=NULL){
        $podstanari = $this->ModelZakup->dohvatiPodstanare($this->session->userdata("korisnik")->IDK);
        $data['podstanariIme'] = $podstanari['ime'];
        $data['podstanariValue'] = $podstanari['value'];
        $this->load->view('stanodavac/posaljiteObavestenjePodstanaru.php', $data);
    }
    
    /*
     * Funkcija koja prosledjuje neophodne podatke za validno prikazivanje view-a
     * okaciteNaOglasnuTablu
     */
    public function okaciteNaOglasnuTabluPg($data=NULL){
        $this->load->view('stanodavac/okaciteNaOglasnuTablu.php', $data);
    }
    
   
}
