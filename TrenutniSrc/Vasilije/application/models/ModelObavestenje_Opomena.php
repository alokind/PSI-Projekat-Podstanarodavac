<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelObavestenje_Opomena
 *
 * @author User
 */
class ModelObavestenje_Opomena extends CI_Model {
    
    public function dodajObavestenjeOpomenu($vlasnikId, $stanarId, $naslov, $tekst, $tip){
        $this->db->set("IDVlasnika", $vlasnikId);
        $this->db->set("IDStanara", $stanarId);
        $this->db->set("Naslov", $naslov);
        $this->db->set("Tekst", $tekst);
        $this->db->set("Vrsta", $tip);
        $this->db->insert("Obavestenje_opomena");
    }
}
