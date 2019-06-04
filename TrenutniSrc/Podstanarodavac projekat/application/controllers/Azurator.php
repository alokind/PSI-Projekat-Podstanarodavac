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
        if ($this->session->userdata('korisnik') != NULL) {
            $this->load->model("ModelKorisnik");
            $this->load->library('form_validation');
            $this->aktivanKorisnik = $this->session->userdata('korisnik');
        } else {
            redirect('Gost');
        }   
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
            
            $poruka = "Nova lozinka je azurirana.";
            $this->session->set_flashdata('succ_change', $poruka);
            
            if ($trenutni_korisnik->Tip == 'P') {
                redirect("Podstanar/naProfil");
            } else {
                redirect('Stanodavac/naProfil');
            }
            
        }
    }  
    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------
}
