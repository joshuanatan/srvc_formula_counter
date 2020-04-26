<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Attribute extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function get_attribute($id_submit_attr){
        $respond["status"] = "SUCCESS";
        $respond["attr"] = array();
        if($id_submit_attr != "" && is_numeric($id_submit_attr)){
            $this->load->model("m_formula_attr");
            
            $this->m_formula_attr->set_id_submit_formula_attr($id_submit_attr);
            $result = $this->m_formula_attr->detail();
            if($result->num_rows() > 0){
                $result = $result->result_array();
                $respond["attr"]["attr_id"] = $id_submit_attr;
                $respond["attr"]["attr_name"] = $result[0]["formula_attr_name"];
                $respond["attr"]["attr_price"] = $result[0]["harga_satuan_attr"];
                $respond["attr"]["attr_unit"] = $result[0]["satuan_attr"];
                $respond["attr"]["attr_status"] = $result[0]["status_formula_attr"];
                $respond["attr"]["attr_last"] = $result[0]["formula_attr_last_modified"];
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
    public function register(){
        
        $respond["status"] = "SUCCESS";
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
            ),
            array(
                "field" => "attr_type",
                "label" => "Attribute Type",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $this->load->model("m_formula_attr");
            $attr_name = $this->input->post("attr_name");
            $hrg_attr = $this->input->post("attr_price");
            $attr_unit = $this->input->post("attr_unit");
            $attr_type = $this->input->post("attr_type");

            $this->m_formula_attr->set_formula_attr_name($attr_name);
            $this->m_formula_attr->set_harga_satuan_attr($hrg_attr);
            $this->m_formula_attr->set_satuan_attr($attr_unit);
            $this->m_formula_attr->set_tipe_attr($attr_type);
            $id_formula_attr = $this->m_formula_attr->insert();
        }
        else{
            $respond["status"] = "ERROR";
        }
        echo json_encode($respond);
    }
    public function update(){
        $respond["status"] = "SUCCESS";
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
        else{
            $respond["status"] = "ERROR";
            $respond["msg"] = validation_errors();
        }
        echo json_encode($respond);
    }
    public function delete($attr_id){
        $respond["status"] = "SUCCESS";
        if($attr_id != "" && is_numeric($attr_id)){
            $this->load->model("m_formula_attr");
            $this->m_formula_attr->set_id_submit_formula_attr($attr_id);
            $this->m_formula_attr->delete();
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
        $jenis = $this->input->get("jenis");
        $data_per_page = 20;
        
        $this->load->model("m_formula_attr");
        $this->m_formula_attr->set_tipe_attr($jenis);
        $result = $this->m_formula_attr->content($page,$order_by,$order_direction,$search_key,$data_per_page);

        if($result["data"]->num_rows() > 0){
            $result["data"] = $result["data"]->result_array();
            for($a = 0; $a<count($result["data"]); $a++){
                $respond["content"][$a]["name"] = $result["data"][$a]["formula_attr_name"];
                $respond["content"][$a]["satuan"] = $result["data"][$a]["satuan_attr"];
                $respond["content"][$a]["harga_satuan"] = $result["data"][$a]["harga_satuan_attr"];
                $respond["content"][$a]["status"] = $result["data"][$a]["status_formula_attr"];
                $respond["content"][$a]["last_modified"] = $result["data"][$a]["formula_attr_last_modified"];
                $respond["content"][$a]["id"] = $result["data"][$a]["id_submit_formula_attr"];
            }
        }
        else{
            $respond["status"] = "ERROR";
        }
        $respond["page"] = $this->pagination->generate_pagination_rules($page,$result["total_data"],$data_per_page);

        echo json_encode($respond);
    }
    public function daftar($bahan){
        $respond["status"] = "SUCCESS";
        $respond["attr"] = array();
        
        $this->load->model("m_formula_attr");
        $this->m_formula_attr->set_tipe_attr($bahan);
        $result = $this->m_formula_attr->list();
        if($result->num_rows() > 0){
            $result = $result->result_array();
            for($a = 0; $a<count($result); $a++){
                $respond["attr"][$a]["attr_id"] = $result[$a]["id_submit_formula_attr"];
                $respond["attr"][$a]["attr_name"] = $result[$a]["formula_attr_name"];
                $respond["attr"][$a]["attr_price"] = $result[$a]["harga_satuan_attr"];
                $respond["attr"][$a]["attr_unit"] = $result[$a]["satuan_attr"];
                $respond["attr"][$a]["attr_status"] = $result[$a]["status_formula_attr"];
                $respond["attr"][$a]["attr_last"] = $result[$a]["formula_attr_last_modified"];
            }
        }
        else{
            $respond["status"] = "ERROR";
        }
        echo json_encode($respond);
    }
    public function list_unassigned_attr($id_formula){
        if($id_submit_attr != "" && is_numeric($id_submit_attr)){
            $respond["status"] = "SUCCESS";
            $respond["attr"] = array();
            
            $this->load->model("m_formula_comb");
            $this->m_formula_comb->set_id_mstr_formula($id_formula);
            $result = $this->m_formula_comb->unassigned_attr();
            if($result->num_rows() > 0){
                $result = $result->result_array();
                for($a = 0; $a<count($result); $a++){
                    $respond["attr"][$a]["attr_id"] = $result[$a]["id_submit_formula_attr"];
                    $respond["attr"][$a]["attr_name"] = $result[$a]["formula_attr_name"];
                    $respond["attr"][$a]["attr_price"] = $result[$a]["harga_satuan_attr"];
                    $respond["attr"][$a]["attr_unit"] = $result[$a]["satuan_attr"];
                    $respond["attr"][$a]["attr_status"] = $result[$a]["status_formula_attr"];
                    $respond["attr"][$a]["attr_last"] = $result[$a]["formula_attr_last_modified"];
                }
            }
            else{
                $respond["status"] = "ERROR";
            }
            echo json_encode($respond);
        }
    }
}
?>

