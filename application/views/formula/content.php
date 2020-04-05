<div class = "col-lg-12">
    <button type = "button" class = "btn btn-primary btn-sm" data-toggle = "modal" data-target = "#addformula">Add Formula</button><br/><br/>
    <table class = "table table-bordered table-hover table-striped" data-plugin = "dataTable">
        <thead>
            <th>Formula Name</th>
            <th>Formula Desc</th>
            <th>Status</th>
            <th>Last Modified</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php foreach($formula as $a):?>
            <tr>
                <td><?php echo $a->formula_name;?></td>
                <td><?php echo $a->formula_desc;?></td>
                <td><?php echo $a->formula_status;?></td>
                <td><?php echo $a->formula_last_modified;?></td>
                <td>
                    <a href = "#" data-toggle = "modal" data-target = "#editFormula" onclick = "load_content(<?php echo $a->id_submit_formula;?>)" class = "btn btn-primary btn-sm">
                        <i class = "md-edit"></i>
                    </a>
                    <a href = "#" data-toggle = "modal" data-target = "#deleteFormula" onclick = "load_delete_id(<?php echo $a->id_submit_formula;?>);load_delete_content(<?php echo $a->id_submit_formula;?>)" class = "btn btn-danger btn-sm">
                        <i class = "md-delete"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<div class = "modal fade" id = "addFormula">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Add Formula</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>formula/register" method = "POST">
                    <div class = "form-group">
                        <h5>Formula Name</h5>
                        <input type = "text" class = "form-control" required name = "formula_name">
                        
                    </div>
                    <div class = "form-group">
                        <h5>Formula Description</h5>
                        <textarea class = "form-control" required name = "formula_desc"></textarea>
                    </div>
                    <div class = "form-group">
                        <h5>Bahan</h5>
                        <a href = "<?php echo base_url();?>attribute" target = "_blank" class = "btn btn-primary btn-sm">Tambah Data Bahan</a>
                        <br/><br/>
                        <table class = "table table-striped table-hover table-bordered">
                            <thead>
                                <th style = "width:5%">#</th>
                                <th>Bahan</th>
                                <th>Koefisien</th>
                            </thead>
                            <tbody>
                                <tr id = "add_row_bahan_container">
                                    <td colspan = 3>
                                        <button type = "button" class = "btn btn-primary btn-sm col-lg-12" onclick = "add_attr_row('bahan')">Add Attribute</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class = "form-group">
                        <h5>Upah Tukang</h5>
                        <a href = "<?php echo base_url();?>attribute" target = "_blank" class = "btn btn-primary btn-sm">Tambah Data Upah</a>
                        <br/><br/>
                        <table class = "table table-striped table-hover table-bordered">
                            <thead>
                                <th style = "width:5%">#</th>
                                <th>Upah</th>
                                <th>Koefisien</th>
                            </thead>
                            <tbody>
                                <tr id = "add_row_upah_container">
                                    <td colspan = 3>
                                        <button type = "button" class = "btn btn-primary btn-sm col-lg-12" onclick = "add_attr_row('upah')">Add Attribute</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class = "form-group">
                        <h5>Alat Bantu</h5>
                        <a href = "<?php echo base_url();?>attribute" target = "_blank" class = "btn btn-primary btn-sm">Tambah Data Alat</a>
                        <br/><br/>
                        <table class = "table table-striped table-hover table-bordered">
                            <thead>
                                <th style = "width:5%">#</th>
                                <th>Alat</th>
                                <th>Koefisien</th>
                            </thead>
                            <tbody>
                                <tr id = "add_row_alat_container">
                                    <td colspan = 3>
                                        <button type = "button" class = "btn btn-primary btn-sm col-lg-12" onclick = "add_attr_row('alat')">Add Attribute</button>
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
<div class = "modal fade" id = "deleteFormula">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Delete Formula</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>formula/delete" method = "POST">
                    <input type = "hidden" name = "id_formula" value = "" id = "id_formula_delete">
                    <h4 align = "center">Are you sure want to delete this formula?</h4>
                    <table class = "table table-bordered table-striped table-hover">
                        <thead>
                            <th style = "width:50%">Attributes</th>
                            <th style = "width:50%">Values</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Formula Name</td>
                                <td id = "formula_name_delete"></td>
                            </tr>
                            <tr>
                                <td>Formula Description</td>
                                <td id = "formula_desc_delete"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class = "row">
                        <button type = "button" class = "btn btn-sm btn-primary col-lg-3 col-sm-12 offset-lg-3" data-dismiss = "modal">Cancel</button>
                        <button type = "submit" class = "btn btn-sm btn-danger col-lg-3">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class = "modal fade" id = "editFormula">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Edit Formula</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>formula/update" method = "POST">
                    <div class = "form-group">
                        <h5>Formula Name</h5>
                        <input type = "hidden" name = "id_formula" id = "formula_id_edit">
                        <input type = "text" class = "form-control" required name = "formula_name" id = "formula_name_edit">
                    </div>
                    <div class = "form-group">
                        <h5>Formula Description</h5>
                        <textarea class = "form-control" required name = "formula_desc" id = "formula_desc_edit"></textarea>
                    </div>
                    <div class = "form-group">
                        <h5>Bahan</h5>
                        <table class = "table table-striped table-hover table-bordered">
                            <thead>
                                <th style = "width:5%">Edit</th>
                                <th style = "width:5%">Delete</th>
                                <th>Bahan</th>
                                <th>Koefisien</th>
                            </thead>
                            <tbody>
                                <tr id = "add_row_container_bahan_edit">
                                    <td colspan = 4>
                                        <button type = "button" class = "btn btn-primary btn-sm col-lg-12" onclick = "add_attr_row_edit('bahan')">Add Attribute</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class = "form-group">
                        <h5>Upah</h5>
                        <table class = "table table-striped table-hover table-bordered">
                            <thead>
                                <th style = "width:5%">Edit</th>
                                <th style = "width:5%">Delete</th>
                                <th>Upah</th>
                                <th>Koefisien</th>
                            </thead>
                            <tbody>
                                <tr id = "add_row_container_upah_edit">
                                    <td colspan = 4>
                                        <button type = "button" class = "btn btn-primary btn-sm col-lg-12" onclick = "add_attr_row_edit('upah')">Add Attribute</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class = "form-group">
                        <h5>Alat Bantu</h5>
                        <table class = "table table-striped table-hover table-bordered">
                            <thead>
                                <th style = "width:5%">Edit</th>
                                <th style = "width:5%">Delete</th>
                                <th>Alat</th>
                                <th>Koefisien</th>
                            </thead>
                            <tbody>
                                <tr id = "add_row_container_alat_edit">
                                    <td colspan = 4>
                                        <button type = "button" class = "btn btn-primary btn-sm col-lg-12" onclick = "add_attr_row_edit('alat')">Add Attribute</button>
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
    function add_attr_row(jenis){
        var counter = $(".attr_row").length;
        switch(jenis){
            case "bahan":
                $.ajax({
                    url:"<?php echo base_url();?>ws/attribute/daftar/bahan",
                    type:"GET",
                    dataType:"JSON",
                    success:function(respond){
                        var options = "";
                        for(var a = 0; a<respond["attr"].length; a++){
                            options += "<option value = '"+respond["attr"][a]["attr_id"]+"'>"+respond["attr"][a]["attr_name"].toUpperCase()+"</option>";
                        }
                        $("#formulaListRow"+counter).html(options);
                    }
                });
            break;
            case "upah":
                $.ajax({
                    url:"<?php echo base_url();?>ws/attribute/daftar/upah",
                    type:"GET",
                    dataType:"JSON",
                    success:function(respond){
                        var options = "";
                        for(var a = 0; a<respond["attr"].length; a++){
                            options += "<option value = '"+respond["attr"][a]["attr_id"]+"'>"+respond["attr"][a]["attr_name"].toUpperCase()+"</option>";
                        }
                        $("#formulaListRow"+counter).html(options);
                    }
                });
            break;
            case "alat":
            
                $.ajax({
                    url:"<?php echo base_url();?>ws/attribute/daftar/alat",
                    type:"GET",
                    dataType:"JSON",
                    success:function(respond){
                        var options = "";
                        for(var a = 0; a<respond["attr"].length; a++){
                            options += "<option value = '"+respond["attr"][a]["attr_id"]+"'>"+respond["attr"][a]["attr_name"].toUpperCase()+"</option>";
                        }
                        $("#formulaListRow"+counter).html(options);
                    }
                });
            break;
        }
        var html = '<tr class = "attr_row"><td vertical-align = "middle"><div class = "checkbox-custom checkbox-primary"><input checked type = "checkbox" name = "check[]" value = '+counter+'><label></label></div></td><td vertical-align = "middle"><select class = "form-control" name = "id_attr'+counter+'" id = "formulaListRow'+counter+'"></select></td><td vertical-align = "middle"><input type = "number" class = "form-control" name = "koefisien'+counter+'" step="0.0000000001"></td></tr>';
        $("#add_row_"+jenis+"_container").before(html);
    }
    function add_attr_row_edit(jenis){
        var counter = $(".attr_row").length;
        switch(jenis){
            case "bahan":
                $.ajax({
                    url:"<?php echo base_url();?>ws/attribute/daftar/bahan",
                    type:"GET",
                    dataType:"JSON",
                    success:function(respond){
                        var options = "";
                        for(var a = 0; a<respond["attr"].length; a++){
                            options += "<option value = '"+respond["attr"][a]["attr_id"]+"'>"+respond["attr"][a]["attr_name"].toUpperCase()+"</option>";
                        }
                        $("#formulaListRow"+counter).html(options);
                    }
                });
            break;
            case "upah":
                $.ajax({
                    url:"<?php echo base_url();?>ws/attribute/daftar/upah",
                    type:"GET",
                    dataType:"JSON",
                    success:function(respond){
                        var options = "";
                        for(var a = 0; a<respond["attr"].length; a++){
                            options += "<option value = '"+respond["attr"][a]["attr_id"]+"'>"+respond["attr"][a]["attr_name"].toUpperCase()+"</option>";
                        }
                        $("#formulaListRow"+counter).html(options);
                    }
                });
            break;
            case "alat":
                $.ajax({
                    url:"<?php echo base_url();?>ws/attribute/daftar/alat",
                    type:"GET",
                    dataType:"JSON",
                    success:function(respond){
                        var options = "";
                        for(var a = 0; a<respond["attr"].length; a++){
                            options += "<option value = '"+respond["attr"][a]["attr_id"]+"'>"+respond["attr"][a]["attr_name"].toUpperCase()+"</option>";
                        }
                        $("#formulaListRow"+counter).html(options);
                    }
                });
            break;
        }
        var html = '<tr class = "attr_row"><td vertical-align = "middle" colspan = 2><div class = "checkbox-custom checkbox-primary"><input checked type = "checkbox" name = "check[]" value = '+counter+'><label></label></div></td><td vertical-align = "middle"><select class = "form-control" name = "id_attr'+counter+'" id = "formulaListRow'+counter+'"></select></td><td vertical-align = "middle"><input type = "number" class = "form-control" name = "koefisien'+counter+'" step="0.0000000001"></td></tr>';
        $("#add_row_container_"+jenis+"_edit").before(html);
        
    }
    function load_delete_id(id_submit_formula){
        $("#id_formula_delete").val(id_submit_formula);
    }
