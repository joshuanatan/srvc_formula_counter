<?php
defined("BASEPATH") or exit("No Direct Access Script");
date_default_timezone_set("Asia/Jakarta");

class M_Formula_attr extends CI_Model{
    public function insert($attr_name = "",$id_last_modified = ""){
        $test = array(
            $attr_name,$id_last_modified
        );
        if(!in_array("",$test)){
            $data = array(
                "formula_attr_name" => $attr_name,
                "status_formula_attr" => "ACTIVE",
                "formula_attr_last_modified" => date("Y-m-d H:i:s"),
                "id_last_modified" => $id_last_modified
            );
            return insertRow("mstr_formula_attr",$data);
        }
        else{
            return false;
        }
    }
    public function execute(){

    }
    public function replace_formula(){
        //mengganti variabel dengan argumen yang dikirimkan

    }
    public function insert_attr_combination($id_formula = "",$id_attr = "",$comb_formula = ""){
        $test = array(
            $id_formula,$id_attr,$comb_formula
        );
        if(!in_array("",$test)){
            $data = array(
                "id_mstr_formula" => $id_formula,
                "id_formula_attr" => $id_attr,
                "combination_formula" => $comb_formula
            );
            return insertRow("tbl_formula_combination",$data);
        }
        else{
            return false;
        }
    }
    public function update_formula(){

    }
    public function remove_attr_combination(){

    }
}