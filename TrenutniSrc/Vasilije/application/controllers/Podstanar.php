<?php

/*
 * 
 * Opis:    - Klasa kontrolera za akcije Podstanara
 *          - Ovde samo u sluzbi azuriranja nove lozinke
 * Autor metoda:
 *      index, naPocetnu, naPrijavu, naProfil,
 *      naPrijavu, neuspesnaPrijava, ulogujSe, 
 * Vasilije Becic
 */

class Podstanar extends CI_Controller {
    private $aktivanKorisnik = null;
    
    //Konstruktor
    public function __construct() {
        parent::__construct();
        $this->load->model("ModelKorisnik");
        $this->load->library('form_validation');
        $this->aktivanKorisnik = $this->session->userdata('korisnik');
    }
    
    //GLAVNE METODE
    //--------------------------------------------------------------------------
    //index metoda
    public function index() {
        $this->load->view('ulogeStanara.php');
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
                if ($korisnik->Tip == 'S') {
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
}
