<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelRacun
 *
 * @author Bosko
 */
class ModelRacun extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function izlistajRacune($podstanarID){
        $this->db->where("IDStanara", $podstanarID);
        $query=$this->db->get('Racun');
        $result=$query->result();//vraca niz racuna
        //Kako da ih ispisem sve u ona polja?
    }
    //Bojanine metode://--------------------------------------------------------------------------
    //sa sajta videla ovo
    public function cuvajRacun($data) {
        $this->db->insert('racun',$data);
    }
    
    public function dohvatiPlaceneRacune($IDVlasnika){
        if ($IDVlasnika == NULL) {
            return null;
        }
        $this->db->where("Placen", true);
        $this->db->where("IDVlasnika", $IDVlasnika);
        $this->db->from("Racun");
        $this->db->join('Korisnik', 'Korisnik.IDK = Racun.IDStanara');
        $query = $this->db->get();
        $result = $query->result();
        
        $racuniHtml = '';
        foreach ($result as $row) {
            $racuniHtml .= '<option value="'.$row->IDR.'">'.$row->SvrhaUplate.' ('.$row->Iznos.' dinara) - '.$row->Ime.' '.$row->Prezime.' ('.$row->Mail.')</option>';
        }
        return $racuniHtml;
   }
   
      public function dohvatiNeplaceneRacune($IDVlasnika){
        if ($IDVlasnika == NULL) {
            return null;
        }
        $this->db->where("Placen", false);
        $this->db->where("IDVlasnika", $IDVlasnika);
        $this->db->from("Racun");
        $this->db->join('Korisnik', 'Korisnik.IDK = Racun.IDStanara');
        $query = $this->db->get();
        $result = $query->result();
        
        $racuniHtml = '';
        foreach ($result as $row) {
            $racuniHtml .= $row->SvrhaUplate.' ('.$row->Iznos.' dinara) - '.$row->Ime.' '.$row->Prezime.' ('.$row->Mail.')<br>';
        }
        return $racuniHtml;
   }
   
   public function obrisiRacun($IDRacuna){
        if ($IDRacuna == NULL) {
            return null;
        }
        $this->db->where("IDR", $IDRacuna);
        $this->db->delete('Racun');
   }
}
