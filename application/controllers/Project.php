<?php
defined("BASEPATH") or exit("No Direct Script");

class Project extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->load->view("req_include/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("req_include/page_open");
        $this->load->view("req_include/navbar");
        $this->load->view("project/page_open");

        $this->load->model("m_client");
        $this->load->model("m_project");
        $result = $this->m_project->list();
        $data["project"] =  $result->result_array();

        $result = $this->m_client->list();
        $data["cp"] = $result->result_array();

        $this->load->view("project/content",$data);
        $this->load->view("project/page_close");
        $this->load->view("req_include/page_close");
        $this->load->view("req_include/script");
        $this->load->view("plugin/datatable/datatable-js");
    }
    public function register(){
        $config = array(
            array(
                "field" => "prj_name",
                "label" => "Project Name",
                "rules" => "required"
            ),
            array(
                "field" => "prj_addrs",
                "label" => "Project Address",
                "rules" => "required"
            ),
            array(
                "field" => "prj_dateline",
                "label" => "Project Dateline",
                "rules" => "required"
            ),
            array(
                "field" => "id_client",
                "label" => "Contact Person",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $this->load->model("m_project");
            $prj_name = $this->input->post("prj_name");
            $prj_addrs = $this->input->post("prj_addrs");
            $prj_dateline = $this->input->post("prj_dateline");
            $id_client = $this->input->post("id_client");
            if($id_client == "0"){
                $config = array(
                    array(
                        "field" => "clnt_name",
                        "label" => "Client Name",
                        "rules" => "required"
                    ),
                    array(
                        "field" => "clnt_phone",
                        "label" => "Client Phone",
                        "rules" => "required"
                    ),
                    array(
                        "field" => "clnt_email",
                        "label" => "Client Email",
                        "rules" => "required|valid_email"
                    )
                );
                $this->form_validation->set_rules($config);
                if($this->form_validation->run()){
                    $this->load->model("m_client");
                    
                    $clnt_name = $this->input->post("clnt_name");
                    $clnt_phone = $this->input->post("clnt_phone");
                    $clnt_email = $this->input->post("clnt_email");
                    $this->m_client->set_clnt_name($clnt_name);
                    $this->m_client->set_clnt_phone($clnt_phone);
                    $this->m_client->set_clnt_email($clnt_email);
                    $id_client = $this->m_client->insert();
                }
            }
            $this->m_project->set_prj_name($prj_name);
            $this->m_project->set_prj_addrs($prj_addrs);
            $this->m_project->set_prj_dateline($prj_dateline);
            $this->m_project->set_id_client($id_client);
            $this->m_project->insert();
        }
        else{

        }
        redirect("project");
    }
    public function update(){
        $config = array(
            array(
                "field" => "id_submit_project",
                "label" => "ID Project",
                "rules" => "required|integer"
            ),
            array(
                "field" => "prj_name",
                "label" => "Project Name",
                "rules" => "required"
            ),
            array(
                "field" => "prj_addrs",
                "label" => "Project Address",
                "rules" => "required"
            ),
            array(
                "field" => "prj_dateline",
                "label" => "Project Dateline",
                "rules" => "required"
            ),
            array(
                "field" => "id_client",
                "label" => "Contact Person",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $this->load->model("m_project");
            $id_project = $this->input->post("id_submit_project");
            $prj_name = $this->input->post("prj_name");
            $prj_addrs = $this->input->post("prj_addrs");
            $prj_dateline = $this->input->post("prj_dateline");
            $id_client = $this->input->post("id_client");
            if($id_client == "0"){
                $config = array(
                    array(
                        "field" => "clnt_name",
                        "label" => "Client Name",
                        "rules" => "required"
                    ),
                    array(
                        "field" => "clnt_phone",
                        "label" => "Client Phone",
                        "rules" => "required"
                    ),
                    array(
                        "field" => "clnt_email",
                        "label" => "Client Email",
                        "rules" => "required|valid_email"
                    )
                );
                $this->form_validation->set_rules($config);
                if($this->form_validation->run()){
                    $this->load->model("m_client");
                    
                    $clnt_name = $this->input->post("clnt_name");
                    $clnt_phone = $this->input->post("clnt_phone");
                    $clnt_email = $this->input->post("clnt_email");
                    $this->m_client->set_clnt_name($clnt_name);
                    $this->m_client->set_clnt_phone($clnt_phone);
                    $this->m_client->set_clnt_email($clnt_email);
                    $id_client = $this->m_client->insert();
                }
            }
            $this->m_project->set_id_submit_project($id_project);
            $this->m_project->set_prj_name($prj_name);
            $this->m_project->set_prj_addrs($prj_addrs);
            $this->m_project->set_prj_dateline($prj_dateline);
            $this->m_project->set_id_client($id_client);
            $this->m_project->update();
        }
        else{

        }
        redirect("project");
    }
    public function delete(){
        $config = array(
            array(
                "field" => "id_project",
                "label" => "ID Project",
                "rules" => "required" 
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $this->load->model("m_project");
            $id_project = $this->input->post("id_project");
            $this->m_project->set_id_submit_project($id_project);
            $this->m_project->delete();
        }
        else{

        }
        redirect("project");
    }
    public function rab($id_project){
        if($id_project == "" || !is_numeric($id_project)){
            redirect("project");
        }
        $this->load->view("req_include/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("req_include/page_open");
        $this->load->view("req_include/navbar");
        $this->load->view("project/page_open");

        $this->load->model("m_rab");
        $this->load->model("m_project");
        $this->load->model("m_formula");

        $this->m_project->set_id_submit_project($id_project);
        $result = $this->m_project->detail();
        $data["project"] = $result->result_array();

        $this->m_rab->set_id_project($id_project);
        $result = $this->m_rab->list();
        $data["rab"] = $result->result_array();
        
        $this->load->view("project/rab",$data);
        $this->load->view("project/page_close");
        $this->load->view("req_include/page_close");
        $this->load->view("req_include/script");
        $this->load->view("plugin/datatable/datatable-js");
    }
    public function register_rab(){
        $config = array(
            array(
                "field" => "id_prj",
                "label" => "",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $id_prj = $this->input->post("id_prj");
            $checks = $this->input->post("check");
            if($checks != ""){
                foreach($checks as $a){
                    $config = array(
                        array(
                            "field" => "formula".$a,
                            "label" => "Formula",
                            "rules" => "required"
                        ),
                        array(
                            "field" => "satuan_htg".$a,
                            "label" => "Count Unit",
                            "rules" => "required"
                        )
                    );
                    $this->form_validation->set_rules($config);
                    if($this->form_validation->run()){
                        $this->load->model("m_rab");
                        $id_formula = $this->input->post("formula".$a);
                        $satuan_htg = $this->input->post("satuan_htg".$a); 

                        $this->m_rab->set_id_project($id_prj);
                        $this->m_rab->set_id_formula($id_formula);
                        $this->m_rab->set_satuan_htg($satuan_htg);
                        $this->m_rab->insert();
                    }
                }
            }
        }
        redirect("project/rab/".$id_prj);
    }
}