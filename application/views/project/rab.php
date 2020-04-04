<div class = "col-lg-12">
    <h3><b><i><?php echo strtoupper($project[0]["prj_name"]);?></i></b> RAB</h3>
    <button type = "button" class = "btn btn-primary btn-sm" data-toggle = "modal" data-target = "#addRab">Add RAB</button><br/><br/>
    <table class = "table table-bordered table-hover table-striped" data-plugin = "dataTable">
        <thead>
            <th>Formula Name</th>
            <th>Satuan Hitung</th>
            <th style = "width:20%">Action</th>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($rab); $a++):?>
            <tr>
                <input type = 'hidden' id = "id_rab<?php echo $a;?>" value = "<?php echo $rab[$a]["id_submit_rab"];?>">
                <td>
                    <input type = 'hidden' id = 'id_formula<?php echo $a;?>' value = "<?php echo $rab[$a]["id_formula"];?>">
                    <div id = 'formula_name<?php echo $a;?>'>
                        <?php echo strtoupper($rab[$a]["formula_name"]);?>
                    </div>
                </td>         
                <td>
                    <input type = 'hidden' id = 'satuan<?php echo $a;?>' value = "<?php echo $rab[$a]["satuan_htg"];?>">
                    <div id = 'satuan_htg<?php echo $a;?>'>
                        <?php echo $rab[$a]["satuan_htg"];?>
                    </div>        
                </td>
                <td>
                    <a href = "#" onclick = "active_edit(<?php echo $a;?>);" id = "editButton<?php echo $a;?>" class = "btn btn-primary btn-sm">
                        <i class = "md-edit"></i>
                    </a>
                    <a href = "#" style = "display:none" onclick = "save_update(<?php echo $a;?>);" id = "saveButton<?php echo $a;?>" class = "btn btn-success btn-sm">
                        <i class = "md-check"></i>
                    </a>
                    <a href = "#" onclick = "load_delete_content(<?php echo $a;?>)" id = "deleteButton<?php echo $a;?>" class = "btn btn-danger btn-sm">
                        <i class = "md-delete"></i>
                    </a>
                </td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>
<div class = "modal fade" id = "addRab">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Add RAB</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>project/register_rab" method = "POST">
                    <input type = "hidden" name = "id_prj" value = "<?php echo $project[0]["id_submit_project"];?>">
                    <div class = "form-group">
                        <h5>Formula List</h5>
                        <table class = "table table-striped table-hover table-bordered">
                            <thead>
                                <th>#</th>
                                <th>Formula</th>
                                <th>Satuan Hitung</th>
                            </thead>
                            <tbody>
                                <tr id = "add_row_container">
                                    <td colspan = 3>
                                        <button type = "button" class = "btn btn-primary btn-sm col-lg-12" onclick = "addRabRow()">Add Attribute</button>
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
<script>
function addRabRow(){
    $.ajax({
        url:"<?php echo base_url();?>ws/formula/list",
        type:"GET",
        dataType:"JSON",
        success:function(respond){

            var options = "";
            for(var a = 0; a<respond["main"].length; a++){
                options += "<option value = '"+respond["main"][a]["id_formula"]+"'>"+respond["main"][a]["name"].toUpperCase()+"</option>";
            }
            
            var length = $(".rab_row").length;
            var html = "<tr class = 'rab_row'><td><div class = 'checkbox-custom checkbox-primary'><input checked type = 'checkbox' name = 'check[]' value = '"+length+"'><label></label></div></td><td><select class = 'form-control' name = 'formula"+length+"' id = 'formulaListRow"+length+"'>"+options+"</select><br/><div><ul id = 'detailFormulaList"+length+"'></ul></div></td><td><input type = 'number' class = 'form-control' name = 'satuan_htg"+length+"'></td></tr>";
            $("#add_row_container").before(html);
        }
    });
}
function active_edit(row){
    $("#saveButton"+row).css("display","inline-block");
    $("#editButton"+row).css("display","none");
    $("#deleteButton"+row).css("display","none");
    
    $.ajax({
        url:"<?php echo base_url();?>ws/formula/list",
        type:"GET",
        dataType:"JSON",
        success:function(respond){
            var options = "";
            for(var a = 0; a<respond["main"].length; a++){
                if(respond["main"][a]["id_formula"] == $("#id_formula"+row).val()){
                    options += "<option value = '"+respond["main"][a]["id_formula"]+"' selected>"+respond["main"][a]["name"].toUpperCase()+"</option>";
                    continue;
                }
                options += "<option value = '"+respond["main"][a]["id_formula"]+"'>"+respond["main"][a]["name"].toUpperCase()+"</option>";
            }
            var html = "<select class = 'form-control' id = 'formula_edit"+row+"'>"+options+"</select>";
            $("#formula_name"+row).html(html);
            $("#formula_name"+row).val();
        }
    });
    var satuan_htg = $("#satuan"+row).val();
    var html = "<input type = 'number' value = '"+satuan_htg+"' class = 'form-control' id = 'satuan_htg_edit"+row+"'>";
    $("#satuan_htg"+row).html(html);
}
function save_update(row){
    var id_project = "<?php echo $project[0]["id_submit_project"];?>";
    var id_rab = $("#id_rab"+row).val();
    var satuan_htg = $("#satuan_htg_edit"+row).val();
    var id_formula = $("#formula_edit"+row).val();
    $.ajax({
        url:"<?php echo base_url();?>ws/project/update_rab",
        type:"POST",
        dataType:"JSON",
        data:{id_rab:id_rab, satuan_htg:satuan_htg, id_formula:id_formula,id_project:id_project},
        success:function(respond){
            if(respond["status"] == "SUCCESS"){
                $("#satuan_htg"+row).html(satuan_htg);
                $("#formula_name"+row).html($("#formula_name"+row+" option:selected").text());
                
                $("#satuan"+row).val(satuan_htg);
                $("#id_formula"+row).val(id_formula);
                
                $("#editButton"+row).css("display","inline-block");
                $("#saveButton"+row).css("display","none");
                $("#deleteButton"+row).css("display","inline-block");
            }
        }
    });
}
function deactiveEdit(row){
    $(".row"+row).css("display","block");
    $(".rowEdit"+row).css("display","none");
    $(".rowButton"+row).css("display","inline-block");
    $(".rowButtonEdit"+row).css("display","none");
}
function displayFormulaDetail(row){
    $(".detailFormulaRow"+row).css("display","block");
}
</script>