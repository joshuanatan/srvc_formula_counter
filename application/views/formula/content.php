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
                    <a href = "#" class = "btn btn-primary btn-sm">
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

<script>
    function add_attr_row(){
        var counter = $(".attr_row").length;
        var html = '<tr class = "attr_row"><td vertical-align = "middle"><input checked type = "checkbox" name = "check[]" value = '+counter+'></td><td vertical-align = "middle"><input type = "text" class = "form-control" name = "attr_name'+counter+'"></td><td vertical-align = "middle"><textarea class = "form-control" name = "rumus'+counter+'"></textarea></td></tr>';
        $("#add_row_container").before(html);
    }
</script>