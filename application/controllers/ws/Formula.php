<?php
defined("BASEPATH") or exit("No Direct Script is Allowed");

class Formula extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function get_formula($id_submit_formula){
        $respond["status"] = "SUCCESS";
        $respond["main"] = array();
        $respond["attr"] = array();

        if($id_submit_formula != "" && is_numeric($id_submit_formula)){
            $this->load->model("m_formula");
            $this->m_formula->set_id_submit_formula($id_submit_formula);
            $result = $this->m_formula->detail();
            if($result->num_rows() > 0){
                $result = $result->result_array();
                $respond["main"] = array(
                    "id_formula" => $result[0]["id_submit_formula"],
                    "formula_name" => $result[0]["formula_name"],
                    "formula_desc" => $result[0]["formula_desc"]
                );
                
                $this->load->model("m_formula_comb");
                $this->m_formula_comb->set_id_mstr_formula($id_submit_formula);
                $result = $this->m_formula_comb->list();
                if($result->num_rows() > 0){
                    $result = $result->result_array();
                    for($a = 0; $a<count($result); $a++){
                        $respond["attr"][$a] = array(
                            "id_formula_comb" => $result[$a]["id_submit_formula_comb"],
                            "id_formula_attr" => $result[$a]["id_formula_attr"],
                            "attr_name" => $result[$a]["formula_attr_name"],
                            "koefisien" => $result[$a]["koefisien"]
                        );
                    }
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
