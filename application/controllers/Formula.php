<?php
defined("BASEPATH") or exit("No Direct Script Access is Allowed");

class Formula extends CI_Controller{
    private function check_session(){
        if($this->session->id_submit_acc == ""){
            redirect("welcome/login");
            exit();
        }
    }  
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->check_session();
        $this->load->view("req_include/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("req_include/page_open");
        $this->load->view("req_include/navbar");
        $this->load->view("formula/page_open");

        $this->load->model("m_formula_cat");
        $data["col"] = $this->m_formula_cat->column();
        

        $this->load->view("formula/category",$data);
        $this->load->view("formula/page_close");
        $this->load->view("req_include/page_close");
        $this->load->view("req_include/script");
        $this->load->view("plugin/datatable/datatable-js");
    }
    
    public function subformula($id_formula_cat){
        $this->check_session();
        
        $this->load->view("req_include/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/form/form-css");
        $this->load->view("req_include/page_open");
        $this->load->view("req_include/navbar");
        $this->load->view("formula/page_open");

        $data["id_formula_cat"] = $id_formula_cat;

        $this->load->model("m_formula");
        $data["col"] = $this->m_formula->column();

        $this->load->model("m_formula_attr");
        $result = $this->m_formula_attr->list();
        $data["attr"] = $result->result();

        $this->load->view("formula/content",$data);
        $this->load->view("formula/page_close");
        $this->load->view("req_include/page_close");
        $this->load->view("req_include/script");
        $this->load->view("plugin/form/form-js");
        $this->load->view("plugin/datatable/datatable-js");
    }
    
    public function import_cat(){
        $data = array(
            "A. PEKERJAAN PERSIAPAN",
            "B. PEKERJAAN TANAH DAN PONDASI",
            "C. PEKERJAAN STRUKTUR",
            "D. PEKERJAAN DINDING",
            "E. PEKERJAAN PLAFOND",
            "F. PEKERJAAN LANTAI",
            "G. PEKERJAAN CAT",
            "H. PEKERJAAN KUSEN PINTU DAN JENDELA",
            "I. PEKERJAAN LISTRIK",
            "J. PEKERJAAN INSTALASI AIR",
            "K. PEKERJAAN WC",
            "PEKERJAAN DAPUR BERSIH DAN KOTOR",
            "PEKERJAAN LAIN-LAIN"
        );
        for($a = 0; $a<count($data); $a++){
            $this->load->model("m_formula_cat");
            $this->m_formula_cat->set_formula_cat_name($data[$a]);
            $this->m_formula_cat->insert();
        }
    }
    public function import_formula(){
        $data = array(
            "A. PEKERJAAN PERSIAPAN",
            "B. PEKERJAAN TANAH DAN PONDASI",
            "C. PEKERJAAN STRUKTUR",
            "D. PEKERJAAN DINDING",
            "E. PEKERJAAN PLAFOND",
            "F. PEKERJAAN LANTAI",
            "G. PEKERJAAN CAT",
            "H. PEKERJAAN KUSEN PINTU DAN JENDELA",
            "I. PEKERJAAN LISTRIK",
            "J. PEKERJAAN INSTALASI AIR",
            "K. PEKERJAAN WC",
            "PEKERJAAN DAPUR BERSIH DAN KOTOR",
            "PEKERJAAN LAIN-LAIN"
        );
        for($a = 0; $a<count($data); $a++){
            $where = array(
                "formula_cat_name" => $data[$a]
            );
            $field = array(
                "id_submit_formula_cat"
            );
            $result = selectRow("mstr_formula_cat",$where,$field);
            $result = $result->result_array();
            $sql = "update mstr_formula set id_formula_cat = '".$result[0]["id_submit_formula_cat"]."' where formula_name = '".$data[$a]."'";
            executeQuery($sql);
        }
    }
}

?>
