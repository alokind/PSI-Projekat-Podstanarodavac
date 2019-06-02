<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelKvar
 *
 * @author Bosko
 */
class ModelKvar extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function dodajKvar($podstanarID,$naslov,$opis){
        $this->db->from('zakup');
        $this->db->where("IDStanara",$podstanarID);
        $query = $this->db->get();
        $result = $query->row();
        $vlasnikID = $result->IDVlasnika;
        
        $data = array(
          'Naslov' => $naslov,
          'Opis' => $opis,
          'IDStanara' => $podstanarID,
          'IDVlasnika' => $vlasnikID
        );
       
        $this->db->insert('kvar', $data);
    }
    
        public function dohvatiKvaroveIDVlasnika($IDVlasnika){
        if ($IDVlasnika == NULL) {
            return null;
        }
        $this->db->where("IDVlasnika", $IDVlasnika);
        $this->db->from("kvar");
        $this->db->join('Korisnik', 'Korisnik.IDK = Kvar.IDStanara');
        $query = $this->db->get();
        $result = $query->result();
        
        $kvarovi = '';
        foreach ($result as $row) {
            $kvarovi .= 
                                        '<div class="col-lg-3 col-md-4 col-sm-6 mb-4">'.
                                                '<div class="card bg-danger text-white h-50 w-80">'.
                                                  '<div class="card-header">'.$row->Ime.' '.$row->Prezime.
                                                      '<button type="submit" name="obrisi" class="close" aria-label="Close" value="'.$row->IDKvar.'">'.
                                                        '<span aria-hidden="true" title="Uklonite kvar">&times;</span>'.
                                                      '</button>'.
                                                  '</div>'.
                                                  '<div class="card-body">'.
                                                        '<h4 class="card-title">'.
                                                          $row->Naslov.
                                                        '</h4>'.
                                                        '<hr>'.
                                                        '<p class="card-text" align="left">'.
                                                                $row->Opis.
                                                        '</p>'.
                                                  '</div>'.
                                                '</div>'.
                                        '</div>';
        }
        return $kvarovi;
    }
    
    public function obrisiKvar($IDKvar){
        $this->db->where('IDKvar', $IDKvar);
        $this->db->delete('kvar');
    }   
}
