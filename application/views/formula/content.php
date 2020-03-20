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
                    <a href = "#" class = "btn btn-danger btn-sm">
                        <i class = "md-delete"></i>
                    </a>
                    <a href = "#" class = "btn btn-success btn-sm">
                        <i class = "md-assignment"></i>
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
                        <h5>Attribute Table</h5>
                        <p>You can put variables inside <i>formula</i> using [ ]. ex: 2*[argument]</p>
                        <table class = "table table-striped table-hover table-bordered">
                            <thead>
                                <th style = "width:5%">#</th>
                                <th>Attribute</th>
                                <th>Formula</th>
                            </thead>
                            <tbody>
                                <tr id = "add_row_container">
                                    <td colspan = 3>
                                        <button type = "button" class = "btn btn-primary btn-sm col-lg-12" onclick = "add_attr_row()">Add Attribute</button>
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
                        <input type = "text" class = "form-control" required name = "formula_name" id = "formula_name_edit">
                        <input type = "hidden" name = "id_formula" id = "formula_id_edit">
                    </div>
                    <div class = "form-group">
                        <h5>Formula Description</h5>
                        <textarea class = "form-control" required name = "formula_desc" id = "formula_desc_edit"></textarea>
                    </div>
                    <div class = "form-group">
                        <h5>Attribute Table</h5>
                        <p>You can put variables inside <i>formula</i> using @. ex: 2*@argument</p>
                        <table class = "table table-striped table-hover table-bordered">
                            <thead>
                                <th style = "width:5%">Edit</th>
                                <th style = "width:5%">Delete</th>
                                <th>Attribute</th>
                                <th>Formula</th>
                            </thead>
                            <tbody id = "attr_table_edit">
                                <tr id = "add_row_container_edit">
                                    <td colspan = 4>
                                        <button type = "button" class = "btn btn-primary btn-sm col-lg-12" onclick = "add_attr_row_edit()">Add Attribute</button>
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
    function add_attr_row(){
        var counter = $(".attr_row").length;
        var html = '<tr class = "attr_row"><td vertical-align = "middle"><input checked type = "checkbox" name = "check[]" value = '+counter+'></td><td vertical-align = "middle"><input type = "text" class = "form-control" name = "attr_name'+counter+'"></td><td vertical-align = "middle"><textarea class = "form-control" name = "rumus'+counter+'"></textarea></td></tr>';
        $("#add_row_container").before(html);
    }
    function add_attr_row_edit(){
        var counter = $(".attr_row").length;
        var html = '<tr class = "attr_row"><td vertical-align = "middle" colspan = 2><input checked type = "checkbox" name = "checks[]" value = '+counter+'></td><td vertical-align = "middle"><input type = "text" class = "form-control" name = "attr_name'+counter+'"></td><td vertical-align = "middle"><textarea class = "form-control" name = "rumus'+counter+'"></textarea></td></tr>';
        $("#add_row_container_edit").before(html);
    }
</script>
<script>
    function load_content(id_submit_formula){
        $.ajax({
            url:"<?php echo base_url();?>ws/formula/get_formula/"+id_submit_formula,
            dataType:"JSON",
            type:"GET",
            success:function(respond){
                $("#formula_name_edit").val(respond["main"]["formula_name"]);
                $("#formula_desc_edit").val(respond["main"]["formula_desc"]);
                $("#formula_id_edit").val(respond["main"]["id_formula"]);
                
                var html = "";
                for(var a = 0; a<respond["attr"].length; a++){
                    html += "<tr class = 'attr_row'><td><input type = 'hidden' name = 'id_formula_attr' value = '"+respond["attr"][a]["id_formula_attr"]+"'><input type = 'checkbox' name = 'edit[]' value = '"+a+"'></td><td><input type = 'checkbox' name = 'delete[]' value = '"+a+"'></td><td><input type = 'text' class = 'form-control' value = '"+respond["attr"][a]["attr_name"]+"' name = 'attr_name"+a+"'></td><td><textarea class = 'form-control' name = 'rumus"+a+"'>"+respond["attr"][a]["attr_formula"]+"</textarea></td></tr>";
                }
                $("#add_row_container_edit").before(html);
            }
        });
    }
</script>