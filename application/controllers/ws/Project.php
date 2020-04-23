<?php
defined("BASEPATH") or exit("No Direct Script");

class Project extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function get_project_detail($id_submit_project){
        $respond["status"] = "SUCCESS";
        $respond["main"] = array();

        if($id_submit_project != "" && is_numeric($id_submit_project)){
            $this->load->model("m_project");
            $this->m_project->set_id_submit_project($id_submit_project);
            $result = $this->m_project->detail();
            if($result->num_rows() > 0){
                $result = $result->result_array();
                $respond["main"] = array(
                    "project_name" => $result[0]["prj_name"],
                    "address" => $result[0]["prj_addrs"],
                    "dateline" => $result[0]["prj_dateline"],
                    "id_client" => $result[0]["id_client"],
                );
                $this->load->model("m_client");
                $this->m_client->set_id_submit_client($result[0]["id_client"]);
                $result = $this->m_client->detail();
                if($result->num_rows() > 0){
                    $result = $result->result_array();
                    $respond["main"] += array(
                        "client_name" => $result[0]["clnt_name"],
                        "phone" => $result[0]["clnt_phone"],
                        "email" => $result[0]["clnt_email"],
                    );
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
    public function get_project($id_submit_project){
        $respond["status"] = "SUCCESS";
        $respond["main"] = array();

        if($id_submit_project != "" && is_numeric($id_submit_project)){
            $this->load->model("m_project");
            $this->m_project->set_id_submit_project($id_submit_project);
            $result = $this->m_project->detail();
            if($result->num_rows() > 0){
                $result = $result->result_array();
                $respond["main"] = array(
                    "project_name" => $result[0]["prj_name"],
                    "address" => $result[0]["prj_addrs"],
                    "dateline" => $result[0]["prj_dateline"],
                    "id_client" => $result[0]["id_client"],
                );
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
    public function update_rab(){
        $respond["status"] = "SUCCESS";
        $config = array(
            array(
                "field" => "id_rab",
                "label" => "",
                "rules" => "required|integer"
            ),
            array(
                "field" => "satuan_htg",
                "label" => "",
                "rules" => "required"
            ),
            array(
                "field" => "id_formula",
                "label" => "",
                "rules" => "required|integer"
            ),
            array(
                "field" => "id_project",
                "label" => "",
                "rules" => "required|integer"
            ),
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $id_rab = $this->input->post("id_rab");
            $satuan_htg = $this->input->post("satuan_htg");
            $id_formula = $this->input->post("id_formula");
            $id_project = $this->input->post("id_project");

            $this->load->model("m_rab");
            $this->m_rab->set_id_submit_rab($id_rab);
            $this->m_rab->set_id_formula($id_formula);
            $this->m_rab->set_satuan_htg($satuan_htg);
            $this->m_rab->set_id_project($id_project);
            
            if(!$this->m_rab->update()){
                $respond["status"] = "ERROR";
            }
        }
        else{
            $respond["status"] = "ERROR";
        }
        echo json_encode($respond);
    }
    public function remove_rab($id_rab){
        $respond["status"] = "SUCCESS";
        if($id_rab != "" && is_numeric($id_rab)){
            $this->load->model("m_rab");
            $this->m_rab->set_id_submit_rab($id_rab);
            $this->m_rab->delete();
        }
        else{
            $respond["status"] = "ERROR";
        }
        echo json_encode($respond);
    }
    public function list_belanja($id_project){
        $respond["status"] = "SUCCESS";
        $respond["content"] = array();
        $respond["total"] = 0;
        if($id_project != "" && is_numeric($id_project)){
            $this->load->model("m_belanja");
            $this->m_belanja->set_id_project($id_project);
            $result = $this->m_belanja->list_belanja_project();
            if($result->num_rows() > 0){
                $result = $result->result_array();
                for($a = 0; $a<count($result); $a++){
                    $respond["content"][$a]["id_belanja"] = $result[$a]["id_submit_belanja"];
                    $respond["content"][$a]["id_project"] = $result[$a]["id_project"];
                    $respond["content"][$a]["id_item"] = $result[$a]["id_item"];
                    $respond["content"][$a]["id_supplier"] = $result[$a]["id_supplier"];
                    $respond["content"][$a]["pengeluaran"] = $result[$a]["pengeluaran"];
                    $respond["content"][$a]["status"] = $result[$a]["blnj_status"];
                    $respond["content"][$a]["last_modified"] = $result[$a]["blnj_last_modified"];
                    $respond["content"][$a]["project"] = $result[$a]["prj_name"];
                    $respond["content"][$a]["item"] = $result[$a]["formula_attr_name"]; 
                    $respond["content"][$a]["supplier"] = $result[$a]["nama_supp"]; 
                    
                    $respond["total"] += $result[$a]["pengeluaran"];
                }
                $respond["total"] = number_format($respond["total"],0,',','.');
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
    public function register_belanja(){
        $respond["status"] = "SUCCESS";
        $config = array(
            array(
                "field" => "id_project",
                "label" => "",
                "rules" => "required"
            ),
            array(
                "field" => "id_item",
                "label" => "",
                "rules" => "required"
            ),
            array(
                "field" => "id_supplier",
                "label" => "",
                "rules" => "required"
            ),
            array(
                "field" => "pengeluaran",
                "label" => "",
                "rules" => "required"
            ),
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $id_project = $this->input->post("id_project");
            $id_item = $this->input->post("id_item");
            $id_supplier = $this->input->post("id_supplier");
            $pengeluaran = $this->input->post("pengeluaran");
            
            $this->load->model("m_belanja");
            $this->m_belanja->set_id_project($id_project);
            $this->m_belanja->set_id_item($id_item);
            $this->m_belanja->set_id_supplier($id_supplier);
            $this->m_belanja->set_pengeluaran($pengeluaran);
            if($this->m_belanja->insert()){
                $respond["register_time"] = date("Y-m-d H:i:s");
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
    public function update_belanja(){
        $respond["status"] = "SUCCESS";
        $config = array(
            array(
                "field" => "id_belanja",
                "label" => "",
                "rules" => "required"
            ),
            array(
                "field" => "nama_item",
                "label" => "",
                "rules" => "required"
            ),
            array(
                "field" => "nama_supp",
                "label" => "",
                "rules" => "required"
            ),
            array(
                "field" => "pengeluaran",
                "label" => "",
                "rules" => "required"
            ),
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $id_belanja = $this->input->post("id_belanja");

            $nama_item = $this->input->post("nama_item");
            $where = array(
                "formula_attr_name" => $nama_item
            );
            $id_item = get1Value("mstr_formula_attr","id_submit_formula_attr",$where);

            $nama_supp = $this->input->post("nama_supp");
            $where = array(
                "nama_supp" => $nama_supp
            );
            $id_supplier = get1Value("mstr_supplier","id_submit_supplier",$where);
            $pengeluaran = $this->input->post("pengeluaran");
            $this->load->model("m_belanja");
            $this->m_belanja->set_id_submit_belanja($id_belanja);
            $this->m_belanja->set_id_item($id_item);
            $this->m_belanja->set_id_supplier($id_supplier);
            $this->m_belanja->set_pengeluaran($pengeluaran);
            $this->m_belanja->update();
        }
        else{
            $respond["status"] = "ERROR";
        }
        echo json_encode($respond);
    }
    public function delete_belanja($id_belanja){
        $respond["status"] = "SUCCESS";
        if($id_belanja != "" && is_numeric($id_belanja)){
            $this->load->model("m_belanja");
            $this->m_belanja->set_id_submit_belanja($id_belanja);
            $this->m_belanja->delete();
        }
        else{
            $respond["status"] = "ERROR";
        }
        echo json_encode($respond);
    }
}