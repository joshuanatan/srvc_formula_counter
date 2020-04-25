<?php
defined("BASEPATH") or exit("No Direct Script Access is Allowed");
date_default_timezone_set("Asia/Jakarta");

class M_formula extends CI_Model{
    private $tbl_name = "mstr_formula";
    private $id_submit_formula = 0;
    private $id_formula_cat = 0;
    private $formula_desc = ""; 
    private $formula_last_modified = "";
    private $id_last_modified = 0;
    private $column_list = array();

    public function __construct(){
        parent::__construct();
        $this->formula_last_modified = date("Y-m-d H:i:s");
        $this->id_last_modified = $this->session->id_submit_acc;
        $this->column_list = array(
            array(
                "col_name" => "formula_desc",
                "col_disp" => "Formula Description",
                "order_by" => true
            ),
            array(
                "col_name" => "formula_status",
                "col_disp" => "Formula Status",
                "order_by" => false
            ),
            array(
                "col_name" => "formula_last_modified",
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
                formula_desc LIKE '%".$search_key."%' OR
                formula_status LIKE '%".$search_key."%' OR
                formula_last_modified LIKE '%".$search_key."%' OR
                id_submit_formula LIKE '%".$search_key."%'
            )";
        }
        $query = "
        SELECT formula_desc,formula_status,formula_last_modified,id_submit_formula
        FROM ".$this->tbl_name." 
        WHERE formula_status = ? and id_formula_cat = ? ".$search_query."  
        ORDER BY ".$order_by." ".$order_direction." 
        LIMIT 10 OFFSET ".($page-1)*$data_per_page;
        $args = array(
            "ACTIVE",$this->id_formula_cat
        );
        $result["data"] = executeQuery($query,$args);
        
        $query = "
        SELECT id_submit_formula
        FROM ".$this->tbl_name." 
        WHERE formula_status = ? and id_formula_cat = ? ".$search_query."  
        ORDER BY ".$order_by." ".$order_direction;
        $result["total_data"] = executeQuery($query,$args)->num_rows();
        return $result;
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