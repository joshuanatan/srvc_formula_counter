<?php
defined("BASEPATH") or exit("No Direct Script Access is Allowed");

class M_Formula extends CI_Model{
    public function insert($name = "",$desc = "",$id_acc = ""){
        $check = array(
            $name,$desc,$id_acc
        );
        if(!in_array("",$check)){
            $data = array(
                "formula_name" => $name,
                "formula_desc" => $desc,
                "formula_status" => "ACTIVE",
                "formula_last_modified" => date("Y-m-d H:i:s"),
                "id_last_modified" => $id_acc
            );
            return insertRow("mstr_formula",$data);
        }
        else{
            return false;
        }
    }
    public function list(){
        $where = array(
            "formula_status != " => "DELETED" 
        );
        $field = array(
            "formula_name","formula_desc"
        );
        $result = selectRow("mstr_formula",$where,$field);
        return $result;
    }
}
?>