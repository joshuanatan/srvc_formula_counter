<?php
defined("BASEPATH") or exit("No Direct Script");

class Contact extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function get_detail($id_contact){
        $respond["status"] = "SUCCESS";
        $respond["main"] = array();

        if($id_contact != "" && is_numeric($id_contact)){
            $this->load->model("m_client");
            $this->m_client->set_id_submit_client($id_contact);
            $result = $this->m_client->detail();

            if($result->num_rows() > 0){
                $result = $result->result_array();
                $respond["main"] = array(
                    "client_name" => $result[0]["clnt_name"],
                    "phone" => $result[0]["clnt_phone"],
                    "email" => $result[0]["clnt_email"],
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