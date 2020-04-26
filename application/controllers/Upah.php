<?php
defined("BASEPATH") or exit("No Direct Script Allowed");

class Upah extends CI_Controller{
    private function check_session(){
        if($this->session->id_submit_acc == ""){
            redirect("welcome/login");
            exit();
        }
    }  
    public function __construct(){
        parent::__construct();
    }
    public function remove_table_session($page){
        if($this->session->page != $page){
            $this->session->page = $page;
            $this->session->orderBy = "";
            $this->session->orderDirection = "";
            $this->session->searchKey = "";
            $this->session->page = "";
        }
    }
    public function index(){
        $this->check_session();
        $this->remove_table_session("upah");
        $this->load->view("req_include/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("req_include/page_open");
        $this->load->view("req_include/navbar");
        $this->load->view("upah/page_open");
        
        $this->load->model("m_formula_attr");
        $data["col"] = $this->m_formula_attr->column();

        $this->load->view("upah/content",$data);
        $this->load->view("upah/page_close");
        $this->load->view("req_include/page_close");
        $this->load->view("req_include/script");
        $this->load->view("plugin/datatable/datatable-js");
    }
    public function import(){
        $this->check_session();
        $data = array(
            "Kenek/Laden","Tukang Gali","Tukang Batu Kasar","Tukang Batu Halus","Tukang Besi","Tukang Seng","Tukang Kayu Kasar","Tukang Kayu Halus","Tukang Cat","Tukang Pipa","Tukang Listrik","Kepala Tukang","Mandor"
        );
        $harga = array(
            "90000","170000","125000","125000","125000","125000","125000","135000","125000","125000","125000","140000","160000",
        );
        for($a = 0; $a<count($data); $a++){
            $this->load->model("m_formula_attr");
            $this->m_formula_attr->set_formula_attr_name(strtoupper($data[$a]));
            $this->m_formula_attr->set_harga_satuan_attr($harga[$a]);
            $this->m_formula_attr->set_satuan_attr("HARI");
            $this->m_formula_attr->set_tipe_attr("UPAH");
            $this->m_formula_attr->insert();
        }
    }
}