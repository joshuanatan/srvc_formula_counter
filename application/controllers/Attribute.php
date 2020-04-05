<?php
defined("BASEPATH") or exit("No Direct Script Allowed");

class Attribute extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->load->view("req_include/head");
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("req_include/page_open");
        $this->load->view("req_include/navbar");
        $this->load->view("attribute/page_open");
        
        $this->load->model("m_formula_attr");
        $this->m_formula_attr->set_tipe_attr("BAHAN");
        $result = $this->m_formula_attr->list();
        $data = array(
            "attribute" => $result->result()
        );
        $this->load->view("attribute/content",$data);
        $this->load->view("attribute/page_close");
        $this->load->view("req_include/page_close");
        $this->load->view("req_include/script");
        $this->load->view("plugin/datatable/datatable-js");
    }
    public function register(){
        $config = array(
            array(
                "field" => "attr_name",
                "label" => "Attribute Name",
                "rules" => "required"
            ),
            array(
                "field" => "attr_unit",
                "label" => "Attribute Unit",
                "rules" => "required"
            ),
            array(
                "field" => "attr_price",
                "label" => "Attribute Price",
                "rules" => "required|integer"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $this->load->model("m_formula_attr");
            $attr_name = $this->input->post("attr_name");
            $hrg_attr = $this->input->post("attr_price");
            $attr_unit = $this->input->post("attr_unit");

            $this->m_formula_attr->set_formula_attr_name($attr_name);
            $this->m_formula_attr->set_harga_satuan_attr($hrg_attr);
            $this->m_formula_attr->set_satuan_attr($attr_unit);
            $this->m_formula_attr->set_tipe_attr("BAHAN");
            $id_formula_attr = $this->m_formula_attr->insert();
        }
        redirect("attribute");
    }
    public function update(){
        $config = array(
            array(
                "field" => "attr_name",
                "label" => "Attribute Name",
                "rules" => "required"
            ),
            array(
                "field" => "attr_id",
                "label" => "Attribute ID",
                "rules" => "required"
            ),
            array(
                "field" => "attr_unit",
                "label" => "Attribute Unit",
                "rules" => "required"
            ),
            array(
                "field" => "attr_price",
                "label" => "Attribute Price",
                "rules" => "required|integer"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $this->load->model("m_formula_attr");

            $attr_id = $this->input->post("attr_id");
            $attr_name = $this->input->post("attr_name");
            $attr_price = $this->input->post("attr_price");
            $attr_unit = $this->input->post("attr_unit");

            $this->m_formula_attr->set_id_submit_formula_attr($attr_id);
            $this->m_formula_attr->set_formula_attr_name($attr_name);
            $this->m_formula_attr->set_harga_satuan_attr($attr_price);
            $this->m_formula_attr->set_satuan_attr($attr_unit);
            $this->m_formula_attr->update();
        }
        redirect("attribute");
    }
    public function delete(){
        $config = array(
            array(
                "field" => "attr_id",
                "label" => "Attribute ID",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $this->load->model("m_formula_attr");

            $attr_id = $this->input->post("attr_id");
            $this->m_formula_attr->set_id_submit_formula_attr($attr_id);
            $this->m_formula_attr->delete();
        }
        redirect("attribute");
    }
    public function import(){
        $data = array(
            'Acetyline'
            ,'Abu Batu'
            ,'Aluminium Foil Single Side'
            ,'Aluminium Foil Double Sided'
            ,'Amplas Besi'
            ,'Amplas Duco'
            ,'Amplas Kayu'
            ,'Anti Rayap'
            ,'Asbes Gelombang Kecil'
            ,'Asbes Gelombang Besar'
            ,'Asbes Nok Gelombang Kecil'
            ,'Asbes Pertemuan Nok 2 Arah L'
            ,'Asbes Pertemuan Nok 3 Arah T'
            ,'Asbes Pertemuan Nok 4 Arah +'
            ,'Asbes Ujung Nok'
            ,'Asbes Nok Gelombang Besar'
            ,'Asbes Pertemuan Nok 2 Arah L'
            ,'Asbes Pertemuan Nok 3 Arah T'
            ,'Asbes Pertemuan Nok 4 Arah +'
            ,'Asbes Ujung Nok'
            ,'Asbes Plat 4mm'
            ,'Asbes Plat 6mm'
            ,'Aspal'
            ,'Balok Kayu Jati BELUM Diserut'
            ,'Balok Kayu Bangkirai BELUM Diserut'
            ,'Balok Kayu Kamper Samarinda BELUM Diserut'
            ,'Balok Kayu Kamper Medan BELUM Diserut'
            ,'Balok Kayu Meranti BELUM Diserut'
            ,'Balok Kayu Borneo BELUM Diserut'
            ,'Balok Kayu Jati SUDAH Diserut'
            ,'Balok Kayu Bangkirai SUDAH Diserut'
            ,'Balok Kayu Kamper Samarinda SUDAH Diserut'
            ,'Balok Kayu Kamper Medan SUDAH Diserut'
            ,'Balok Kayu Meranti SUDAH Diserut'
            ,'Balok Kayu Borneo SUDAH Diserut'
            ,'Bak Mandi Fibre Import Type-1'
            ,'Bak Mandi Fibre Import Type-2'
            ,'Bak Mandi Fibre Import Type-3'
            ,'Bak Mandi Lokal Fibre Type-1'
            ,'Bak Mandi Lokal Fibre Type-2'
            ,'Bak Mandi Lokal Fibre Type-3'
            ,'Bambu Besar'
            ,'Bambu Sedang'
            ,'Bambu Kecil'
            ,'Bath Tube Import'
            ,'Bath Tube Import'
            ,'Bath Tube Import'
            ,'Bath Tube Lokal Toto'
            ,'Bath Tube Lokal Toto'
            ,'Bath Tube Lokal Toto'
            ,'Bath Tube Lokal KIA'
            ,'Bath Tube Lokal KIA'
            ,'Bath Tube Lokal KIA'
            ,'Bath Tube Lokal INA'
            ,'Bath Tube Lokal INA'
            ,'Bath Tube Lokal INA'
            ,'Bath Tube Shower Import'
            ,'Bath Tube Shower Import'
            ,'Bath Tube Shower Import'
            ,'Bath Tube Shower Lokal Toto'
            ,'Bath Tube Shower Lokal Toto'
            ,'Bath Tube Shower Lokal Toto'
            ,'Bath Tube Shower Lokal KIA'
            ,'Bath Tube Shower Lokal KIA'
            ,'Bath Tube Shower Lokal KIA'
            ,'Bath Tube Shower Lokal INA'
            ,'Bath Tube Shower Lokal INA'
            ,'Bath Tube Shower Lokal INA'
            ,'Bataco Semen'
            ,'Batu Bata Kampung'
            ,'Batu Bata Kuo Shin'
            ,'Batu Bata Press'
            ,'Batu Kali/Belah'
            ,'Batu Karang'
            ,'Batu Koral Beton'
            ,'Batu Koral Gundu'
            ,'Batu Koral Sikat'
            ,'Batu Seplit'
            ,'Batu  Alam Bronjol Hitam'
            ,'Batu  Alam Pipih Hitam'
            ,'Batu  Alam Pipih Kuning/Paras'
            ,'Batu Bintang'
            ,'Baut Aisan Kap'
            ,'Baut-baut Angkur dia 19mm'
            ,'Baut-baut Angkur dia 16mm'
            ,'Baut-baut Angkur dia 12mm'
            ,'Baut Gording Baja/Besi Kanal C'
            ,'Baut Sekrup dia.3mm-2,5cm'
            ,'Benang Rami'
            ,'Besi Beton Polos U.24'
            ,'Besi Beton Ulir U.32'
            ,'Besi Hollow 4x4cm P.6,00m'
            ,'Besi Hollow 2x4cm P.4,00m'
            ,'Besi Kanal C'
            ,'Besi Plat'
            ,'Besi Siku'
            ,'Besi WF'
            ,'Beton Ready Mix K.300'
            ,'Beton Ready Mix K.250'
            ,'Beton Ready Mix K.225'
            ,'Beton Ready Mix K.200'
            ,'Beton Ready Mix K.175'
            ,'Beton Ready Mix K.150'
            ,'Beton Ready Mix K.125'
            ,'Bidet Import'
            ,'Bidet Import'
            ,'Bidet Import'
            ,'Bidet Lokal Toto'
            ,'Bidet Lokal Toto'
            ,'Bidet Lokal Toto'
            ,'Bidet Lokal KIA'
            ,'Bidet Lokal KIA'
            ,'Bidet Lokal KIA'
            ,'Bidet Lokal INA'
            ,'Bidet Lokal INA'
            ,'Bidet Lokal INA'
            ,'Box Sikring   2 Group'
            ,'Box Sikring   4 Group'
            ,'Box Sikring   6 Group'
            ,'Box Sikring   8 Group'
            ,'Box Sikring 10 Group'
            ,'Box Sikring 12 Group'
            ,'Buis Beton Bulat dia 100cm'
            ,'Buis Beton Bulat dia   90cm'
            ,'Buis Beton Bulat dia   80cm'
            ,'Buis Beton Bulat dia   70cm'
            ,'Buis Beton Bulat dia   60cm'
            ,'Buis Beton Bulat dia   50cm'
            ,'Buis Beton Bulat dia   40cm'
            ,'Buis Beton Bulat dia   30cm'
            ,'Buis Beton Bulat dia   20cm'
            ,'Buis Beton Setengah dia   60cm'
            ,'Buis Beton Setengah dia   50cm'
            ,'Buis Beton Setengah dia   40cm'
            ,'Buis Beton Setengah dia   30cm'
            ,'Buis Beton Setengah dia   20cm'
            ,'Canopy T"parant R"ka Pipa Hitam Starlite'
            ,'Canopy T"parant R"ka Pipa Galvani Starlite'
            ,'Canopy T"parant R"ka Pipa St.Steel Starlite'
            ,'Canopy T"parant R"ka Pipa Hitam Twinlite'
            ,'Canopy T"parant R"ka Pipa Galvani Twinlite'
            ,'Canopy T"parant R"ka Pipa St.Steel Twinlite'
            ,'Canopy T"parant R"ka Pipa Hitam Lexan'
            ,'Canopy T"parant R"ka Pipa Galvani Lexan'
            ,'Canopy T"parant R"ka Pipa St.Steel Lexan'
            ,'Cat Besi '
            ,'Cat Dasar Besi'
            ,'Cat Dasar Kayu '
            ,'Cat Duco'
            ,'Cat Kayu '
            ,'Cat Tembok Dalam'
            ,'Cat Tembok Luar Mowilex'
            ,'Celcon blok T.10cm'
            ,'Celcon blok T.7,5cm'
            ,'Cermin Wastafel Import Type-1'
            ,'Cermin Wastafel Import Type-2'
            ,'Cermin Wastafel Import Type-3'
            ,'Cermin Wastafel Lokal TOTO Type-1'
            ,'Cermin Wastafel Lokal TOTO Type-2'
            ,'Cermin Wastafel Lokal TOTO Type-3'
            ,'Cermin Wastafel Lokal KIA Type-1'
            ,'Cermin Wastafel Lokal KIA Type-2'
            ,'Cermin Wastafel Lokal KIA Type-3'
            ,'Cermin Wastafel Lokal INA Type-1'
            ,'Cermin Wastafel Lokal INA Type-2'
            ,'Cermin Wastafel Lokal INA Type-3'
            ,'Closet Duduk Import'
            ,'Closet Duduk Import'
            ,'Closet Duduk Import'
            ,'Closet Duduk Lokal Toto'
            ,'Closet Duduk Lokal Toto'
            ,'Closet Duduk Lokal Toto'
            ,'Closet Duduk Lokal KIA'
            ,'Closet Duduk Lokal KIA'
            ,'Closet Duduk Lokal KIA'
            ,'Closet Duduk Lokal INA'
            ,'Closet Duduk Lokal INA'
            ,'Closet Duduk Lokal INA'
            ,'Closet Jongkok Import'
            ,'Closet Jongkok Import'
            ,'Closet Jongkok Import'
            ,'Closet Jongkok Lokal Toto'
            ,'Closet Jongkok Lokal Toto'
            ,'Closet Jongkok Lokal Toto'
            ,'Closet Jongkok Lokal KIA'
            ,'Closet Jongkok Lokal KIA'
            ,'Closet Jongkok Lokal KIA'
            ,'Closet Jongkok Lokal INA'
            ,'Closet Jongkok Lokal INA'
            ,'Closet Jongkok Lokal INA'
            ,'Daun Pintu Panel Kwal.Politur Jati'
            ,'Daun Pintu Panel Solid Kwalitet Cat Jati'
            ,'Daun Pintu Solid Kw.Politur Bangkirai'
            ,'Daun Pintu Solid K"litet Cat  Bangkirai'
            ,'Daun Pintu Solid Kw.Politur Kamper Smd'
            ,'Daun Pintu Solid K"litet Cat  Kamper Smd'
            ,'Daun Pintu Solid Kwal.Politur Kpr.Medan'
            ,'Daun Pintu Solid K"litet Cat Kamper Medan'
            ,'Daun Pintu Solid Kwal.Politur Meranti'
            ,'Daun Pintu Solid K"litet Cat Meranti'
            ,'Daun Pintu Solid Kwal.Politur Nyatoh'
            ,'Daun Pintu Solid K"litet Cat Nyatoh'
            ,'Daun Pintu Krepyak/Grill Kwal.Politur Jati'
            ,'Daun Pintu Krepyak/Grill Kwalitet Cat Jati'
            ,'Daun Pintu Krepyak/Grill Kwal.Politur Bangkirai'
            ,'Daun Pintu Krepyak/Grill Kwalitet Cat Bangkirai'
            ,'Daun Pintu Krepyak/Grill Kwal.Politur Kpr.Smd'
            ,'Daun Pintu Krepyak/Grill Kwalitet Cat Kpr.Smd'
            ,'Daun Pintu Krepyak/Grill Kwal.Politur Kpr.Medan'
            ,'Daun Pintu Krepyak/Grill Kwalitet Cat Kpr.Medan'
            ,'Daun Pintu Krepyak/Grill Kwal.Politur Meranti'
            ,'Daun Pintu Krepyak/Grill Kwalitet Cat Meranti'
            ,'Daun Pintu Krepyak/Grill Kwal.Politur Nyatoh'
            ,'Daun Pintu Krepyak/Grill Kwalitet Cat Nyatoh'
            ,'Daun Pintu Kaca Kwal.Politur Jati'
            ,'Daun Pintu Kaca Kwalitet Cat Jati'
            ,'Daun Pintu Kaca Kw.Politur Bangkirai'
            ,'Daun Pintu Kaca Kw.Cat Bangkirai'
            ,'Daun Pintu Kaca Kw.Politur Kpr Smd'
            ,'Daun Pintu Kaca Kw.Cat  Kpr.Smd'
            ,'Daun Pintu Kaca Kw.Politur Kpr Medan'
            ,'Daun Pintu Kaca Kw.Cat  Kpr.Medan'
            ,'Daun Pintu Kaca Kw.Politur Meranti'
            ,'Daun Pintu Kaca Kw.Cat Meranti'
            ,'Daun Pintu Kaca Kw.Politur Nyatoh'
            ,'Daun Pintu Kaca Kw.Cat Nyatoh'
            ,'Daun Pintu Panel+Krepyak Kwal.Politur Jati'
            ,'Daun Pintu Panel+Krepyak Kwalitet Cat Jati'
            ,'Daun Pintu Panel+Krepyak Kw.Politur Bangkirai'
            ,'Daun Pintu Panel+Krepyak Kw.Cat  Bangkirai'
            ,'Daun Pintu Panel+Krepyak Kw.Politur Kpr Smd'
            ,'Daun Pintu Panel+Krepyak Kw.Cat  Kpr.Smd'
            ,'Daun Pintu Panel+Krepyak Kw.Politur Kpr Medan'
            ,'Daun Pintu Panel+Krepyak Kw.Cat  Kpr.Medan'
            ,'Daun Pintu Panel+Krepyak Kw.Politur Meranti'
            ,'Daun Pintu Panel+Krepyak Kw.Cat Meranti'
            ,'Daun Pintu Panel+Krepyak Kw.Politur Nyatoh'
            ,'Daun Pintu Panel+Krepyak Kw.Cat Nyatoh'
            ,'Daun Pintu Panel+Kaca Kwal.Politur Jati'
            ,'Daun Pintu Panel+Kaca Kwalitet Cat Jati'
            ,'Daun Pintu Panel+Kaca Kw.Politur Bangkirai'
            ,'Daun Pintu Panel+Kaca Kw.Cat  Bangkirai'
            ,'Daun Pintu Panel+Kaca Kw.Politur Kpr Smd'
            ,'Daun Pintu Panel+Kaca Kw.Cat  Kpr.Smd'
            ,'Daun Pintu Panel+Kaca Kw.Politur Kpr Medan'
            ,'Daun Pintu Panel+Kaca Kw.Cat  Kpr.Medan'
            ,'Daun Pintu Panel+Kaca Kw.Politur Meranti'
            ,'Daun Pintu Panel+Kaca Kw.Cat Meranti'
            ,'Daun Pintu Panel+Kaca Kw.Politur Nyatoh'
            ,'Daun Pintu Panel+Kaca Kw.Cat Nyatoh'
            ,'Daun Pintu Teak Wood Rka Jati Kw.Politur'
            ,'Daun Pintu Teak Wood Rangka Jati Kw.Cat'
            ,'Daun Pintu Teak Wood Rangka B"kirai Kw.Politur'
            ,'Daun Pintu Teak Wood Rangka B"kirai Kw.Cat'
            ,'Daun Pintu Teak Wood Rka Kpr Smd Kw.Politur'
            ,'Daun Pintu Teak Wood Rka Kpr Smd Kw.Cat'
            ,'Daun Pintu Teak Wood Rka Kpr Mdn Kw.Politur'
            ,'Daun Pintu Teak Wood Rka Kpr Mdn Kw.Cat'
            ,'Daun Pintu Teak Wood Rka Meranti Kw.Politur'
            ,'Daun Pintu Teak Wood Rka Meranti Kw.Cat'
            ,'Daun Pintu Teak Wood Rka Nyatoh Kw.Politur'
            ,'Daun Pintu Teak Wood Rka Nyatoh Kw.Cat'
            ,'Daun Pintu Teak M"minto Rka Jati Kw.Politur'
            ,'Daun Pintu Teak Melaminto Rangka Jati Kw.Cat'
            ,'Daun Pintu Teak M"minto Raka B"kirai Kw.Politur'
            ,'Daun Pintu Teak M"minto Rangka B"kirai Kw.Cat'
            ,'Daun Pintu Teak M"minto Rka Kpr Smd Kw.Politur'
            ,'Daun Pintu Teak M"minto Rka Kpr Smd Kw.Cat'
            ,'Daun Pintu Teak M"minto Rka Kpr Mdn Kw.Politur'
            ,'Daun Pintu Teak M"minto Rka Kpr Mdn Kw.Cat'
            ,'Daun Pintu Teak M"minto Rka Meranti Kw.Politur'
            ,'Daun Pintu Teak M"minto Rka Meranti Kw.Cat'
            ,'Daun Pintu Teak M"minto Rka Nyatoh Kw.Politur'
            ,'Daun Pintu Teak Melaminto Rka Nyatoh Kw.Cat'
            ,'Daun Pintu Triplex Rangka Jati Kw.Politur'
            ,'Daun Pintu Triplex Rangka Jati Kw.Cat'
            ,'Daun Pintu Triplex Rangka B"kirai Kw.Politur'
            ,'Daun Pintu Triplex Rangka B"kirai Kw.Cat'
            ,'Daun Pintu Triplex Rangka Kpr Smd Kw.Politur'
            ,'Daun Pintu Triplex Rangka Kpr Smd Kw.Cat'
            ,'Daun Pintu Triplex Rangka Kpr Mdn Kw.Politur'
            ,'Daun Pintu Triplex Rangka Kpr Mdn Kw.Cat'
            ,'Daun Pintu Triplex Rangka Meranti Kw.Politur'
            ,'Daun Pintu Triplex Rangka Meranti Kw.Cat'
            ,'Daun Pintu Triplex Rangka Nyatoh Kw.Politur'
            ,'Daun Pintu Triplex Rangka Nyatoh Kw.Cat'
            ,'Daun Jendela Krepyak Jati Kw.Politur'
            ,'Daun Jendela Krepyak Jati Kw.Cat'
            ,'Daun Jendela Krepyak Bangkirai Kw.Politur'
            ,'Daun Jendela Krepyak Bangkirai Kw.Cat'
            ,'Daun Jendela Krepyak Kpr.S"rinda Kw.Politur'
            ,'Daun Jendela Krepyak Kpr.S"rinda Kw.Cat'
            ,'Daun Jendela Krepyak Kpr.Medan Kw.Politur'
            ,'Daun Jendela Krepyak Kpr.Medan Kw.cat'
            ,'Daun Jendela Krepyak Kpr.Meranti Kw.Politur'
            ,'Daun Jendela Krepyak Kpr.Meranti Kw.Cat'
            ,'Daun Jendela Krepyak Nyatoh Kw.Politur'
            ,'Daun Jendela Krepyak Nyatoh Kw.Cat'
            ,'Daun Jendela Kaca Jati Kw.Politur'
            ,'Daun Jendela Kaca Jati Kw.Cat'
            ,'Daun Jendela Kaca Bangkirai Kw.Politur'
            ,'Daun Jendela Kaca Bangkirai Kw.Cat'
            ,'Daun Jendela Kaca Kpr.S"rinda Kw.Politur'
            ,'Daun Jendela Kaca Kpr.S"rinda Kw.Cat'
            ,'Daun Jendela Kaca Kpr.Medan Kw.Politur'
            ,'Daun Jendela Kaca Kpr.Medan Kw.cat'
            ,'Daun Jendela Kaca Kpr.Meranti Kw.Politur'
            ,'Daun Jendela Kaca Kpr.Meranti Kw.Cat'
            ,'Daun Jendela Kaca Nyatoh Kw.Politur'
            ,'Daun Jendela Kaca Nyatoh Kw.Cat'
            ,'Daun Jendela Panel+Krepyak Kw.Politur Jati'
            ,'Daun Jendela Panel+Krepyak Kwalitet Cat Jati'
            ,'Daun Jendela Panel+Krepyak Kw.Politur B"kirai'
            ,'Daun Jendela Panel+Krepyak Kw.Cat Bangkirai'
            ,'Daun Jendela Panel+Krepyak Kw.Politur Kpr.Smd'
            ,'Daun Jendela Panel+Krepyak Kw.Cat Kpr.Smd'
            ,'Daun Jendela Panel+Krepyak Kw.Politur Kpr Mdn'
            ,'Daun Jendela Panel+Krepyak Kw.Cat Kpr.Medan'
            ,'Daun Jendela Panel+Krepyak Kw.Politur Meranti'
            ,'Daun Jendela Panel+Krepyak Kw.Cat Meranti'
            ,'Daun Jendela Panel+Krepyak Kw.Politur Nyatoh'
            ,'Daun Jendela Panel+Krepyak Kw.Cat Nyatoh'
            ,'Daun Jendela Panel+Kaca Kwal.Politur Jati'
            ,'Daun Jendela Panel+Kaca Kwalitet Cat Jati'
            ,'Daun Jendela Panel+Kaca Kw.Politur Kpr Smd'
            ,'Daun Jendela Panel+Kaca Kw.Cat  Kpr.Smd'
            ,'Daun Jendela Panel+Kaca Kw.Politur Bangkirai'
            ,'Daun Jendela Panel+Kaca Kw.Cat Bangkirai'
            ,'Daun Jendela Panel+Kaca Kw.Politur Kpr Medan'
            ,'Daun Jendela Panel+Kaca Kw.Cat  Kpr.Medan'
            ,'Daun Jendela Panel+Kaca Kw.Politur Meranti'
            ,'Daun Jendela Panel+Kaca Kw.Cat Meranti'
            ,'Daun Jendela Panel+Kaca Kw.Politur Nyatoh'
            ,'Daun Jendela Panel+Kaca Kw.Cat Nyatoh'
            ,'Dolken Besar'
            ,'Dolken Sedang'
            ,'Dolken Kecil'
            ,'Engsel Pintu Swing 4" Stainlees Steel'
            ,'Engsel Pintu Swing 4" Kuningan'
            ,'Engsel Pintu Swing 4" Nylon'
            ,'Engsel Pintu Lipat 2Daun'
            ,'Engsel Pintu Lipat 3Daun'
            ,'Engsel Pintu Lipat 4Daun'
            ,'Engsel Pintu Lipat 5Daun'
            ,'Engsel Pintu Lipat 6Daun'
            ,'Engsel Pintu Lipat 7Daun'
            ,'Engsel Pintu Lipat 8Daun'
            ,'Engsel Jendela Swing 3" Stainlees Steel'
            ,'Engsel Jendela Swing 3" Kuningan'
            ,'Engsel Jendela Swing 3" Nylon'
            ,'Fitting Plafond Lampu Biasa'
            ,'Fitting Plafond Lampu Standart'
            ,'Fitting Plafond Lampu Khusus'
            ,'Floor Drain Import'
            ,'Floor Drain Import'
            ,'Floor Drain Import'
            ,'Floor Drain Lokal Toto'
            ,'Floor Drain Lokal Toto'
            ,'Floor Drain Lokal Toto'
            ,'Floor Drain Lokal KIA'
            ,'Floor Drain Lokal KIA'
            ,'Floor Drain Lokal KIA'
            ,'Floor Drain Lokal INA'
            ,'Floor Drain Lokal INA'
            ,'Floor Drain Lokal INA'
            ,'Formica Besar'
            ,'Formica Kecil'
            ,'Gantungan Handuk Lurus Import'
            ,'Gantungan Handuk Lurus Import'
            ,'Gantungan Handuk Lurus Import'
            ,'Gantungan Handuk Ring Import'
            ,'Gantungan Handuk Ring Import'
            ,'Gantungan Handuk Ring Import'
            ,'Gantungan Handuk Lurus Lokal Toto '
            ,'Gantungan Handuk Lurus Lokal Toto'
            ,'Gantungan Handuk Lurus Lokal Toto'
            ,'Gantungan Handuk Ring Lokal Toto'
            ,'Gantungan Handuk Ring Lokal Toto'
            ,'Gantungan Handuk Ring Lokal Toto'
            ,'Gantungan Handuk Lurus Lokal KIA'
            ,'Gantungan Handuk Lurus Lokal KIA'
            ,'Gantungan Handuk Lurus Lokal KIA'
            ,'Gantungan Handuk Ring Lokal KIA'
            ,'Gantungan Handuk Ring Lokal KIA'
            ,'Gantungan Handuk Ring Lokal KIA'
            ,'Gantungan Handuk Lurus Lokal INA'
            ,'Gantungan Handuk Lurus Lokal INA'
            ,'Gantungan Handuk Lurus Lokal INA'
            ,'Gantungan Handuk Ring Lokal INA'
            ,'Gantungan Handuk Ring Lokal INA'
            ,'Gantungan Handuk Ring Lokal INA'
            ,'Genteng Badan Kodok'
            ,'Genteng Nok Kodok'
            ,'Genteng Pertemuan Nok Kodok 2 Arah L'
            ,'Genteng Pertemuan Nok Kodok 3 Arah T'
            ,'Genteng Pertemuan Nok Kodok 4 Arah +'
            ,'Genteng Ujung Nok Kodok'
            ,'Genteng Tepi Listplank Miring'
            ,'Genteng Badan Plentong'
            ,'Genteng Nok Plentong'
            ,'Genteng Pertemuan Nok Plentong 2 Arah L'
            ,'Genteng Pertemuan Nok Plentong 3 Arah T'
            ,'Genteng Pertemuan Nok Plentong 4 Arah +'
            ,'Genteng Nok Ujung Plentong'
            ,'Genteng Tepi Listplank Miring'
            ,'Genteng Beton Cengkareng Permai Type Besar'
            ,'Genteng Beton Cengkareng Permai Type Kecil'
            ,'Genteng Nok Beton'
            ,'Genteng Pertemuan Nok Beton 2 Arah L'
            ,'Genteng Pertemuan Nok Beton 3 Arah T'
            ,'Genteng Pertemuan Nok Beton 4 Arah +'
            ,'Genteng Nok Ujung Beton'
            ,'Genteng Tepi Listplank Miring'
            ,'Genteng Badan Beton Cisangkan Type Besar'
            ,'Genteng Badan Beton Cisangkan Type Sedang'
            ,'Genteng Badan Beton Cisangkan Type Kecil'
            ,'Genteng Nok Beton Cisangkan'
            ,'Genteng Pertemuan Nok Beton 2 Arah L'
            ,'Genteng Pertemuan Nok Beton 3 Arah T'
            ,'Genteng Pertemuan Nok Beton 4 Arah +'
            ,'Genteng Ujung Nok Beton'
            ,'Genteng Tepi Listplank Miring'
            ,'Genteng Badan Keramik Kanmuri Type Besar'
            ,'Genteng Badan Keramik Kanmuri Type Kecil'
            ,'Genteng Nok Keramik Kanmuri'
            ,'Genteng Pertemuan Nok K"mik Kanmuri 2 Arah L'
            ,'Genteng Pertemuan Nok K"mik Kanmuri 3 Arah T'
            ,'Genteng Pertemuan Nok K"mik Kanmuri 4 Arah +'
            ,'Genteng Ujung Nok Keramik Kanmuri'
            ,'Genteng Tepi Listplank Miring'
            ,'Genteng Badan Keramik KIA Type Standard'
            ,'Genteng Nok Keramik KIA'
            ,'Genteng Pertemuan Nok Keramik KIA 2 Arah L'
            ,'Genteng Pertemuan Nok Keramik KIA 3 Arah T'
            ,'Genteng Pertemuan Nok Keramik KIA 4 Arah +'
            ,'Genteng Ujung Nok Keramik KIA'
            ,'Genteng Tepi Listplank Miring'
            ,'Genteng Badan Metal'
            ,'Genteng Nok Metal'
            ,'Genteng Pertemuan Nok Metal 2 Arah L'
            ,'Genteng Pertemuan Nok Metal 3 Arah T'
            ,'Genteng Pertemuan Nok Metal 4 Arah +'
            ,'Genteng Ujung Nok Metal'
            ,'Genteng Badan Tegola'
            ,'Genteng Nok Tegola'
            ,'Genteng Pertemuan Nok Tegola 2 Arah L'
            ,'Genteng Pertemuan Nok Tegola 3 Arah T'
            ,'Genteng Pertemuan Nok Tegola 4 Arah +'
            ,'Genteng Ujung Nok Tegola'
            ,'Glass Bloc Import 20x20cm Putih'
            ,'Glass Bloc Import 20x20cm Warna'
            ,'Glass Bloc Lokal 20x20cm Putih'
            ,'Glass Bloc Lokal 20x20cm Warna'
            ,'Granit Dinding Import 60x60cm'
            ,'Granit Dinding Import 50x50cm'
            ,'Granit Dinding Import 40x40cm'
            ,'Granit Dinding Import 30x30cm'
            ,'Granit Dinding Import 60x60cm'
            ,'Granit Dinding Import 50x50cm'
            ,'Granit Dinding Import 40x40cm'
            ,'Granit Dinding Import 30x30cm'
            ,'Granito Dinding Lokal 60x60cm'
            ,'Granito Dinding Lokal 50x50cm'
            ,'Granito Dinding Lokal 40x40cm'
            ,'Granito Dinding Lokal 30x30cm'
            ,'Granit Lantai Import 40x40cm'
            ,'Granit Lantai Import 50x50cm'
            ,'Granit Lantai Import 60x60cm'
            ,'Granit Lantai Import Slab'
            ,'Granit Lantai Import 40x40cm'
            ,'Granit Lantai Import 50x50cm'
            ,'Granit Lantai Import 60x60cm'
            ,'Granit Lantai Import Slab'
            ,'Granit Lantai Lokal 80x80'
            ,'Granit Lantai Lokal 50x50'
            ,'Granit Lantai Lokal 60x60'
            ,'Granit Lantai Lokal Slab'
            ,'Grass Bloc Lokal CP'
            ,'Grass Bloc Lokal CIS'
            ,'Grass Bloc Lokal CON'
            ,'Grendel Tanam Pintu 2 Daun Stainless Steel'
            ,'Grendel Tanam Pintu 2 Daun Kuningan'
            ,'Grendel Tanam Pintu 2 Daun Nylon'
            ,'Grendel Tanam Jendela 2 Daun Stainless Steel'
            ,'Grendel Tanam Jendela 2 Daun Kuningan'
            ,'Grendel Tanam Jendela 2 Daun Nylon'
            ,'Gypsum Board T.9mm'
            ,'Gypsum Board T.12mm'
            ,'Injuk Rembesan'
            ,'Impra Politur'
            ,'Jet Washer Closet Duduk Import'
            ,'Jet Washer Closet Duduk Import'
            ,'Jet Washer Closet Duduk Import'
            ,'Jet Washer Closet Duduk Toto'
            ,'Jet Washer Closet Duduk Toto'
            ,'Jet Washer Closet Duduk Toto'
            ,'Jet Washer Closet Duduk KIA'
            ,'Jet Washer Closet Duduk KIA'
            ,'Jet Washer Closet Duduk KIA'
            ,'Jet Washer Closet Duduk INA'
            ,'Jet Washer Closet Duduk INA'
            ,'Jet Washer Closet Duduk INA'
            ,'Kabel NYM 2x1,5 Putih'
            ,'Kabel NYM 2x2,5 Putih'
            ,'Kabel NYM 3x1,5 Putih'
            ,'Kabel NYM 3x2,5 Putih'
            ,'Kabel NYY 3x3,5 Hitam'
            ,'Kabel Toevoer NYM 3x16mm'
            ,'Kaca Brown 5mm'
            ,'Kaca Brown 6mm'
            ,'Kaca Cermin 3mm '
            ,'Kaca Cermin   5mm '
            ,'Kaca Cermin   6mm  '
            ,'Kaca Es   3mm'
            ,'Kaca Es   5mm'
            ,'Kaca Panasap Grey/Blue/Green   5mm'
            ,'Kaca Panasap Grey/Blue/Green   6mm'
            ,'Kaca Panasap Grey/Blue/Green   8mm'
            ,'Kaca Panasap Grey/Blue/Green 12mm'
            ,'Kaca Polos   3mm'
            ,'Kaca Polos   5mm'
            ,'Kaca Polos   6mm'
            ,'Kaca Polos   8mm'
            ,'Kaca Polos 10mm'
            ,'Kaca Polos 12mm'
            ,'Kaca Polos 15mm'
            ,'Kaca Polos 19mm'
            ,'Kaca Rayban 3mm Dark Grey'
            ,'Kaca Rayban   5mm Dark Grey'
            ,'Kaca Rayban   6mm Dark Grey'
            ,'Kaca Rayban   8mm Dark Grey'
            ,'Kaca Rayban 12mm Dark Grey'
            ,'Kaca Reflektif (One Way) 5mm'
            ,'Kaca Reflektif (One Way) 6mm'
            ,'Kaca Stopsol   5mm Blue/Green/Grey'
            ,'Kaca Stopsol   6mm Blue/Green/Grey'
            ,'Kaca Stopsol   8mm Blue/Green/Grey'
            ,'Kaca Stopsol 12mm Blue/Green/Grey'
            ,'Kaca Tempered 10mm Polos'
            ,'Kaca Tempered 12mm Polos'
            ,'Kansteen Beton Jadi'
            ,'Kansteen Beton Jadi'
            ,'Kansteen Beton Jadi'
            ,'Kansteen Beton Jadi'
            ,'Kansteen Beton Jadi'
            ,'Kansteen Beton Jadi'
            ,'Kansteen Beton Jadi'
            ,'Kansteen Beton Jadi'
            ,'Kansteen Beton Jadi'
            ,'Kawat BC Listrik'
            ,'Kawat Beton'
            ,'Kawat Burung'
            ,'Kawat Las'
            ,'Kawat Plafond'
            ,'Kaso Jati'
            ,'Kaso Bangkirai'
            ,'Kaso Kamper Samarinda'
            ,'Kaso Kamper Medan'
            ,'Kaso Meranti'
            ,'Kaso Borneo'
            ,'Keramik Dinding Import 60x60cm'
            ,'Keramik Dinding Import 50x50cm'
            ,'Keramik Dinding Import 40x40cm'
            ,'Keramik Dinding Import 30x30cm'
            ,'Keramik Dinding Import 20x25cm'
            ,'Keramik Dinding Import 20x20cm'
            ,'Keramik Dinding Import 10x20cm'
            ,'Keramik Dinding Lokal 60x60 '
            ,'Keramik Dinding Lokal 50x50 '
            ,'Keramik Dinding Lokal 40x40 '
            ,'Keramik Dinding Lokal 30x30 '
            ,'Keramik Dinding Lokal 20x25 '
            ,'Keramik Dinding Lokal 20x20 '
            ,'Keramik Dinding Lokal 10x20 '
            ,'Keramik Dinding Lokal 60x60 '
            ,'Keramik Dinding Lokal 50x50 '
            ,'Keramik Dinding Lokal 40x40 '
            ,'Keramik Dinding Lokal 30x30 '
            ,'Keramik Dinding Lokal 20x25 '
            ,'Keramik Dinding Lokal 20x20 '
            ,'Keramik Dinding Lokal 10x20 '
            ,'Keramik Dinding Lokal 60x60 '
            ,'Keramik Dinding Lokal 50x50 '
            ,'Keramik Dinding Lokal 40x40 '
            ,'Keramik Dinding Lokal 30x30 '
            ,'Keramik Dinding Lokal 20x25 '
            ,'Keramik Dinding Lokal 20x20 '
            ,'Keramik Dinding Lokal 10x20 '
            ,'Keramik Dinding Lokal 60x60 '
            ,'Keramik Dinding Lokal 50x50 '
            ,'Keramik Dinding Lokal 40x40 '
            ,'Keramik Dinding Lokal 30x30 '
            ,'Keramik Dinding Lokal 20x25 '
            ,'Keramik Dinding Lokal 20x20 '
            ,'Keramik Dinding Lokal 10x20 '
            ,'Keramik Lantai Import 10x20cm'
            ,'Keramik Lantai Import 20x20cm'
            ,'Keramik Lantai Import 30x30cm'
            ,'Keramik Lantai Import 40x40cm'
            ,'Keramik Lantai Import 50x50cm'
            ,'Keramik Lantai Import 60x60cm'
            ,'Keramik Lantai Lokal 10x20'
            ,'Keramik Lantai Lokal 20x20'
            ,'Keramik Lantai Lokal 30x30'
            ,'Keramik Lantai Lokal 40x40'
            ,'Keramik Lantai Lokal 50x50'
            ,'Keramik Lantai Lokal 60x60'
            ,'Keramik Lantai Lokal 10x20'
            ,'Keramik Lantai Lokal 20x20'
            ,'Keramik Lantai Lokal 30x30'
            ,'Keramik Lantai Lokal 40x40'
            ,'Keramik Lantai Lokal 50x50'
            ,'Keramik Lantai Lokal 60x60'
            ,'Keramik Lantai Lokal 10x20'
            ,'Keramik Lantai Lokal 20x20'
            ,'Keramik Lantai Lokal 30x30'
            ,'Keramik Lantai Lokal 40x40'
            ,'Keramik Lantai Lokal 50x50'
            ,'Keramik Lantai Lokal 60x60'
            ,'Keramik Lantai Lokal 10x20'
            ,'Keramik Lantai Lokal 20x20'
            ,'Keramik Lantai Lokal 30x30'
            ,'Keramik Lantai Lokal 40x40'
            ,'Keramik Lantai Lokal 50x50'
            ,'Keramik Lantai Lokal 60x60'
            ,'Keramik Lantai Lokal 10x20'
            ,'Keramik Lantai Lokal 20x20'
            ,'Keramik Lantai Lokal 30x30'
            ,'Keramik Lantai Lokal 40x40'
            ,'Keramik Lantai Lokal 50x50'
            ,'Keramik Lantai Lokal 60x60'
            ,'Kitchen Zink Import 2Lubang+2Sayap'
            ,'Kitchen Zink Import 1Lubang+1Sayap'
            ,'Kitchen Zink Lokal 2Lubang+2Sayap'
            ,'Kitchen Zink Lokal 1Lubang+1Sayap'
            ,'Kitchen Zink Lokal 2Lubang+2Sayap'
            ,'Kitchen Zink Lokal 1Lubang+1Sayap'
            ,'Kitchen Zink Lokal 2Lubang+2Sayap'
            ,'Kitchen Zink Lokal 1Lubang+1Sayap'
            ,'Klem Kabel'
            ,'Klem Pipa Listrik'
            ,'Kosen Aluminium 3" Natural'
            ,'Kosen Aluminium 3" Colour'
            ,'Kosen Aluminium 3" Powder Coating'
            ,'Kosen Aluminium 3" Powder Coating'
            ,'Kosen Aluminium 4" Natural'
            ,'Kosen Aluminium 4" Colour'
            ,'Kosen Aluminium 4" Natural'
            ,'Kosen Kayu Jati Kwalitet Politur'
            ,'Kosen Kayu Jati Kwalitet Cat'
            ,'Kosen Kayu Bangkirai Kwalitet Politur'
            ,'Kosen Kayu Bangkirai Kwalitet Politur'
            ,'Kosen Kayu Kamper Samarinda Kw.Politur'
            ,'Kosen Kayu Kamper Samarinda Kw.Cat'
            ,'Kosen Kayu Kamper Medan Kw.Politur'
            ,'Kosen Kayu Kamper Medan Kw.Cat'
            ,'Kosen Kayu Meranti Kwalitet Politur'
            ,'Kosen Kayu Meranti Kwalitet Cat'
            ,'Kosen Kayu Nyatoh Kwalitet Politur'
            ,'Kosen Kayu Nyatoh Kwalitet Cat'
            ,'Kran Taman Import'
            ,'Kran Taman Lokal TOTO'
            ,'Kran Taman Lokal KIA'
            ,'Kran Taman Lokal INA'
            ,'Kran Tembok Import Type-1'
            ,'Kran Tembok Import Type-2'
            ,'Kran Tembok Import Type-3'
            ,'Kran Tembok Lokal TOTO Type-1'
            ,'Kran Tembok Lokal TOTO Type-2'
            ,'Kran Tembok Lokal TOTO Type-3'
            ,'Kran Tembok Lokal KIA Type-1'
            ,'Kran Tembok Lokal KIA Type-2'
            ,'Kran Tembok Lokal KIA Type-3'
            ,'Kran Tembok Lokal INA Type-1'
            ,'Kran Tembok Lokal INA Type-2'
            ,'Kran Tembok Lokal INA Type-1'
            ,'Kran Zink Import Type-1'
            ,'Kran Zink Import Type-2'
            ,'Kran Zink Import Type-3'
            ,'Kran Zink Lokal TOTO Type-1'
            ,'Kran Zink Lokal TOTO Type-2'
            ,'Kran Zink Lokal TOTO Type-3'
            ,'Kran Zink Lokal KIA Type-1'
            ,'Kran Zink Lokal KIA Type-2'
            ,'Kran Zink Lokal KIA Type-3'
            ,'Kran Zink Lokal INA Type-1'
            ,'Kran Zink Lokal INA Type-2'
            ,'Kran Zink Lokal INA Type-3'
            ,'Kran Taman Import Type-1'
            ,'Kran Taman Import Type-1'
            ,'Kran Taman Import Type-1'
            ,'Kran Taman Lokal TOTO Type-1'
            ,'Kran Taman Lokal TOTO Type-2'
            ,'Kran Taman Lokal TOTO Type-3'
            ,'Kran Taman Lokal KIA Type-1'
            ,'Kran Taman Lokal KIA Type-2'
            ,'Kran Taman Lokal KIA Type-3'
            ,'Kran Taman Lokal KIA Type-1'
            ,'Kran Taman Lokal KIA Type-2'
            ,'Kran Taman Lokal KIA Type-3'
            ,'Kunci Pintu Masuk Utama'
            ,'Kunci Pintu Masuk Utama'
            ,'Kunci Pintu Masuk Utama'
            ,'Kunci Pintu Masuk Lain'
            ,'Kunci Pintu Masuk Lain'
            ,'Kunci Pintu Masuk Lain'
            ,'Kunci Pintu Kamar Utama'
            ,'Kunci Pintu Kamar Utama'
            ,'Kunci Pintu Kamar Utama'
            ,'Kunci Pintu Kamar Lain'
            ,'Kunci Pintu Kamar Lain'
            ,'Kunci Pintu Kamar Lain'
            ,'Kunci Pintu Kamar Mandi Utama'
            ,'Kunci Pintu Kamar Mandi Utama'
            ,'Kunci Pintu Kamar Mandi Utama'
            ,'Kunci Pintu Kamar Mandi Lain'
            ,'Kunci Pintu Kamar Mandi Lain'
            ,'Kunci Pintu Kamar Mandi Lain'
            ,'Kunci Pintu Kamar Service'
            ,'Kunci Pintu Kamar Service'
            ,'Kunci Pintu Kamar Service'
            ,'Kunci Pintu Kamar Mandi Service'
            ,'Kunci Pintu Kamar Mandi Service'
            ,'Kunci Pintu Kamar Mandi Service'
            ,'Kunci Pintu Sliding Cisa'
            ,'Kunci Pintu Sliding Logo'
            ,'Kunci Pintu Sliding Lainnya'
            ,'Kunci Pintu Lipat Umum Cisa'
            ,'Kunci Pintu Lipat Umum Logo'
            ,'Kunci Pintu Lipat Umum Lainnya'
            ,'Kunci Pintu Lipat Garasi Cisa'
            ,'Kunci Pintu Lipat Garasi Logo'
            ,'Kunci Pintu Lipat Garasi Lainnya'
            ,'Kunci Jendela Swing'
            ,'Kunci Jendela Sliding'
            ,'Kunci Jendela Lipat'
            ,'Kwas Cat 2"'
            ,'Kwas Cat 3"'
            ,'Kwas Cat 4"'
            ,'Lambrisering Jati'
            ,'Lambrisering Bangkirai'
            ,'Lambrisering Kamper Samarinda'
            ,'Lambrisering Kamper Medan'
            ,'Lambrisering Meranti'
            ,'Lem PVC'
            ,'List Profil Kayu 3x3cm'
            ,'List Profil Kayu 3x5cm'
            ,'List Profil Kayu 5x5cm'
            ,'List Profil Kayu 5x7,5cm'
            ,'List Profil Kayu 7,5x7,5cm'
            ,'List Profil Gypsum 3x3cm'
            ,'List Profil Gypsum 3x5cm'
            ,'List Profil Gypsum 5x5cm'
            ,'List Profil Gypsum 5x7,5cm'
            ,'List Profil Gypsum 7,5x7,5cm'
            ,'List Profil Gypsum 7,5x10cm'
            ,'List Profil Gypsum 10x10cm'
            ,'List Profil Gypsum 10x15cm'
            ,'List Profil Gypsum 15x15cm'
            ,'Marmer Dinding Import 60x60cm'
            ,'Marmer Dinding Import 50x50cm'
            ,'Marmer Dinding Import 40x40cm'
            ,'Marmer Dinding Import 30x30cm'
            ,'Marmer Dinding Import 60x60cm'
            ,'Marmer Dinding Import 50x50cm'
            ,'Marmer Dinding Import 40x40cm'
            ,'Marmer Dinding Import 30x30cm'
            ,'Marmer Dinding Lokal 60x60cm'
            ,'Marmer Dinding Lokal 50x50cm'
            ,'Marmer Dinding Lokal 40x40cm'
            ,'Marmer Dinding Lokal 30x30cm'
            ,'Marmer Dinding Lokal 60x60cm'
            ,'Marmer Dinding Lokal 50x50cm'
            ,'Marmer Dinding Lokal 40x40cm'
            ,'Marmer Dinding Lokal 30x30cm'
            ,'Marmer Dinding Lokal 60x60cm'
            ,'Marmer Dinding Lokal 50x50cm'
            ,'Marmer Dinding Lokal 40x40cm'
            ,'Marmer Dinding Lokal 30x30cm'
            ,'Marmer Dinding Lokal 60x60cm'
            ,'Marmer Dinding Lokal 50x50cm'
            ,'Marmer Dinding Lokal 40x40cm'
            ,'Marmer Dinding Lokal 30x30cm'
            ,'Marmer Dinding Lokal 60x60cm'
            ,'Marmer Dinding Lokal 50x50cm'
            ,'Marmer Dinding Lokal 40x40cm'
            ,'Marmer Dinding Lokal 30x30cm'
            ,'Marmer Lantai Import 40x40cm'
            ,'Marmer Lantai Import 50x50cm'
            ,'Marmer Lantai Import 60x60cm'
            ,'Marmer Lantai Import Slab'
            ,'Marmer Lantai Import 40x40cm'
            ,'Marmer Lantai Import 50x50cm'
            ,'Marmer Lantai Import 60x60cm'
            ,'Marmer Lantai Import Slab'
            ,'Marmer Lantai Lokal 40x40'
            ,'Marmer Lantai Lokal 50x50'
            ,'Marmer Lantai Lokal 60x60'
            ,'Marmer Lantai Lokal Slab'
            ,'Marmer Lantai Lokal 40x40'
            ,'Marmer Lantai Lokal 50x50'
            ,'Marmer Lantai Lokal 60x60'
            ,'Marmer Lantai Lokal Slab'
            ,'Marmer Lantai Lokal 40x40'
            ,'Marmer Lantai Lokal 50x50'
            ,'Marmer Lantai Lokal 60x60'
            ,'Marmer Lantai Lokal Slab'
            ,'Marmer Lantai Lokal 40x40'
            ,'Marmer Lantai Lokal 50x50'
            ,'Marmer Lantai Lokal 60x60'
            ,'Marmer Lantai Lokal Slab'
            ,'Marmer Lantai Lokal 40x40'
            ,'Marmer Lantai Lokal 50x50'
            ,'Marmer Lantai Lokal 60x60'
            ,'Marmer Lantai Lokal Slab'
            ,'Mata Bor U.Pek.Besi/Baja'
            ,'Mata Gerinda U.Pek.Besi/Baja'
            ,'Meni Besi'
            ,'Meni Kayu'
            ,'MCB Sikring'
            ,'Naco Daun Lebar 15cm Terpasang+Tralis'
            ,'Naco Daun Lebar 10cm Terpasang+Tralis'
            ,'Oker Politur'
            ,'Oksigen U.Pek.Besi/Baja'
            ,'Pagar BRC T.90cm'
            ,'Pagar BRC T.120cm'
            ,'Pagar BRC T.175cm'
            ,'Pagar BRC T.190cm'
            ,'Paku Atap Asbes'
            ,'Paku Gypsum (Warna Putih)'
            ,'Paku Genteng Metal'
            ,'Paku Sekrup 1"'
            ,'Paku Sekrup 2"'
            ,'Paku Sekrup 3"'
            ,'Paku Triplex'
            ,'Paku 5-7cm'
            ,'Paku 10-12cm'
            ,'Paku Seng'
            ,'Pantry/Kitchen Zink 2Lubang 2Sayap Import'
            ,'Pantry/Kitchen Zink 2Lubang 1Sayap Import'
            ,'Pantry/Kitchen Zink 1Lubang 2Sayap Import'
            ,'Pantry/Kitchen Zink 1Lubang 1Sayap Import'
            ,'Pantry Zink 2Lubang 2Sayap Lokal Diethelm'
            ,'Pantry Zink 2Lubang 1Sayap Lokal Diethelm'
            ,'Pantry Zink 1Lubang 2Sayap Lokal Diethelm'
            ,'Pantry Zink 1Lubang 1Sayap Lokal Diethelm'
            ,'Pantry/K"chen Zink 2L"bang 2S"yap Lokal Ariston'
            ,'Pantry/K"chen Zink 2L"bang 1S"yap Lokal Ariston'
            ,'Pantry/K"chen Zink 1L"bang 2S"yap Lokal Ariston'
            ,'Pantry/K"chen Zink 1L"bang 1S"yap Lokal Ariston'
            ,'Pantry/K"chen Zink 2Lbang 2Sayap Lokal Meiwa'
            ,'Pantry/K"chen Zink 2Lbang 1Sayap Lokal Meiwa'
            ,'Pantry/K"chen Zink 1Lbang 2Sayap Lokal Meiwa'
            ,'Pantry/K"chen Zink 1Lbang 1Sayap Lokal Meiwa'
            ,'Papan Jati'
            ,'Papan Bangkirai'
            ,'Papan Kamper Samarinda'
            ,'Papan Kamper Medan'
            ,'Papan Meranti'
            ,'Papan Borneo'
            ,'Parquete Jati'
            ,'Parquete Bangkirai'
            ,'Parquete Kamper Samarinda'
            ,'Parquete Kamper Medan'
            ,'Parquete Meranti'
            ,'Pasir Beton'
            ,'Pasir Extra Beton'
            ,'Pasir Pasang'
            ,'Pasir Urug '
            ,'Paving Blok T. 6cm CP'
            ,'Paving Blok T.  8cm CP'
            ,'Paving Blok T.10cm CP'
            ,'Paving Blok T. 6cm CIS'
            ,'Paving Blok T.  8cm CIS'
            ,'Paving Blok T.10cm CIS'
            ,'Paving Blok T. 6cm CON'
            ,'Paving Blok T.  8cm CON'
            ,'Paving Blok T.10cm CON'
            ,'Penutup Atap Transparant Twin Light'
            ,'Penutup Atap Transparant Lexan'
            ,'Pintu Pgr BRC Double Gate DG.90 T1'
            ,'Pintu Pgr BRC Double Gate DG.120 T1'
            ,'Pintu Pgr BRC Double Gate DG.175 T1'
            ,'Pintu Pgr BRC Double Gate DG.190 T1'
            ,'Pintu Pgr BRC Single Gate DG.90 T1'
            ,'Pintu Pgr BRC Single Gate DG.120 T1'
            ,'Pintu Pgr BRC Single Gate DG.175 T1'
            ,'Pintu Pgr BRC Single Gate DG.190 T1'
            ,'Pipa Flexible Listrik'
            ,'Pipa GIP dia 1/2"'
            ,'Pipa GIP dia 1"'
            ,'Pipa GIP dia 1 1/2"'
            ,'Pipa Listrik Clipsal'
            ,'Pipa PVC dia 1/2" Klas AW'
            ,'Pipa PVC dia 3/4" Klas AW'
            ,'Pipa PVC dia 1" Klas AW'
            ,'Pipa PVC dia 11/4" Klas AW'
            ,'Pipa PVC dia 11/2" Klas AW'
            ,'Pipa PVC dia 2" Klas AW'
            ,'Pipa PVC dia 21/2" Klas AW'
            ,'Pipa PVC dia 3" Klas AW'
            ,'Pipa PVC dia 4" Klas AW'
            ,'Pipa PVC dia 5" Klas AW'
            ,'Pipa PVC dia 6" Klas AW'
            ,'Pipa PVC dia 1/2" Klas D'
            ,'Pipa PVC dia 3/4" Klas D'
            ,'Pipa PVC dia 1" Klas D'
            ,'Pipa PVC dia 11/4" Klas D'
            ,'Pipa PVC dia 11/2" Klas D'
            ,'Pipa PVC dia 2" Klas D'
            ,'Pipa PVC dia 21/2" Klas D'
            ,'Pipa PVC dia 3" Klas D'
            ,'Pipa PVC dia 4" Klas D'
            ,'Pipa PVC dia 5" Klas D'
            ,'Pipa PVC dia 6" Klas D'
            ,'Plamur Besi'
            ,'Plamur Cat Duco'
            ,'Plamur Kayu'
            ,'Plamur Tembok dalam'
            ,'Plamur Tembok Luar'
            ,'Plastik Sheet'
            ,'Rangka Atap Aluminium'
            ,'Politur Ultran P.01'
            ,'Politur Ultran P.03'
            ,'Politur Melamic Dasar'
            ,'Politur Melamic Jadi'
            ,'Railling Tangga+Handrail Besi St.Steel'
            ,'Railling Tangga+Handrail Besi Tempa'
            ,'Railling Tangga+Handrail Besi GIP'
            ,'Railling Tangga+Handrail Besi Profil'
            ,'Handrail Tangga Kayu Jati Kw.Politur'
            ,'Handrail Tangga Kayu Jati Kw.cat'
            ,'Handrail Tangga Kayu Bangkirai Kw.Politur'
            ,'Handrail Tangga Kayu Bangkirai Kw.cat'
            ,'Handrail Tangga Kayu Kamper Smd Kw.Politur'
            ,'Handrail Tangga Kayu Kamper Smd Kw.cat'
            ,'Rell Jendela Sliding 1 Daun'
            ,'Rell Jendela Sliding 2 Daun'
            ,'Rell Jendela Sliding 3 Daun'
            ,'Rell Pintu Garasi 4 Daun'
            ,'Rell Pintu Garasi 6 Daun'
            ,'Rell Pintu Garasi 8 Daun'
            ,'Rell Pintu Sorong 1Daun'
            ,'Rell Pintu Sorong 2Daun'
            ,'Reng Jati'
            ,'Reng Bangkirai'
            ,'Reng Kamper Samarinda'
            ,'Reng Kamper Medan'
            ,'Reng Meranti'
            ,'Reng Borneo'
            ,'Residu Kayu'
            ,'Roof Drain dia 4" Plastik'
            ,'Roof Drain dia 4" Kuningan'
            ,'Roof Drain dia 4" Stainless Steel'
            ,'Roll Cat Kecil'
            ,'Roll Cat Sedang'
            ,'Roll Cat Besar'
            ,'Saringan Pipa Air Hujan Kuningan dia 2"'
            ,'Saringan Pipa Air Hujan Kuningan dia 2,5"'
            ,'Saringan Pipa Air Hujan Kuningan dia 3"'
            ,'Saringan Pipa Air Hujan Kuningan dia 4"'
            ,'Saringan Pipa Air Hujan Kuningan dia 5"'
            ,'Saringan Pipa Air Hujan Kuningan dia 6"'
            ,'Saringan Pipa Air Stainless Steel dia 2"'
            ,'Saringan Pipa Air Stainless Steel dia 2,5"'
            ,'Saringan Pipa Air Stainless Steel dia 3"'
            ,'Saringan Pipa Air Stainless Steel dia 4"'
            ,'Saringan Pipa Air Stainless Steel dia 5"'
            ,'Saringan Pipa Air Stainless Steel dia 6"'
            ,'Seal Tape Kran dll'
            ,'Semen PC'
            ,'Semen Putih'
            ,'Semen Pengisi Nat'
            ,'Seng Gelombang BJLS 30'
            ,'Seng Plat BJLS 30'
            ,'Septic Tank Fibre Kap.1,00M3'
            ,'Septic Tank Fibre Kap.1,50M3'
            ,'Septic Tank Fibre Kap.2,00M3'
            ,'Septic Tank Fibre Kap.2,50M3'
            ,'Septic Tank Fibre Kap.3,00M3'
            ,'Shower Tray Import Type-1'
            ,'Shower Tray Import Type-2'
            ,'Shower Tray Import Type-3'
            ,'Shower Tray Lokal TOTO Type-1'
            ,'Shower Tray Lokal TOTO Type-2'
            ,'Shower Tray Lokal TOTO Type-3'
            ,'Shower Tray Lokal KIA Type-1'
            ,'Shower Tray Lokal KIA Type-2'
            ,'Shower Tray Lokal KIA Type-3'
            ,'Shower Tray Lokal INA Type-1'
            ,'Shower Tray Lokal INA Type-2'
            ,'Shower Tray Lokal INA Type-3'
            ,'Sikat Kawat U.Pek.Besi/Baja'
            ,'Sirtu Gali'
            ,'Shower Spray Import'
            ,'Shower Spray Import'
            ,'Shower Spray Import'
            ,'Shower Spray Toto'
            ,'Shower Spray Toto'
            ,'Shower Spray Toto'
            ,'Shower Spray KIA'
            ,'Shower Spray KIA'
            ,'Shower Spray KIA'
            ,'Shower Spray INA'
            ,'Shower Spray INA'
            ,'Shower Spray INA'
            ,'Sok & Knie PVC AW dia 1 1/2"'
            ,'Sok & Knie PVC AW dia 1 1/4"'
            ,'Sok & Knie PVC AW dia 1"'
            ,'Sok & Knie PVC AW dia 3/4"'
            ,'Sok & Knie PVC AW dia 1/2"'
            ,'Sok & Knie PVC D dia 1/2"'
            ,'Sok & Knie PVC D dia 3/4"'
            ,'Sok & Knie PVC D dia 1"'
            ,'Sok & Knie PVC D dia 1 1/4"'
            ,'Sok & Knie PVC D dia 1 1/2"'
            ,'Sok & Knie PVC D dia 2"'
            ,'Sok & Knie PVC D dia 2 1/2"'
            ,'Sok & Knie PVC D dia 3"'
            ,'Sok & Knie PVC D dia 4"'
            ,'Sok & Knie PVC D dia 5"'
            ,'Sok & Knie PVC D dia 6"'
            ,'Stop Kran Logam dia 1"'
            ,'Stop Kran Logam dia 3/4"'
            ,'Stop Kran Logam dia 1/2"'
            ,'Saklar Tunggal'
            ,'Saklar Ganda'
            ,'Saklar Hotel'
            ,'Stop Kontak Biasa'
            ,'Stop Kontak Khusus'
            ,'T Doos Listrik'
            ,'Tanah Urug'
            ,'Tempat Sabun Dinding Import'
            ,'Tempat Sabun Dinding Import'
            ,'Tempat Sabun Dinding Import'
            ,'Tempat Sabun Dinding Lokal Toto'
            ,'Tempat Sabun Dinding Lokal Toto'
            ,'Tempat Sabun Dinding Lokal Toto'
            ,'Tempat Sabun Dinding Lokal KIA'
            ,'Tempat Sabun Dinding Lokal KIA'
            ,'Tempat Sabun Dinding Lokal KIA'
            ,'Tempat Sabun Dinding Lokal INA'
            ,'Tempat Sabun Dinding Lokal INA'
            ,'Tempat Sabun Dinding Lokal INA'
            ,'Tempat Tissue Import'
            ,'Tempat Tissue Import'
            ,'Tempat Tissue Import'
            ,'Tempat Tissue Lokal Toto'
            ,'Tempat Tissue Lokal Toto'
            ,'Tempat Tissue Lokal Toto'
            ,'Tempat Tissue Lokal KIA'
            ,'Tempat Tissue Lokal KIA'
            ,'Tempat Tissue Lokal KIA'
            ,'Tempat Tissue Lokal INA'
            ,'Tempat Tissue Lokal INA'
            ,'Tempat Tissue Lokal INA'
            ,'Tiang BRC T.1,20M U.Pgr T.0,90M'
            ,'Tiang BRC T.1,50M U.Pgr T.1,20M'
            ,'Tiang BRC T.2,25M U.Pgr T.1,75M'
            ,'Tiang BRC T.2,40M U.Pgr T.1,90M'
            ,'Timah Patri'
            ,'Triplex 4mm'
            ,'Triplex   6mm'
            ,'Triplex   9mm'
            ,'Triplex 12mm'
            ,'Triplex 15mm'
            ,'Triplex 18mm'
            ,'Triplex 24mm'
            ,'Urinoir Import'
            ,'Urinoir Import'
            ,'Urinoir Import'
            ,'Urinoir Toto'
            ,'Urinoir Toto'
            ,'Urinoir Toto'
            ,'Urinoir KIA'
            ,'Urinoir KIA'
            ,'Urinoir KIA'
            ,'Urinoir INA'
            ,'Urinoir INA'
            ,'Urinoir INA'
            ,'Wall Shower Import Type-1'
            ,'Wall Shower Import Type-2'
            ,'Wall Shower Import Type-3'
            ,'Wall Shower Lokal TOTO Type-1'
            ,'Wall Shower Lokal TOTO Type-2'
            ,'Wall Shower Lokal TOTO Type-3'
            ,'Wall Shower Lokal KIA Type-1'
            ,'Wall Shower Lokal KIA Type-2'
            ,'Wall Shower Lokal KIA Type-3'
            ,'Wall Shower Lokal INA Type-1'
            ,'Wall Shower Lokal INA Type-2'
            ,'Wall Shower Lokal INA Type-3'
            ,'Wastafel Import'
            ,'Wastafel Import'
            ,'Wastafel Import'
            ,'Wastafel Lokal Toto'
            ,'Wastafel Lokal Toto'
            ,'Wastafel Lokal Toto'
            ,'Wastafel Lokal KIA'
            ,'Wastafel Lokal KIA'
            ,'Wastafel Lokal KIA'
            ,'Wastafel Lokal INA'
            ,'Wastafel Lokal INA'
            ,'Wastafel Lokal INA'
            ,'Waterproofing Type Coating'
            ,'Waterproofing Type Membrane'
            ,'Waterproofing Type Coating'
            ,'Waterproofing Type Membrane'
            ,'Wire Mesh M.5 s/d M.9'
            ,'Wire Mesh M.10'
        );
        $harga = array(
            160000,
            175000,
            7500,
            10000,
            1500,
            2000,
            1500,
            10000,
            15000,
            20000,
            10000,
            15000,
            20000,
            30000,
            15000,
            15000,
            20000,
            25000,
            30000,
            20000,
            7500,
            12500,
            250000,
            20000000,
            4000000,
            3500000,
            2500000,
            1200000,
            1100000,
            20300000,
            4300000,
            3700000,
            2700000,
            1400000,
            1300000,
            400000,
            350000,
            300000,
            250000,
            200000,
            150000,
            10000,
            7500,
            5000,
            35000000,
            25000000,
            15000000,
            12700000,
            9600000,
            7200000,
            12500000,
            9500000,
            7000000,
            12000000,
            9000000,
            6500000,
            3500000,
            2500000,
            2000000,
            2059000,
            1998000,
            1536000,
            2000000,
            1750000,
            1500000,
            1750000,
            1500000,
            1250000,
            3000,
            500,
            400,
            500,
            150000,
            175000,
            150000,
            160000,
            100000,
            175000,
            100000,
            110000,
            125000,
            135000,
            10000,
            20000,
            15000,
            10000,
            2500,
            350,
            5000,
            9500,
            9600,
            75000,
            35000,
            5000,
            5000,
            5000,
            5000,
            830500,
            800000,
            750000,
            486200,
            478500,
            463000,
            451000,
            4500000,
            3500000,
            2500000,
            2464000,
            2302000,
            1997000,
            2500000,
            2250000,
            2000000,
            2250000,
            2000000,
            1750000,
            100000,
            200000,
            300000,
            400000,
            500000,
            600000,
            200000,
            180000,
            160000,
            140000,
            120000,
            100000,
            80000,
            60000,
            40000,
            75000,
            62500,
            50000,
            37500,
            25000,
            130000,
            135000,
            230000,
            180000,
            185000,
            280000,
            220000,
            225000,
            320000,
            25000,
            15000,
            25000,
            35000,
            25000,
            7500,
            10000,
            7850,
            5200,
            750000,
            650000,
            550000,
            560000,
            460000,
            360000,
            500000,
            400000,
            300000,
            400000,
            300000,
            200000,
            6000000,
            3500000,
            2500000,
            5120000,
            6190000,
            1850000,
            4500000,
            2500000,
            1500000,
            4250000,
            2250000,
            1250000,
            1750000,
            400000,
            300000,
            1620000,
            272000,
            142000,
            350000,
            250000,
            125000,
            300000,
            200000,
            100000,
            4000000,
            3500000,
            600000,
            500000,
            500000,
            400000,
            400000,
            300000,
            300000,
            200000,
            350000,
            250000,
            4500000,
            4000000,
            700000,
            600000,
            600000,
            500000,
            500000,
            400000,
            400000,
            300000,
            450000,
            350000,
            3500000,
            3000000,
            500000,
            400000,
            400000,
            300000,
            300000,
            200000,
            300000,
            200000,
            350000,
            250000,
            4250000,
            3750000,
            650000,
            550000,
            550000,
            450000,
            450000,
            350000,
            350000,
            250000,
            400000,
            300000,
            3750000,
            3250000,
            550000,
            450000,
            450000,
            350000,
            350000,
            250000,
            275000,
            175000,
            300000,
            200000,
            1250000,
            1000000,
            450000,
            400000,
            400000,
            350000,
            350000,
            300000,
            300000,
            250000,
            250000,
            200000,
            1350000,
            1100000,
            550000,
            500000,
            500000,
            450000,
            450000,
            400000,
            400000,
            350000,
            350000,
            300000,
            1200000,
            950000,
            400000,
            350000,
            350000,
            300000,
            300000,
            250000,
            250000,
            200000,
            250000,
            200000,
            2250000,
            2000000,
            350000,
            300000,
            300000,
            250000,
            250000,
            200000,
            200000,
            150000,
            225000,
            175000,
            1750000,
            1500000,
            250000,
            200000,
            200000,
            150000,
            150000,
            100000,
            150000,
            100000,
            175000,
            125000,
            2250000,
            2000000,
            350000,
            300000,
            300000,
            250000,
            250000,
            200000,
            200000,
            150000,
            200000,
            150000,
            2000000,
            1750000,
            250000,
            200000,
            225000,
            175000,
            175000,
            125000,
            150000,
            100000,
            175000,
            125000,
            10000,
            7500,
            5000,
            20000,
            10000,
            5000,
            200000,
            300000,
            400000,
            500000,
            600000,
            700000,
            800000,
            10000,
            5000,
            2500,
            5000,
            7500,
            10000,
            250000,
            200000,
            175000,
            295000,
            182000,
            146000,
            175000,
            150000,
            125000,
            150000,
            125000,
            100000,
            50000,
            75000,
            500000,
            450000,
            400000,
            350000,
            300000,
            250000,
            462000,
            378000,
            312000,
            287000,
            268000,
            244000,
            400000,
            350000,
            300000,
            275000,
            250000,
            225000,
            350000,
            300000,
            275000,
            250000,
            200000,
            175000,
            1250,
            2500,
            10000,
            15000,
            20000,
            10000,
            5000,
            1000,
            2500,
            10000,
            15000,
            20000,
            10000,
            5000,
            4600,
            4500,
            4500,
            15000,
            17500,
            37000,
            37000,
            17500,
            7150,
            7700,
            5850,
            12500,
            15000,
            20000,
            40000,
            20000,
            17500,
            8750,
            8000,
            20000,
            85000,
            85000,
            250000,
            69000,
            25000,
            9000,
            21500,
            90000,
            90000,
            245000,
            66000,
            25000,
            90000,
            36000,
            72000,
            108000,
            144000,
            25000,
            85000,
            55000,
            25000,
            35000,
            55000,
            35000,
            15000,
            20000,
            10000,
            15000,
            750000,
            600000,
            500000,
            450000,
            600000,
            500000,
            400000,
            300000,
            300000,
            250000,
            200000,
            150000,
            400000,
            450000,
            550000,
            900000,
            350000,
            400000,
            500000,
            800000,
            400000,
            250000,
            300000,
            500000,
            50000,
            60000,
            75000,
            750000,
            500000,
            250000,
            350000,
            250000,
            100000,
            40000,
            50000,
            15000,
            20000,
            500000,
            400000,
            300000,
            200000,
            233000,
            206000,
            250000,
            225000,
            200000,
            225000,
            200000,
            175000,
            100000,
            150000,
            125000,
            175000,
            25000,
            15000,
            140000,
            175000,
            100000,
            150000,
            200000,
            55000,
            85000,
            140000,
            175000,
            240000,
            385000,
            40000,
            65000,
            90000,
            125000,
            170000,
            225000,
            850000,
            1100000,
            60000,
            75000,
            140000,
            250000,
            385000,
            200000,
            250000,
            200000,
            250000,
            375000,
            550000,
            345000,
            400000,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            6000,
            17500,
            12500,
            50000,
            3500,
            25000000,
            14000000,
            12000000,
            9000000,
            3500000,
            2500000,
            200000,
            175000,
            150000,
            100000,
            75000,
            60000,
            50000,
            250000,
            225000,
            200000,
            175000,
            150000,
            125000,
            100000,
            100000,
            90000,
            80000,
            70000,
            60000,
            50000,
            40000,
            90000,
            80000,
            70000,
            60000,
            50000,
            40000,
            30000,
            70000,
            60000,
            55000,
            50000,
            45000,
            40000,
            30000,
            75000,
            100000,
            150000,
            200000,
            250000,
            300000,
            125000,
            150000,
            175000,
            200000,
            225000,
            250000,
            30000,
            35000,
            40000,
            50000,
            60000,
            75000,
            30000,
            35000,
            40000,
            45000,
            50000,
            60000,
            35000,
            40000,
            45000,
            50000,
            75000,
            80000,
            30000,
            35000,
            40000,
            50000,
            60000,
            75000,
            750000,
            600000,
            500000,
            350000,
            350000,
            250000,
            250000,
            150000,
            3500,
            350,
            45000,
            55000,
            55000,
            65000,
            65000,
            75000,
            80000,
            40000000,
            35000000,
            6500000,
            6000000,
            5500000,
            5000000,
            3500000,
            3000000,
            2500000,
            2000000,
            2500000,
            2000000,
            200000,
            150000,
            125000,
            100000,
            300000,
            275000,
            250000,
            275000,
            250000,
            225000,
            250000,
            225000,
            200000,
            225000,
            200000,
            175000,
            500000,
            450000,
            400000,
            400000,
            350000,
            300000,
            300000,
            250000,
            200000,
            200000,
            150000,
            100000,
            300000,
            250000,
            200000,
            250000,
            200000,
            150000,
            200000,
            150000,
            125000,
            150000,
            125000,
            100000,
            1500000,
            1000000,
            500000,
            750000,
            500000,
            350000,
            750000,
            500000,
            350000,
            500000,
            350000,
            250000,
            750000,
            500000,
            350000,
            500000,
            350000,
            250000,
            350000,
            250000,
            150000,
            250000,
            150000,
            100000,
            750000,
            500000,
            350000,
            600000,
            500000,
            250000,
            750000,
            500000,
            350000,
            100000,
            150000,
            250000,
            5000,
            7500,
            10000,
            200000,
            175000,
            150000,
            125000,
            100000,
            7500,
            20000,
            25000,
            30000,
            40000,
            45000,
            25000,
            30000,
            35000,
            40000,
            45000,
            50000,
            55000,
            60000,
            65000,
            700000,
            600000,
            500000,
            400000,
            650000,
            500000,
            400000,
            300000,
            400000,
            300000,
            250000,
            200000,
            350000,
            250000,
            200000,
            150000,
            325000,
            225000,
            175000,
            125000,
            300000,
            250000,
            200000,
            150000,
            375000,
            275000,
            225000,
            175000,
            600000,
            700000,
            800000,
            1200000,
            500000,
            600000,
            700000,
            1000000,
            300000,
            350000,
            400000,
            750000,
            250000,
            300000,
            350000,
            700000,
            225000,
            275000,
            325000,
            700000,
            175000,
            225000,
            275000,
            650000,
            200000,
            250000,
            300000,
            600000,
            15000,
            20000,
            15000,
            15000,
            25000,
            15000,
            10000,
            25000,
            75000,
            155100,
            194700,
            295900,
            321200,
            150,
            10000,
            15000,
            5000,
            7500,
            10000,
            20000,
            12000,
            12000,
            20000,
            350000,
            300000,
            250000,
            200000,
            300000,
            250000,
            200000,
            150000,
            250000,
            200000,
            150000,
            100000,
            250000,
            200000,
            150000,
            75000,
            16000000,
            12000000,
            10000000,
            8000000,
            3000000,
            2750000,
            200000,
            75000,
            60000,
            40000,
            30000,
            170000,
            160000,
            160000,
            145000,
            50000,
            70000,
            90000,
            55000,
            75000,
            95000,
            60000,
            80000,
            100000,
            50000,
            90000,
            1059300,
            1195700,
            1824900,
            1883200,
            451000,
            524700,
            794200,
            845900,
            7500,
            40000,
            75000,
            100000,
            7500,
            10000,
            12500,
            15000,
            17500,
            20000,
            25000,
            27500,
            30000,
            40000,
            50000,
            60000,
            7500,
            10000,
            12500,
            15000,
            17500,
            20000,
            22500,
            27500,
            35000,
            45000,
            55000,
            10000,
            15000,
            10000,
            10000,
            15000,
            1000,
            175000,
            30000,
            30000,
            35000,
            40000,
            1000000,
            750000,
            500000,
            350000,
            175000,
            150000,
            100000,
            85000,
            75000,
            50000,
            100000,
            200000,
            300000,
            2000000,
            3000000,
            4000000,
            150000,
            250000,
            20000000,
            4000000,
            3500000,
            2500000,
            1100000,
            1000000,
            3500,
            10000,
            25000,
            50000,
            10000,
            15000,
            20000,
            5000,
            7500,
            10000,
            15000,
            20000,
            25000,
            10000,
            15000,
            20000,
            30000,
            40000,
            50000,
            2500,
            55000,
            5000,
            5000,
            22500,
            25000,
            1750000,
            2500000,
            3000000,
            3750000,
            4250000,
            750000,
            700000,
            650000,
            600000,
            550000,
            500000,
            450000,
            400000,
            350000,
            300000,
            250000,
            200000,
            10000,
            125000,
            750000,
            600000,
            500000,
            351000,
            308000,
            308000,
            300000,
            250000,
            225000,
            275000,
            225000,
            200000,
            3000,
            2750,
            2500,
            2250,
            2000,
            1750,
            2000,
            2250,
            2500,
            2750,
            3000,
            3500,
            4000,
            5000,
            6000,
            7500,
            35000,
            30000,
            25000,
            20000,
            30000,
            30000,
            20000,
            60000,
            4000,
            100000,
            200000,
            150000,
            100000,
            130000,
            42000,
            34000,
            125000,
            50000,
            35000,
            100000,
            35000,
            25000,
            250000,
            150000,
            100000,
            149000,
            119000,
            54000,
            125000,
            100000,
            50000,
            100000,
            75000,
            35000,
            60500,
            72600,
            103400,
            108900,
            35000,
            60000,
            80000,
            130000,
            170000,
            200000,
            250000,
            120000,
            1500000,
            1350000,
            1250000,
            2260000,
            1268000,
            1129000,
            1250000,
            1000000,
            900000,
            1000000,
            900000,
            800000,
            1000000,
            900000,
            800000,
            750000,
            670000,
            500000,
            450000,
            400000,
            350000,
            325000,
            300000,
            275000,
            5000000, 
            3500000, 
            2500000, 
            3230000, 
            2327000, 
            1653000, 
            3500000, 
            2250000, 
            1500000, 
            3000000, 
            2000000, 
            1250000, 
            60000, 
            75000, 
            60000, 
            75000, 
            6000, 
            6000, 
        );
        $satuan = array(
            'tbg',
            'm3',
            'm2',
            'm2',
            'lbr',
            'lbr',
            'lbr',
            'm2',
            'm2',
            'm2',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'm2',
            'm2',
            'drum',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'btg',
            'btg',
            'btg',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'm3',
            'm3',
            'm3',
            'm3',
            'm2',
            'm3',
            'm2',
            'm2',
            'm2',
            'm2',
            'kg',
            'kg',
            'kg',
            'kg',
            'bh',
            'bh',
            'glg',
            'kg',
            'kg',
            'btg',
            'btg',
            'kg',
            'kg',
            'kg',
            'kg',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'kg',
            'kg',
            'kg',
            'kg',
            'kg',
            'kg',
            'kg',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'btg',
            'btg',
            'btg',
            'bh',
            'bh',
            'bh',
            'set',
            'set',
            'set',
            'set',
            'set',
            'set',
            'set',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'lbr',
            'lbr',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'm2',
            'm"',
            'bh',
            'bh',
            'bh',
            'bh',
            'm2',
            'm"',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'set',
            'set',
            'set',
            'set',
            'set',
            'set',
            'lbr',
            'lbr',
            'm2',
            'kg',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'roll',
            'roll',
            'roll',
            'roll',
            'm"',
            'm"',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm"',
            'm"',
            'm"',
            'm"',
            'm"',
            'm"',
            'm"',
            'm"',
            'm"',
            'm"',
            'kg',
            'm2',
            'kg',
            'm"',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            'bks',
            'bh',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            '',
            '',
            '',
            '',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'tube',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'bh',
            'bh',
            'kg',
            'kg',
            'bh',
            'dn',
            'dn',
            'kg',
            'tbg',
            'pnl',
            'pnl',
            'pnl',
            'pnl',
            'bh',
            'kg',
            'kg',
            'doos',
            'doos',
            'doos',
            'kg',
            'kg',
            'kg',
            'kg',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm3',
            'm3',
            'm3',
            'm3',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'm2',
            'unit',
            'unit',
            'unit',
            'unit',
            'unit',
            'unit',
            'unit',
            'unit',
            'm"',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'btg',
            'kg',
            'kg',
            'kg',
            'kg',
            'kg',
            'm2',
            'm2',
            'kg',
            'kg',
            'kg',
            'kg',
            'm"',
            'm"',
            'm"',
            'm"',
            'm"',
            'm"',
            'm"',
            'm"',
            'm"',
            'm"',
            'set',
            'set',
            'set',
            'set',
            'set',
            'set',
            'set',
            'set',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'm3',
            'ltr',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'sak',
            'kg',
            'kg',
            'lbr',
            'm"',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'm3',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'm3',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'kg',
            'lbr',
            'lbr',
            'lbr',
            'lbr',
            'lbr',
            'lbr',
            'lbr',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'bh',
            'm2',
            'm2',
            'm2',
            'm2',
            'kg',
            'kg',
        );
        for($a = 0; $a<count($data); $a++){
            $this->load->model("m_formula_attr");
            $this->m_formula_attr->set_formula_attr_name(strtoupper($data[$a]));
            $this->m_formula_attr->set_harga_satuan_attr($harga[$a]);
            $this->m_formula_attr->set_satuan_attr(strtoupper($satuan[$a]));
            $this->m_formula_attr->set_tipe_attr("BAHAN");
            $this->m_formula_attr->insert();
        }
    }
}