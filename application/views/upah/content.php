<div class = "col-lg-12">
    <button type = "button" class = "btn btn-primary btn-sm" data-toggle = "modal" data-target = "#addAttribute">Tambah Data Upah</button><br/><br/>
    <table class = "table table-bordered table-hover table-striped" data-plugin = "dataTable">
        <thead>
            <th>Nama Upah</th>
            <th>Satuan Upah</th>
            <th>Harga Upah</th>
            <th>Status Upah</th>
            <th>Last Modified</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php foreach($attribute as $a):?>
            <tr>
                <td><?php echo strtoupper($a->formula_attr_name);?></td>
                <td><?php echo strtoupper($a->satuan_attr);?></td>
                <td><?php echo strtoupper($a->harga_satuan_attr);?></td>
                <td><?php echo $a->status_formula_attr;?></td>
                <td><?php echo $a->formula_attr_last_modified;?></td>
                <td>
                    <a href = "#" data-toggle = "modal" data-target = "#editAttribute" onclick = "load_content(<?php echo $a->id_submit_formula_attr;?>)" class = "btn btn-primary btn-sm">
                        <i class = "md-edit"></i>
                    </a>
                    <a href = "#" data-toggle = "modal" data-target = "#deleteAttribute" onclick = "load_delete_content(<?php echo $a->id_submit_formula_attr;?>);load_delete_content(<?php echo $a->id_submit_formula_attr;?>)" class = "btn btn-danger btn-sm">
                        <i class = "md-delete"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<div class = "modal fade" id = "addAttribute">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Tambah Data Upah</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>upah/register" method = "POST">
                    <div class = "form-group">
                        <h5>Nama Upah</h5>
                        <input type = "text" class = "form-control" required name = "attr_name">
                    </div>
                    <div class = "form-group">
                        <h5>Satuan Upah</h5>
                        <input type = "text" required name = "attr_unit" class = "form-control">
                    </div>
                    <div class = "form-group">
                        <h5>Harga Upah</h5>
                        <input type = "text" required name = "attr_price" class = "form-control">
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

<div class = "modal fade" id = "editAttribute">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Ubah Data Upah</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>upah/update" method = "POST">
                    <input type = "hidden" name = "attr_id" id = "attr_id_edit">
                    <div class = "form-group">
                        <h5>Nama Upah</h5>
                        <input type = "text" class = "form-control" required name = "attr_name" id = "attr_name_edit">
                    </div>
                    <div class = "form-group">
                        <h5>Satuan Upah</h5>
                        <input type = "text" required name = "attr_unit" class = "form-control" id = "attr_unit_edit">
                    </div>
                    <div class = "form-group">
                        <h5>Harga Upah</h5>
                        <input type = "text" required name = "attr_price" class = "form-control" id = "attr_price_edit">
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

<div class = "modal fade" id = "deleteAttribute">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Hapus Upah</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>upah/delete" method = "POST">
                <input type = "hidden" name = "attr_id" value = "" id = "attr_id_delete">
                    <h4 align = "center">Apakah anda yakin akan menghapus data upah di bawah ini?</h4>
                    <table class = "table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <td>Nama Upah</td>
                                <td id = "attr_name_delete"></td>
                            </tr>
                            <tr>
                                <td>Satuan Upah</td>
                                <td id = "attr_unit_delete"></td>
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

<script>
function load_content(id_submit_attr){
    $.ajax({
        url:"<?php echo base_url();?>ws/attribute/get_attribute/"+id_submit_attr,
        dataType:"JSON",
        type:"GET",
        success:function(respond){
            $("#attr_name_edit").val(respond["attr"]["attr_name"]);
            $("#attr_unit_edit").val(respond["attr"]["attr_unit"]);
            $("#attr_id_edit").val(respond["attr"]["attr_id"]);
            $("#attr_price_edit").val(respond["attr"]["attr_price"]);
        }
    });
}

function load_delete_content(id_submit_attr){
    $.ajax({
        url:"<?php echo base_url();?>ws/attribute/get_attribute/"+id_submit_attr,
        dataType:"JSON",
        type:"GET",
        success:function(respond){
            $("#attr_name_delete").html(respond["attr"]["attr_name"]);
            $("#attr_unit_delete").html(respond["attr"]["attr_unit"]);
            $("#attr_id_delete").val(respond["attr"]["attr_id"]);
        }
    });
}
</script>