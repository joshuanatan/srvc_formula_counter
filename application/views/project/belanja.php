<div class = "col-lg-12">
    <h3><b><i><?php echo strtoupper($project[0]["prj_name"]);?></i></b> Daftar Pengeluaran</h3>
    <button type = "button" class = "btn btn-primary btn-sm" onclick = "load_list_bahan();load_list_supplier()" data-toggle = "modal" data-target = "#tambah_pembayaran">Tambah Daftar Pengeluaran</button><br/><br/>
    <table class = "table table-bordered table-hover table-striped" id = "table_list_belanja">
        <thead>
            <tr>
                <th class = "text-center" style = "font-weight:500">Nama Item</th>
                <th class = "text-center" style = "font-weight:500">Nama Supplier</th>
                <th class = "text-center" style = "font-weight:500">Pengeluaran</th>
                <th class = "text-center" style = "font-weight:500">Last Modified</th>
                <th class = "text-center" style = "font-weight:500">Action</th>
            </tr>
        </thead>
        <tbody id = "list_belanja">
        </tbody>
    </table>
    <a href = "<?php echo base_url();?>project" class = "btn btn-primary btn-sm">BACK</a>
</div>
<div class = "modal fade" id = "tambah_pembayaran">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4>Tambah Belanja Proyek</h4>
            </div>
            <div class = "modal-body">
                <input type = "hidden" id = "id_proj" value = "<?php echo $project[0]["id_submit_project"];?>">
                <div class = "form-group">
                    <h5>Tipe Item</h5>
                    <select class = "form-control" id = "tipe_item" data-plugin = "select2" onchange = "load_list_bahan()">
                        <option value = "bahan">BAHAN</option>
                        <option value = "alat">ALAT</option>
                        <option value = "upah">UPAH</option>
                    </select>
                </div>
                <div class = "form-group">
                    <h5>Nama Item</h5>
                    <select class = "form-control" id = "attr_list">
                    </select>
                </div>
                <div class = "form-group">
                    <h5>Nama Supplier</h5>
                    <select class = "form-control" id = "supp_list" onchange = "toggle_supplier()">
                    </select>
                </div>
                <div class = "form-group">
                    <h5>Pengeluaran</h5>
                    <input type = "text" class = "form-control" id = "pengeluaran">
                </div>
                <hr/>
                <div id = "supp_new_container">
                    <div class = "form-group">
                        <h5>Nama Supplier</h5>
                        <input type = "text" class = "form-control" id = "nama_supp_add">
                    </div>
                    <div class = "form-group">
                        <h5>Deskripsi Supplier</h5>
                        <input type = "text" class = "form-control" id = "desc_supp_add">
                    </div>
                    <div class = "form-group">
                        <h5>Alamat Supplier</h5>
                        <input type = "text" class = "form-control" id = "almt_supp_add">
                    </div>
                    <div class = "form-group">
                        <h5>PIC Supplier</h5>
                        <input type = "text" class = "form-control" id = "pic_supp_add">
                    </div>
                    <div class = "form-group">
                        <h5>No Telp supplier</h5>
                        <input type = "text" class = "form-control" id = "notelp_supp_add">
                    </div>
                </div>
                <div class = "form-group">
                    <button class = "btn btn-danger btn-sm" data-dismiss = "modal">CANCEL</button>
                    <button class = "btn btn-primary btn-sm" type = "button" onclick = "register_belanja()">SUBMIT</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class = "modal fade" id = "ubah_pembayaran">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4>Ubah Belanja Proyek</h4>
            </div>
            <div class = "modal-body">
                <input type = "hidden" id = "id_belanja_edit">
                <div class = "form-group">
                    <h5>Nama Item</h5>
                    <input type = "text" class = "form-control" list = "item_list_edit" id = "nama_item_edit">
                    <datalist id = "item_list_edit">
                    </datalist>
                </div>
                <div class = "form-group">
                    <h5>Nama Supplier</h5>
                    
                    <input type = "text" class = "form-control" list = "supp_list_edit" id = "nama_supp_edit">
                    <datalist id = "supp_list_edit">
                    </datalist>
                </div>
                <div class = "form-group">
                    <h5>Pengeluaran</h5>
                    <input type = "text" class = "form-control" id = "pengeluaran_edit">
                </div>
                <hr/>
                <div class = "form-group">
                    <button class = "btn btn-danger btn-sm" data-dismiss = "modal">CANCEL</button>
                    <button class = "btn btn-primary btn-sm" type = "button" onclick = "update_belanja()">SUBMIT</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class = "modal fade" id = "hapus_pembayaran">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Hapus Pembayaran</h4>
            </div>
            <div class = "modal-body">
                <input type = "hidden" id = "id_pembayaran_delete">
                <h4 align = "center">Apakah anda ingin menghapus data belanja ini?</h4>
                <table class = "table table-bordered table-striped table-hover">
                    <tr>
                        <td>Nama Item</td>
                        <td id = "nama_item_delete"></td>
                    </tr>
                    <tr>
                        <td>Nama Supplier</td>
                        <td id = "nama_supp_delete"></td>
                    </tr>
                    <tr>
                        <td>Pembayaran</td>
                        <td id = "pembayaran_delete"></td>
                    </tr>
                </table>
                <div class = "row">
                    <button type = "button" class = "btn btn-sm btn-primary col-lg-3 col-sm-12 offset-lg-3" data-dismiss = "modal">Cancel</button>
                    <button type = "button" onclick = "delete_belanja()" class = "btn btn-sm btn-danger col-lg-3">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function load_data_belanja(){
        var id_proj = $("#id_proj").val();
        $.ajax({
            url:"<?php echo base_url();?>ws/project/list_belanja/"+id_proj,
            type:"GET",
            dataType:"JSON",
            success:function(respond){
                if(respond["status"] == "SUCCESS"){
                    $("#table_list_belanja").DataTable().clear().destroy();
                    var html = "";
                    for(var a = 0; a<respond["content"].length; a++){
                        html += "<tr>";
                        html += "<input type = 'hidden' id = 'id_belanja"+a+"' value = '"+respond["content"][a]["id_belanja"]+"'>";
                        html += "<td class = 'align-middle text-center' id = 'text_item"+a+"'><input type = 'hidden' id = 'id_item"+a+"' value = '"+respond["content"][a]["id_item"]+"'>"+respond["content"][a]["item"]+"</td>";
                        html += "<td class = 'align-middle text-center' id = 'text_supplier"+a+"'><input type = 'hidden' id = 'id_supplier"+a+"' value = '"+respond["content"][a]["id_supplier"]+"'>"+respond["content"][a]["supplier"]+"</td>";
                        html += "<td class = 'align-middle text-center' id = 'text_pengeluaran"+a+"'><input type = 'hidden' id = 'id_pengeluaran"+a+"' value = '"+respond["content"][a]["pengeluaran"]+"'>"+respond["content"][a]["pengeluaran"]+"</td>";
                        html += "<td class = 'align-middle text-center'>"+respond["content"][a]["last_modified"]+"</td>";
                        html += "<td class = 'align-middle text-center'><i onclick = 'load_list_bahan_edit();load_list_supplier_edit();load_edit_content("+a+")' data-toggle = 'modal' data-target = '#ubah_pembayaran' style = 'cursor:pointer;font-size:large' class = 'text-primary md-edit'></i> | <i onclick = 'load_delete_content("+a+")'data-toggle = 'modal' data-target = '#hapus_pembayaran' style = 'cursor:pointer;font-size:large' class = 'text-danger md-delete'></i></td>";
                    html += "</tr>";
                    }
                    $("#list_belanja").html(html);
                    $("#table_list_belanja").dataTable();
                }
            }
        })
    }
    function load_list_bahan(){
        var jenis_attr = $("#tipe_item").val();
        $.ajax({
            url:"<?php echo base_url();?>ws/attribute/daftar/"+jenis_attr,
            type:"GET",
            dataType:"JSON",
            success:function(respond){
                if(respond["attr"].length > 0){
                    var html = "";
                    for(var a = 0; a<respond["attr"].length; a++){
                        html += "<option value = '"+respond["attr"][a]["attr_id"]+"'>"+respond["attr"][a]["attr_name"]+"</option>";
                    }
                    $("#attr_list").html(html);
                    $("#attr_list").select2();
                }
                else{
                    $("#attr_list").html(html);
                    $("#attr_list").select2();
                }
            }
        });
    }
    function load_list_supplier(){
        $.ajax({
            url:"<?php echo base_url();?>ws/supplier/daftar",
            type:"GET",
            dataType:"JSON",
            success:function(respond){
                if(respond["supplier"].length > 0){
                    var html = "<option value = 0>Tambah Supplier Baru</option>";
                    for(var a = 0; a<respond["supplier"].length; a++){
                        html += "<option value = '"+respond["supplier"][a]["id"]+"'>"+respond["supplier"][a]["nama"]+"</option>";
                    }
                    $("#supp_list").html(html);
                    $("#supp_list").select2();
                }
                else{
                    var html = "<option value = 0>Tambah Supplier baru</option>";
                    $("#supp_list").html(html);
                    $("#supp_list").select2();
                    $("#supp_new_container").css("display","block");
                }
            }
        });
    }
    function load_list_bahan_edit(){
        var jenis_attr = $("#tipe_item").val();
        $.ajax({
            url:"<?php echo base_url();?>ws/attribute/daftar/"+jenis_attr,
            type:"GET",
            dataType:"JSON",
            success:function(respond){
                if(respond["attr"].length > 0){
                    var html = "";
                    for(var a = 0; a<respond["attr"].length; a++){
                        html += "<option value = '"+respond["attr"][a]["attr_name"]+"'>";
                    }
                    $("#item_list_edit").html(html);
                }
                else{
                    $("#item_list_edit").html(html);
                }
            }
        });
    }
    function load_list_supplier_edit(){
        $.ajax({
            url:"<?php echo base_url();?>ws/supplier/daftar",
            type:"GET",
            dataType:"JSON",
            success:function(respond){
                if(respond["supplier"].length > 0){
                    var html = "";
                    for(var a = 0; a<respond["supplier"].length; a++){
                        html += "<option value = '"+respond["supplier"][a]["nama"]+"'>"+respond["supplier"][a]["id"]+"</option>";
                    }
                    $("#supp_list_edit").html(html);
                }
                else{
                    var html = "";
                    $("#supp_list_edit").html(html);
                    $("#supp_new_container").css("display","block");
                }
            }
        });
    }
    function load_edit_content(row){
        var item = $("#text_item"+row).text();
        var supplier = $("#text_supplier"+row).text();
        var pengeluaran = $("#id_pengeluaran"+row).val();
        var id_belanja = $("#id_belanja"+row).val();

        $("#nama_item_edit").val(item);
        $("#nama_supp_edit").val(supplier);
        $("#pengeluaran_edit").val(pengeluaran);
        $("#id_belanja_edit").val(id_belanja);
    }
    function load_delete_content(row){
        var id_pembayaran_delete = $("#id_belanja"+row).val();
        var nama_item_delete = $("#text_item"+row).text();
        var nama_supp_delete = $("#text_supplier"+row).text();
        var pembayaran_delete = $("#id_pengeluaran"+row).val();

        $("#id_pembayaran_delete").val(id_pembayaran_delete);
        $("#nama_item_delete").text(nama_item_delete);
        $("#nama_supp_delete").text(nama_supp_delete);
        $("#pembayaran_delete").text(pembayaran_delete);
    }
    function toggle_supplier(){
        var supp_id = $("#supp_list").val();
        if(parseInt(supp_id) == 0){
            $("#supp_new_container").css("display","block");
        }
        else{
            $("#supp_new_container").css("display","none");
        }
    }
    function register_new_supp(){
        var new_supp_id = "";
        $.ajax({
            url:"<?php echo base_url();?>ws/supplier/register",
            type:"POST",
            dataType:"JSON",
            async: false,
            data:{
                nama_supp_add:$("#nama_supp_add").val(),
                desc_supp_add:$("#desc_supp_add").val(),
                almt_supp_add:$("#almt_supp_add").val(),
                pic_supp_add:$("#pic_supp_add").val(),
                notelp_supp_add:$("#notelp_supp_add").val()
            },
            success:function(respond){
                if(respond["status"] == "SUCCESS"){
                    new_supp_id = respond["id"];
                    empty_add_sup_form();
                }
            }
        });
        return new_supp_id;
    }
    function register_belanja(){
        var id_supplier = $("#supp_list").val();
        var id_project = $("#id_proj").val();
        var id_item = $("#attr_list").val();
        var nama_supp = "";
        var nama_item = $("#attr_list option:selected").text();
        var pengeluaran = $("#pengeluaran").val();
        if(parseInt(id_supplier) == 0){
            id_supplier = register_new_supp();
            nama_supp = $("#nama_supp_add").val();
        }
        else{
            nama_supp = $("#supp_list option:selected").text()
        }
        $.ajax({
            url:"<?php echo base_url();?>ws/project/register_belanja",
            type:"POST",
            dataType:"JSON",
            async: false,
            data:{
                id_project:id_project,
                id_item:id_item,
                id_supplier:id_supplier,
                pengeluaran:pengeluaran
            },
            success:function(respond){
                if(respond["status"] == "SUCCESS"){
                    load_data_belanja();
                    empty_add_form();
                    $("#tambah_pembayaran").modal("hide");
                }
            }
        });
    }
    function update_belanja(){
        var id_belanja = $("#id_belanja_edit").val();
        var nama_item = $("#nama_item_edit").val();
        var nama_supp = $("#nama_supp_edit").val();
        var pengeluaran = $("#pengeluaran_edit").val();
        $.ajax({
            url:"<?php echo base_url();?>ws/project/update_belanja",
            type:"POST",
            dataType:"JSON",
            data:{
                id_belanja:id_belanja,
                nama_item:nama_item,
                nama_supp:nama_supp,
                pengeluaran:pengeluaran
            },
            success:function(respond){
                $("#ubah_pembayaran").modal("hide");
                load_data_belanja();
            }
        });
    }
    function delete_belanja(){
        var id_pembayaran_delete = $("#id_pembayaran_delete").val();
        $.ajax({
            url:"<?php echo base_url();?>ws/project/delete_belanja/"+id_pembayaran_delete,
            type:"DELETE",
            dataType:"JSON",
            success:function(respond){
                $("#hapus_pembayaran").modal("hide");
                load_data_belanja();
            }
        });
    }
    function empty_add_form(){
        $("#supp_list").val("");
        $("#id_proj").val("");
        $("#attr_list").val("");
        $("#pengeluaran").val("");
    }
    function empty_add_sup_form(){
        $("#nama_supp_add").val("");
        $("#desc_supp_add").val("");
        $("#almt_supp_add").val("");
        $("#pic_supp_add").val("");
        $("#notelp_supp_add").val("");
    }
    window.onload = function(){
        load_data_belanja();
    }
</script>