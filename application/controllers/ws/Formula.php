<?php
defined("BASEPATH") or exit("No Direct Script is Allowed");

class Formula extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("m_formula");
        $this->load->model("m_formula_attr");
    }
    public function get_formula($id_submit_formula){
        $respond["status"] = "SUCCESS";
        $respond["main"] = array();
        $respond["attr"] = array();

        if(is_numeric($id_submit_formula)){
            $result = $this->m_formula->detail($id_submit_formula)->result_array();
            if(count($result) > 0){
                $respond["main"] = array(
                    "id_formula" => $result[0]["id_submit_formula"],
                    "formula_name" => $result[0]["formula_name"],
                    "formula_desc" => $result[0]["formula_desc"]
                );
            
                $result = $this->m_formula_attr->formula_attr($id_submit_formula)->result_array();
                $row = count($result);
                for($a = 0; $a<$row; $a++){
                    $respond["attr"][$a] = array(
                        "id_formula_comb" => $result[$a]["id_submit_formula_comb"],
                        "id_formula_attr" => $result[$a]["id_formula_attr"],
                        "attr_name" => $result[$a]["formula_attr_name"],
                        "attr_formula" => $result[$a]["combination_formula"]
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
}
?>
