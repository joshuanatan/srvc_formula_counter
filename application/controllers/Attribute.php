<?php
defined("BASEPATH") or exit("No Direct Script Allowed");

class Attribute extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->load->view("req_include/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("req_include/page_open");
        $this->load->view("req_include/navbar");
        $this->load->view("attribute/page_open");
        
        $this->load->model("m_formula_attr");
        $this->m_formula_attr->set_tipe_attr("BAHAN");
        $result = $this->m_formula_attr->list();
        $data = array(
            "attribute" => $result->result()
        );
        $this->load->view("attribute/content",$data);
        $this->load->view("attribute/page_close");
        $this->load->view("req_include/page_close");
        $this->load->view("req_include/script");
        $this->load->view("plugin/datatable/datatable-js");
    }
    public function register(){
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
            $this->m_formula_attr->set_tipe_attr("BAHAN");
            $id_formula_attr = $this->m_formula_attr->insert();
        }
        redirect("attribute");
    }
    public function update(){
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
        redirect("attribute");
    }
    public function delete(){
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
        redirect("attribute");
    }
}