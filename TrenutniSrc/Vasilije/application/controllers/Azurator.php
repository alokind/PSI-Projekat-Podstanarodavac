<?php

/*
 * 
 * Opis:    - Pomocna klasa kontrolera za azuriranje
 *          - Akciju azuriranja dele i podstanar i stanodavac
 *          - Te ne zavisi direktno od njihovih kontrolera
 * Autor klase: Vasilije Becic
 * Bojana Krivokapic -> odjava
 * 
 */

class Azurator extends CI_Controller {
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
        $this->load->view('azuriraj.php');
    }
    
    //Metoda za odlazak na pocetnu
    public function naPocetnu() {
        $this->load->view('index.php');
    }
    
    //Metoda za odlazak nazad na stranicu profila
    public function naProfil() {
        $this->load->view('profil.php');
    }
    
    //Metoda za odlazak na stranicu za azuriranje loznike
    public function naAzuriranje() {
        $this->load->view('azuriraj.php');
    }
    
    //Metoda za azuriranje lozinke
    public function azuriraj() {
        //Proverava se mail trenutno ulogovanog korisnika
        $trenutni_korisnik = $this->session->userdata('korisnik');
        $email_trenutnog = $trenutni_korisnik->Mail;
        
        if ($this->input->post('azuriranje')) {
            //U ModelKorisnik se ubacuje trenutni korisnik, nadjen preko maila
            //(ovo je osiguranje ako mozda dodje do promene korisnika u ModelKorisnik zbog drugih radnji)
            $this->ModelKorisnik->dohvatiKorisnika($email_trenutnog);
            
            //Dohvata se nova lozinka i ubacuje u korisnika u ModelKorisnik
            $nova_lozinka = $this->input->post('lozinka');
            $this->ModelKorisnik->izmeniLozinku($nova_lozinka);
            
                    if ($trenutni_korisnik->Tip == 'S') {
                        redirect('Podstanar');
                    } else {
                        redirect('Stanodavac');
                    }
                    $this->naProfil();
        }
    }
    
    //Metoda za odjavu (potrebna zarad debagovanja)
    public function odjava() {
        $this->session->unset_userdata('korisnik');
        $this->session->sess_destroy();
        redirect('Gost');
    }
    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------
    
    
    //METODE ZA PRIJAVU  Otvoreno pitanje - da li je potrebno da stoji uopste ovo dugme
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
            
            //Provera da li postoji korisnik sa datim emailom i odredjivanje eventualne greske
            if (!$this->ModelKorisnik->dohvatiKorisnika($this->input->post('email'))) {
                $this->neuspesnaPrijava("Neispravan email");
            } else if (!$this->ModelKorisnik->ispravnaSifra($this->input->post('passwd'))) {
                $this->neuspesnaPrijava("Neispravna sifra");
                
            } else {
                //Nakon uspesne prijave, pamti se koji je korisnik u sesiji
                $korisnik = $this->ModelKorisnik->korisnik;
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
