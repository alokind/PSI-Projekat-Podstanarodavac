<?php

/*
 * 
 * @author Vasilije Becić 0069/2016
 * 
 */

/*
 * 
 * Azurator - klasa kontrolera za Gosta
 * 
 * @version 2.0
 */

class Gost extends CI_Controller {
    
    /*
     * @var string $admin_email Mail
     */
    private $admin_email = 'podstanarodavac@gmail.com';
    
    /*
     * Konstruktor nove instance klase Gosta, uz vodjenje racuna da li je
     * neko vec trenutno ulogovan u momentu rada gosta, cime bi se izbegla
     * dupla prijava i problemi koji dolaze vracanjem unazad preko pretrazivaca
     * 
     * @return void
     */
    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('korisnik') != NULL) {
            $trenutni_korisnik = $this->session->userdata('korisnik');
            if ($trenutni_korisnik->Tip == 'P') {
                redirect('Podstanar');
            } else {
                redirect('Stanodavac');
            }
        } else {
            $this->load->model("ModelKorisnik");
            $this->load->library('form_validation');
            $this->load->library('email');

           //SMTP & mail configuration
            $config = array(
                'protocol'  => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'podstanarodavac@gmail.com',
                'smtp_pass' => 'ata45ktu.1',
                'mailtype'  => 'html',
                'charset'   => 'utf-8'
            );
            $this->email->initialize($config);
            //$this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");
        }
    }
    
    /*
     * funkcija index Gosta
     */
    public function index() {
        $this->load->view('index.php');
        //$this->naPocetnu();
    }
    
    /*
     * funkcija za odlazak na pocetnu stranicu
     */
    public function naPocetnu() {
        $this->load->view('index.php');
    }
    
    
    /*
     * funkcija za odlazak na stranicu za prijavu
     */
    public function naPrijavu() {
        $this->load->view('prijava.php');
    }

    /*
     * funkcija za ispis greske pri neuspesnoj prijavi
     * 
     * @param string $poruka Poruka
     */
    public function neuspesnaPrijava($poruka = NULL) {
        $this->session->set_flashdata('error_login_msg', $poruka);
        $this->naPrijavu();
    }
    
    /*
     * funkcija za prijavljivanje neprijavljenog korisnika uz provere ispravnosti
     * unetog emaila i sifre, kao i ispisa poruke rezultata neuspesne, odnosno
     * uspesne prijave
     * 
     * @return void
     */
    public function ulogujse() {
        //Obavezni email i password
        $this->form_validation->set_rules("email", "Email", "required");
        $this->form_validation->set_rules("passwd", "Password", "required");

        //Poruka ako je neko polje ostalo prazno
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno.");

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
    
    
    /*
     * funkcija za odlazak na stranicu za registraciju
     * 
     * @return void 
     */
    public function naRegistraciju() {
        $this->load->view('registracija.php');
    }
    
    /*
     * funkcija zaduzena za registrovanje korisnika, uz kupljenje podataka iz
     * odgovarajucih formi, provere ispravnosti i upisa novog korisniak u sistem,
     * kao i slanje email-a dobrodosilce, alternativno ispisa
     * poruka gresaka pri neuspesnoj registraciji
     * 
     * @return void
     */
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
            );
            
            //Obrada - provera ispravnosti podataka
            //Provera da li postoji korisnik sa datim emailom ili jmbg-om
            if (($this->ModelKorisnik->dohvatiKorisnika($email)) || ($this->ModelKorisnik->postojeciJMBG($matbr))) {
                $this->neuspesnaRegistracija("Korisnik sa datim emailom ili jmbg-om vec postoji");
            } else { //Prelazak dalje u zavisnosti od unosa
                $this->ModelKorisnik->dodajKorisnika($korisnik);
                
                $this->posaljiEmail($korisnik);

                $this->uspesnaRegistracija("Uspesno ste se registrovali!");
            }  
        }
    }
    
    /*
     * funkcija zaduzena za slanje maila na email odgovarajuceg korisnika, u ovom
     * slucaju, poruke dobrodoslice nakon uspesne registracije, uz osiguranje
     * da ako je doslo do greske pri slanju maila, da se dobija poruka preko
     * print_debugger() standardnog email Codeigniter
     * 
     * @return void
     */
    public function posaljiEmail($korisnik) {
                $ime = $korisnik['Ime'];
                $prezime = $korisnik['Prezime'];
                $lozinka = $korisnik['Lozinka'];
                $email = $korisnik['Mail'];
                
                $poruka = 'Dobrodosli ' . $ime . ' ' . $prezime . '. Vasa lozinka je: ' . $lozinka . '. Srecan rad!'; 
                $subject = 'Dobrodoslica';
                
                $this->email->from($this->admin_email, 'Podstanarodavac');
                $this->email->to($email);

                $this->email->subject($subject);
                $this->email->message($poruka);

                $this->email->send();
                echo $this->email->print_debugger();
    }
    
    /*
     * funkcija za prikaz poruke pri neuspesnoj registraciji, sa ostajanjem
     * na stranici za registraciju, gde ce se te poruke i videti
     *
     * @param string $poruka Poruka
     * 
     * @return void 
     */
    public function neuspesnaRegistracija($poruka = NULL) {
        $this->session->set_flashdata('error_reg_msg', $poruka);
        $this->naRegistraciju();
    }
    
    /*
     * funkcija za prikaz poruke pri uspesnog registraciji i redirekciji
     * ka pocetnoj stranici, gde ce ta poruka biti i ispisana
     * 
     * @param string $poruka Poruka
     * 
     * @return void
     */
    public function uspesnaRegistracija($poruka) {
        $this->session->set_flashdata('succ_reg', $poruka);
        $this->naPocetnu();
    }
    
    
    /*
     * funkcija za odlazak nastranicu za zaboravljenu lozinku
     */
    public function naZaboravljenuLozinku() {
        $this->load->view("zaboravljenaLozinka.php");
    }
    
    /*
     * funkcija za prosledjivanje zaboravljene lozinke putem maila
     * 
     * @return void
     */
    public function proslediLozinku() {
        if ($this->input->post('zahtevajLozinku')) {
            $email = $this->input->post('email');
            $postoji = $this->ModelKorisnik->dohvatiKorisnika($email);
        
            if ($postoji == TRUE) {
                $trenutni_korisnik = $this->ModelKorisnik->korisnik;
                $lozinka = $trenutni_korisnik->Lozinka;
            
                $subject = 'Lozinka';
                $poruka = 'Vasa lozinka je: ' . $lozinka;

                $this->email->from($this->admin_email, 'Podstanarodavac');
                $this->email->to($email);
                $this->email->subject($subject);
                $this->email->message($poruka);

                $this->email->send();
                echo $this->email->print_debugger();

                $this->naPocetnu();  
            } else {
                $poruka = "Korisnik sa datim email-om nije registrovan.";
                $this->session->set_flashdata('error_no_email', $poruka);
                $this->naZaboravljenuLozinku();
            }
        }
    }
}
