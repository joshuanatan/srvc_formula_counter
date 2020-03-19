<?php
defined("BASEPATH") or exit("No Direct Script Allowed");
date_default_timezone_set("Asia/Jakarta");
class Account extends CI_Model{
    public function login($email,$password){
        $where = array(
            "acc_email" => $email,
            "acc_status" => "ACTIVE"
        );
        $field = array(
            "id_submit_acc","acc_name", "acc_pswd"
        );
        $result = selectRow("mstr_acc",$where,$field);
        if($result->num_rows() > 0){
            $result = $result->result_array();
            if (password_verify($password, $result[0]["acc_pswd"])){
                $data = array(
                    "id" => $result[0]["id_submit_acc"],
                    "name" => $result[0]["acc_name"],
                    "email" => $email 
                );
                return $data;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
    public function insert($name = "",$email = "",$pswd = "", $phone = ""){
        $check = array($name,$email,$pswd,$phone);
        if(in_array("",$check)){
            return false;
        }
        else{
            $data = array(
                "acc_name"  => $name,
                "acc_email" => $email,
                "acc_pswd" => password_hash($pswd,PASSWORD_DEFAULT),
                "acc_phone" => $phone,
                "acc_status" => "ACTIVE",
                "acc_last_modified" => date("Y-m-d H:i:s")
            );
            insertRow("mstr_acc",$data);
            return true;
        }
    }
    public function list(){
        $where = array(
            "acc_status !=" => "DELETED"
        );
        $field = array(
            "acc_name","acc_email","acc_phone","acc_status","acc_last_modified"
        );
        $result = selectRow("mstr_acc",$where,$field);
        return $result;
    }
}
?>