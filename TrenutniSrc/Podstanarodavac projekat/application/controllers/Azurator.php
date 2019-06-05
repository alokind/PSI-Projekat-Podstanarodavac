<?php

/*
 * 
 * @author Vasilije Becić 0069/2016
 * 
 */

/*
 * 
 * Azurator - klasa kontrolera za azuriranje lozinke
 * 
 * @version 2.0
 */

class Azurator extends CI_Controller {
    
    /*
     * @var object $aktivanKorisnik Korisnik
     */
    private $aktivanKorisnik = null;
    
    /*
     * Konstruktor nove instance klase Azurator
     * 
     * @return void
     */
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
    
    /*
     * funkcija index Azuratora
     */
    public function index() {
        $this->load->view('azuriraj.php');
    }
    
    /*
     * funkcija za odlazak na pocetnu stranicu
     */
    public function naPocetnu() {
        $this->load->view('index.php');
    }
    
    /*
     * funkcija za odlazak na stranicu za azuriranje
     */
    public function naAzuriranje() {
        $this->load->view('azuriraj.php');
    }
    
    /*
     * funkcija koja sluzi da azurira lozinku trenutnog korisnika, na osnovu
     * lozinke prosledjene u view
     */
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
}
