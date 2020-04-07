<?php
defined("BASEPATH") or exit("No Direct Script Access is Allowed");

class Formula extends CI_Controller{
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
        $this->load->view("formula/page_open");

        $this->load->model("m_formula_cat");
        $result = $this->m_formula_cat->list();
        $data["formula"] = $result->result();

        $this->load->view("formula/category",$data);
        $this->load->view("formula/page_close");
        $this->load->view("req_include/page_close");
        $this->load->view("req_include/script");
        $this->load->view("plugin/datatable/datatable-js");
    }
    public function register_cat(){
        $this->check_session();
        $config = array(
            array(
                "field" => "cat_name",
                "label" => "Formula Category Name",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $formula_cat_name = $this->input->post("cat_name");
            $this->load->model("m_formula_cat");
            $this->m_formula_cat->set_formula_cat_name($formula_cat_name);
            $this->m_formula_cat->insert();
        }
        redirect("formula");
    }
    public function update_cat(){
        $this->check_session();
        $config = array(
            array(
                "field" => "id_cat",
                "label" => "",
                "rules" => "required"
            ),
            array(
                "field" => "cat_name",
                "label" => "Formula Category Name",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $formula_cat_name = $this->input->post("cat_name");
            $id_submit_formula_cat = $this->input->post("id_cat");
            $this->load->model("m_formula_cat");
            $this->m_formula_cat->set_id_submit_formula_cat($id_submit_formula_cat);
            $this->m_formula_cat->set_formula_cat_name($formula_cat_name);
            $this->m_formula_cat->update();
        }
        redirect("formula");
    }
    public function delete_cat(){
        $this->check_session();
        $config = array(
            array(
                "field" => "id_submit_cat",
                "label" => "",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $id_submit_formula_cat = $this->input->post("id_submit_cat");
            $this->load->model("m_formula_cat");
            $this->m_formula_cat->id_submit_formula_cat($id_submit_formula_cat);
            $this->m_formula_cat->delete();
        }
    }
    public function subformula($id_formula_cat){
        $this->check_session();
        
        $this->load->view("req_include/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("req_include/page_open");
        $this->load->view("req_include/navbar");
        $this->load->view("formula/page_open");

        $data["id_formula_cat"] = $id_formula_cat;

        $this->load->model("m_formula");
        $this->m_formula->set_id_formula_cat($id_formula_cat);
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
        $this->check_session();
        $config = array(
            array(
                "field" => "id_formula_cat",
                "label" => "Formula Category",
                "rules" => "required"
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
            $id_formula_cat = $this->input->post("id_formula_cat");
            $formula_desc = $this->input->post("formula_desc");

            $this->m_formula->set_id_formula_cat($id_formula_cat);
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
        redirect("formula/subformula/".$id_formula_cat);
    }
    public function update(){
        $this->check_session();
        $config = array(
            array(
                "field" => "id_formula",
                "label" => "Formula ID",
                "rules" => "required"
            ),
            array(
                "field" => "id_formula_cat",
                "label" => "",
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
            $id_formula_cat = $this->input->post("id_formula_cat");
            $formula_desc = $this->input->post("formula_desc");
            
            $this->m_formula->set_id_submit_formula($id_submit_formula);
            $this->m_formula->set_id_formula_cat($id_formula_cat);
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
        redirect("formula/subformula/".$id_formula_cat);
    }
    public function delete(){
        $this->check_session();
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
            $id_formula_cat = $this->input->post("id_formula_cat");
            $this->m_formula->set_id_submit_formula($id_formula);
            $this->m_formula->delete();
        }
        redirect("formula/subformula/".$id_formula_cat);
    }
    public function import_cat(){
        $data = array(
            "A. PEKERJAAN PERSIAPAN",
            "B. PEKERJAAN TANAH DAN PONDASI",
            "C. PEKERJAAN STRUKTUR",
            "D. PEKERJAAN DINDING",
            "E. PEKERJAAN PLAFOND",
            "F. PEKERJAAN LANTAI",
            "G. PEKERJAAN CAT",
            "H. PEKERJAAN KUSEN PINTU DAN JENDELA",
            "I. PEKERJAAN LISTRIK",
            "J. PEKERJAAN INSTALASI AIR",
            "K. PEKERJAAN WC",
            "PEKERJAAN DAPUR BERSIH DAN KOTOR",
            "PEKERJAAN LAIN-LAIN"
        );
        for($a = 0; $a<count($data); $a++){
            $this->load->model("m_formula_cat");
            $this->m_formula_cat->set_formula_cat_name($data[$a]);
            $this->m_formula_cat->insert();
        }
    }
    public function import_formula(){
        $data = array(
            "A. PEKERJAAN PERSIAPAN",
            "B. PEKERJAAN TANAH DAN PONDASI",
            "C. PEKERJAAN STRUKTUR",
            "D. PEKERJAAN DINDING",
            "E. PEKERJAAN PLAFOND",
            "F. PEKERJAAN LANTAI",
            "G. PEKERJAAN CAT",
            "H. PEKERJAAN KUSEN PINTU DAN JENDELA",
            "I. PEKERJAAN LISTRIK",
            "J. PEKERJAAN INSTALASI AIR",
            "K. PEKERJAAN WC",
            "PEKERJAAN DAPUR BERSIH DAN KOTOR",
            "PEKERJAAN LAIN-LAIN"
        );
        for($a = 0; $a<count($data); $a++){
            $where = array(
                "formula_cat_name" => $data[$a]
            );
            $field = array(
                "id_submit_formula_cat"
            );
            $result = selectRow("mstr_formula_cat",$where,$field);
            $result = $result->result_array();
            $sql = "update mstr_formula set id_formula_cat = '".$result[0]["id_submit_formula_cat"]."' where formula_name = '".$data[$a]."'";
            executeQuery($sql);
        }
    }
}

?>
