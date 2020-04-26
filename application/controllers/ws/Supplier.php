<?php
defined("BASEPATH") or exit("No Direct Script");

class Supplier extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
    }
    public function list(){
        $respond["status"] = "SUCCESS";
        $respond["content"] = array();

        $order_by = $this->input->get("orderBy");
        $order_direction = $this->input->get("orderDirection");
        $page = $this->input->get("page");
        $search_key = $this->input->get("searchKey");
        $data_per_page = 20;
        
        $this->load->model("m_supplier");
        $result = $this->m_supplier->content($page,$order_by,$order_direction,$search_key,$data_per_page);
        if($result["data"]->num_rows() > 0){
            $result["data"] = $result["data"]->result_array();
            for($a = 0; $a<count($result["data"]); $a++){
                $respond["content"][$a]["id"] = $result["data"][$a]["id_submit_supplier"];
                $respond["content"][$a]["nama"] = $result["data"][$a]["nama_supp"];
                $respond["content"][$a]["desc"] = $result["data"][$a]["desc_supp"];
                $respond["content"][$a]["alamat"] = $result["data"][$a]["alamat_supp"];
                $respond["content"][$a]["pic"] = $result["data"][$a]["pic_supp"];
                $respond["content"][$a]["notelp"] = $result["data"][$a]["notelp_supp"];
                $respond["content"][$a]["last_modified"] = $result["data"][$a]["supp_last_modified"];
                $respond["content"][$a]["status"] = $result["data"][$a]["supp_status"];
            }
        }
        else{
            $respond["status"] = "ERROR";
        }
        $respond["page"] = $this->pagination->generate_pagination_rules($page,$result["total_data"],$data_per_page);

        echo json_encode($respond);
    }
    public function daftar(){
        $respond["status"] = "SUCCESS";
        $respond["supplier"] = array();
        $this->load->model("m_supplier");
        $result = $this->m_supplier->list();
        if($result->num_rows() > 0){
            $result = $result->result_array();
            for($a = 0; $a<count($result); $a++){
                $respond["supplier"][$a]["id"] = $result[$a]["id_submit_supplier"];
                $respond["supplier"][$a]["nama"] = $result[$a]["nama_supp"];
                $respond["supplier"][$a]["desc"] = $result[$a]["desc_supp"];
                $respond["supplier"][$a]["alamat"] = $result[$a]["alamat_supp"];
                $respond["supplier"][$a]["pic"] = $result[$a]["pic_supp"];
                $respond["supplier"][$a]["notelp"] = $result[$a]["notelp_supp"];
                $respond["supplier"][$a]["last_modified"] = $result[$a]["supp_last_modified"];
                $respond["supplier"][$a]["status"] = $result[$a]["supp_status"];
            }
        }
        else{
            $respond["status"] = "ERROR";
        }
        echo json_encode($respond);
    }
    public function register(){
        $respond["status"] = "SUCCESS";
        $respond["id"] = false;
        $config = array(
            array(
                "field" => "nama_supp_add",
                "label" =>"",
                "rules" => "required"
            ),
            array(
                "field" => "desc_supp_add",
                "label" =>"",
                "rules" => "required"
            ),
            array(
                "field" => "almt_supp_add",
                "label" =>"",
                "rules" => "required"
            ),
            array(
                "field" => "pic_supp_add",
                "label" =>"",
                "rules" => "required"
            ),
            array(
                "field" => "notelp_supp_add",
                "label" =>"",
                "rules" => "required"
            ),
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $nama_supp_add = $this->input->post("nama_supp_add");
            $desc_supp_add = $this->input->post("desc_supp_add");
            $almt_supp_add = $this->input->post("almt_supp_add");
            $pic_supp_add = $this->input->post("pic_supp_add");
            $notelp_supp_add = $this->input->post("notelp_supp_add");

            $this->load->model("m_supplier");
            $this->m_supplier->set_nama_supp($nama_supp_add);
            $this->m_supplier->set_desc_supp($desc_supp_add);
            $this->m_supplier->set_alamat_supp($almt_supp_add);
            $this->m_supplier->set_pic_supp($pic_supp_add);
            $this->m_supplier->set_notelp_supp($notelp_supp_add);
            $result = $this->m_supplier->insert();
            if($result){
                $respond["id"] = $result; 
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