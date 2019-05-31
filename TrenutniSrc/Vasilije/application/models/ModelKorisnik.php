<?php

/*
 * 
 * Opis:    - Klasa Modela za tabelu Korisnika
 *          - Obuhvata sledece akcije:
 *              o Dohvatanje korisnika
 *              o Provera da li lozinka postoji
 *              o Provera da li korisnik sa datim JMBG postoji
 *              o Dodavanje novog korisnika
 * 
 * Autor metoda:
 *      prostojeciJMBG, dodajKorisnika, dohvacenKorisnik, izmeniLozinku, ispravnaLozinka
 * Vasilije Becic
 * 
 * Autor metoda:
 *      dohvatiKorisnika
 * Bosko Curcin
 */

class ModelKorisnik extends CI_Model {
    public $korisnik;
    
    public function __construct() {
        parent::__construct();
        $this->korisnik=NULL;
    }
    
    public function dohvatiKorisnika($kor_email){
        $result = $this->db->where('Mail', $kor_email)->get('korisnik');
        $kor = $result->row();
        if ($kor != NULL) {
            $this->korisnik = $kor;
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function dohvatiKorisnikaById($id){
        $result = $this->db->where('IDK',$id)->get('korisnik');
        $kor = $result->row();
        return $kor;
    }
    
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
    
    public function postojeciJMBG($jmbg) {
        $result = $this->db->where('JMBG', $jmbg)->get('korisnik');
        $kor = $result->row();
        if ($kor != NULL) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function dodajKorisnika($korisnik) {
        $this->db->insert('Korisnik', $korisnik);
    }
    
    public function izmeniLozinku($nova_lozinka) {
        $korisnik = $this->session->userdata('korisnik');
        $email = $korisnik->Mail;
        $this->db->query("UPDATE Korisnik SET Lozinka='$nova_lozinka' WHERE Mail='$email'");
    }
    
    public function dohvacenKorisnik() {
        return $this->korisnik;
    }
}
