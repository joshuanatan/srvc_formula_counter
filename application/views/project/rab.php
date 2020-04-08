<div class = "col-lg-12">
    <h3><b><i><?php echo strtoupper($project[0]["prj_name"]);?></i></b> RAB</h3>
    <button type = "button" class = "btn btn-primary btn-sm" data-toggle = "modal" data-target = "#addRab">Tambah Komponen RAB</button><br/><br/>
    <table class = "table table-bordered table-hover table-striped" data-plugin = "dataTable">
        <thead>
            <th>Nama Pekerjaan</th>
            <th>Satuan Hitung</th>
            <th style = "width:20%">Action</th>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($rab); $a++):?>
            <tr id = "row<?php echo $a;?>">
                <input type = 'hidden' id = "id_rab<?php echo $a;?>" value = "<?php echo $rab[$a]["id_submit_rab"];?>">
                <td>
                    <input type = 'hidden' id = 'id_formula_cat<?php echo $a;?>' value = "<?php echo $rab[$a]["id_formula_cat"];?>">
                    <input type = 'hidden' id = 'id_formula<?php echo $a;?>' value = "<?php echo $rab[$a]["id_formula"];?>">
                    <div id = 'formula_name<?php echo $a;?>'>
                        <?php echo strtoupper($rab[$a]["formula_cat_name"])." / ".$rab[$a]["formula_desc"];?>
                    </div>
                </td>         
                <td>
                    <input type = 'hidden' id = 'satuan<?php echo $a;?>' value = "<?php echo $rab[$a]["satuan_htg"];?>">
                    <div id = 'satuan_htg<?php echo $a;?>'>
                        <?php echo $rab[$a]["satuan_htg"];?>
                    </div>        
                </td>
                <td>
                    <!--<a href = "#" onclick = "active_edit(<?php echo $a;?>);" id = "editButton<?php echo $a;?>" class = "btn btn-primary btn-sm">
                        <i class = "md-edit"></i>
                    </a>-->
                    <a href = "#" data-target = "#editRab" onclick = "load_formula_list(<?php echo $a;?>)" data-toggle = "modal" class = "btn btn-primary btn-sm">
                        <i class = "md-edit"></i>
                    </a>
                    <a href = "#" style = "display:none" onclick = "save_update(<?php echo $a;?>);" id = "saveButton<?php echo $a;?>" class = "btn btn-success btn-sm">
                        <i class = "md-check"></i>
                    </a>
                    <a href = "#" onclick = "load_delete_content(<?php echo $a;?>)" data-toggle = "modal" data-target = "#deleteRab" id = "deleteButton<?php echo $a;?>" class = "btn btn-danger btn-sm">
                        <i class = "md-delete"></i>
                    </a>
                </td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
    <a href = "<?php echo base_url();?>project" class = "btn btn-primary btn-sm">BACK</a>
    <a href = "<?php echo base_url();?>project/count_unit/<?php echo $project[0]["id_submit_project"];?>" target = "_blank" class = "btn btn-warning btn-sm">COUNT ESTIMATED UNIT</a>