</script>
<script>
    function load_content(id_submit_formula){
        var option_bahan = "";
        var option_upah = "";
        var option_alat = "";
        $.ajax({
            url:"<?php echo base_url();?>ws/attribute/daftar/bahan",
            type:"GET",
            dataType:"JSON",
            success:function(respond){
                for(var a = 0; a<respond["attr"].length; a++){
                    option_bahan += "<option value = '"+respond["attr"][a]["attr_id"]+"'>"+respond["attr"][a]["attr_name"].toUpperCase()+"</option>";
                }
                $(".formulaListRowEditBahan").html(option_bahan);
            }
        });
        $.ajax({
            url:"<?php echo base_url();?>ws/attribute/daftar/upah",
            type:"GET",
            dataType:"JSON",
            success:function(respond){
                for(var a = 0; a<respond["attr"].length; a++){
                    option_upah += "<option value = '"+respond["attr"][a]["attr_id"]+"'>"+respond["attr"][a]["attr_name"].toUpperCase()+"</option>";
                }
                $(".formulaListRowEditUpah").html(option_upah);
            }
        });
        $.ajax({
            url:"<?php echo base_url();?>ws/attribute/daftar/alat",
            type:"GET",
            dataType:"JSON",
            success:function(respond){
                for(var a = 0; a<respond["attr"].length; a++){
                    option_alat += "<option value = '"+respond["attr"][a]["attr_id"]+"'>"+respond["attr"][a]["attr_name"].toUpperCase()+"</option>";
                }
                $(".formulaListRowEditAlat").html(option_alat);
            }
        });
        $.ajax({
            url:"<?php echo base_url();?>ws/formula/get_formula/"+id_submit_formula,
            dataType:"JSON",
            type:"GET",
            success:function(respond){
                
                $("#formula_name_edit").val(respond["main"]["formula_name"]);
                $("#formula_desc_edit").val(respond["main"]["formula_desc"]);
                $("#formula_id_edit").val(respond["main"]["id_formula"]);
                
                var html_bahan = "";
                var html_upah = "";
                var html_alat = "";
                for(var a = 0; a<respond["attr"].length; a++){
                    switch(respond["attr"][a]["tipe_attr"].toLowerCase()){
                        case "bahan":
                            html_bahan += '<tr class = "attr_row"><input type = "hidden" name = "id_formula_comb'+a+'" value = "'+respond["attr"][a]["id_formula_comb"]+'"><td><div class = "checkbox-custom checkbox-primary"><input checked type = "checkbox" name = "edit[]" value = '+a+'><label></label></div></td><td><div class = "checkbox-custom checkbox-danger"><input type = "checkbox" name = "delete[]" value = '+a+'><label></label></td><td vertical-align = "middle"><select class = "form-control formulaListRowEditBahan" name = "id_attr'+a+'" id = "formulaListRowEdit'+a+'">'+option_bahan+'</select></td><td vertical-align = "middle"><input required value = "'+respond["attr"][a]["koefisien"]+'" type = "number" class = "form-control" name = "koefisien'+a+'" step="0.0000000001"></td></tr>';
                        break;
                        case "upah":
                            html_upah += '<tr class = "attr_row"><input type = "hidden" name = "id_formula_comb'+a+'" value = "'+respond["attr"][a]["id_formula_comb"]+'"><td><div class = "checkbox-custom checkbox-primary"><input checked type = "checkbox" name = "edit[]" value = '+a+'><label></label></div></td><td><div class = "checkbox-custom checkbox-danger"><input type = "checkbox" name = "delete[]" value = '+a+'><label></label></td><td vertical-align = "middle"><select class = "form-control formulaListRowEditUpah" name = "id_attr'+a+'" id = "formulaListRowEdit'+a+'">'+option_upah+'</select></td><td vertical-align = "middle"><input required value = "'+respond["attr"][a]["koefisien"]+'" type = "number" class = "form-control" name = "koefisien'+a+'" step="0.0000000001"></td></tr>';
                        break;
                        case "alat":
                            html_alat += '<tr class = "attr_row"><input type = "hidden" name = "id_formula_comb'+a+'" value = "'+respond["attr"][a]["id_formula_comb"]+'"><td><div class = "checkbox-custom checkbox-primary"><input checked type = "checkbox" name = "edit[]" value = '+a+'><label></label></div></td><td><div class = "checkbox-custom checkbox-danger"><input type = "checkbox" name = "delete[]" value = '+a+'><label></label></td><td vertical-align = "middle"><select class = "form-control formulaListRowEditAlat" name = "id_attr'+a+'" id = "formulaListRowEdit'+a+'">'+option_alat+'</select></td><td vertical-align = "middle"><input required value = "'+respond["attr"][a]["koefisien"]+'" type = "number" class = "form-control" name = "koefisien'+a+'" step="0.0000000001"></td></tr>';
                        break;
                    }
                }
                $(".attr_row").remove();
                $("#add_row_container_bahan_edit").before(html_bahan);
                $("#add_row_container_upah_edit").before(html_upah);
                $("#add_row_container_alat_edit").before(html_alat);

                for(var a = 0; a<respond["attr"].length; a++){
                    $("#formulaListRowEdit"+a).val(respond["attr"][a]["id_formula_attr"]);
                }
            }
        });
    }
    function load_delete_content(id_submit_formula){
        $.ajax({
            url:"<?php echo base_url();?>ws/formula/get_formula/"+id_submit_formula,
            dataType:"JSON",
            type:"GET",
            success:function(respond){
                $("#formula_name_delete").html(respond["main"]["formula_name"]);
                $("#formula_desc_delete").html(respond["main"]["formula_desc"]);
            }
        });
    }
</script>