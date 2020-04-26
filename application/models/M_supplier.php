<?php
defined("BASEPATH") or exit("N Direct Script");
date_default_timezone_set("Asia/Jakarta");

class M_supplier extends CI_Model{
    private $tbl_name = "mstr_supplier";
    private $column_list = array();
    private $id_submit_supplier = 0;
    private $nama_supp = "";
    private $desc_supp = "";
    private $alamat_supp = "";
    private $pic_supp = "";
    private $notelp_supp = "";
    private $supp_last_modified = "";
    private $id_last_modified = 0;
    
    public function __construct(){
        parent::__construct();
        $this->supp_last_modified = date("Y-m-d H:i:s");
        $this->id_last_modified = $this->session->id_submit_acc;
        $this->column_list = array(
            array(
                "col_name" => "nama_supp",
                "col_disp" => "Nama Supplier",
                "order_by" => true
            ),
            array(
                "col_name" => "desc_supp",
                "col_disp" => "Deskripsi Supplier",
                "order_by" => false
            ),
            array(
                "col_name" => "alamat_supp",
                "col_disp" => "Alamat Supplier",
                "order_by" => false
            ),
            array(
                "col_name" => "pic_supp",
                "col_disp" => "PIC Supplier",
                "order_by" => false
            ),
            array(
                "col_name" => "notelp_supp",
                "col_disp" => "No Telp Supplier",
                "order_by" => false
            ),
            array(
                "col_name" => "supp_last_modified",
                "col_disp" => "Last Modified",
                "order_by" => false
            ),
            array(
                "col_name" => "supp_status",
                "col_disp" => "Status Supplier",
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
                id_submit_supplier LIKE '%".$search_key."%' OR
                nama_supp LIKE '%".$search_key."%' OR
                desc_supp LIKE '%".$search_key."%' OR
                alamat_supp LIKE '%".$search_key."%' OR
                pic_supp LIKE '%".$search_key."%' OR
                notelp_supp LIKE '%".$search_key."%' OR
                supp_last_modified LIKE '%".$search_key."%' OR
                supp_status LIKE '%".$search_key."%'
            )";
        }
        $query = "
        SELECT id_submit_supplier,nama_supp,desc_supp,alamat_supp,pic_supp,notelp_supp,supp_last_modified,supp_status
        FROM ".$this->tbl_name." 
        WHERE supp_status = ? ".$search_query."  
        ORDER BY ".$order_by." ".$order_direction." 
        LIMIT 20 OFFSET ".($page-1)*$data_per_page;
        $args = array(
            "ACTIVE"
        );
        $result["data"] = executeQuery($query,$args);
        $query = "
        SELECT id_submit_supplier
        FROM ".$this->tbl_name." 
        WHERE supp_status = ? ".$search_query."  
        ORDER BY ".$order_by." ".$order_direction;
        $result["total_data"] = executeQuery($query,$args)->num_rows();
        return $result;
    }
    public function insert(){
        $where = array(
            "nama_supp" => $this->nama_supp,
            "supp_status" => "ACTIVE"
        );
        if(!isExistsInTable($this->tbl_name,$where)){
            $data = array(
                "nama_supp" => $this->nama_supp,
                "desc_supp" => $this->desc_supp,
                "alamat_supp" => $this->alamat_supp,
                "pic_supp" => $this->pic_supp,
                "notelp_supp" => $this->notelp_supp,
                "supp_status" => "ACTIVE",
                "supp_last_modified" => $this->supp_last_modified,
                "id_last_modified" => $this->id_last_modified,
            );
            return insertRow($this->tbl_name,$data);
        }
        else{
            return false;
        }
    }
    public function update(){
        $where = array(
            "id_submit_supplier != " => $this->id_submit_supplier,
            "nama_supp" => $this->nama_supp,
            "supp_status" => "ACTIVE"
        );
        if(!isExistsInTable($this->tbl_name,$where)){
            $where = array(
                "id_submit_supplier" => $this->id_submit_supplier,
            );
            $data = array(
                "nama_supp" => $this->nama_supp,
                "desc_supp" => $this->desc_supp,
                "alamat_supp" => $this->alamat_supp,
                "pic_supp" => $this->pic_supp,
                "notelp_supp" => $this->notelp_supp,
                "supp_last_modified" => $this->supp_last_modified,
                "id_last_modified" => $this->id_last_modified,
            );
            updateRow($this->tbl_name,$data,$where);
        }
    }
    public function delete(){
        $where = array(
            "id_submit_supplier" => $this->id_submit_supplier,
        );
        $data = array(
            "supp_status" => "NOT ACTIVE",
            "supp_last_modified" => $this->supp_last_modified,
            "id_last_modified" => $this->id_last_modified,
        );
        updateRow($this->tbl_name,$data,$where);
    }
    public function list(){
        $where = array(
            "supp_status" => "ACTIVE"
        );
        $field = array(
            "id_submit_supplier","nama_supp","desc_supp","alamat_supp","pic_supp","notelp_supp","supp_last_modified","supp_status"
        );
        $result = selectRow($this->tbl_name,$where,$field);
        return $result;
    }
    public function set_id_submit_supplier($id_submit_supplier){
        if($id_submit_supplier != "" && is_numeric($id_submit_supplier)){
            $this->id_submit_supplier = $id_submit_supplier;
        }
        else{
            return false;
        }
    }
    public function set_nama_supp($nama_supp){
        if($nama_supp != ""){
            $this->nama_supp = $nama_supp;
        }
        else{
            return false;
        }
    }
    public function set_alamat_supp($alamat_supp){
        if($alamat_supp != ""){
            $this->alamat_supp = $alamat_supp;
        }
        else{
            return false;
        }
    }
    public function set_pic_supp($pic_supp){
        if($pic_supp != ""){
            $this->pic_supp = $pic_supp;
        }
        else{
            return false;
        }
    }
    public function set_notelp_supp($notelp_supp){
        if($notelp_supp != ""){
            $this->notelp_supp = $notelp_supp;
        }
        else{
            return false;
        }
    }
    public function set_desc_supp($desc_supp){
        if($desc_supp != ""){
            $this->desc_supp = $desc_supp;
        }
        else{
            return false;
        }
    }
    public function get_id_submit_supplier(){
        return $this->id_submit_supplier;
    }
    public function get_nama_supp(){
        return $this->nama_supp;
    }
    public function get_alamat_supp(){
        return $this->alamat_supp;
    }
    public function get_pic_supp(){
        return $this->pic_supp;
    }
    public function get_notelp_supp(){
        return $this->notelp_supp;
    }
    public function get_desc_supp(){
        return $this->desc_supp;
    }
}