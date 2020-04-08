<?php
defined("BASEPATH") or exit("No Direct Script");
date_default_timezone_set("Asia/Jakarta");

class M_rab extends CI_Model{
    private $id_submit_rab = 0;
    private $id_formula = 0;
    private $id_project = 0;
    private $satuan_htg = 0.0;
    private $rab_last_modified = "";
    private $id_last_modified = 0;

    public function __construct(){
        parent::__construct();
        $this->rab_last_modified = date("Y-m-d H:i:s");
        $this->id_last_modified = $this->session->id_submit_acc;
    }
    public function list(){ 
        $query = "
        select id_submit_rab, id_formula, formula_desc, satuan_htg, formula_cat_name,id_formula_cat 
        from tbl_project_rab
        inner join mstr_formula on mstr_formula.id_submit_formula = tbl_project_rab.id_formula
        inner join mstr_formula_cat on mstr_formula_cat.id_submit_formula_cat = mstr_formula.id_formula_cat
        where status_rab = 'ACTIVE' and id_project = ?";
        $args = array(
            $this->id_project   
        );
        $result = executeQuery($query,$args);
        return $result;
    }
    public function detail_rab(){
        $sql = "select id_submit_rab,id_formula,id_project,satuan_htg,id_submit_formula,formula_cat_name,formula_desc,id_formula_attr,koefisien,formula_attr_name, tipe_attr, harga_satuan_attr, satuan_attr, round((satuan_htg*koefisien),6) as jumlah_unit, round(satuan_htg*harga_satuan_attr*koefisien,2) as harga_satuan
        from tbl_project_rab
        inner join mstr_formula on mstr_formula.id_submit_formula = tbl_project_rab.id_formula
        inner join mstr_formula_cat on mstr_formula_cat.id_submit_formula_cat = mstr_formula.id_formula_cat
        inner join tbl_formula_combination on tbl_formula_combination.id_mstr_formula = mstr_formula.id_submit_formula
        inner join mstr_formula_attr on mstr_formula_attr.id_submit_formula_attr = tbl_formula_combination.id_formula_attr
        where status_rab = 'ACTIVE' and formula_status = 'ACTIVE' and status_formula_comb = 'ACTIVE' and status_formula_attr = 'ACTIVE'
        and id_project = ?
        order by formula_cat_name,formula_desc,tipe_attr";
        $args = array(
            $this->id_project
        );
        $result = executeQuery($sql,$args);
        return $result;
    }
    public function insert(){
        $where = array(
            "id_project" => $this->id_project,
            "id_formula" => $this->id_formula,
            "status_rab" => "ACTIVE"
        );
        if(isExistsInTable("tbl_project_rab",$where)){
            return false;
        }
        else{
            $data = array(
                "id_project" => $this->id_project,
                "id_formula" => $this->id_formula,
                "satuan_htg" => $this->satuan_htg,
                "status_rab" => "ACTIVE",
                "rab_last_modified" => $this->rab_last_modified,
                "id_last_modified" => $this->id_last_modified
            );
            return insertRow("tbl_project_rab",$data);
        }
    }
    public function update(){
        $where = array(
            "id_submit_rab !=" => $this->id_submit_rab,
            "id_formula" => $this->id_formula,
            "id_project" => $this->id_project,
            "status_rab" => "ACTIVE"
        );
        if(isExistsInTable("tbl_project_rab",$where)){
            //return $where;
            return false;
        }
        else{
            $where = array(
                "id_submit_rab" => $this->id_submit_rab
            );
            $data = array(
                "id_formula" => $this->id_formula,
                "satuan_htg" => $this->satuan_htg,
                "rab_last_modified" => $this->rab_last_modified,
                "id_last_modified" => $this->id_last_modified
            );
            updateRow("tbl_project_rab",$data,$where);
            return true;
        }
    }
    public function delete(){
        $where = array(
            "id_submit_rab" => $this->id_submit_rab
        );
        $data = array(
            "status_rab" => "NOT ACTIVE",
            "rab_last_modified" => $this->rab_last_modified,
            "id_last_modified" => $this->id_last_modified
        );
        updateRow("tbl_project_rab",$data,$where);
        return true;
    }
    #setter & getter
    public function set_id_submit_rab($id_submit_rab){
        if($id_submit_rab != "" && is_numeric($id_submit_rab)){
            $this->id_submit_rab = $id_submit_rab;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_id_formula($id_formula){
        if($id_formula != "" && is_numeric($id_formula)){
            $this->id_formula = $id_formula;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_id_project($id_project){
        if($id_project != "" && is_numeric($id_project)){
            $this->id_project = $id_project;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_satuan_htg($satuan_htg){
        if($satuan_htg != "" && is_numeric($satuan_htg)){
            $this->satuan_htg = $satuan_htg;
            return true;
        }
        else{
            return false;
        }
    }
    public function get_id_submit_rab(){
        return $this->id_submit_rab;
    }
    public function get_id_formula(){
        return $this->id_formula;
    }
    public function get_id_project(){
        return $this->id_project;
    }
    public function get_satuan_htg(){
        return $this->satuan_htg;
    }
}
?>