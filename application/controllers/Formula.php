<?php
defined("BASEPATH") or exit("No Direct Script Access is Allowed");

class Formula extends CI_Controller{
    private $id_last_modified;
    public function __construct(){
        parent::__construct();
        $this->load->model("m_formula");
        $this->load->model("m_formula_attr");
        
        $this->id_last_modified = $this->session->id_submit_acc;
    }
    public function index(){
        $this->load->view("req_include/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("req_include/page_open");
        $this->load->view("req_include/navbar");
        $this->load->view("formula/page_open");

        $result = $this->m_formula->list();
        $data["formula"] = $result->result();
        $this->load->view("formula/content",$data);
        $this->load->view("formula/page_close");
        $this->load->view("req_include/page_close");
        $this->load->view("req_include/script");
        $this->load->view("plugin/datatable/datatable-js");
    }
    public function register(){
        $config = array(
            array(
                "field" => "formula_name",
                "label" => "Formula Name",
                "rules" => "required|max_length[100]"
            ),
            array(
                "field" => "formula_desc",
                "label" => "Formula Description",
                "rules" => "required|max_length[300]"
            ),
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $formula_name = $this->input->post("formula_name");
            $formula_desc = $this->input->post("formula_desc");
            $id_submit_acc = $this->session->id_submit_acc;
            $id_formula = $this->m_formula->insert($formula_name,$formula_desc,$id_submit_acc);
            if($id_formula){
                $check = $this->input->post("check");
                if($check != ""){
                    foreach($check as $a){
                        $config = array(
                            array(
                                "field" => "attr_name".$a,
                                "label" => "Attribute Name",
                                "rules" => "required"
                            )
                        );
                        $this->form_validation->set_rules($config);
                        if($this->form_validation->run()){
                            $attr_name = $this->input->post("attr_name".$a);
                            $id_attr = $this->m_formula_attr->insert($attr_name,$id_submit_acc);
                            if($id_attr){
                                $config = array(
                                    array(
                                        "field" => "rumus".$a,
                                        "label" => "Attribute Formula",
                                        "rules" => "required"
                                    )
                                );
                                $this->form_validation->set_rules($config);
                                if($this->form_validation->run()){
                                    $rumus = $this->input->post("rumus".$a);
                                    $this->m_formula_attr->insert_attr_combination($id_formula,$id_attr,$rumus); 
                                }
                            }
                        }
                    }
                }
            }
        }
        redirect("formula");
    }
    public function update(){
        $config = array(
            array(
                "field" => "formula_name",
                "label" => "Formula Name",
                "rules" => "required"
            ), 
            array(
                "field" => "id_formula",
                "label" => "Formula ID",
                "rules" => "required"
            ), 
            array(
                "field" => "formula_desc",
                "label" => "Formula Description",
                "rules" => "required"
            ), 
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $id_submit_formula = $this->input->post("id_formula");
            $formula_name = $this->input->post("formula_name");
            $formula_desc = $this->input->post("formula_desc");
            if($this->m_formula->update($id_submit_formula,$formula_name,$formula_desc,$this->id_last_modified)){
                $edit = $this->input->post("edit");
                if($edit != ""){
                    foreach($edit as $a){
                        $id_formula_attr = $this->input->post("id_formula_attr".$a); 
                        $formula_attr_name = $this->input->post("attr_name".$a); 
                        $this->m_formula_attr->update($id_formula_attr,$formula_attr_name,$this->id_last_modified);

                        $combination_formula = $this->input->post("rumus".$a);
                        $this->m_formula_attr->update_formula("",$id_submit_formula,$id_formula_attr,$combination_formula);
                    }
                }

                $delete = $this->input->post("delete");
                if($delete != ""){
                    foreach($delete as $a){
                        /*formula attrnya ga hapus disini, hapusnya di master. Bagian ini untuk menghapus atribut yang terpakai saja*/
                        $id_submit_formula_comb = $this->input->post("id_formula_comb".$a);
                        $this->m_formula_attr->delete_formula($id_submit_formula_comb);
                    }
                }

                $check = $this->input->post("check");
                if($check != ""){
                    foreach($check as $a){
                        foreach($check as $a){
                            $config = array(
                                array(
                                    "field" => "attr_name".$a,
                                    "label" => "Attribute Name",
                                    "rules" => "required"
                                )
                            );
                            $this->form_validation->set_rules($config);
                            if($this->form_validation->run()){
                                $attr_name = $this->input->post("attr_name".$a);
                                $id_attr = $this->m_formula_attr->insert($attr_name,$this->id_last_modified);
                                if($id_attr){
                                    $config = array(
                                        array(
                                            "field" => "rumus".$a,
                                            "label" => "Attribute Formula",
                                            "rules" => "required"
                                        )
                                    );
                                    $this->form_validation->set_rules($config);
                                    if($this->form_validation->run()){
                                        $rumus = $this->input->post("rumus".$a);
                                        $this->m_formula_attr->insert_attr_combination($id_submit_formula,$id_attr,$rumus); 
                                    }
                                }
                            }
                        }
                    }
                }
            }
            else{

            }
        }
        else{

        }
        redirect("formula");
    }
    public function delete(){
        $config = array(
            array(
                "field" => "id_formula",
                "label" => "Formula ID",
                "rules" => "required|numeric"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $id_formula = $this->input->post("id_formula");
            $result = $this->m_formula->delete($id_formula,$this->id_last_modified);
            if($result){

            }
            else{

            }
        }
        else{

        }
        redirect("formula");
    }
}
?>
