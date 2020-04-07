<?php
defined("BASEPATH") or exit("N Direct Script");
date_default_timezone_set("Asia/Jakarta");

class M_toko extends CI_Model{
    private $id_submit_toko = 0;
    private $nama_toko = "";
    private $alamat_toko = "";
    private $pic_toko = "";
    private $notelp_toko = "";
    private $toko_last_modified = "";
    private $id_last_modified = 0;
    
    public function __construct(){
        parent::__construct();
        $this->toko_last_modified = date("Y-m-d H:i:s");
        $this->id_last_modified = $this->session->id_submit_acc;
    }
    public function set_id_submit_toko($id_submit_toko){
        if($id_submit_toko != "" && is_numeric($id_submit_toko)){
            $this->id_submit_toko = $id_submit_toko;
        }
        else{
            return false;
        }
    }
    public function set_nama_toko($nama_toko){
        if($nama_toko != ""){
            $this->nama_toko = $nama_toko;
        }
        else{
            return false;
        }
    }
    public function set_alamat_toko($alamat_toko){
        if($alamat_toko != ""){
            $this->alamat_toko = $alamat_toko;
        }
        else{
            return false;
        }
    }
    public function set_pic_toko($pic_toko){
        if($pic_toko != ""){
            $this->pic_toko = $pic_toko;
        }
        else{
            return false;
        }
    }
    public function set_notelp_toko($notelp_toko){
        if($notelp_toko != ""){
            $this->notelp_toko = $notelp_toko;
        }
        else{
            return false;
        }
    }
    public function get_id_submit_toko(){
        return $this->id_submit_toko;
    }
    public function get_nama_toko(){
        return $this->nama_toko;
    }
    public function get_alamat_toko(){
        return $this->alamat_toko;
    }
    public function get_pic_toko(){
        return $this->pic_toko;
    }
    public function get_notelp_toko(){
        return $this->notelp_toko;
    }
}