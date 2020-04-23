<?php
defined("BASEPATH") or exit("No Direct Script");
date_default_timezone_set("Asia/Jakarta");

class M_belanja extends CI_Model{
    private $tbl_name = "tbl_blnj_project";
    private $id_submit_belanja = 0;
    private $id_project = 0;
    private $id_item = 0; /*item = formula attribute*/
    private $id_supplier = 0;
    private $pengeluaran = 0;
    private $blnj_last_modified = "";
    private $id_last_modified = 0;

    public function __construct(){
        parent::__construct();
        $this->blnj_last_modified = date("Y-m-d H:i:s");
        $this->id_last_modified = $this->session->id_submit_acc;
    }
    public function list_belanja_project(){
        $query = "SELECT id_submit_belanja, id_project,id_item, id_supplier,pengeluaran,blnj_status,blnj_last_modified,prj_name, formula_attr_name,nama_supp 
            FROM tbl_blnj_project
            INNER JOIN mstr_project ON mstr_project.id_submit_project = tbl_blnj_project.id_project
            INNER JOIN mstr_formula_attr ON mstr_formula_attr.id_submit_formula_attr = tbl_blnj_project.id_item
            INNER JOIN mstr_supplier ON mstr_supplier.id_submit_supplier = tbl_blnj_project.id_supplier
            WHERE blnj_status = 'ACTIVE'
            AND id_project = ?;";
        $args = array($this->id_project);
        $result = executeQuery($query,$args);
        return $result;
    }
    public function insert(){
        $data = array(
            "id_project" => $this->id_project,
            "id_item" => $this->id_item,
            "id_supplier" => $this->id_supplier,
            "pengeluaran" => $this->pengeluaran,
            "blnj_status" => "ACTIVE",
            "blnj_last_modified" => $this->blnj_last_modified,
            "id_last_modified" => $this->id_last_modified
        );
        return insertRow($this->tbl_name,$data);
    }
    public function update(){
        $where = array(
            "id_submit_belanja" => $this->id_submit_belanja
        );
        $data = array(
            "id_item" => $this->id_item,
            "id_supplier" => $this->id_supplier,
            "pengeluaran" => $this->pengeluaran,
            "blnj_last_modified" => $this->blnj_last_modified,
            "id_last_modified" => $this->id_last_modified
        );
        updateRow($this->tbl_name,$data,$where);
    }
    public function delete(){
        $where = array(
            "id_submit_belanja" => $this->id_submit_belanja
        );
        $data = array(
            "blnj_status" => "NOT ACTIVE",
            "blnj_last_modified" => $this->blnj_last_modified,
            "id_last_modified" => $this->id_last_modified
        );
        updateRow($this->tbl_name,$data,$where);
    }
    public function set_id_submit_belanja($id_submit_belanja){
        if($id_submit_belanja != "" && is_numeric($id_submit_belanja)){
            $this->id_submit_belanja = $id_submit_belanja;
        }
        else{
            return false;
        }
    }
    public function set_id_project($id_project){
        if($id_project != "" && is_numeric($id_project)){
            $this->id_project = $id_project;
        }
        else{
            return false;
        }
    }
    public function set_id_item($id_item){
        if($id_item != "" && is_numeric($id_item)){
            $this->id_item = $id_item;
        }
        else{
            return false;
        }
    }
    public function set_id_supplier($id_supplier){
        if($id_supplier != "" && is_numeric($id_supplier)){
            $this->id_supplier = $id_supplier;
        }
        else{
            return false;
        }
    }
    public function set_pengeluaran($pengeluaran){
        if($pengeluaran != "" && is_numeric($pengeluaran)){
            $this->pengeluaran = $pengeluaran;
        }
        else{
            return false;
        }
    }
    public function get_id_submit_belanja(){
        return $this->id_submit_belanja;
    }
    public function get_id_project(){
        return $this->id_project;
    }
    public function get_id_item(){
        return $this->id_item;
    }
    public function get_id_supplier(){
        return $this->id_supplier;
    }
    public function get_pengeluaran(){
        return $this->pengeluaran;
    }
}