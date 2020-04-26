<?php
defined("BASEPATH") or exit("No Direct Script");

class Supplier extends CI_Controller{
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
        $this->remove_table_session("supplier");
        $this->load->view("req_include/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("req_include/page_open");
        $this->load->view("req_include/navbar");
        $this->load->view("supplier/page_open");

        $this->load->model("m_supplier");
        $data["col"] = $this->m_supplier->column();

        $this->load->view("supplier/content",$data);
        $this->load->view("supplier/page_close");
        $this->load->view("req_include/page_close");
        $this->load->view("req_include/script");
        $this->load->view("plugin/datatable/datatable-js");
    }
}