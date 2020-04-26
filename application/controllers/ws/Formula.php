<?php
defined("BASEPATH") or exit("No Direct Script is Allowed");

class Formula extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function get_formula($id_submit_formula){
        $respond["status"] = "SUCCESS";
        $respond["main"] = array();
        $respond["attr"] = array();

        if($id_submit_formula != "" && is_numeric($id_submit_formula)){
            $this->load->model("m_formula");
            $this->m_formula->set_id_submit_formula($id_submit_formula);
            $result = $this->m_formula->detail();
            if($result->num_rows() > 0){
                $result = $result->result_array();
                $respond["main"] = array(
                    "id_formula" => $result[0]["id_submit_formula"],
                    "formula_desc" => $result[0]["formula_desc"]
                );
                
                $this->load->model("m_formula_comb");
                $this->m_formula_comb->set_id_mstr_formula($id_submit_formula);
                $result = $this->m_formula_comb->list();
                if($result->num_rows() > 0){
                    $result = $result->result_array();
                    for($a = 0; $a<count($result); $a++){
                        $respond["attr"][$a] = array(
                            "id_formula_comb" => $result[$a]["id_submit_formula_comb"],
                            "id_formula_attr" => $result[$a]["id_formula_attr"],
                            "attr_name" => $result[$a]["formula_attr_name"],
                            "tipe_attr" => $result[$a]["tipe_attr"],
                            "koefisien" => $result[$a]["koefisien"]
                        );
                    }
                }
            }
            else{
                $respond["status"] = "ERROR";
            }
        }
        else{
            $respond["status"] = "ERROR";
        }
        echo json_encode($respond);
    }
    public function list(){
        $respond["status"] = "SUCCESS";
        $respond["content"] = array();

        $order_by = $this->input->get("orderBy");
        $order_direction = $this->input->get("orderDirection");
        $page = $this->input->get("page");
        $search_key = $this->input->get("searchKey");
        $id_cat = $this->input->get("idCat");
        $data_per_page = 10;
        
        $this->load->model("m_formula");
        $this->m_formula->set_id_formula_cat($id_cat);
        $result = $this->m_formula->content($page,$order_by,$order_direction,$search_key,$data_per_page);

        if($result["data"]->num_rows() > 0){
            $result["data"] = $result["data"]->result_array();
            for($a = 0; $a<count($result["data"]); $a++){
                $respond["content"][$a]["desc"] = $result["data"][$a]["formula_desc"];
                $respond["content"][$a]["status"] = $result["data"][$a]["formula_status"];
                $respond["content"][$a]["last_modified"] = $result["data"][$a]["formula_last_modified"];
                $respond["content"][$a]["id"] = $result["data"][$a]["id_submit_formula"];
            }
        }
        else{
            $respond["status"] = "ERROR";
        }
        $respond["page"] = $this->pagination->generate_pagination_rules($page,$result["total_data"],$data_per_page);

        echo json_encode($respond);
    }
    public function register(){
        $respond["status"] = "SUCCESS";
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
                        else{
                            $respond["status"] = "ERROR";
                            $respond["msg"] = validation_errors();
                        }
                    }
                }
            }
        }
        else{
            $respond["status"] = "ERROR";
            $respond["msg"] = validation_errors();
        }
        echo json_encode($respond);
    }
    public function update(){
        $respond["status"] = "SUCCESS";
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
                            "field" => "attr_name".$a,
                            "label" => "Formula Attribute",
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

                        $id_formula_comb = $this->input->post("id_formula_comb".$a);
                        $attr_name = $this->input->post("attr_name".$a);
                        $where = array(
                            "formula_attr_name" => $attr_name
                        );
                        $id_formula_attr = get1Value("mstr_formula_attr","id_submit_formula_attr",$where);
                        $koefisien = $this->input->post("koefisien".$a);
                        
                        $this->m_formula_comb->set_id_mstr_formula($id_submit_formula);
                        $this->m_formula_comb->set_id_submit_formula_comb($id_formula_comb);
                        $this->m_formula_comb->set_id_formula_attr($id_formula_attr);
                        $this->m_formula_comb->set_koefisien($koefisien);
                        $this->m_formula_comb->update();
                    }
                    else{
                        $respond["status"] = "ERROR";
                        $respond["msg"] = validation_errors();
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
                    else{
                        $respond["status"] = "ERROR";
                        $respond["msg"] = validation_errors();
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
                    else{
                        $respond["status"] = "ERROR";
                        $respond["msg"] = validation_errors();
                    }
                }
            }
        }
        else{
            $respond["status"] = "ERROR";
            $respond["msg"] = validation_errors();
        }
        echo json_encode($respond);
    }
    public function delete($id_formula){
        $respond["status"] = "SUCCESS";
        if($id_formula != "" && is_numeric($id_formula)){
            $this->load->model("m_formula");
            $this->m_formula->set_id_submit_formula($id_formula);
            $this->m_formula->delete();
        }
        else{
            $respond["status"] = "ERROR";
            $respond["msg"] = validation_errors();
        }
        echo json_encode($respond);
    }
    public function subformula($id_formula){
        $respond["status"] = "SUCCESS";
        $respond["main"] = array();
        $respond["attr"] = array();

        if($id_formula != "" && is_numeric($id_formula)){
            $this->load->model("m_subformula");
            $this->m_subformula->set_id_formula($id_formula);
            $result = $this->m_subformula->list();
            if($result->num_rows() > 0){
                $result = $result->result_array();
                for($a = 0; $a<count($result); $a++){
                    $respond["main"][$a]["id_subformula"] = $result[$a]["id_submit_subformula"];
                    $respond["main"][$a]["name"] = $result[$a]["subformula_name"];
                    $respond["main"][$a]["status"] = $result[$a]["subformula_status"];
                    $respond["main"][$a]["last_modified"] = $result[$a]["subformula_last_modified"];
                }
            }
            else{
                $respond["status"] = "ERROR";
            }
        }
        else{
            $respond["status"] = "ERROR";
        }
        echo json_encode($respond);
    }
    public function category(){
        $respond["status"] = "SUCCESS";
        $respond["main"] = array();
        $respond["attr"] = array();

        $this->load->model("m_formula_cat");
        $result = $this->m_formula_cat->list();
        if($result->num_rows() > 0){
            $result = $result->result_array();
            for($a = 0; $a<count($result); $a++){
                $respond["main"][$a]["id_formula_cat"] = $result[$a]["id_submit_formula_cat"];
                $respond["main"][$a]["cat_name"] = $result[$a]["formula_cat_name"];
                $respond["main"][$a]["cat_status"] = $result[$a]["status_formula_cat"];
                $respond["main"][$a]["cat_last_modified"] = $result[$a]["formula_cat_last_modified"];
            }
        }
        else{
            $respond["status"] = "ERROR";
        }   
        echo json_encode($respond);
    }
    public function daftar_pekerjaan($id_formula_cat){
        $respond["status"] = "SUCCESS";
        $respond["main"] = array();
        $respond["attr"] = array();

        if($id_formula_cat != "" && is_numeric($id_formula_cat)){
            $this->load->model("m_formula");
            $this->m_formula->set_id_formula_cat($id_formula_cat);
            $result = $this->m_formula->list();
            if($result->num_rows() > 0){
                $result = $result->result_array();
                for($a = 0; $a<count($result); $a++){
                    $respond["main"][$a]["id_formula"] = $result[$a]["id_submit_formula"];
                    $respond["main"][$a]["formula_desc"] = $result[$a]["formula_desc"];
                    $respond["main"][$a]["status"] = $result[$a]["formula_status"];
                    $respond["main"][$a]["last_modified"] = $result[$a]["formula_last_modified"];
                }
            }
            else{
                $respond["status"] = "ERROR";
            }
        }
        else{
            $respond["status"] = "ERROR";
        }
        echo json_encode($respond);
    }
    public function list_category(){
        $respond["status"] = "SUCCESS";
        $respond["content"] = array();

        $order_by = $this->input->get("orderBy");
        $order_direction = $this->input->get("orderDirection");
        $page = $this->input->get("page");
        $search_key = $this->input->get("searchKey");

        $data_per_page = 10;
        
        $this->load->model("m_formula_cat");
        $result = $this->m_formula_cat->content($page,$order_by,$order_direction,$search_key,$data_per_page);

        if($result["data"]->num_rows() > 0){
            $result["data"] = $result["data"]->result_array();
            for($a = 0; $a<count($result["data"]); $a++){
                $respond["content"][$a]["id"] = $result["data"][$a]["id_submit_formula_cat"];
                $respond["content"][$a]["name"] = $result["data"][$a]["formula_cat_name"];
                $respond["content"][$a]["status"] = $result["data"][$a]["status_formula_cat"];
                $respond["content"][$a]["last_modified"] = $result["data"][$a]["formula_cat_last_modified"];
            }
        }
        else{
            $respond["status"] = "ERROR";
        }
        $respond["page"] = $this->pagination->generate_pagination_rules($page,$result["total_data"],$data_per_page);

        echo json_encode($respond);
    }
    public function register_cat(){
        $respond["status"] = "SUCCESS";
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
        else{
            $respond["status"] = "ERROR";
            $respond["msg"] = validation_errors();
        }
        echo json_encode($respond);
    }
    public function update_cat(){
        $respond["status"] = "SUCCESS";
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
        else{
            $respond["status"] = "ERROR";
            $respond["msg"] = validation_errors();
        }
        echo json_encode($respond);
    }
    public function delete_cat($id_cat){
        $respond["status"] = "SUCCESS";
        if($id_cat != "" && is_numeric($id_cat)){
            $this->load->model("m_formula_cat");
            $this->m_formula_cat->set_id_submit_formula_cat($id_cat);
            $this->m_formula_cat->delete();
        }
        else{
            $respond["status"] = "ERROR";
            $respond["msg"] = validation_errors();
        }
        echo json_encode($respond);
    }
}
?>
