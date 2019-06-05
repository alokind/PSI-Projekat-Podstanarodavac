<?php

/*
 * 
 * @author Vasilije Becić 0069/2016
 * @author Bosko Curcin 0549/2016
 * 
 */

/*
 * 
 * ModelKorisnik - klasa koja opslužuje zahteve za upis i čitanje iz baze,
 * iz entiteta Korisnik
 * 
 * @version 2.0
 */

class ModelKorisnik extends CI_Model {
    
     /*
     * @var object $korisnik Korisnik
     */
    public $korisnik;
    
    /*
     * Konstruktor nove instance klase ModelKorisnik
     * 
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->korisnik = NULL;
    }
    
    /*
     * Funkcija koja dohvata korisnika na osnovu prosleđenog email-a
     * 
     * @param string $kor_email Mail
     * 
     * @return []
     */
    public function dohvatiKorisnika($kor_email){
        $this->korisnik = NULL;
        $result = $this->db->where('Mail', $kor_email)->get('korisnik');
        $kor = $result->row();
        if ($kor != NULL) {
            $this->korisnik = $kor;
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /*
     * Funkcija koja dohvata korisnika na osnovu prosleđenog id-a
     * 
     * @param integer $id IDK
     * 
     * @return []
     */
    public function dohvatiKorisnikaById($id){
        $result = $this->db->where('IDK',$id)->get('korisnik');
        $kor = $result->row();
        return $kor;
    }
    
    /*
     * Funkcija koja za korisnika sa datim emailom proverava da li je 
     * prosledjena lozinka ispravna (podudarna onoj u bazi), uz proveru da li postoji uopste
     * korisnik sa datim email-om
     * 
     * @param string $lozinka Lozinka
     * @param string $email Mail
     * 
     * @return boolean
     */
    public function ispravnaLozinka($lozinka, $email){
        $result = $this->db->where('Mail', $email)->get('korisnik');
        $kor = $result->row(); //Ovime izbegnuto logovanje starim siframa
        if ($kor != NULL) {
            $this->korisnik = $kor;
            if ($this->korisnik->Lozinka == $lozinka) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
    
    /*
     * Funkcija koja proverava da li prosledjeni jmbg postoji kod nekog
     * korisnika u bazi
     * 
     * @param string $jmbg JMBG
     * 
     * @return boolean
     */
    public function postojeciJMBG($jmbg) {
        $result = $this->db->where('JMBG', $jmbg)->get('korisnik');
        $kor = $result->row();
        if ($kor != NULL) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * Funkcija koja dodaje korisnika u bazu podataka
     * 
     * @param object $korisnik Korisnik
     * 
     * return void
     */
    public function dodajKorisnika($korisnik) {
        $this->db->insert('Korisnik', $korisnik);
    }
    
    /*
     * Funkcija koja menja lozinku novom prosledjenom
     * 
     * @param string $nova_lozinka Lozinka
     * 
     * @return void
     */
    public function izmeniLozinku($nova_lozinka) {
        $korisnik = $this->session->userdata('korisnik');
        $email = $korisnik->Mail;
        $this->db->query("UPDATE Korisnik SET Lozinka='$nova_lozinka' WHERE Mail='$email'");
    }
    
    /*
     * Funkcija koja vraca prethodno dohvacenog korisnika u polje ove klase
     * 
     * @return Korisnik
     * 
     */
    public function dohvacenKorisnik() {
        return $this->korisnik;
    }
    
    /*
     * Funkcija koja vraca  id vlasnika za odgovarajceg stanara
     * 
     * @param integer $stanarID IDK
     * 
     * @return IDK
     */
    public function dohvatiVlasnika($stanarID){
        $this->db->from('zakup');
        $this->db->where("IDStanara",$stanarID);
        $query = $this->db->get();
        $result = $query->row();
        $vlasnikID = $result->IDVlasnika;
        
        return $vlasnikID;
    }
}
