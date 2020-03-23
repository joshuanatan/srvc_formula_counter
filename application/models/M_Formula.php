<?php
defined("BASEPATH") or exit("No Direct Script Access is Allowed");

class M_Formula extends CI_Model{
    public function insert($name = "",$desc = "",$id_acc = ""){
        $where = array(
            "formula_name" => $name,
            "id_last_modified" => $id_acc
        );
        $field = array(
            "id_submit_formula"
        );
        $result = selectRow("mstr_formula",$where,$field);
        if(!$result->num_rows() > 0){
            $check = array(
                $name,$desc,$id_acc
            );
            if(!in_array("",$check)){
                $data = array(
                    "formula_name" => $name,
                    "formula_desc" => $desc,
                    "formula_status" => "ACTIVE",
                    "formula_last_modified" => date("Y-m-d H:i:s"),
                    "id_last_modified" => $id_acc
                );
                return insertRow("mstr_formula",$data);
            }
            else{
                return false;
            }
        }
        else{
            $result = $result->result_array();
            return $result[0]["id_submit_formula"];
        }
    }
    public function list(){
        $where = array(
            "formula_status != " => "DELETED" 
        );
        $field = array(
            "formula_name","formula_desc","formula_status","formula_last_modified","id_submit_formula"
        );
        $result = selectRow("mstr_formula",$where,$field);
        return $result;
    }
    public function detail($id_submit_formula){
        $where = array(
            "id_submit_formula" => $id_submit_formula,
        );
        $field = array(
            "id_submit_formula","formula_name","formula_desc"
        );
        $result = selectRow("mstr_formula",$where,$field);
        return $result;
    }
    public function update($id_submit_formula = "",$formula_name = "",$formula_desc = "",$id_last_modified = ""){
        $test = array(
            $id_submit_formula,$formula_name,$formula_desc,$id_last_modified
        );
        if(!in_array("",$test)){
            $where = array(
                "id_submit_formula" => $id_submit_formula
            );
            $data = array(
                "formula_name" => $formula_name,
                "formula_desc" => $formula_desc,
                "formula_last_modified" => date("Y-m-d H:i:s"),
                "id_last_modified" => $id_last_modified
            );
            updateRow("mstr_formula",$data,$where);
            return true;
        }
        else{
            return false;
        }
    }
    public function delete($id_submit_formula = "",$id_last_modified = ""){
        $test = array(
            $id_submit_formula,$id_last_modified
        );
        if(!in_array("",$test)){
            $where = array(
                "id_submit_formula" => $id_submit_formula
            );
            $data = array(
                "formula_status" => "DELETED" ,
                "formula_last_modified" => date("Y-m-d H:i:s"),
                "id_last_modified" => $id_last_modified
            );
            updateRow("mstr_formula",$data,$where);
            return true;
        }
        else{
            return false;
        }
    }
}
?>