<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
date_default_timezone_set("Asia/Jakarta");

class M_Client extends CI_Model{
    private $id_submit_client = 0;
    private $clnt_name = "";
    private $clnt_phone = "";
    private $clnt_email = "";
    private $clnt_last_modified = "";
    private $id_last_modified = 0;

    public function __construct(){
        parent::__construct();
        $this->clnt_last_modified = date("Y-m-d H:i:s");
        $this->id_last_modified = $this->session->id_submit_acc;
    }
    public function search($where = "",$field = "", $search_type = "EXACT"){
        $test = array(
            $where,$field
        );
        if(!in_array("",$test)){
            if($where == ""){
                return $result = $this->list();
            }
            else{
                if($search_type == "EXACT"){
                    $result = selectRow("mstr_client",$where,$field);
                }
                else{
                    $condition = array(
                        "status_clnt" => "ACTIVE"
                    );
                    $result = selectRow("mstr_client",$condition,$field,"","","","","",$where);
                }
                return $result;
            }
        }
        else{
            return false;
        }
    }
    public function list(){
        $where = array(
            "status_clnt" => "ACTIVE"
        );
        $field = array(
            "id_submit_client","clnt_name","clnt_phone","clnt_email","status_clnt","clnt_last_modified"
        );
        $result = selectRow("mstr_client",$where,$field);
        return $result;
    }
    public function insert(){
        $data = array(
            "clnt_name" => $this->clnt_name,
            "clnt_phone" => $this->clnt_phone,
            "clnt_email" => $this->clnt_email,
            "status_clnt" => "ACTIVE",
            "clnt_last_modified" => $this->clnt_last_modified,
            "id_last_modified" => $this->id_last_modified,
        );
        return insertRow("mstr_client",$data);
    }
    public function update(){
        $where = array(
            "id_submit_client" => $this->id_submit_client,
        );
        $data = array(
            "clnt_name" => $this->clnt_name,
            "clnt_phone" => $this->clnt_phone,
            "clnt_email" => $this->clnt_email,
            "clnt_last_modified" => $this->clnt_last_modified,
            "id_last_modified" => $this->id_last_modified,
        );
        updateRow("mstr_client",$data,$where);
        return true;
    }
    public function delete(){
        $where = array(
            "id_submit_client" => $this->id_submit_client,
        );
        $data = array(
            "status_clnt" => "NOT ACTIVE",
            "clnt_last_modified" => $this->clnt_last_modified,
            "id_last_modified" => $this->id_last_modified,
        );
        updateRow("mstr_client",$data,$where);
        return true;
    }
    #setter & getter
    public function set_id_submit_client($id_submit_client = ""){
        if($id_submit_client != "" && is_numeric($id_submit_client)){
            $this->id_submit_client = $id_submit_client;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_clnt_name($clnt_name = ""){
        if($clnt_name != ""){
            $this->clnt_name = $clnt_name;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_clnt_phone($clnt_phone = ""){
        if($clnt_phone != ""){
            $this->clnt_phone = $clnt_phone;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_clnt_email($clnt_email = ""){
        if($clnt_email != ""){
            $this->clnt_email = $clnt_email;
            return true;
        }
        else{
            return false;
        }
    }
    public function get_id_submit_client(){
        return $this->id_submit_client;
    }
    public function get_clnt_name(){
        return $this->clnt_name;
    }
    public function get_clnt_phone(){
        return $this->clnt_phone;
    }
    public function get_clnt_email(){
        return $this->clnt_email;
    }
    
}