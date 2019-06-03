<?php



/**
 * Description of ModelZakup
 *
 * @author Bosko
 */
class ModelZakup extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    /*
     *  Pomocna funkcija koja mi sluzi da proverim da li je vlasnik 
     *  kreirao ugovor koji podstanar moze da prihvati ili odbije.
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
    
    
    public function zakupiStan($podstanarID,$prihvacen){
        $this->db->from('zakup');
        $this->db->where("IDStanara",$podstanarID);
        $query = $this->db->get();
        $result = $query->row();
        $vlasnikID = $result->IDVlasnika;
        $this->db->query("UPDATE zakup SET Prihvacen='$prihvacen' WHERE IDVlasnika='$vlasnikID' AND IDStanara='$podstanarID'");
    }
        
    
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
        ////FIX THIS!
        //$trajanje = 1;
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
   
    public function dohvatiPodstanare($idStanodavac=NULL){
        if ($idStanodavac == NULL) {
            return null;
        }
        $this->db->where("IDVlasnika", $idStanodavac);
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
    
    public function dohvatiZakupById($vlasnikId, $stanarId){
        $this->db->where('IDVlasnika',$vlasnikId);
        $this->db->where("IDStanara", $stanarId);
        $this->db->from("Zakup");
        $query = $this->db->get();
        $row = $query->row();
        return $row;
    }
    
    //Proveravam da li mi je vlasnik poslao novi ugovor koji mogu da prihvatim ili odbijem
    public function ugovorPrihvacen($podstanarID){
        $this->db->where("IDStanara", $podstanarID);
        $this->db->from("Zakup");
        $query = $this->db->get();
        $row = $query->row();
        $prihvacen = $row->Prihvacen;
        if($prihvacen == 0){
            return false;
        }
        else{
            return true;
        }
    }
    
    //Proveravam da li mi je vlasnik poslao novi ugovor koji mogu da prihvatim ili odbijem
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
