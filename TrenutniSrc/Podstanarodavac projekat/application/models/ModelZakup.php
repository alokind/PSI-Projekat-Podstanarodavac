<?php

/*
 * @author Nikola Dimitrijević 0597/2016
 * @author Boško Ćurčin 0549/2016
 */

/*
 * ModelZakup - klasa koja opslužuje zahteve za upis i čitanje iz baze,
 * iz entiteta Zakup
 * 
 * @version 2.0
 */

class ModelZakup extends CI_Model{
    
	//Konstruktor
    public function __construct() {
        parent::__construct();
    }
    
    /*
        Funkcija koja mi sluzi da proverim da li je vlasnik 
        kreirao ugovor koji podstanar moze da prihvati ili odbije.
		
		@param int $podstanarID IDPodstanara
		
		@return boolean
     */
    public function kreiranZahtev($podstanarID){
       $result=$this->db->where('IDStanara',$podstanarID)->get('Zakup'); //Pretpostavka da imam samo 1 red u zakupu
       $ugovor=$result->row();
        if ($ugovor!=NULL) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
	/*
		Funkcija kojom za ulogu Podstanara, u bazi
		označavam da li sam prihvatio ili odbio stan
		
		@param int $podstanarID IDStanara
		@param int $prihvacen Prihvacen
	*/
    public function zakupiStan($podstanarID,$prihvacen){
        $this->db->from('zakup');
        $this->db->where("IDStanara",$podstanarID);
        $query = $this->db->get();
        $result = $query->row();
        $vlasnikID = $result->IDVlasnika;
        $this->db->query("UPDATE zakup SET Prihvacen='$prihvacen' WHERE IDVlasnika='$vlasnikID' AND IDStanara='$podstanarID'");
    }
        
    /*
		Fukcija kojom na osnovu idja stanara , generisem ugovor o zakupu
		tako što na osnovu tog idja dohvatam sve ostale potrebne podatke
		
		@param int $podstanarID IDStanara
	*/
    public function izgenerisiUgovor($podstanarID){
        $data=[];
        //Dohvatanje ugovora iz baze:
        $this->db->from('zakup');
        $this->db->where('IDStanara',$podstanarID);
        $query=$this->db->get();
        $result=$query->row(); //Ceo ugovor mi je sad u nizu $result
        //Dohvatanje svih informacija iz jednog reda tabele Ugovor
        $idZ = $result->IDZ;   
        $data['idz']=$idZ;
        $idVlasnika = $result->IDVlasnika;
        $data['idvlasnika']=$idVlasnika;
        $idStanara = $result->IDStanara;
        $data['idstanara']=$idStanara;
        $adresa = $result->AdresaStana;
        $data['adresa']=$adresa;
        $kirija = $result->Kirija;
        $data['kirija']=$kirija;
        $trajanje = $result->TrajanjeZakupa; 
        $data['trajanje']=$trajanje;
        $datum = $result->DatumPocetkaZakupa;
        $data['datum']=$datum;
        $kvadratura = $result->Kvadratura;
        $data['kvadratura']=$kvadratura;
        $prihvacen = $result->Prihvacen;
        $data['prihvacen']=$prihvacen;
        
        //Dohvatanje svih ostalih informaciaj iz tabele Korisnik //Za vlasnika
        $this->db->from('korisnik');
        $this->db->where('IDK',$idVlasnika);
        $query=$this->db->get();
        $result=$query->row();
        $imeVlasnik = $result->Ime; $data['imeV']=$imeVlasnik;
        $ulicaVlasnik = $result->Adresa; $data['ulicaV']=$ulicaVlasnik;
        
        //Dohvatanje svih ostalih informaciaj iz tabele Korisnik
        $this->db->from('korisnik');
        $this->db->where("IDK",$idStanara);
        $query=$this->db->get();
        $result=$query->row();
        $imePodstanar = $result->Ime; $data['imeP']=$imePodstanar;
        $ulicaPodstanar = $result->Adresa;  $data['ulicaP']=$ulicaPodstanar;
        
         $this->load->helper('pdf_helper');
        
            
         $this->load->view('pdfreport',$data);
    }
    
    /*
     * Funkcija koja unosi u bazu novu instancu zakupa
     * 
     * @param int $vlasnikId IDVlasnika
     * @param int $stanarId IDStanara
     * @param string $adresaStana AdresaStana
     * @param int $kirija Kirija
     * @param int $duzinaZakupa TrajanjeZakupa
     * @param Date $datumPocetkaZakupa DatumPocetkaZakupa
     * @param int $kvadratura Kvadratura
     */
    public function dodaj($vlasnikId, $stanarId, $adresaStana, $kirija, $duzinaZakupa, $datumPocetkaZakupa, $kvadratura){
        $false = false;
        $this->db->set("IDVlasnika", $vlasnikId);
        $this->db->set("IDStanara", $stanarId);
        $this->db->set("AdresaStana",$adresaStana);
        $this->db->set("Kirija",$kirija);
        $this->db->set("TrajanjeZakupa",$duzinaZakupa);
        $this->db->set("DatumPocetkaZakupa",$datumPocetkaZakupa);
        $this->db->set("Kvadratura",$kvadratura);
        $this->db->set("Prihvacen",false);
        $this->db->insert("Zakup");
   }
   
   /*
    * Funkcija koja proverava da li je dati Vlasnik vec izdao stan datom Stanaru
    * 
    * @param int $vlasnikId IDVlasnika
    * @param int $stanarId IDStanara
    * 
    * @return bool
    */
   public function vecIzdatTomPodstanaru($vlasnikId, $stanarId){
        $this->db->where('IDVlasnika',$vlasnikId);
        $this->db->where("IDStanara", $stanarId);
        $this->db->from("Zakup");
        $query = $this->db->get();
        $row = $query->row();
        if (isset($row)) {
            return TRUE;
        } else {
            return FALSE;
        }
   }
   
   /*
    * Funkcija koja dohvata sve podstanare koji su prihvatili zakup stana sa Vlasnikom
    * i parsira ih za prikazvanje u slect-u u html-u
    * 
    * @param int $idStanodavac IDVlasnika
    * 
    * @return String
    */
    public function dohvatiPodstanare($idStanodavac=NULL){
        if ($idStanodavac == NULL) {
            return null;
        }
        $this->db->where("IDVlasnika", $idStanodavac);
        $this->db->where("Prihvacen", true);
        $this->db->from("Zakup");
        $this->db->join('Korisnik', 'Korisnik.IDK = Zakup.IDStanara');
        $query = $this->db->get();
        $result = $query->result();
        
        $podstanari['ime'] = [];
        $podstanari['value'] = [];
        foreach ($result as $podstanar) {
            array_push($podstanari['ime'], "".$podstanar->Ime." ".$podstanar->Prezime." (".$podstanar->Mail.")");
            array_push($podstanari['value'], $podstanar->IDK);
        }
        return $podstanari;
    }
    
    /*
     * Funkcija koja dohvata idVlasnika za dati idStanra
     * 
     * @param int $stanarId IDStanara
     * 
     * @return int
     */
    public function dohvatiIdVlasnika($idStanar=NULL){
        if ($idStanar == NULL) {
            return null;
        }
        $this->db->where("IDStanara", $idStanar);
        $this->db->from("Zakup");
        $query = $this->db->get();
        $row = $query->row();
        
        return $row->IDVlasnika;
    }
    
    /*
     * Funkcija koja dohvata instancu zakupa na osnovu prosledjenih idVlasnika i
     * idStanara
     * 
     * @param int $vlasnikId IDVlasnika
     * @param int $stanarId IDStanara
     * 
     * @return string[]
     */
    public function dohvatiZakupById($vlasnikId, $stanarId){
        $this->db->where('IDVlasnika',$vlasnikId);
        $this->db->where("IDStanara", $stanarId);
        $this->db->from("Zakup");
        $query = $this->db->get();
        $row = $query->row();
        return $row;
    }
    
    /*
		Funckija kojom za Stanara proveravam da li mi je Vlasnik 
		poslao novi ugovor koji mogu da prihvatim ili odbijem,
		
		@param int $podstanarID IDStanara
		
		@return boolean
	*/
    public function ugovorPrihvacen($podstanarID){
        $this->db->where("IDStanara", $podstanarID);
        $this->db->from("Zakup");
        $query = $this->db->get();
        $row = $query->row();
        if ($row == null) {
            return false;
        }
        $prihvacen = $row->Prihvacen;
        if($prihvacen == 0){
            return false;
        }
        else{
            return true;
        }
    }
    
    /*
		Funkcija kojom za Stanara proveravam da li mi je Vlasnik 
		poslao novi ugovor koji mogu da prihvatim ili odbijem
	
		@param int $podstanarID IDStanara
		
		@return boolean
	*/
    public function postojiUgovorZaStanara($podstanarID){
        $this->db->where("IDStanara", $podstanarID);
        $this->db->from("Zakup");
        $query = $this->db->get();
        $row = $query->row();
        if($row == null){
            return false;
        }
        else{
            return true;
        }
    }
}
