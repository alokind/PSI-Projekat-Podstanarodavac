<?php

/*
 * @author Nikola Dimitrijević 0597/2016
 * 
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
      /*
     * Funkcija koja unosi u bazu novu unete podatke iz oglasne table
     * 
     * @param int $IDVlasnika IDVlasnika
     * @param string $naslov Naslov
     * @param string $tekst Tekst
     * kako ne bih cuvala u bazu polje po polje sacuvala sam u niz pa onda prosledila ceo niz sa podacima u bazu 
     */
    public function cuvajObavestenje($naslov, $tekst, $IDVlasnika) {
        $data = array('Naslov'=>$naslov,'Tekst'=> $tekst, 'IDVlasnika'=> $IDVlasnika);
        $this->db->insert('oglasna_tabla',$data);
    }
     /*
     * Funkcija koja cuva podatke koje je uneo stanar na adekvatnu oglasnu tablu
     * @param int $VlasnikID IDVlasnika
     * @param string $naslov Naslov
     * @param string $tekst Tekst
     * takodje ih cuva u niz data pa onda ceo niz insertuje. 
     * Naravno, pre toga je potrebno da te podatke cuva na adekvatnoj oglasnoj tabli, 
     * odnosno, na onoj gde je njegov vlasnik sa svojim podstanarima. Da bih utvrdila tu relaciju, da taj podstanar
     * ogovara bas tom stanodavcu moram to da pokupim iz tabele zakup.
     */
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
     * Funkcija koja dohvata sve stvari sa Oglasne table koji su okačeni
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
     /*
     * Funkcija koja dohvata sve stvari sa Oglasne table koji su okačeni
     * na oglasnu tablu stanara sa prosleđenim ID-jem
     * i parsira ih za adekvatno prikazivanje frontend-u
     * 
     * @param int $IDStanara IDStanara
     * 
     */
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
