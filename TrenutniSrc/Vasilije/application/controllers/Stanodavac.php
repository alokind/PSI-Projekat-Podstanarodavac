<?php

/*
 * 
 * Opis:    - Klasa kontrolera za akcije Stanodavac
 *          - Ovde samo u sluzbi azuriranja nove lozinke
 * Autor metoda:
 *      index, naPocetnu, naPrijavu, naProfil,
 *      naPrijavu, neuspesnaPrijava, ulogujSe, 
 * Vasilije Becic
 */

class Stanodavac extends CI_Controller {
    private $aktivanKorisnik = null;
    
    //Konstruktor
    public function __construct() {
        parent::__construct();
        $this->load->model("ModelKorisnik");
        $this->load->library('form_validation');
        $this->aktivanKorisnik = $this->session->userdata('korisnik');
		$this->load->model('ModelOglasnaTabla');
        $this->load->model('ModelRacun');
    }
    
    //GLAVNE METODE
    //--------------------------------------------------------------------------
    //index metoda
    public function index() {
        $this->load->view('ulogeVlasnika.php');
    }
    
    //Metoda za odlazak na pocetnu
    public function naPocetnu() {
        $this->load->view('index.php');
    }
    
    //Metoda za prikaz profila
    public function naProfil() {
        $this->load->view('profil.php');
    }
    
    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------

    
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
	public function uzmiObavestenje(){
            $query=$this->db->query("select * from oglasna_tabla");
            $result['result']=$query->result();
             $this->load->view("oglasnaTabla.php", $result);
            
        }
	//fja koja treba da se izvrsi pri samom otvaranju stranice unesiteRacun zato
	//sto je njen zadatak da automatski stavi u padajuci meni vlasnikove podstanare
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
//fja u kojoj cuvamo podatke koje treba da se dostave podstanaru o zadatom racunu    
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
   
}
