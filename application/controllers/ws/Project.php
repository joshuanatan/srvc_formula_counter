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
}