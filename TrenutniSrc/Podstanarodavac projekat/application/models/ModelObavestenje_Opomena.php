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
    
    public function dohvatiObavestenjaIDStanara($IDStanara){
        if ($IDStanara == NULL) {
            return null;
        }
        $this->db->where("IDStanara", $IDStanara);
        $this->db->from("Obavestenje_opomena");
        $this->db->join('Korisnik', 'Korisnik.IDK = Obavestenje_opomena.IDVlasnika');
        $query = $this->db->get();
        $result = $query->result();
        
        $kvarovi = '';
        foreach ($result as $row) {
            if($row->Vrsta == "Obaveštenje"){
                $boja = "primary";
            }
            else{
                $boja = "danger";
            }
            $kvarovi .= 
                                        '<div class="col-lg-3 col-md-4 col-sm-6 mb-4">'.
                                                '<div class="card bg-'.$boja.' text-white h-50 w-80">'.
                                                  '<div class="card-body">'.
                                                        '<h4 class="card-title">'.
                                                            '<button type="submit" name="obrisi" class="close" aria-label="Close" value="'.$row->IDO.'">'.
                                                              '<span aria-hidden="true" title="Uklonite kvar">&times;</span>'.
                                                            '</button>'.
                                                          $row->Naslov.
                                                        '</h4>'.
                                                        '<hr>'.
                                                        '<p class="card-text" align="left">'.
                                                                $row->Tekst.
                                                        '</p>'.
                                                  '</div>'.
                                                '</div>'.
                                        '</div>';
        }
        return $kvarovi;
    }
    
    public function obrisiObavestenje($IDO){
        $this->db->where('IDO', $IDO);
        $this->db->delete('Obavestenje_opomena');
    } 
}
