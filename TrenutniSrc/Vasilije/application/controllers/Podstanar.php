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
    
    //Konstruktor
    public function __construct() { //Da li treba ucitavati sve modele?
        parent::__construct();
        
        $this->load->model("ModelKvar");
        $this->load->model("ModelObavestenjeOpomena");
        $this->load->model("ModelOglasnaTabla");
        $this->load->model("ModelRacun");
        $this->load->model("ModelZakup");
        $this->load->library('form_validation');
    }
    
    //Indeks metoda
    public function index(){
        $this->load->view('podstanar/ulogeStanara.php');
    }
    
    //Redirekcije://----------------------------------------------------------------------------
    public function naPocetnu(){
        $this->load->view("index.php");
    }
    
    public function naUloge(){
        $this->load->view("podstanar/ulogeStanara.php");
    }
    
    public function naOglasnu(){
        $this->load->view("oglasnaTabla.php");
    }
    
    public function naProfil(){
        $this->load->view("profil.php");
    }
    
    //Redirekcije na uloge podstanara://---------------------------------------------------------
    public function zakupiStanRedirect(){
        $this->load->view("podstanar/zakupStana.php");
    }
    
    public function sklopiUgovorRedirect(){
        $this->load->view("podstanar/sklopiUgovor.php");
    }
    
    public function platiRacunRedirect(){
        $this->load->view("podstanar/platiRacun.php");
    }
    
    public function uplataRacunaRedirect(){
        $this->load->view("podstanar/uplata.php");
    }
    
    public function prijaviKvarRedirect(){
        $this->load->view("podstanar/prijaviKvar.php");
    }
    
    public function okaciObavestenjeRedirect(){
        $this->load->view("podstanar/okaciNaOglasnu.php");
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
       potrebni za ugovor. I otvara mi se pdf sa mogucnoscu
       da isti i odstampam.
    */
    public function generisiUgovor(){
         $podstanarID = $this->session->userdata("korisnik")->IDK;
         $this->ModelZakup->izgenerisiUgovor($podstanarID);
         //redirect("Podstanar/naUloge");
    }
    
      /* Biram iz liste racuna koji racun hocu.
       Mogu da ga platim ili ne.
       Ako ga platim, izbacim ga iz liste i dodam
       u bazu oznacenog kao placenog 
    */
    public function platiRacun(){
        $podstanarID=$this->session->userdata('korisnik')->IDK;
        $this->ModelRacun->izlistajRacune($podstanarID);
        redirect("Podstanar/naUloge");
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
   
    //Vasilije:
    //METODE ZA PRIJAVU    Otvoreno pitanje - da li je potrebno da stoji uopste ovo dugme
    //--------------------------------------------------------------------------
    //Metoda za odlazak na stranicu prijavu
    public function naPrijavu() {
        $this->load->view('prijava.php');   
    }

    //Metoda za prikaz greske pri neuspesnoj prijavi
    public function neuspesnaPrijava($poruka = NULL) {
        $this->session->set_flashdata('error_login_msg', $poruka);
        $this->naPrijavu();
    }
    
    //Metoda za prijavljivanje - radjena na nacin sa form_validation->run()
    public function ulogujse() {
        //Obavezni email i password
        $this->form_validation->set_rules("email", "Email", "required");
        $this->form_validation->set_rules("passwd", "Password", "required");
        
        //Poruka ako je neko polje ostalo prazno
        $this->form_validation->set_message("required","Polje {field} je ostalo prazno.");
        
        $email = $this->input->post('email');
        $lozinka = $this->input->post('passwd');
        
        if ($this->form_validation->run()) {
            //Provera da li postoji korisnik sa datim emailom i odredjivanje eventualne greske
            if (!$this->ModelKorisnik->dohvatiKorisnika($email)) {
                $this->neuspesnaPrijava("Neispravan email");
                
            } else if (!$this->ModelKorisnik->ispravnaLozinka($lozinka)) {
                $this->neuspesnaPrijava("Neispravna lozinka");
                
            } else {
                //Nakon uspesne prijave, pamti se koji je korisnik u sesiji
                $korisnik = $this->ModelKorisnik->dohvacenKorisnik();
                $this->session->set_userdata('korisnik', $korisnik);
                
                //U zavisnosti od tipa korisnika, odlazi se na odgovarajuci kontroler
                if ($korisnik->Tip == 'P') {
                    redirect("Podstanar");
                } else {
                    redirect("Stanodavac");
                }
            }
        } else {
            $this->neuspesnaPrijava("Popunite prazna polja");
        }
    }
    
    //kacenje obavestenja na oglasnu tablu, cuvam u bazu, ali i dalje ostajem na toj stranici
    //jer po zelji mozda hoce da ostane na toj stranici
        public function okaciNaOglasnuP(){
        $naslov = $this->input->post('naslovObav');
        $tekst = $this->input->post('tekstObav');
        $this->ModelOglasnaTabla->cuvajObavestenje2($naslov,$tekst);
    } 
    //logout
    public function logout(){
        $this->session->unset_userdata('korisnik');
        $this->session->sess_destroy();
        redirect('Gost');
    }
}
