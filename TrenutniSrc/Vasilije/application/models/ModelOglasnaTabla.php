<?php

/**
 * Description of ModelOglasnaTabla
 *
 * @author bojanakri
 */
class ModelOglasnaTabla extends CI_Model{
  public function __construct() {
        parent ::__construct();
    }
    //sa sajta videla ovo
    public function cuvajObavestenje($naslov, $tekst) {
        
          $data = array('IDO'=>'3', 'Naslov'=>$naslov,'Tekst'=> $tekst);
            $this->db->insert('oglasna_tabla',$data);
        
    }
        public function cuvajObavestenje2($naslov, $tekst) {
        $query="insert into oglasna_tabla values('4',$naslov,$tekst)";
        $this->db->query($query);
        }
      
}
