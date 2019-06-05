<?php

/*
 * @author Nikola Dimitrijević 0597/2016
 */

/*
 * ModelObavestenje_Opomena - klasa koja opslužuje zahteve za upis i čitanje iz baze,
 * iz entiteta Obavestenje_Opomena
 * 
 * @version 2.0
 *
 */
class ModelObavestenje_Opomena extends CI_Model {
    
    /*
     * Funkcija koja unosi u bazu novu instancu Obavestenje_Opomene
     * 
     * @param int $vlasnikId IDVlasnika
     * @param int $stanarId IDStanara
     * @param string $naslov Naslov
     * @param string $tekst Tekst
     * @param string $tip Tip
     */
    public function dodajObavestenjeOpomenu($vlasnikId, $stanarId, $naslov, $tekst, $tip){
        $this->db->set("IDVlasnika", $vlasnikId);
        $this->db->set("IDStanara", $stanarId);
        $this->db->set("Naslov", $naslov);
        $this->db->set("Tekst", $tekst);
        $this->db->set("Vrsta", $tip);
        $this->db->insert("Obavestenje_opomena");
    }
    
    
    /*
     * Funkcija koja dohvata sva obavestenja/opomene koji su poslati stanaru sa
     * prosledjenim id-jem i parsira ih za adekvatno prikazivanje frontend-u
     * 
     * @param int $IDStanara IDStanara
     * 
     */
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
    
    /* Funkcija koja briše Obavestenje sa prosleđenim id-jem iz baze
     * 
     * @param int $IDO IDO
     */
    public function obrisiObavestenje($IDO){
        $this->db->where('IDO', $IDO);
        $this->db->delete('Obavestenje_opomena');
    } 
}
