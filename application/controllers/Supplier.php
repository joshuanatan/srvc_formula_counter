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
    public function index(){
        $this->check_session();
        $this->load->view("req_include/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("req_include/page_open");
        $this->load->view("req_include/navbar");
        $this->load->view("supplier/page_open");

        $this->load->model("m_supplier");
        $result = $this->m_supplier->list();
        $data["supplier"] = $result->result_array();

        $this->load->view("supplier/content",$data);
        $this->load->view("supplier/page_close");
        $this->load->view("req_include/page_close");
        $this->load->view("req_include/script");
        $this->load->view("plugin/datatable/datatable-js");
    }
    public function register(){
        $config = array(
            array(
                "field" => "nama",
                "label" => "Nama Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "desc",
                "label" => "Desc Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "alamat",
                "label" => "Alamat Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "pic",
                "label" => "Pic Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "notelp",
                "label" => "No Telp Supplier",
                "rules" => "required"
            ),
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $nama = $this->input->post("nama");
            $desc = $this->input->post("desc");
            $alamat = $this->input->post("alamat");
            $pic = $this->input->post("pic");
            $notelp = $this->input->post("notelp");

            $this->load->model("m_supplier");
            $this->m_supplier->set_nama_supp($nama);
            $this->m_supplier->set_alamat_supp($alamat);
            $this->m_supplier->set_pic_supp($pic);
            $this->m_supplier->set_notelp_supp($notelp);
            $this->m_supplier->set_desc_supp($desc);
            $this->m_supplier->insert();
        }
        redirect("supplier");
    }
    public function update(){
        $config = array(
            array(
                "field" => "id",
                "label" => "ID Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "nama",
                "label" => "Nama Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "desc",
                "label" => "Desc Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "alamat",
                "label" => "Alamat Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "pic",
                "label" => "Pic Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "notelp",
                "label" => "No Telp Supplier",
                "rules" => "required"
            ),
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $id = $this->input->post("id");
            $nama = $this->input->post("nama");
            $desc = $this->input->post("desc");
            $alamat = $this->input->post("alamat");
            $pic = $this->input->post("pic");
            $notelp = $this->input->post("notelp");

            $this->load->model("m_supplier");
            $this->m_supplier->set_id_submit_supplier($id);
            $this->m_supplier->set_nama_supp($nama);
            $this->m_supplier->set_alamat_supp($alamat);
            $this->m_supplier->set_pic_supp($pic);
            $this->m_supplier->set_notelp_supp($notelp);
            $this->m_supplier->set_desc_supp($desc);
            $this->m_supplier->update();
        }
        redirect("supplier");
    }
    public function delete($id_supplier){
        if($id_supplier != "" && is_numeric($id_supplier)){
            $this->load->model("m_supplier");
            $this->m_supplier->set_id_submit_supplier($id_supplier);
            $this->m_supplier->delete();
        }
        redirect("supplier");
    }
}