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
        $this->m_formula_attr->set_tipe_attr("ALAT");
        $result = $this->m_formula_attr->list();
        $data = array(
            "attribute" => $result->result()
        );
        $this->load->view("alat/content",$data);
        $this->load->view("alat/page_close");
        $this->load->view("req_include/page_close");
        $this->load->view("req_include/script");
        $this->load->view("plugin/datatable/datatable-js");
    }
    public function register(){
        $this->check_session();
        $config = array(
            array(
                "field" => "attr_name",
                "label" => "Attribute Name",
                "rules" => "required"
            ),
            array(
                "field" => "attr_unit",
                "label" => "Attribute Unit",
                "rules" => "required"
            ),
            array(
                "field" => "attr_price",
                "label" => "Attribute Price",
                "rules" => "required|integer"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $this->load->model("m_formula_attr");
            $attr_name = $this->input->post("attr_name");
            $hrg_attr = $this->input->post("attr_price");
            $attr_unit = $this->input->post("attr_unit");

            $this->m_formula_attr->set_formula_attr_name($attr_name);
            $this->m_formula_attr->set_harga_satuan_attr($hrg_attr);
            $this->m_formula_attr->set_satuan_attr($attr_unit);
            $this->m_formula_attr->set_tipe_attr("ALAT");
            $id_formula_attr = $this->m_formula_attr->insert();
        }
        redirect("alat");
    }
    public function update(){
        $this->check_session();
        $config = array(
            array(
                "field" => "attr_name",
                "label" => "Attribute Name",
                "rules" => "required"
            ),
            array(
                "field" => "attr_id",
                "label" => "Attribute ID",
                "rules" => "required"
            ),
            array(
                "field" => "attr_unit",
                "label" => "Attribute Unit",
                "rules" => "required"
            ),
            array(
                "field" => "attr_price",
                "label" => "Attribute Price",
                "rules" => "required|integer"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $this->load->model("m_formula_attr");

            $attr_id = $this->input->post("attr_id");
            $attr_name = $this->input->post("attr_name");
            $attr_price = $this->input->post("attr_price");
            $attr_unit = $this->input->post("attr_unit");

            $this->m_formula_attr->set_id_submit_formula_attr($attr_id);
            $this->m_formula_attr->set_formula_attr_name($attr_name);
            $this->m_formula_attr->set_harga_satuan_attr($attr_price);
            $this->m_formula_attr->set_satuan_attr($attr_unit);
            $this->m_formula_attr->update();
        }
        redirect("alat");
    }
    public function delete(){
        $this->check_session();
        $config = array(
            array(
                "field" => "attr_id",
                "label" => "Attribute ID",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $this->load->model("m_formula_attr");

            $attr_id = $this->input->post("attr_id");
            $this->m_formula_attr->set_id_submit_formula_attr($attr_id);
            $this->m_formula_attr->delete();
        }
        redirect("alat");
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