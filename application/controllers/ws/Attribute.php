<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
class Attribute extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("m_formula_attr");
    }
    public function get_attribute($id_submit_attr){
        $respond["status"] = "SUCCESS";
        $respond["attr"] = array();
        if($id_submit_attr != "" && is_numeric($id_submit_attr)){
    
            $result = $this->m_formula_attr->detail($id_submit_attr);
            if($result->num_rows() > 0){
                $result = $result->result_array();
                $respond["attr"]["attr_id"] = $id_submit_attr;
                $respond["attr"]["attr_name"] = $result[0]["formula_attr_name"];
                $respond["attr"]["attr_unit"] = $result[0]["satuan_attr"];
                $respond["attr"]["attr_status"] = $result[0]["status_formula_attr"];
                $respond["attr"]["attr_last"] = $result[0]["formula_attr_last_modified"];
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
?>

