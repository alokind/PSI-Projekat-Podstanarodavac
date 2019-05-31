<?php


class OglasnaTabla extends CI_Model{
    
    
    public function __construct() {
        parent ::__construct();
    }
    //sa sajta videla ovo
    public function cuvajObavestenje($naslov, $tekst) {
        $query="insert into OglasnaTabla values('$naslov','$tekst')";
	$this->db->query($query);
           // $data = array($naslov, $tekst);
           // $this->db->insert('OglasnaTabla',$data);
             //ako slucano pravi problem sa ovim proveri da li radi autoincrement za primarni kljuc
    }
        public function cuvajObavestenje2($naslov, $tekst) {
        $query="insert into OglasnaTabla values('$naslov','$tekst')";
        $this->db->query($query);
        
        }
}
