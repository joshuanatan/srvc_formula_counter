<?php
defined("BASEPATH") or exit("No Direct Script");
date_default_timezone_set("Asia/Jakarta");

class M_Rab extends CI_Model{
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
        select id_submit_rab,id_project,id_formula,satuan_htg,rab_last_modified,formula_name, formula_desc, formula_last_modified 
        from tbl_project_rab
        inner join mstr_formula on mstr_formula.id_submit_formula = tbl_project_rab.id_formula
        where status_rab = 'ACTIVE' and id_project = ?";
        $args = array(
            $this->id_project   
        );
        $result = executeQuery($query,$args);
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