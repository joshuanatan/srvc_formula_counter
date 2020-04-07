<?php
defined("BASEPATH") or exit("No Direct Script Access is Allowed");
date_default_timezone_set("Asia/Jakarta");

class M_formula extends CI_Model{
    private $id_submit_formula = 0;
    private $id_formula_cat = 0;
    private $formula_desc = ""; 
    private $formula_last_modified = "";
    private $id_last_modified = 0;
    
    public function __construct(){
        parent::__construct();
        $this->formula_last_modified = date("Y-m-d H:i:s");
        $this->id_last_modified = $this->session->id_submit_acc;
    }
    public function list(){
        $where = array(
            "id_formula_cat" => $this->id_formula_cat,
            "formula_status" => "ACTIVE" 
        );
        $field = array(
            "formula_desc","formula_status","formula_last_modified","id_submit_formula"
        );
        $result = selectRow("mstr_formula",$where,$field);
        return $result;
    }
    public function detail(){
        $where = array(
            "id_submit_formula" => $this->id_submit_formula,
        );
        $field = array(
            "id_submit_formula","formula_desc"
        );
        $result = selectRow("mstr_formula",$where,$field);
        return $result;
    }
    public function insert(){
        $where = array(
            "id_formula_cat" => $this->id_formula_cat,
            "formula_desc" => $this->formula_desc
        );
        $field = array(
            "id_submit_formula"
        );
        $result = selectRow("mstr_formula",$where,$field);
        if(!$result->num_rows() > 0){
            $data = array(
                "id_formula_cat" => $this->id_formula_cat,
                "formula_desc" => $this->formula_desc,
                "formula_status" => "ACTIVE",
                "formula_last_modified" => $this->formula_last_modified,
                "id_last_modified" => $this->id_last_modified
            );
            return insertRow("mstr_formula",$data);
        }
        else{
            $result = $result->result_array();
            return $result[0]["id_submit_formula"];
        }
    }
    public function update(){
        $where = array(
            "id_submit_formula !=" => $this->id_submit_formula,
            "id_formula_cat" => $this->id_formula_cat,
            "formula_desc" => $this->formula_desc
        );
        if(!isExistsInTable("mstr_formula",$where)){
            $where = array(
                "id_submit_formula" => $this->id_submit_formula
            );
            $data = array(
                "formula_desc" => $this->formula_desc,
                "formula_last_modified" => $this->formula_last_modified,
                "id_last_modified" => $this->id_last_modified
            );
            updateRow("mstr_formula",$data,$where);
            return true;
        }
        else{
            return false;
        }
    }
    public function delete(){
        $where = array(
            "id_submit_formula" => $this->id_submit_formula
        );
        $data = array(
            "formula_status" => "NOT ACTIVE" ,
            "formula_last_modified" => $this->formula_last_modified,
            "id_last_modified" => $this->id_last_modified
        );
        updateRow("mstr_formula",$data,$where);
        return true;
    }
    #setter & getter
    public function set_id_submit_formula($id_submit_formula = ""){
        if($id_submit_formula != "" && is_numeric($id_submit_formula)){
            $this->id_submit_formula = $id_submit_formula;
            return true;
        }   
        else{
            return false;
        }
    }
    public function set_formula_desc($formula_desc = ""){
        if($formula_desc != ""){
            $this->formula_desc = $formula_desc;
            return true;
        }   
        else{
            return false;
        }
    }
    public function set_id_formula_cat($id_formula_cat = ""){
        if($id_formula_cat != "" && is_numeric($id_formula_cat)){
            $this->id_formula_cat = $id_formula_cat;
            return true;
        }
        else{
            return false;
        }
    }
    public function get_id_submit_formula(){
        return $this->id_submit_formula;

    }
    public function get_formula_desc(){
        return $this->formula_desc;

    }
    public function get_id_formula_cat(){
        return $this->id_formula_cat;
    }
}
?>