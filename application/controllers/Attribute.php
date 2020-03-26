<?php
defined("BASEPATH") or exit("No Direct Script Allowed");

class Attribute extends CI_Controller{
    private $id_last_modified;
    public function __construct(){
        parent::__construct();
        $this->load->model("m_formula_attr");
        $this->id_last_modified = $this->session->id_submit_acc;
    }
    public function index(){
        $this->load->view("req_include/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("req_include/page_open");
        $this->load->view("req_include/navbar");
        $this->load->view("attribute/page_open");
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
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $attr_name = $this->input->post("attr_name");
            $id_last_modified = $this->id_last_modified;
            $attr_unit = $this->input->post("attr_unit");
            if($this->m_formula_attr->insert($attr_name,$id_last_modified,$attr_unit)){

            }
            else{

            }
        }
        else{

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
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $attr_id = $this->input->post("attr_id");
            $attr_name = $this->input->post("attr_name");
            $id_last_modified = $this->id_last_modified;
            $attr_unit = $this->input->post("attr_unit");
            
            if($this->m_formula_attr->update($attr_id,$attr_name,$id_last_modified,$attr_unit)){
                
            }
            else{

            }
        }
        else{
            
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
            $attr_id = $this->input->post("attr_id");
            $id_last_modified = $this->id_last_modified;
            if($this->m_formula_attr->delete($attr_id,$id_last_modified)){

            }
            else{

            }
        }
        else{

        }
        redirect("attribute");
    }
}