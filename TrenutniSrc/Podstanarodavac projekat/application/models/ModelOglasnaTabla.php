<?php

/*
 * @author Nikola Dimitrijević 0597/2016
 * @author Bosko
 * 
 */

/*
 * 
 * ModelOglasnaTabla - klasa koja opslužuje zahteve za upis i čitanje iz baze,
 * iz entiteta OglasnaTabla
 * 
 * @version 2.0
 * 
 */
class ModelOglasnaTabla extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    //Bojanine metode://--------------------------------------------------------------------------
    //sa sajta videla ovo
    public function cuvajObavestenje($naslov, $tekst, $IDVlasnika) {
        $data = array('Naslov'=>$naslov,'Tekst'=> $tekst, 'IDVlasnika'=> $IDVlasnika);
        $this->db->insert('oglasna_tabla',$data);
    }
    
    public function cuvajObavestenjeStanar($naslov, $tekst, $IDStanara) {
        $this->db->where("IDStanara", $IDStanara);
        $this->db->from("zakup");
        
        $query = $this->db->get();
        $result = $query->row();
        $VlasnikID = $result->IDVlasnika;
        
        $data = array('Naslov'=>$naslov,'Tekst'=> $tekst, 'IDVlasnika'=> $VlasnikID);
        $this->db->insert('oglasna_tabla',$data);
    }
    
    /*
     * Funkcija koja dohvata sve stvari sa OGlasne table koji su okačeni
     * na oglasnu tablu vlasnika sa prosleđenim ID-jem
     * i parsira ih za adekvatno prikazivanje frontend-u
     * 
     * @param int $IDVlasnika IDVlasnika
     * 
     */
    public function dohvatiObavestenjaIDVlasnika($IDVlasnika){
        if ($IDVlasnika == NULL) {
            return null;
        }
        $this->db->where("IDVlasnika", $IDVlasnika);
        $this->db->from("oglasna_tabla");
        $query = $this->db->get();
        $result = $query->result();
        
        $stvariNaOglasnojTabli = '';
        foreach ($result as $row) {
            $stvariNaOglasnojTabli .= 
                                        '<div class=" col-lg-3 col-md-4 col-sm-6 mb-4">'.
                                                '<div class="card h-50 w-80">'.
                                                  '<div class="card-body">'.
                                                        '<h4 class="card-title">'.
                                                            '<button type="submit" name="obrisi" class="close" aria-label="Close" value="'.$row->IDO.'">'.
                                                              '<span aria-hidden="true" title="Uklonite sa oglasne table">&times;</span>'.
                                                            '</button>'.
                                                          $row->Naslov.
                                                        '</h4>'.
                                                        '<hr>'.
                                                        '<p class="card-text" align="center">'.
                                                                $row->Tekst.
                                                        '</p>'.
                                                  '</div>'.
                                                '</div>'.
                                        '</div>';
        }
        return $stvariNaOglasnojTabli;
    }
    
         public function dohvatiObavestenjaIDStanara($IDStanara){
        if ($IDStanara == NULL) {
            return null;
        }
        $this->db->where("IDStanara", $IDStanara);
        $this->db->from("oglasna_tabla");
        $query = $this->db->get();
        $result = $query->result();
        
        $stvariNaOglasnojTabli = '';
        foreach ($result as $row) {
            $stvariNaOglasnojTabli .= 
                                        '<div class=" col-lg-3 col-md-4 col-sm-6 mb-4">'.
                                                '<div class="card h-50 w-80">'.
                                                  '<div class="card-body">'.
                                                        '<h4 class="card-title">'.
                                                          $row->Naslov.
                                                        '</h4>'.
                                                        '<hr>'.
                                                        '<p class="card-text" align="center">'.
                                                                $row->Tekst.
                                                        '</p>'.
                                                  '</div>'.
                                                '</div>'.
                                        '</div>';
        }
        return $stvariNaOglasnojTabli;
    }
    
    /*
     * Funkcija koja briše Oglas sa prosleđenim id-jem iz baze
     * 
     * @param int $IDO IDO
     */
    public function obrisiOglas($IDO){
        $this->db->where('IDO', $IDO);
        $this->db->delete('oglasna_tabla');
    }

}
