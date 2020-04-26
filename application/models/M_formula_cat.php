<?php
defined("BASEPATH") or exit("No Direct Script Access is Allowed");
date_default_timezone_set("Asia/Jakarta");

class M_formula_cat extends CI_Model{
    private $tbl_name = "mstr_formula_cat";
    private $id_submit_formula_cat = 0;
    private $formula_cat_name = "";
    private $formula_cat_last_modified = "";
    private $id_last_modified = 0;
    private $column_list = array();

    public function __construct(){
        parent::__construct();
        $this->formula_cat_last_modified = date("Y-m-d H:i:s");
        $this->id_last_modified = $this->session->id_submit_acc;
        $this->column_list = array(
            array(
                "col_name" => "formula_cat_name",
                "col_disp" => "Kategori Pekerjaan",
                "order_by" => true
            ),
            array(
                "col_name" => "status_formula_cat",
                "col_disp" => "Status Kategori",
                "order_by" => false
            ),
            array(
                "col_name" => "formula_cat_last_modified",
                "col_disp" => "Last Modified",
                "order_by" => false
            ),
        );
    }
    public function column(){
        return $this->column_list;
    }
    public function content($page = 1,$order_by = 0, $order_direction = "ASC", $search_key = "",$data_per_page = ""){
        $order_by = $this->column_list[$order_by]["col_name"];
        $search_query = "";
        if($search_key != ""){
            $search_query .= "AND
            ( 
                id_submit_formula_cat LIKE '%".$search_key."%' OR
                formula_cat_name LIKE '%".$search_key."%' OR
                status_formula_cat LIKE '%".$search_key."%' OR
                formula_cat_last_modified LIKE '%".$search_key."%'
            )";
        }
        $query = "
        SELECT id_submit_formula_cat,formula_cat_name,status_formula_cat,formula_cat_last_modified
        FROM ".$this->tbl_name." 
        WHERE status_formula_cat = ? ".$search_query."  
        ORDER BY ".$order_by." ".$order_direction." 
        LIMIT 10 OFFSET ".($page-1)*$data_per_page;
        $args = array(
            "ACTIVE"
        );
        $result["data"] = executeQuery($query,$args);
        
        $query = "
        SELECT id_submit_formula_cat
        FROM ".$this->tbl_name." 
        WHERE status_formula_cat = ? ".$search_query."  
        ORDER BY ".$order_by." ".$order_direction;
        $result["total_data"] = executeQuery($query,$args)->num_rows();
        return $result;
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