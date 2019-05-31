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
}
