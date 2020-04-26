<div class = "col-lg-12">
    <button type = "button" class = "btn btn-primary btn-sm" data-toggle = "modal" data-target = "#addFormula" style = "margin-right:10px">Add Formula</button>
    <div class = "align-middle text-center">
        <i style = "cursor:pointer;font-size:large;margin-left:10px" class = "text-primary md-edit"></i><b> - Edit </b>   
        <i style = "cursor:pointer;font-size:large;margin-left:10px" class = "text-danger md-delete"></i><b> - Delete </b>
        <i style = "cursor:pointer;font-size:large;margin-left:10px" class = "text-success md-collection-text"></i><b> - Item Pekerjaan </b>
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
<div class = "modal fade" id = "addFormula">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Tambah Kategori Pekerjaan</h4>
            </div>
            <div class = "modal-body">
                <form id = "add_form" method = "POST">
                    <div class = "form-group">
                        <h5>Nama Kategori</h5>
                        <input type = "text" class = "form-control" required name = "cat_name">
                    </div>
                    <div class = "form-group">
                        <button type = "button" class = "btn btn-sm btn-danger" data-dismiss = "modal">Cancel</button>
                        <button type = "button" onclick = "register_cat()" class = "btn btn-sm btn-primary">Submit</button>
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
                <input type = "hidden" name = "id_cat" value = "" id = "formula_cat_id_delete">
                <h4 align = "center">Apakah anda yakin akan menghapus kategori <i><span id = "formula_cat_delete"></span></i>? Seluruh pekerjaan dalam kategori ini tidak dapat digunakan.</h4>
                <div class = "row">
                    <button type = "button" class = "btn btn-sm btn-primary col-lg-3 col-sm-12 offset-lg-3" data-dismiss = "modal">Cancel</button>
                    <button type = "button" onclick = "delete_cat()" class = "btn btn-sm btn-danger col-lg-3">Delete</button>
                </div>
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
                <form id = "edit_form" method = "POST">
                    <div class = "form-group">
                        <h5>Formula Name</h5>
                        <input type = "hidden" name = "id_cat" id = "formula_cat_id_edit">
                        <input type = "text" class = "form-control" required name = "cat_name" id = "formula_cat_edit">
                    </div>
                    <div class = "form-group">
                        <button type = "button" class = "btn btn-sm btn-danger" data-dismiss = "modal">Cancel</button>
                        <button type = "button" onclick = "update_cat()" class = "btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
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
            url: "<?php echo base_url();?>ws/formula/list_category?orderBy="+orderBy+"&orderDirection="+orderDirection+"&page="+page+"&searchKey="+searchKey,
            type: "GET",
            dataType: "JSON",
            success: function(respond) {
                var html = "";
                if(respond["status"] == "SUCCESS"){
                    for(var a = 0; a<respond["content"].length; a++){
                        html += "<tr>";
                        html += "<td class = 'align-middle text-center' id = 'name"+respond["content"][a]["id"]+"'>"+respond["content"][a]["name"]+"</td>";
                        html += "<td class = 'align-middle text-center' id = 'status"+respond["content"][a]["id"]+"'>"+respond["content"][a]["status"]+"</td>";
                        html += "<td class = 'align-middle text-center' id = 'last_modified"+respond["content"][a]["id"]+"'>"+respond["content"][a]["last_modified"]+"</td>";
                        html += "<td class = 'align-middle text-center'><i style = 'cursor:pointer;font-size:large' data-toggle = 'modal' class = 'text-primary md-edit' data-target = '#editFormula' onclick = 'load_content("+respond["content"][a]["id"]+")'></i> | <i style = 'cursor:pointer;font-size:large' data-toggle = 'modal' class = 'text-danger md-delete' data-target = '#deleteFormula' onclick = 'load_delete_id("+respond["content"][a]["id"]+")'></i> | <a style = 'cursor:pointer;font-size:large;text-decoration:none' class = 'text-success md-collection-text' href = '<?php echo base_url();?>formula/subformula/"+respond["content"][a]["id"]+"'></a></td>";
                        html += "</tr>";
                    }
                }
                else{
                    html += "<tr>";
                    html += "<td colspan = 4 class = 'align-middle text-center'>No Records Found</td>";
                    html += "</tr>";
                }
                $("#content_container").html(html);

                html = "";
                if(respond["page"]["previous"]){
                    html += '<li class="page-item"><a class="page-link" onclick = "refresh('+(respond["page"]["before"])+')"><</a></li>';
                }
                else{
                    html += '<li class="page-item"><a class="page-link" style = "cursor:not-allowed"><</a></li>';
                }
                if(respond["page"]["before"]){
                    html += '<li class="page-item"><a class="page-link" onclick = "refresh('+(respond["page"]["before"])+')">'+respond["page"]["before"]+'</a></li>';
                }
                html += '<li class="page-item active"><a class="page-link" onclick = "refresh('+(respond["page"]["current"])+')">'+respond["page"]["current"]+'</a></li>';
                if(respond["page"]["after"]){
                    html += '<li class="page-item"><a class="page-link" onclick = "refresh('+(respond["page"]["after"])+')">'+respond["page"]["after"]+'</a></li>';
                }
                if(respond["page"]["next"]){
                    html += '<li class="page-item"><a class="page-link" onclick = "refresh('+(respond["page"]["after"])+')">></a></li>';
                }
                else{
                    html += '<li class="page-item"><a class="page-link" style = "cursor:not-allowed">></a></li>';
                }
                $("#pagination_container").html(html);
            },
            error: function(){
                var html = "";
                html += "<tr>";
                html += "<td colspan = 4 class = 'align-middle text-center'>No Records Found</td>";
                html += "</tr>";
                $("#content_container").html(html);
                
                html = "";
                html += '<li class="page-item"><a class="page-link" style = "cursor:not-allowed"><</a></li>';
                html += '<li class="page-item"><a class="page-link" style = "cursor:not-allowed">></a></li>';
                $("#pagination_container").html(html);
            }
        });
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
    function register_cat(){
        var form = $("#add_form")[0];
        var data = new FormData(form);
        $.ajax({
            url:"<?php echo base_url();?>ws/formula/register_cat",
            type:"POST",
            dataType:"JSON",
            data:data,
            processData:false,
            contentType:false,
            success:function(respond){
                $("#addFormula").modal("hide");
                refresh(page);
            }
        })
    }
    function update_cat(){
        var form = $("#edit_form")[0];
        var data = new FormData(form);
        $.ajax({
            url:"<?php echo base_url();?>ws/formula/update_cat",
            type:"POST",
            dataType:"JSON",
            data:data,
            processData:false,
            contentType:false,
            success:function(respond){
                $("#editFormula").modal("hide");
                refresh(page);
            }
        })
    }
    function delete_cat(){
        var id_cat = $("#formula_cat_id_delete").val();
        $.ajax({
            url:"<?php echo base_url();?>ws/formula/delete_cat/"+id_cat,
            type:"POST",
            dataType:"JSON",
            processData:false,
            contentType:false,
            success:function(respond){
                $("#deleteFormula").modal("hide");
                refresh(page);
            }
        })
    }
</script>
<script>
    function load_content(id_submit_formula){
        var cat_name = $("#name"+id_submit_formula).text();
        $("#formula_cat_id_edit").val(id_submit_formula);
        $("#formula_cat_edit").val(cat_name);
    }
</script>
<script>
    function load_delete_id(id_submit_formula){
        var cat_name = $("#name"+id_submit_formula).text();
        $("#formula_cat_id_delete").val(id_submit_formula);
        $("#formula_cat_delete").html(cat_name);
    }
</script>
