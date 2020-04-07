<?php
defined("BASEPATH") or exit("No Direct Script Access is Allowed");
date_default_timezone_set("Asia/Jakarta");

class M_formula_cat extends CI_Model{
    private $tbl_name = "mstr_formula_cat";
    private $id_submit_formula_cat = 0;
    private $formula_cat_name = "";
    private $formula_cat_last_modified = "";
    private $id_last_modified = 0;

    public function __construct(){
        parent::__construct();
        $this->formula_cat_last_modified = date("Y-m-d H:i:s");
        $this->id_last_modified = $this->session->id_submit_acc;
    }
    public function list(){
        $where = array(
            "status_formula_cat" => "ACTIVE"
        );
        $field = array(
            "id_submit_formula_cat","formula_cat_name","status_formula_cat","formula_cat_last_modified"
        );
        $result = selectRow($this->tbl_name, $where,$field);
        return $result;
    }
    public function insert(){
        $where = array(
            "formula_cat_name" => $this->formula_cat_name,
            "status_formula_cat" => "ACTIVE"
        );
        if(!isExistsInTable($this->tbl_name,$where)){
            $data = array(
                "formula_cat_name" => $this->formula_cat_name,
                "status_formula_cat" => "ACTIVE",
                "formula_cat_last_modified" => $this->formula_cat_last_modified, 
                "id_last_modified" => $this->id_last_modified,
            );
            $id_subformula = insertRow($this->tbl_name,$data);
            return $id_subformula;
        }
        else{
            return false;
        }
    }
    public function update(){
        $where = array(
            "id_submit_formula_cat !=" => $this->id_submit_formula_cat,
            "formula_cat_name" => $this->formula_cat_name,
            "status_formula_cat" => "ACTIVE",
        );
        if(!isExistsInTable($this->tbl_name,$where)){
            $where = array(
                "id_submit_formula_cat" => $this->id_submit_formula_cat
            );
            $data = array(
                "formula_cat_name" => $this->formula_cat_name,
                "formula_cat_last_modified" => $this->formula_cat_last_modified, 
                "id_last_modified" => $this->id_last_modified,
            );
            updateRow($this->tbl_name,$data,$where);
            return true;
        }
        else{
            return false;
        }
    }
    public function delete(){
        $where = array(
            "id_submit_formula_cat" => $this->id_submit_formula_cat
        );
        $data = array(
            "status_formula_cat" => "NOT ACTIVE",
            "formula_cat_last_modified" => $this->formula_cat_last_modified, 
            "id_last_modified" => $this->id_last_modified,
        );
        updateRow($this->tbl_name,$data,$where);
        return true;
    }
    public function set_formula_cat_name($formula_cat_name){
        if($formula_cat_name != ""){
            $this->formula_cat_name = $formula_cat_name;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_id_submit_formula_cat($id_submit_formula_cat){
        if($id_submit_formula_cat != "" && is_numeric($id_submit_formula_cat)){
            $this->id_submit_formula_cat = $id_submit_formula_cat;
            return true;
        }
        else{
            return false;
        }
    }
    public function get_formula_cat_name(){
        return $this->formula_cat_name;
    }
    public function get_id_submit_formula_cat(){
        return $this->id_submit_formula_cat;
    }
}
?>