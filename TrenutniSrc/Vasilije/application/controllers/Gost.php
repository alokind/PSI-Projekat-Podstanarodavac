<?php

/*
 * 
 * Opis:    - Klasa kontrolera za akcije gosta
 *          - Obuhvata sledece akcije:
 *              o Posecivanje pocetne
 *              o Prijava gosta na sajt
 *              o Registracija gosta za aplikaciju
 * 
 * Autor metoda:
 *      index, naPocetnu, naPrijavu, neuspesnaPrijava, ulogujSe, 
 *      naRegistraciju, registrujSe, neuspesnaRegistracija, uspesnaRegistracija
 * Vasilije Becic
 */

class Gost extends CI_Controller{
    //Konstruktor
    public function __construct() {
        parent::__construct();
        $this->load->model("ModelKorisnik");
        $this->load->library('form_validation');
    }
    
    //GLAVNE METODE
    //--------------------------------------------------------------------------
    //index metoda
    public function index() {
        $this->load->view('index.php');
    }
    
    //Metoda za odlazak na pocetnu
    public function naPocetnu() {
        $this->load->view('index.php');
    }
    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------
    
    
    //METODE ZA PRIJAVU
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
        
        
        if ($this->form_validation->run()) {
            $email = $this->input->post('email');
            $lozinka = $this->input->post('passwd');
            
            //Provera da li postoji korisnik sa datim emailom i odredjivanje eventualne greske
            if (!$this->ModelKorisnik->dohvatiKorisnika($email)) {
                $this->neuspesnaPrijava("Neispravan email");
                
            } else if (!$this->ModelKorisnik->ispravnaLozinka($lozinka, $email)) {
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
    
    
    //METODE ZA REGISTRACIJU
    //--------------------------------------------------------------------------
    //Metoda za odlazak na stranicu za registraciju
    public function naRegistraciju() {
        $this->load->view('registracija.php');
    }
    
    //Metoda za registrovanje - radjena na nacin sa input nad dugmetom za submit
    public function registrujSe() {
        if ($this->input->post('registruj')) {
            //Kupljenje podataka iz forme
            $ime = $this->input->post('name');
            $prezime = $this->input->post('lastname');
            $email = $this->input->post('mail');
            $lozinka = $this->input->post('password');
            $matbr = $this->input->post('jmbg');
            $mobilni = $this->input->post('phone');
            $adresa = $this->input->post('adress');
            $pol = $this->input->post('pol');
            $uloga = $this->input->post('role');
            
            if (!($ime && $prezime && $email && $lozinka && $matbr && $mobilni && $adresa && $pol && $uloga)) {
                $this->neuspesnaRegistracija("Popunite sva polja");
            }   
            $idO = 1; //PROBLEM OKO OGLASNE TABLE
            
            $korisnik = array (
                'Ime' => $ime,
                'Prezime' => $prezime,
                'Mail' => $email,
                'Lozinka' => $lozinka,
                'JMBG' => $matbr,
                'BrojTelefona' => $mobilni,
                'Adresa' => $adresa,
                'Tip' => $uloga,
                'Pol' => $pol,
                'IDO' => $idO //PROBLEM OKO OGLASNE TABLE
            );
            
            //Obrada - provera ispravnosti podataka
            //Provera da li postoji korisnik sa datim emailom ili jmbg-om
            if (($this->ModelKorisnik->dohvatiKorisnika($email)) || ($this->ModelKorisnik->postojeciJMBG($matbr))) {
                $this->neuspesnaRegistracija("Korisnik sa datim emailom ili jmbg-om vec postoji");
            } else { //Prelazak dalje u zavisnosti od unosa
                $this->ModelKorisnik->dodajKorisnika($korisnik);
                $this->uspesnaRegistracija("Uspesno ste se registrovali!");
            }  
        }
    }
    
    //Metoda za prikaz greske pri neuspesnoj registraciji
    public function neuspesnaRegistracija($poruka = NULL) {
        $this->session->set_flashdata('error_reg_msg', $poruka);
        $this->naRegistraciju();
    }
    
    //Metoda za prikaz poruke o uspesnoj registraciji i prelazak na pocetnu
    public function uspesnaRegistracija($poruka) {
        $this->session->set_flashdata('succ_reg', $poruka);
        $this->naPocetnu();
    }
    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------
}
