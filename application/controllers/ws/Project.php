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
}