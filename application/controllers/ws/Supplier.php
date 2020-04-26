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
        $config = array(
            array(
                "field" => "nama",
                "label" => "Nama Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "desc",
                "label" => "Desc Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "alamat",
                "label" => "Alamat Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "pic",
                "label" => "Pic Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "notelp",
                "label" => "No Telp Supplier",
                "rules" => "required"
            ),
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $nama = $this->input->post("nama");
            $desc = $this->input->post("desc");
            $alamat = $this->input->post("alamat");
            $pic = $this->input->post("pic");
            $notelp = $this->input->post("notelp");

            $this->load->model("m_supplier");
            $this->m_supplier->set_nama_supp($nama);
            $this->m_supplier->set_alamat_supp($alamat);
            $this->m_supplier->set_pic_supp($pic);
            $this->m_supplier->set_notelp_supp($notelp);
            $this->m_supplier->set_desc_supp($desc);
            $this->m_supplier->insert();
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
                "field" => "id",
                "label" => "ID Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "nama",
                "label" => "Nama Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "desc",
                "label" => "Desc Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "alamat",
                "label" => "Alamat Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "pic",
                "label" => "Pic Supplier",
                "rules" => "required"
            ),
            array(
                "field" => "notelp",
                "label" => "No Telp Supplier",
                "rules" => "required"
            ),
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $id = $this->input->post("id");
            $nama = $this->input->post("nama");
            $desc = $this->input->post("desc");
            $alamat = $this->input->post("alamat");
            $pic = $this->input->post("pic");
            $notelp = $this->input->post("notelp");

            $this->load->model("m_supplier");
            $this->m_supplier->set_id_submit_supplier($id);
            $this->m_supplier->set_nama_supp($nama);
            $this->m_supplier->set_alamat_supp($alamat);
            $this->m_supplier->set_pic_supp($pic);
            $this->m_supplier->set_notelp_supp($notelp);
            $this->m_supplier->set_desc_supp($desc);
            $this->m_supplier->update();
        }
        else{
            $respond["status"] = "ERROR";
            $respond["msg"] = validation_errors();
        }
        echo json_encode($respond);
    }
    public function delete($id_supplier){
        $respond["status"] = "SUCCESS";
        if($id_supplier != "" && is_numeric($id_supplier)){
            $this->load->model("m_supplier");
            $this->m_supplier->set_id_submit_supplier($id_supplier);
            $this->m_supplier->delete();
        }
        else{
            $respond["status"] = "SUCCESS";
            $respond["msg"] = validation_errors();
        }
        echo json_encode($respond);
    }
}