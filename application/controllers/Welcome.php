<?php
defined("BASEPATH") or exit("No Direct Script is Allowed");

class Welcome extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("account");
    }
    public function check_session(){
        if($this->session->id_submit_acc == ""){
            redirect("welcome/login");
            exit();
        }
    }  
    public function index(){
        $this->session->sess_destroy();
        $result = $this->account->list();
        if($result->num_rows() > 0){
            $this->login();
        }
        else{
            $this->sign_up();
        }
    }
    public function login(){
        $this->load->view("login/login_page");
        $this->load->view("req_include/script");
    }
    public function auth(){
        $config = array(
            array(
                "field" => "email",
                "label" => "Email",
                "rules" => "required"
            ),
            array(
                "field" => "password",
                "label" => "Password",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $email = $this->input->post("email");
            $pswd = $this->input->post("password");
            $result = $this->account->login($email,$pswd);
            if(!$result){
                $msg = "Incorrect Combination, Please try again!";
                $this->session->set_flashdata("msg",$msg);
                $this->session->set_flashdata("type","danger");
            }
            else{
                $msg = "User Authenticated, Welcome!";
                $this->session->set_flashdata("msg",$msg);
                $this->session->set_flashdata("type","success");

                $data = array(
                    "id_submit_acc" => $result["id"],
                    "acc_name" => $result["name"],
                    "acc_email" => $result["email"],
                );
                $this->session->set_userdata($data);
                redirect("welcome/dashboard");
            }
        }
        else{
            $msg = validation_errors();
            $this->session->set_flashdata("msg",$msg);
            $this->session->set_flashdata("type","danger");
        }
        redirect("welcome");
    }
    public function dashboard(){
        $this->check_session();
        $this->load->view("req_include/head");
        $this->load->view("req_include/navbar");
        $this->load->view("req_include/page_open");
        $this->load->view("dashboard/page_open");
        $this->load->view("dashboard/page_close");
        $this->load->view("req_include/page_close");
        $this->load->view("req_include/script");
    }
    public function sign_up(){
        $this->load->view("login/signup_page");
        $this->load->view("req_include/script");
    }
    public function register(){
        $config = array(
            array(
                "field" => "email",
                "label" => "Account Email",
                "rules" => "required|valid_email|is_unique[mstr_acc.acc_email]"
            ),
            array(
                "field" => "password",
                "label" => "Login Password",
                "rules" => "required"
            ),
            array(
                "field" => "name",
                "label" => "Account Name",
                "rules" => "required"
            ),
            array(
                "field" => "phone",
                "label" => "Account Phone Number",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $name = $this->input->post("name");
            $email = $this->input->post("email");
            $pswd = $this->input->post("password");
            $phone = $this->input->post("phone");
            if($this->account->insert($name,$email,$pswd,$phone)){
                $msg = "Account Registered, Please Login";
                $this->session->set_flashdata("msg",$msg);
                $this->session->set_flashdata("type","success");
                redirect("welcome/login");
            }
            else{
                $msg = "Error creating account, please contact developer";
                $this->session->set_flashdata("msg",$msg);
                $this->session->set_flashdata("type","danger");
            }
        }
        else{
            $msg = validation_errors();
            $this->session->set_flashdata("msg",$msg);
            $this->session->set_flashdata("type","danger");
        }
        redirect("welcome/sign_up");
    }
}
?>