</div>
<div class = "modal fade" id = "addRab">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Tambah RAB</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>project/register_rab" method = "POST">
                    <input type = "hidden" name = "id_prj" value = "<?php echo $project[0]["id_submit_project"];?>">
                    <div class = "form-group">
                        <h5>Formula List</h5>
                        <table class = "table table-striped table-hover table-bordered">
                            <thead>
                                <th>#</th>
                                <th>Kategori Pekerjaan</th>
                                <th>Pekerjaan</th>
                                <th>Satuan Hitung</th>
                            </thead>
                            <tbody>
                                <tr id = "add_row_container">
                                    <td colspan = 4>
                                        <button type = "button" class = "btn btn-primary btn-sm col-lg-12" onclick = "add_rab_row()">Add Attribute</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type = "button" class = "btn btn-sm btn-danger" data-dismiss = "modal">Cancel</button>
                        <button type = "submit" class = "btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class = "modal fade" id = "editRab">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Ubah RAB</h4>
            </div>
            <div class = "modal-body">
                <input type = "hidden" name = "id_rab" id = "idRabEdit">
                <div class = "form-group">
                    <h5>Formula List</h5>
                    <table class = "table table-striped table-hover table-bordered">
                        <thead>
                            <th>Kategori Pekerjaan</th>
                            <th>Pekerjaan</th>
                            <th>Satuan Hitung</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class = "form-control" name = "" id = "kategoriListEdit" onchange = "change_formula_list()">
                                        <?php for($a = 0; $a<count($cat); $a++):?>
                                        <option value = "<?php echo $cat[$a]["id_submit_formula_cat"];?>"><?php echo $cat[$a]["formula_cat_name"];?></option>
                                        <?php endfor;?>
                                    </select>
                                </td>
                                <td><select class = "form-control" name = "" id = "pekerjaanListEdit"></select></td>
                                <td><input type = "text" class = "form-control" name = "" id = "satuanhtgEdit"></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type = "button" class = "btn btn-sm btn-danger" data-dismiss = "modal">Cancel</button>
                    <button type = "button" id = "saveEditButton" data-dismiss = "modal" class = "btn btn-sm btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class = "modal fade" id = "deleteRab">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Konfirmasi Hapus RAB</h4>
            </div>
            <div class = "modal-body">
                <h4 align = "center">Are you sure want to remove this formula?</h4>
                <table class = "table table-bordered table-stripped table-hover offset-lg-2 col-lg-8">
                    <thead>
                        <th style = "width:50%">Formula Name</th>
                        <th style = "width:50%">Satuan Hitung</th>
                    </thead>
                    <tbody>
                        <tr>
                            <input type = "hidden" id = "id_rab_delete">
                            <td id = "formulaNameContainer"></td>
                            <td id = "satuanHitungContainer"></td>
                        </tr>
                    </tbody>
                </table>
                <div class = "row">
                    <button type = "button" class = "btn btn-sm btn-primary col-lg-3 col-sm-12 offset-lg-3" data-dismiss = "modal">Cancel</button>
                    <button type = "button" id = "deleteConfirmationButton" onclick = "submit_delete()" data-dismiss = "modal" class = "btn btn-sm btn-danger col-lg-3">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function add_rab_row(){
    $.ajax({
        url:"<?php echo base_url();?>ws/formula/category",
        type:"GET",
        dataType:"JSON",
        success:function(respond){

            var options = "<option selected disabled>Silahkan Pilih Kategori Pekerjaan</option>";
            for(var a = 0; a<respond["main"].length; a++){
                options += "<option value = '"+respond["main"][a]["id_formula_cat"]+"'>"+respond["main"][a]["cat_name"].toUpperCase()+"</option>";
            }
            
            var length = $(".rab_row").length;
            var html = "<tr class = 'rab_row'><td><div class = 'checkbox-custom checkbox-primary'><input checked type = 'checkbox' name = 'check[]' value = '"+length+"'><label></label></div></td><td><select onchange = 'load_daftar_pekerjaan("+length+")' class = 'form-control' id = 'formulaListRow"+length+"'>"+options+"</select></td><td><select class = 'form-control' name = 'formula"+length+"' id = 'pekerjaanRow"+length+"'></select></td><td><input type = 'number' class = 'form-control' step = '0.0000001' name = 'satuan_htg"+length+"'></td></tr>";
            $("#add_row_container").before(html);
        }
    });
}
function load_daftar_pekerjaan(row){
    var id_cat = $("#formulaListRow"+row).val();
    $.ajax({
        url:"<?php echo base_url();?>ws/formula/daftar_pekerjaan/"+id_cat,
        type:"GET",
        dataType:"JSON",
        success:function(respond){
            var options = "";
            for(var a = 0; a<respond["main"].length; a++){
                options += "<option value = '"+respond["main"][a]["id_formula"]+"'>"+respond["main"][a]["formula_desc"].toUpperCase()+"</option>";
            }
            $("#pekerjaanRow"+row).html(options);
        }
    })
}
function save_update(row){  
    var id_project = "<?php echo $project[0]["id_submit_project"];?>";
    var id_rab = $("#idRabEdit").val();
    var id_formula = $("#pekerjaanListEdit").val();
    var satuan_htg = $("#satuanhtgEdit").val();
    var id_formula_cat = $("#kategoriListEdit").val();
    $.ajax({
        url:"<?php echo base_url();?>ws/project/update_rab",
        type:"POST",
        dataType:"JSON",
        data:{id_rab:id_rab, satuan_htg:satuan_htg, id_formula:id_formula,id_project:id_project},
        success:function(respond){
            if(respond["status"] == "SUCCESS"){
                $("#satuan_htg"+row).html(satuan_htg);
                var nama_cat = $("#kategoriListEdit option:selected").text();
                var nama_pekerjaan = $("#pekerjaanListEdit option:selected").text();
                $("#formula_name"+row).html(nama_cat+" / "+nama_pekerjaan);
                
                $("#satuan"+row).val(satuan_htg);
                $("#id_formula"+row).val(id_formula);
                $("#id_formula_cat"+row).val(id_formula_cat);
            }
        }
    });
}
function load_delete_content(row){
    var formula_name = $("#formula_name"+row).text();
    var satuan_htg = $("#satuan_htg"+row).text();
    var id_rab = $("#id_rab"+row).val();
    
    $("#formulaNameContainer").html(formula_name);
    $("#satuanHitungContainer").html(satuan_htg);
    $("#id_rab_delete").val(id_rab);
    $("#deleteConfirmationButton").attr("onclick","submit_delete("+row+")")

}
function submit_delete(row){
    var id_rab = $("#id_rab_delete").val();
    $.ajax({
        url:"<?php echo base_url();?>ws/project/remove_rab/"+id_rab,
        type:"DELETE",
        dataType:"JSON",
        success:function(respond){
            $("#row"+row).remove();
        }
    })
}
function load_formula_list(row){
    var id_cat = $("#id_formula_cat"+row).val();
    $.ajax({
        url:"<?php echo base_url();?>ws/formula/daftar_pekerjaan/"+id_cat,
        type:"GET",
        dataType:"JSON",
        success:function(respond){
            var options = "";
            for(var a = 0;a<respond["main"].length; a++){
                options += "<option value = '"+respond["main"][a]["id_formula"]+"'>"+respond["main"][a]["formula_desc"]+"</option>";
            }
            $("#pekerjaanListEdit").html(options);
            load_edit_content(row);
        }
    });
}
function change_formula_list(){
    var id_cat = $("#kategoriListEdit").val();
    $.ajax({
        url:"<?php echo base_url();?>ws/formula/daftar_pekerjaan/"+id_cat,
        type:"GET",
        dataType:"JSON",
        success:function(respond){
            var options = "";
            for(var a = 0;a<respond["main"].length; a++){
                options += "<option value = '"+respond["main"][a]["id_formula"]+"'>"+respond["main"][a]["formula_desc"]+"</option>";
            }
            $("#pekerjaanListEdit").html(options);
        }
    });
}
function load_edit_content(row){
    var id_cat = $("#id_formula_cat"+row).val();
    var id_formula = $("#id_formula"+row).val();
    var satuan_htg = $("#satuan"+row).val();
    var id_rab = $("#id_rab"+row).val();
    
    $("#kategoriListEdit").val(id_cat); 
    $("#pekerjaanListEdit").val(id_formula);
    $("#satuanhtgEdit").val(satuan_htg);
    $("#idRabEdit").val(id_rab);
    $("#saveEditButton").attr("onclick","save_update("+row+")");
}
</script>