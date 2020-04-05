<?php
defined("BASEPATH") or exit("No Direct Access Script");
date_default_timezone_set("Asia/Jakarta");

class M_Formula_attr extends CI_Model{
    private $id_submit_formula_attr = 0;
    private $formula_attr_name = "";
    private $harga_satuan_attr = 0;
    private $satuan_attr = "";
    private $tipe_attr = "";
    private $formula_attr_last_modified = "";
    private $id_last_modified = 0;
    

    public function __construct(){
        parent::__construct();
        $this->formula_attr_last_modified = date("Y-m-d H:i:s");
        $this->id_last_modified = $this->session->id_submit_acc;
    }
    public function list(){
        $where = array(
            "status_formula_attr" => "ACTIVE",
            "tipe_attr" => $this->tipe_attr 
        );
        $field = array(
            "id_submit_formula_attr","formula_attr_name","harga_satuan_attr","satuan_attr","status_formula_attr","formula_attr_last_modified","id_last_modified"
        );
        $result = selectRow("mstr_formula_attr",$where,$field);
        return $result;
    }
    public function detail(){
        $where = array(
            "id_submit_formula_attr" => $this->id_submit_formula_attr
        );
        $field = array(
            "id_submit_formula_attr","formula_attr_name","harga_satuan_attr","satuan_attr","status_formula_attr","formula_attr_last_modified","id_last_modified"
        );
        $result = selectRow("mstr_formula_attr",$where,$field);
        return $result;
    }
    public function insert(){
        $where = array(
            "formula_attr_name" => $this->formula_attr_name,
            "status_formula_attr" => "ACTIVE"
        );
        $field = array(
            "id_submit_formula_attr"
        );
        $result = selectRow("mstr_formula_attr",$where,$field);
        if(!$result->num_rows() > 0){
            $data = array(
                "formula_attr_name" => $this->formula_attr_name,
                "harga_satuan_attr" => $this->harga_satuan_attr,
                "satuan_attr" => $this->satuan_attr,
                "tipe_attr" => $this->tipe_attr,
                "status_formula_attr" => "ACTIVE",
                "formula_attr_last_modified" => $this->formula_attr_last_modified,
                "id_last_modified" => $this->id_last_modified
            );
            return insertRow("mstr_formula_attr",$data);
        }
        else{
            $result = $result->result_array();
            return $result[0]["id_submit_formula_attr"];
        }
    }
    public function update(){
        $where = array(
            "id_submit_formula_attr" => $this->id_submit_formula_attr,
        );
        $data = array(
            "formula_attr_name" => $this->formula_attr_name,
            "harga_satuan_attr" => $this->harga_satuan_attr,
            "satuan_attr" => $this->satuan_attr,
            "formula_attr_last_modified" => $this->formula_attr_last_modified,
            "id_last_modified" => $this->id_last_modified
        );
        updateRow("mstr_formula_attr",$data,$where);
        return true;
    }
    public function delete(){
        $where = array(
            "id_submit_formula_attr" => $this->id_submit_formula_attr
        );
        $data = array(
            "status_formula_attr" => "NOT ACTIVE",
            "formula_attr_last_modified" => $this->formula_attr_last_modified,
            "id_last_modified" => $this->id_last_modified
        );
        updateRow("mstr_formula_attr",$data,$where);
        return true;
    }
    #setter & #getter
    public function set_id_submit_formula_attr($id_submit_formula_attr = ""){
        if($id_submit_formula_attr != "" && is_numeric($id_submit_formula_attr)){
            $this->id_submit_formula_attr = $id_submit_formula_attr;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_formula_attr_name($formula_attr_name = ""){
        if($formula_attr_name != ""){
            $this->formula_attr_name = $formula_attr_name;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_harga_satuan_attr($harga_satuan_attr = ""){
        if($harga_satuan_attr != "" && is_numeric($harga_satuan_attr)){
            $this->harga_satuan_attr = $harga_satuan_attr;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_satuan_attr($satuan_attr = ""){
        if($satuan_attr != ""){
            $this->satuan_attr = $satuan_attr;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_tipe_attr($tipe_attr = ""){
        if($tipe_attr != ""){
            $this->tipe_attr = $tipe_attr;
            return true;
        }
        else{
            return false;
        }
    }
    public function get_id_submit_formula_attr(){
        return $this->id_submit_formula_attr;
    }
    public function get_formula_attr_name(){
        return $this->formula_attr_name;
    }
    public function get_harga_satuan_attr(){
        return $this->harga_satuan_attr;
    }
    public function get_satuan_attr(){
        return $this->satuan_attr;
    }
    public function get_tipe_attr(){
        return $this->tipe_attr;
    }
}