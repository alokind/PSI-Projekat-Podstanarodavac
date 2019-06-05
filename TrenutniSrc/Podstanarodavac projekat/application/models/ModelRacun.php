<?php

/*
 * @author Nikola Dimitrijević 0597/2016
 * @author Boško Ćurčin 0549/2016
 * 
 */

/*
 * 
 * ModelRacun - klasa koja opslužuje zahteve za upis i čitanje iz baze,
 * iz entiteta Racun
 * 
 * @version 2.0
 */
class ModelRacun extends CI_Model {
    
	//Konstruktor
    public function __construct() {
        parent::__construct();
    }
    
	/*
		Funkcija koja radi izlistavanje svih racuna za
		idPodstanara koji joj je prosledjen
		
		@param int $podstanarID IDStanara
	*/
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
    
    /*
     * Funkcija koja na osnovu prosleđenog ID-ja Vlasnika dohvata iz baze sve racune
     * koje je taj Vlasnik napisao nekom Podstanaru, a koje je ovaj naznačio da je
     * platio, i parsira ih za prikazivanje u frontendu
     * 
     * @param int $IDVlasnika IDVlasnika
     * 
     * @return string
     */
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
            $racuniHtml .= '<option title="'.$row->Mail.'" value="'.$row->IDR.'">'.$row->SvrhaUplate.' ('.$row->Iznos.' din) '.$row->Ime.' '.$row->Prezime.'</option>';
        }
        return $racuniHtml;
   }
   
    /*
     * Funkcija koja na osnovu prosleđenog ID-ja Vlasnika dohvata iz baze sve racune
     * koje je taj Vlasnik napisao nekom Podstanaru, a koje je ovaj naznačio da 
     * NIJE platio, i parsira ih za prikazivanje u frontendu
     * 
     * @param int $IDVlasnika IDVlasnika
     * 
     * @return string
     */
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
            $racuniHtml .= $row->SvrhaUplate.' ('.$row->Iznos.' din)<br>'.$row->Ime.' '.$row->Prezime.'<br> ('.$row->Mail.')<br><hr>';
        }
        return $racuniHtml;
   }
   
    /*
     * Funkcija koja briše racun sa prosleđenim id-jem iz baze
     * 
     * @param int $IDRacun IDRacun
     */
   public function obrisiRacun($IDRacuna){
        if ($IDRacuna == NULL) {
            return null;
        }
        $this->db->where("IDR", $IDRacuna);
        $this->db->delete('Racun');
   }
   
   /*
		Funkcija kojom za Podstanara dohvatam sve
		račune koje on treba da plati. Slična Vlasnikovim funckijama
		uz jedinu razliku u SQL upitu. Isto se radi parsiranje
		zbog lepseg prikaza u frontendu
		
		@param int $IDstanara IDStanara
   */
    public function dohvatiRacune($IDstanara){
        $this->db->where("Placen", 0);
        $this->db->where("IDStanara", $IDstanara);
        $this->db->from("Racun");
        $this->db->join('Korisnik', 'Korisnik.IDK = Racun.IDStanara');
        $query = $this->db->get();

        $result = $query->result();

        //Null -> Stanar nije platio racun
        //1 -> Stanar platio racun
        
        $racuniHtml = '';
        foreach ($result as $row) {
            if($row->Placen != 1){
                $racuniHtml .= '<option value="'.$row->IDR.'">Svrha: '.$row->SvrhaUplate. ' | Poziv na broj: '.$row->PozivNaBroj.' | Žiro-račun: '.$row->ZiroRacun . " | Iznos: ". $row->Iznos.'</option>';
        
            }
        }
     
        return $racuniHtml;
   }
   
   /*
		Funkcija kojom Podstanar označava jedan račun plaćenim 
		na osnovu prosledjenog idja tog racuna
		
		@param int $IDRacuna IDR
   */
    public function oznaciRacun($IDRacuna){
        if ($IDRacuna == NULL) {
            return null;
        }
        $this->db->query("UPDATE racun SET Placen='1' WHERE IDR='$IDRacuna'");
   }
   
}
