<?php
defined("BASEPATH") or exit("No Direct Script Access is Allowed");

class Formula extends CI_Controller{
    private $id_last_modified;
    public function __construct(){
        parent::__construct();
        $this->load->model("m_formula_attr");
    }
    public function index(){
        $this->load->view("req_include/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("req_include/page_open");
        $this->load->view("req_include/navbar");
        $this->load->view("formula/page_open");

        $this->load->model("m_formula");
        $result = $this->m_formula->list();
        $data["formula"] = $result->result();

        $this->load->model("m_formula_attr");
        $result = $this->m_formula->list();
        $data["attr"] = $result->result();

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
            $this->load->model("m_formula");
            $formula_name = $this->input->post("formula_name");
            $formula_desc = $this->input->post("formula_desc");

            $this->m_formula->set_formula_name($formula_name);
            $this->m_formula->set_formula_desc($formula_desc);
            $id_mstr_formula = $this->m_formula->insert();

            if($id_mstr_formula){
                $check = $this->input->post("check");
                if($check != ""){
                    foreach($check as $a){
                        $config = array(
                            array(
                                "field" => "id_attr".$a,
                                "label" => "Attribute",
                                "rules" => "required"
                            ),
                            array(
                                "field" => "koefisien".$a,
                                "label" => "Koefisien",
                                "rules" => "required"
                            )
                        );
                        $this->form_validation->set_rules($config);
                        if($this->form_validation->run()){
                            $this->load->model("m_formula_comb");

                            $id_formula_attr = $this->input->post("id_attr".$a);
                            $koefisien = $this->input->post("koefisien".$a);
                            $this->m_formula_comb->set_id_mstr_formula($id_mstr_formula);
                            $this->m_formula_comb->set_id_formula_attr($id_formula_attr);
                            $this->m_formula_comb->set_koefisien($koefisien);
                            $this->m_formula_comb->insert();
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
                "field" => "id_formula",
                "label" => "Formula ID",
                "rules" => "required"
            ),
            array(
                "field" => "formula_name",
                "label" => "Formula Name",
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
            $this->load->model("m_formula");
            $id_submit_formula = $this->input->post("id_formula");
            $formula_name = $this->input->post("formula_name");
            $formula_desc = $this->input->post("formula_desc");
            
            $this->m_formula->set_id_submit_formula($id_submit_formula);
            $this->m_formula->set_formula_name($formula_name);
            $this->m_formula->set_formula_desc($formula_desc);
            $this->m_formula->update();

            $edit = $this->input->post("edit");
            if($edit != ""){
                foreach($edit as $a){
                    $config = array(
                        array(
                            "field" => "id_formula_comb".$a,
                            "label" => "ID Formula Combination",
                            "rules" => "required|integer" 
                        ),
                        array(
                            "field" => "id_attr".$a,
                            "label" => "ID Formula Attribute",
                            "rules" => "required|integer"
                        ),
                        array(
                            "field" => "koefisien".$a,
                            "label" => "Koefisien",
                            "rules" => "required"
                        )
                    );
                    $this->form_validation->set_rules($config);
                    if($this->form_validation->run()){
                        $this->load->model("m_formula_comb");

                        $id_formula_comb = $this->input->post("id_formula_comb".$a);
                        $id_formula_attr = $this->input->post("id_attr".$a);
                        $koefisien = $this->input->post("koefisien".$a);
                        
                        $this->m_formula_comb->set_id_mstr_formula($id_submit_formula);
                        $this->m_formula_comb->set_id_submit_formula_comb($id_formula_comb);
                        $this->m_formula_comb->set_id_formula_attr($id_formula_attr);
                        $this->m_formula_comb->set_koefisien($koefisien);
                        $this->m_formula_comb->update();
                    }
                }
            }
            $delete = $this->input->post("delete");
            if($delete != ""){
                foreach($delete as $a){
                    $config = array(
                        array(
                            "field" => "id_formula_comb".$a,
                            "label" => "ID Formula Combination",
                            "rules" => "required|integer" 
                        )
                    );
                    $this->form_validation->set_rules($config);
                    if($this->form_validation->run()){
                        $this->load->model("m_formula_comb");

                        $id_formula_comb = $this->input->post("id_formula_comb".$a);

                        $this->m_formula_comb->set_id_submit_formula_comb($id_formula_comb);
                        $this->m_formula_comb->delete();
                    }
                }
            }
            $check = $this->input->post("check");
                if($check != ""){
                    foreach($check as $a){
                        $config = array(
                            array(
                                "field" => "id_attr".$a,
                                "label" => "Attribute",
                                "rules" => "required"
                            ),
                            array(
                                "field" => "koefisien".$a,
                                "label" => "Koefisien",
                                "rules" => "required"
                            )
                        );
                        $this->form_validation->set_rules($config);
                        if($this->form_validation->run()){
                            $this->load->model("m_formula_comb");

                            $id_formula_attr = $this->input->post("id_attr".$a);
                            $koefisien = $this->input->post("koefisien".$a);
                            $this->m_formula_comb->set_id_mstr_formula($id_submit_formula);
                            $this->m_formula_comb->set_id_formula_attr($id_formula_attr);
                            $this->m_formula_comb->set_koefisien($koefisien);
                            $this->m_formula_comb->insert();
                        }
                    }
                }
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
            $this->load->model("m_formula");
            $id_formula = $this->input->post("id_formula");
            $this->m_formula->set_id_submit_formula($id_formula);
            $this->m_formula->delete();
        }
        redirect("formula");
    }
}

?>
