<?php
defined("BASEPATH") or exit("No Direct Script Allowed");

class Alat extends CI_Controller{
    private function check_session(){
        if($this->session->id_submit_acc == ""){
            redirect("welcome/login");
            exit();
        }
    }  
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->check_session();
        $this->load->view("req_include/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("req_include/page_open");
        $this->load->view("req_include/navbar");
        $this->load->view("alat/page_open");
        
        $this->load->model("m_formula_attr");
        $data["col"] = $this->m_formula_attr->column();

        $this->load->view("alat/content",$data);
        $this->load->view("alat/page_close");
        $this->load->view("req_include/page_close");
        $this->load->view("req_include/script");
        $this->load->view("plugin/datatable/datatable-js");
    }
    public function import(){
        $this->check_session();
        $data = array("Ember Aduk","Pacul Aduk","Blencong","Sekop","Pahat Besi","Timbrisan Tanah","Timbrisan Mesin/Stamper","Bar Cutter","Bar Binder","Bor Listrik","Pemotong Keramik","Compressor Cat ","Concrete Mixer","Pompa Beton","Vibrator");
        $harga = array("7000","50000","50000","70000","25000","50000","100000","200","200","25000","3000","100000","250000","350000","100000");
        $satuan = array("bh","bh","bh","bh","bh","bh","m3","kg","kg","hk","m2","hr","m3","m3","m3");
        for($a = 0; $a<count($data); $a++){
            $this->load->model("m_formula_attr");
            $this->m_formula_attr->set_formula_attr_name(strtoupper($data[$a]));
            $this->m_formula_attr->set_harga_satuan_attr($harga[$a]);
            $this->m_formula_attr->set_satuan_attr(strtoupper($satuan[$a]));
            $this->m_formula_attr->set_tipe_attr("ALAT");
            $this->m_formula_attr->insert();
        }
    }
}