<?php
defined("BASEPATH") or exit("No Direct Script");
date_default_timezone_set("Asia/Jakarta");

class M_Project extends CI_Model{
    private $id_submit_project = 0;
    private $prj_name = "";
    private $prj_addrs = "";
    private $prj_dateline = "";
    private $id_client = 0;
    private $project_last_modified = "";
    private $id_last_modified = 0;

    public function __construct(){
        parent::__construct();
        $this->project_last_modified = date("Y-m-d H:i:s");
        $this->id_last_modified = $this->session->id_submit_acc;
    }
    public function list(){
        $where = array(
            "status_project" => "ACTIVE",
        );
        $field = array(
            "id_submit_project","prj_name","prj_addrs","prj_dateline","id_client","status_project","project_last_modified"
        );
        $result = selectRow("mstr_project",$where,$field);
        return $result;
    }
    public function detail(){
        $where = array(
            "id_submit_project" => $this->id_submit_project,
            "status_project" => 'ACTIVE'
        );
        $field = array(
            "id_submit_project","prj_name","prj_addrs","prj_dateline","id_client","status_project","project_last_modified"
        );
        $result = selectRow("mstr_project",$where,$field);
        return $result;
    }
    public function insert(){
        $data = array(
            "prj_name" => $this->prj_name,
            "prj_addrs" => $this->prj_addrs,
            "prj_dateline" => $this->prj_dateline,
            "id_client" => $this->id_client,
            "status_project" => "ACTIVE",
            "project_last_modified" => $this->project_last_modified,
            "id_last_modified" => $this->id_last_modified,
        );
        return insertRow("mstr_project",$data);
    }
    public function update(){
        $where = array(
            "id_submit_project" => $this->id_submit_project
        );
        $data = array(
            "prj_name" => $this->prj_name,
            "prj_addrs" => $this->prj_addrs,
            "prj_dateline" => $this->prj_dateline,
            "id_client" => $this->id_client,
            "project_last_modified" => $this->project_last_modified,
            "id_last_modified" => $this->id_last_modified,
        );
        updateRow("mstr_project",$data,$where);
        return true;
    }
    public function delete(){
        $where = array(
            "id_submit_project" => $this->id_submit_project
        );
        $data = array(
            "status_project" => "NOT ACTIVE",
            "project_last_modified" => $this->project_last_modified,
            "id_last_modified" => $this->id_last_modified,
        );
        updateRow("mstr_project",$data,$where);
        return true;
    }
    public function done(){
        $where = array(
            "id_submit_project" => $this->id_submit_project
        );
        $data = array(
            "status_project" => "DONE",
            "project_last_modified" => $this->project_last_modified,
            "id_last_modified" => $this->id_last_modified,
        );
        updateRow("mstr_project",$data,$where);
        return true;
    }
    #setter & getter
    public function set_id_submit_project($id_submit_project){
        if($id_submit_project != "" && is_numeric($id_submit_project)){
            $this->id_submit_project = $id_submit_project;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_prj_name($prj_name){
        if($prj_name != ""){
            $this->prj_name = $prj_name;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_prj_addrs($prj_addrs){
        if($prj_addrs != ""){
            $this->prj_addrs = $prj_addrs;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_prj_dateline($prj_dateline){
        if($prj_dateline != ""){
            $this->prj_dateline = $prj_dateline;
            return true;
        }
        else{
            return false;
        }
    }
    public function set_id_client($id_client){
        if($id_client != ""  && is_numeric($id_client)){
            $this->id_client = $id_client;
            return true;
        }
        else{
            return false;
        }
    }   
    public function get_id_submit_project(){
        return $this->id_submit_project;
    }
    public function get_prj_name(){
        return $this->prj_name;
    }
    public function get_prj_addrs(){
        return $this->prj_addrs;
    }
    public function get_prj_dateline(){
        return $this->prj_dateline;
    }
    public function get_id_client(){
        return $this->id_client;
    }
}
?>