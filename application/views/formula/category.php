<div class = "col-lg-12">
    <button type = "button" class = "btn btn-primary btn-sm" data-toggle = "modal" data-target = "#addformula">Tambah Kategori Pekerjaan</button><br/><br/>
    <table class = "table table-bordered table-hover table-striped" data-plugin = "dataTable">
        <thead>
            <th>Kategori Pekerjaan</th>
            <th>Status</th>
            <th>Last Modified</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php foreach($formula as $a):?>
            <tr>
                <td id = "cat_name<?php echo $a->id_submit_formula_cat;?>"><?php echo $a->formula_cat_name;?></td>
                <td><?php echo $a->status_formula_cat;?></td>
                <td><?php echo $a->formula_cat_last_modified;?></td>
                <td>
                    <a href = "#" data-toggle = "modal" data-target = "#editFormula" onclick = "load_content(<?php echo $a->id_submit_formula_cat;?>)" class = "btn btn-primary btn-sm">
                        <i class = "md-edit"></i>
                    </a>
                    <a href = "#" data-toggle = "modal" data-target = "#deleteFormula" onclick = "load_delete_id(<?php echo $a->id_submit_formula_cat;?>);load_delete_content(<?php echo $a->id_submit_formula_cat;?>)" class = "btn btn-danger btn-sm">
                        <i class = "md-delete"></i>
                    </a>
                    <a href = "<?php echo base_url();?>formula/subformula/<?php echo $a->id_submit_formula_cat;?>" class = "btn btn-success btn-sm">
                        <i class = "md-collection-text"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<div class = "modal fade" id = "addFormula">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Tambah Kategori Pekerjaan</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>formula/register_cat" method = "POST">
                    <div class = "form-group">
                        <h5>Nama Kategori</h5>
                        <input type = "text" class = "form-control" required name = "cat_name">
                    </div>
                    <div class = "form-group">
                        <button type = "button" class = "btn btn-sm btn-danger" data-dismiss = "modal">Cancel</button>
                        <button type = "submit" class = "btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class = "modal fade" id = "deleteFormula">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Hapus Kategori Pekerjaan</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>formula/delete_cat" method = "POST">
                    <input type = "hidden" name = "id_cat" value = "" id = "formula_cat_id_delete">
                    <h4 align = "center">Apakah anda yakin akan menghapus kategori <i><span id = "formula_cat_delete"></span></i>? Seluruh pekerjaan dalam kategori ini tidak dapat digunakan.</h4>
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
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Ubah Kategori Pekerjaan</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>formula/update_cat" method = "POST">
                    <div class = "form-group">
                        <h5>Formula Name</h5>
                        <input type = "hidden" name = "id_cat" id = "formula_cat_id_edit">
                        <input type = "text" class = "form-control" required name = "cat_name" id = "formula_cat_edit">
                    </div>
                    <div class = "form-group">
                        <button type = "button" class = "btn btn-sm btn-danger" data-dismiss = "modal">Cancel</button>
                        <button type = "submit" class = "btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function load_content(id_submit_formula){
        var cat_name = $("#cat_name"+id_submit_formula).text();
        $("#formula_cat_id_edit").val(id_submit_formula);
        $("#formula_cat_edit").val(cat_name);
    }
</script>
<script>
    function load_delete_id(id_submit_formula){
        var cat_name = $("#cat_name"+id_submit_formula).text();
        $("#formula_cat_id_delete").val(id_submit_formula);
        $("#formula_cat_delete").html(cat_name);
    }
</script>
