<div class = "col-lg-12">
    <button type = "button" class = "btn btn-primary btn-sm" data-toggle = "modal" data-target = "#addSupplier">Tambah Supplier</button><br/><br/>
    <table class = "table table-bordered table-hover table-striped" data-plugin = "dataTable">
        <thead>
            <th>Nama Supplier</th>
            <th>Alamat Supplier</th>
            <th>PIC Supplier</th>
            <th>No Telp Supplier</th>
            <th>Status</th>
            <th>Last Modified</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($supplier); $a++):?>
                <tr>
                    <td id = "nama<?php echo $supplier[$a]["id_submit_supplier"];?>"><?php echo ucwords($supplier[$a]["nama_supp"]);?><br/><span id = 'desc<?php echo $supplier[$a]["id_submit_supplier"];?>'><?php echo ucwords($supplier[$a]["desc_supp"]);?></td>
                    <td id = "alamat<?php echo $supplier[$a]["id_submit_supplier"];?>"><?php echo ucwords($supplier[$a]["alamat_supp"]);?></td>
                    <td id = "pic<?php echo $supplier[$a]["id_submit_supplier"];?>"><?php echo ucwords($supplier[$a]["pic_supp"]);?></td>
                    <td id = "notelp<?php echo $supplier[$a]["id_submit_supplier"];?>"><?php echo $supplier[$a]["notelp_supp"];?></td>
                    <td><?php echo $supplier[$a]["supp_status"];?></td>
                    <td><?php echo $supplier[$a]["supp_last_modified"];?></td>
                    <td>
                        <a href = "#" data-toggle = "modal" data-target = "#editSupplier" onclick = "load_edit_content(<?php echo $supplier[$a]['id_submit_supplier'];?>) " class = "btn btn-primary btn-sm">
                            <i class = "md-edit"></i>
                        </a>
                        <a href = "#" data-toggle = "modal" data-target = "#deleteSupplier" onclick = "load_delete_content(<?php echo $supplier[$a]['id_submit_supplier'];?>)" class = "btn btn-danger btn-sm">
                            <i class = "md-delete"></i>
                        </a>
                    </td>
                </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>
<div class = "modal fade" id = "addSupplier">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4>Tambah Supplier</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>supplier/register" method = "POST">
                    <div class = "form-group">
                        <h5>Nama Supplier</h5>
                        <input type = "text" class = "form-control" name = "nama">
                    </div>
                    <div class = "form-group">
                        <h5>Desc Supplier</h5>
                        <textarea class = "form-control" name = "desc"></textarea>
                    </div>
                    <div class = "form-group">
                        <h5>Alamat Supplier</h5>
                        <textarea class = "form-control" name = "alamat"></textarea>
                    </div>
                    <div class = "form-group">
                        <h5>PIC Supplier</h5>
                        <input type = "text" class = "form-control" name = "pic">
                    </div>
                    <div class = "form-group">
                        <h5>No Telp Supplier</h5>
                        <input type = "text" class = "form-control" name = "notelp">
                    </div>
                    <div class = "form-group">
                        <button type = "button" data-dismiss = "modal" class = "btn btn-danger btn-sm">Cancel</button>
                        <button type = "submit" class = "btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class = "modal fade" id = "editSupplier">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4>Tambah Supplier</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>supplier/update" method = "POST">
                    <input type = "hidden" name = "id" id = "idEdit">
                    <div class = "form-group">
                        <h5>Nama Supplier</h5>
                        <input type = "text" class = "form-control" id = "namaEdit" name = "nama">
                    </div>
                    <div class = "form-group">
                        <h5>Desc Supplier</h5>
                        <textarea class = "form-control" id = "descEdit" name = "desc"></textarea>
                    </div>
                    <div class = "form-group">
                        <h5>Alamat Supplier</h5>
                        <textarea class = "form-control" id = "alamatEdit" name = "alamat"></textarea>
                    </div>
                    <div class = "form-group">
                        <h5>PIC Supplier</h5>
                        <input type = "text" class = "form-control" id = "picEdit" name = "pic">
                    </div>
                    <div class = "form-group">
                        <h5>No Telp Supplier</h5>
                        <input type = "text" class = "form-control" id = "notelpEdit" name = "notelp">
                    </div>
                    <div class = "form-group">
                        <button type = "button" data-dismiss = "modal" class = "btn btn-danger btn-sm">Cancel</button>
                        <button type = "submit" class = "btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class = "modal fade" id = "deleteSupplier">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4>Konfirmasi Hapus Supplier</h4>
            </div>
            <div class = "modal-body">
                <input type = "hidden" name = "id" id = "idEdit">
                <h4 align = "center">Apakah anda yakin akan menghapus data supplier <i><span id = 'namaDelete'></span></i>?</h4>

                <table class = "table table-striped table-bordered table-hover">
                    <tr>
                        <th>Desc Supplier</th>
                        <td id = "descDelete"></td>
                    </tr>
                    <tr>
                        <th>Alamat Supplier</th>
                        <td id = "alamatDelete"></td>
                    </tr>
                    <tr>
                        <th>PIC Supplier</th>
                        <td id = "picDelete"></td>
                    </tr>
                    <tr>
                        <th>No Telp Supplier</th>
                        <td id = "notelpDelete"></td>
                    </tr>
                </table>
                <div class = "row">
                    <button type = "button" class = "btn btn-sm btn-primary col-lg-3 col-sm-12 offset-lg-3" data-dismiss = "modal">Cancel</button>
                    <a href = "<?php echo base_url();?>supplier/delete" id = "deleteButton" class = "btn btn-sm btn-danger col-lg-3">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function load_edit_content(id_supplier){
        var nama = $("#nama"+id_supplier).text();
        var desc = $("#desc"+id_supplier).text();
        var alamat = $("#alamat"+id_supplier).text();
        var pic = $("#pic"+id_supplier).text();
        var notelp = $("#notelp"+id_supplier).text();

        $("#namaEdit").val(nama);
        $("#descEdit").val(desc);
        $("#alamatEdit").val(alamat);
        $("#picEdit").val(pic);
        $("#notelpEdit").val(notelp);
        $("#idEdit").val(id_supplier);
    }
    function load_delete_content(id_supplier){
        var nama = $("#nama"+id_supplier).text();
        var desc = $("#desc"+id_supplier).text();
        var alamat = $("#alamat"+id_supplier).text();
        var pic = $("#pic"+id_supplier).text();
        var notelp = $("#notelp"+id_supplier).text();

        $("#namaDelete").html(nama);
        $("#descDelete").html(desc);
        $("#alamatDelete").html(alamat);
        $("#picDelete").html(pic);
        $("#notelpDelete").html(notelp);
        $("#idDelete").html(id_supplier);
        $("#deleteButton").attr("href","<?php echo base_url();?>supplier/delete/"+id_supplier);
    }
</script>