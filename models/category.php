<?php

class category extends model{
    
    
    public function get_category(){
        $sql = $this->db->prepare("SELECT *FROM categorias ");
        $sql->execute();

        $array = array();
        if ($sql->rowcount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
}
