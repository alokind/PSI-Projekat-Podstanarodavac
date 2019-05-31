<?php

/**
 * Description of ModelRacun
 *
 * @author bojanakri
 */
class ModelRacun extends CI_Model{
      public function __construct() {
        parent ::__construct();
    }
   
    public function cuvajRacun($data) {
        $this->db->insert('racun',$data);     
    }
     
}
