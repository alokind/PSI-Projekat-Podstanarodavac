<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelOglasnaTabla
 *
 * @author Bosko
 */
class ModelOglasnaTabla extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    //Bojanine metode://--------------------------------------------------------------------------
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
