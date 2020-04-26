<div class = "col-lg-12">
    <button type = "button" class = "btn btn-primary btn-sm" data-toggle = "modal" data-target = "#register_dialog" style = "margin-right:10px">Add Account</button>
    <div class = "align-middle text-center">
        <i style = "cursor:pointer;font-size:large;margin-left:10px" class = "text-primary md-edit"></i><b> - Edit </b>   
        <i style = "cursor:pointer;font-size:large;margin-left:10px" class = "text-danger md-delete"></i><b> - Delete </b>
    </div>
    <br/>
    <div class = "table-responsive ">
        <div class = "form-group">
            <h5>Search Data Here</h5>
            <input id = "search_box" placeholder = "Search data here..." type = "text" class = "form-control form-control-sm col-lg-3 col-sm-12" onkeyup = "search()">
        </div>
        <table class = "table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <?php for($a = 0; $a<count($col); $a++):?>
                    <th id = "col<?php echo $a;?>" style = "cursor:pointer" onclick = "sort(<?php echo $a;?>)" class = "text-center align-middle"><?php echo $col[$a]["col_disp"];?> 
                    <?php if($a == 0):?>
                    <span class="badge badge-light align-top" id = "orderDirection">ASC</span>
                    <?php endif;?>
                    </th>
                    <?php endfor;?>
                    <th class = "text-center align-middle">Action</th>
                </tr>
            </thead>
            <tbody id = "content_container">
            </tbody>
        </table>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center" id = "pagination_container">
        </ul>
    </nav>
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
    var orderBy = 0;
    var orderDirection = "ASC";
    var searchKey = "";
    var page = 1;
    function refresh(req_page = 1) {
        page = req_page;
        $.ajax({
            url: "<?php echo base_url();?>ws/supplier/list?orderBy="+orderBy+"&orderDirection="+orderDirection+"&page="+page+"&searchKey="+searchKey,
            type: "GET",
            dataType: "JSON",
            success: function(respond) {
                var html = "";
                if(respond["status"] == "SUCCESS"){
                    for(var a = 0; a<respond["content"].length; a++){
                        html += "<tr>";
                        html += "<td class = 'align-middle text-center' id = 'nama"+respond["content"][a]["id"]+"'>"+respond["content"][a]["nama"]+"</td>";
                        html += "<td class = 'align-middle text-center' id = 'desc"+respond["content"][a]["id"]+"'>"+respond["content"][a]["desc"]+"</td>";
                        html += "<td class = 'align-middle text-center' id = 'alamat"+respond["content"][a]["id"]+"'>"+respond["content"][a]["alamat"]+"</td>";
                        html += "<td class = 'align-middle text-center' id = 'pic"+respond["content"][a]["id"]+"'>"+respond["content"][a]["pic"]+"</td>";
                        html += "<td class = 'align-middle text-center' id = 'notelp"+respond["content"][a]["id"]+"'>"+respond["content"][a]["notelp"]+"</td>";
                        html += "<td class = 'align-middle text-center' id = 'last_modified"+respond["content"][a]["id"]+"'>"+respond["content"][a]["last_modified"]+"</td>";
                        html += "<td class = 'align-middle text-center' id = 'status"+respond["content"][a]["id"]+"'>"+respond["content"][a]["status"]+"</td>";
                        html += "<td class = 'align-middle text-center'><i style = 'cursor:pointer;font-size:large' data-toggle = 'modal' class = 'text-primary md-edit' data-target = '#editSupplier' onclick = 'load_edit_content("+respond["content"][a]["id"]+")'></i> | <i style = 'cursor:pointer;font-size:large' data-toggle = 'modal' class = 'text-danger md-delete' data-target = '#deleteSupplier' onclick = 'load_delete_content("+respond["content"][a]["id"]+")'></i></td>";
                        html += "</tr>";
                    }
                }
                else{
                    html += "<tr>";
                    html += "<td colspan = 8 class = 'align-middle text-center'>No Records Found</td>";
                    html += "</tr>";
                }
                $("#content_container").html(html);
                pagination(respond["page"]);
                
            },
            error: function(){
                var html = "";
                html += "<tr>";
                html += "<td colspan = 8 class = 'align-middle text-center'>No Records Found</td>";
                html += "</tr>";
                $("#content_container").html(html);
                
                html = "";
                html += '<li class="page-item"><a class="page-link" style = "cursor:not-allowed"><</a></li>';
                html += '<li class="page-item"><a class="page-link" style = "cursor:not-allowed">></a></li>';
                $("#pagination_container").html(html);
            }
        });
        function pagination(page_rules){
            html = "";
            if(page_rules["previous"]){
                html += '<li class="page-item"><a class="page-link" onclick = "refresh('+(page_rules["before"])+')"><</a></li>';
            }
            else{
                html += '<li class="page-item"><a class="page-link" style = "cursor:not-allowed"><</a></li>';
            }
            if(page_rules["first"]){
                html += '<li class="page-item"><a class="page-link" onclick = "refresh('+(page_rules["first"])+')">'+(page_rules["first"])+'</a></li>';
                html += '<li class="page-item"><a class="page-link">...</a></li>';
            }
            if(page_rules["before"]){
                html += '<li class="page-item"><a class="page-link" onclick = "refresh('+(page_rules["before"])+')">'+page_rules["before"]+'</a></li>';
            }
            html += '<li class="page-item active"><a class="page-link" onclick = "refresh('+(page_rules["current"])+')">'+page_rules["current"]+'</a></li>';
            if(page_rules["after"]){
                html += '<li class="page-item"><a class="page-link" onclick = "refresh('+(page_rules["after"])+')">'+page_rules["after"]+'</a></li>';
            }
            if(page_rules["last"]){
                html += '<li class="page-item"><a class="page-link">...</a></li>';
                html += '<li class="page-item"><a class="page-link" onclick = "refresh('+(page_rules["last"])+')">'+page_rules["last"]+'</a></li>';
            }
            if(page_rules["next"]){
                html += '<li class="page-item"><a class="page-link" onclick = "refresh('+(page_rules["after"])+')">></a></li>';
            }
            else{
                html += '<li class="page-item"><a class="page-link" style = "cursor:not-allowed">></a></li>';
            }
            $("#pagination_container").html(html);
        }
    }
    function sort(colNum){
        if(parseInt(colNum) != orderBy){
            orderBy = colNum; 
            orderDirection = "ASC";
            var orderDirectionHtml = '<span class="badge badge-light align-top" id = "orderDirection">ASC</span>';
            $("#orderDirection").remove();
            $("#col"+colNum).append(orderDirectionHtml);
        }
        else{
            var direction = $("#orderDirection").text();
            if(direction == "ASC"){
                orderDirection = "DESC";
            }
            else{
                orderDirection = "ASC";
            }
            $("#orderDirection").text(orderDirection);
        }
        refresh();
    }
    function search(){
        searchKey = $("#search_box").val();
        refresh();
    }
</script>
<script>
    window.onload = function(){
        refresh();
    }
</script>
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