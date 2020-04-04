<?php
defined("BASEPATH") or exit("No Direct Script");
date_default_timezone_set("Asia/Jakarta");

class M_Formula_comb extends CI_Model{
    private $id_submit_formula_comb = 0;
    private $id_mstr_formula = 0;
    private $id_formula_attr = 0;
    private $koefisien = 0.0;
    private $formula_comb_last_modified = "";
    private $id_last_modified = 0;
    
    public function __construct(){
        parent::__construct();
        $this->formula_comb_last_modified = date("Y-m-d H:i:s");
        $this->id_last_modified = $this->session->id_submit_acc;
    }
    public function unassigned_attr(){
        $sql = "
        select id_submit_formula_attr, formula_attr_name, harga_satuan_attr, satuan_attr, status_formula_attr,formula_attr_last_modified 
        from mstr_formula_attr 
        where status_formula_attr = 'ACTIVE' 
        and id_submit_formula_attr not in(
            select id_formula_attr from tbl_formula_combination
            where status_formula_comb = 'ACTIVE' and id_mstr_formula = ?
        );";
        $args = array(
            $this->id_mstr_formula
        );
        return executeQuery($sql,$args);
    }
    public function insert(){
        $where = array(
            "id_mstr_formula" => $this->id_mstr_formula,
            "id_formula_attr" => $this->id_formula_attr,
            "status_formula_comb" => "ACTIVE"
        );
        if(!isExistsInTable("tbl_formula_combination",$where)){
            $data = array(
                "id_mstr_formula" => $this->id_mstr_formula,
                "id_formula_attr" => $this->id_formula_attr,
                "koefisien" => $this->koefisien,
                "status_formula_comb" => "ACTIVE",
                "formula_comb_last_modified" => $this->formula_comb_last_modified,
                "id_last_modified" => $this->id_last_modified
            );
            return insertRow("tbl_formula_combination",$data);
        }
        else{
            return false;
        }
    }
    public function update(){
        $where = array(
            "id_submit_formula_comb !=" => $this->id_submit_formula_comb, 
            "id_mstr_formula" => $this->id_mstr_formula,
            "id_formula_attr" => $this->id_formula_attr,
        );
        if(isExistsInTable("tbl_formula_combination",$where)){
            return false;
        }
        else{
            $where = array(
                "id_submit_formula_comb" => $this->id_submit_formula_comb,
            );
            $data = array(
                "id_formula_attr" => $this->id_formula_attr,
                "koefisien" => $this->koefisien,
                "formula_comb_last_modified" => $this->formula_comb_last_modified,
                "id_last_modified" => $this->id_last_modified
            );
            updateRow("tbl_formula_combination",$data,$where);
            return true;
        }
    }
    public function delete(){
        $where = array(
            "id_submit_formula_comb" => $this->id_submit_formula_comb,
        );
        $data = array(
            "status_formula_comb" => "NOT ACTIVE",
            "formula_comb_last_modified" => $this->formula_comb_last_modified,
            "id_last_modified" => $this->id_last_modified
        );
        updateRow("tbl_formula_combination",$data,$where);
        return true;
    }
    public function list(){
        $sql = "
        select id_submit_formula_comb, id_formula_attr, koefisien, status_formula_comb, formula_attr_name, harga_satuan_attr,satuan_attr
        from tbl_formula_combination 
        inner join mstr_formula_attr on mstr_formula_attr.id_submit_formula_attr = tbl_formula_combination.id_formula_attr 
        where id_mstr_formula = ? and status_formula_attr = 'ACTIVE' and status_formula_comb = 'ACTIVE'";
        $result = $this->db->query($sql,$this->id_mstr_formula);
        return $result;
    }
    #setter & getter
    public function set_id_submit_formula_comb($id_submit_formula_comb = ""){
        if($id_submit_formula_comb != "" && is_numeric($id_submit_formula_comb)){
            $this->id_submit_formula_comb = $id_submit_formula_comb;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_id_mstr_formula($id_mstr_formula = ""){
        if($id_mstr_formula != "" && is_numeric($id_mstr_formula)){
            $this->id_mstr_formula = $id_mstr_formula;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_id_formula_attr($id_formula_attr = ""){
        if($id_formula_attr != "" && is_numeric($id_formula_attr)){
            $this->id_formula_attr = $id_formula_attr;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_koefisien($koefisien = ""){
        if($koefisien != "" && is_numeric($koefisien)){
            $this->koefisien = $koefisien;
            return true;
        }
        else{
            return false;
        }
    }
    public function get_id_submit_formula_comb(){
        return $this->id_submit_formula_comb;
    }
    public function get_id_mstr_formula(){
        return $this->id_mstr_formula;
    }
    public function get_id_formula_attr(){
        return $this->id_formula_attr;
    }
    public function get_koefisien(){
        return $this->koefisien;
    }
}