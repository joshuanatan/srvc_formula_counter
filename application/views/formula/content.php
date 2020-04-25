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
<div class = "modal fade" id = "addFormula">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Tambah Pekerjaan</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>formula/register" method = "POST">
                    <input type = "hidden" name = "id_formula_cat" value = "<?php echo $id_formula_cat;?>">
                    <div class = "form-group">
                        <h5>Nama Pekerjaan</h5>
                        <input type = "text" class = "form-control" required name = "formula_desc"/>
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
                <h4 class = "modal-title">Hapus Pekerjaan</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>formula/delete" method = "POST">
                    <input type = "hidden" name = "id_formula_cat" value = "<?php echo $id_formula_cat;?>">
                    <input type = "hidden" name = "id_formula" value = "" id = "id_formula_delete">
                    <h4 align = "center">Apakah anda yakin ingin menghapus pekerjaan <i><span id = "formula_desc_delete"></span></i></h4>
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
                    <input type = "hidden" name = "id_formula_cat" value = "<?php echo $id_formula_cat;?>">
                    <input type = "hidden" name = "id_formula" id = "formula_id_edit">
                    <div class = "form-group">
                        <h5>Formula Description</h5>
                        <input type = "text" class = "form-control" required name = "formula_desc" id = "formula_desc_edit"/>
                    </div>
                    <div class = "form-group">
                        <h5>Bahan</h5>
                        <datalist id = "list_bahan_edit"></datalist>
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
                        <datalist id = "list_upah_edit"></datalist>
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
                        <datalist id = "list_alat_edit"></datalist>
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
    var id_cat = <?php echo $id_formula_cat;?>;
    var orderBy = 0;
    var orderDirection = "ASC";
    var searchKey = "";
    var page = 1;
    function refresh(req_page = 1) {
        page = req_page;
        $.ajax({
            url: "<?php echo base_url();?>ws/formula/list?orderBy="+orderBy+"&orderDirection="+orderDirection+"&page="+page+"&searchKey="+searchKey+"&idCat="+id_cat,
            type: "GET",
            dataType: "JSON",
            success: function(respond) {
                var html = "";
                if(respond["status"] == "SUCCESS"){
                    for(var a = 0; a<respond["content"].length; a++){
                        html += "<tr>";
                        html += "<td class = 'align-middle text-center' id = 'id"+a+"'>"+respond["content"][a]["desc"]+"</td>";
                        html += "<td class = 'align-middle text-center' id = 'name"+a+"'>"+respond["content"][a]["status"]+"</td>";
                        html += "<td class = 'align-middle text-center' id = 'email"+a+"'>"+respond["content"][a]["last_modified"]+"</td>";
                        html += "<td class = 'align-middle text-center'><i style = 'cursor:pointer;font-size:large' data-toggle = 'modal' class = 'text-primary md-edit' data-target = '#editFormula' onclick = 'load_list_bahan_edit();load_list_alat_edit();load_list_upah_edit();load_content("+respond["content"][a]["id"]+")'></i> | <i style = 'cursor:pointer;font-size:large' data-toggle = 'modal' class = 'text-danger md-delete' data-target = '#deleteFormula' onclick = 'load_delete_content("+respond["content"][a]["id"]+")'></i></td>";
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
</script>
<script>
    function load_list_bahan_edit(){
        $.ajax({
            url:"<?php echo base_url();?>ws/attribute/daftar/bahan",
            type:"GET",
            async:false,
            dataType:"JSON",
            success:function(respond){
                var option_bahan = "";
                for(var a = 0; a<respond["attr"].length; a++){
                    option_bahan += "<option value = '"+respond["attr"][a]["attr_name"].toUpperCase()+"'>";
                }
                $("#list_bahan_edit").html(option_bahan);
            }
        });
    }
    function load_list_alat_edit(){
        $.ajax({
            url:"<?php echo base_url();?>ws/attribute/daftar/alat",
            type:"GET",
            async:false,
            dataType:"JSON",
            success:function(respond){
                var option_alat = "";
                for(var a = 0; a<respond["attr"].length; a++){
                    option_alat += "<option value = '"+respond["attr"][a]["attr_name"].toUpperCase()+"'>";
                }
                $("#list_alat_edit").html(option_alat);
            }
        });
    }
    function load_list_upah_edit(){
        $.ajax({
            url:"<?php echo base_url();?>ws/attribute/daftar/upah",
            type:"GET",
            dataType:"JSON",
            success:function(respond){
                var option_upah = "";
                for(var a = 0; a<respond["attr"].length; a++){
                    option_upah += "<option value = '"+respond["attr"][a]["attr_name"].toUpperCase()+"'>";
                }
                $("#list_upah_edit").html(option_upah);
            }
        });
    }
</script>
<script>
    function load_content(id_submit_formula){
        $("#formula_id_edit").val(id_submit_formula)
        $("#formula_desc_edit").val($("#formula_desc"+id_submit_formula).text());
        
        $.ajax({
            url:"<?php echo base_url();?>ws/formula/get_formula/"+id_submit_formula,
            dataType:"JSON",
            type:"GET",
            success:function(respond){
                var html_bahan = "";
                var html_upah = "";
                var html_alat = "";
                for(var a = 0; a<respond["attr"].length; a++){
                    switch(respond["attr"][a]["tipe_attr"].toLowerCase()){
                        case "bahan":
                            html_bahan += '<tr class = "attr_row"><input type = "hidden" name = "id_formula_comb'+a+'" value = "'+respond["attr"][a]["id_formula_comb"]+'"><td><div class = "checkbox-custom checkbox-primary"><input checked type = "checkbox" name = "edit[]" value = '+a+'><label></label></div></td><td><div class = "checkbox-custom checkbox-danger"><input type = "checkbox" name = "delete[]" value = '+a+'><label></label></td><td class = "align-middle;text-center"><input name = "attr_name'+a+'" type = "text" class = "form-control" list = "list_bahan_edit" value = "'+respond["attr"][a]["attr_name"]+'"></td><td class = "align-middle;text-center"><input required value = "'+respond["attr"][a]["koefisien"]+'" type = "number" class = "form-control" name = "koefisien'+a+'" step="0.0000000001"></td></tr>';
                        break;
                        case "upah":
                            html_upah += '<tr class = "attr_row"><input type = "hidden" name = "id_formula_comb'+a+'" value = "'+respond["attr"][a]["id_formula_comb"]+'"><td><div class = "checkbox-custom checkbox-primary"><input checked type = "checkbox" name = "edit[]" value = '+a+'><label></label></div></td><td><div class = "checkbox-custom checkbox-danger"><input type = "checkbox" name = "delete[]" value = '+a+'><label></label></td><td class ="align-middle;text-center"><input name = "attr_name'+a+'" type = "text" class = "form-control" list = "list_upah_edit" value = "'+respond["attr"][a]["attr_name"]+'"></td><td class ="align-middle;text-center"><input required value = "'+respond["attr"][a]["koefisien"]+'" type = "number" class = "form-control" name = "koefisien'+a+'" step="0.0000000001"></td></tr>';
                        break;
                        case "alat":
                            html_alat += '<tr class = "attr_row"><input type = "hidden" name = "id_formula_comb'+a+'" value = "'+respond["attr"][a]["id_formula_comb"]+'"><td><div class = "checkbox-custom checkbox-primary"><input checked type = "checkbox" name = "edit[]" value = '+a+'><label></label></div></td><td><div class = "checkbox-custom checkbox-danger"><input type = "checkbox" name = "delete[]" value = '+a+'><label></label></td><td class = "align-middle;text-center"><input name = "attr_name'+a+'" type = "text" class = "form-control" list = "list_alat_edit" value = "'+respond["attr"][a]["attr_name"]+'"></td><td class = "align-middle;text-center"><input required value = "'+respond["attr"][a]["koefisien"]+'" type = "number" class = "form-control" name = "koefisien'+a+'" step="0.0000000001"></td></tr>';
                        break;
                    }
                }
                $(".attr_row").remove();
                $("#add_row_container_bahan_edit").before(html_bahan);
                $("#add_row_container_upah_edit").before(html_upah);
                $("#add_row_container_alat_edit").before(html_alat);
            }
        });
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
                        $("#formulaListRow"+counter).select2();
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
                        $("#formulaListRow"+counter).select2();
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
                        $("#formulaListRow"+counter).select2();
                    }
                });
            break;
        }
        var html = '<tr class = "attr_row"><td vertical-align = "middle" colspan = 2><div class = "checkbox-custom checkbox-primary"><input checked type = "checkbox" name = "check[]" value = '+counter+'><label></label></div></td><td vertical-align = "middle"><select class = "form-control" name = "id_attr'+counter+'" id = "formulaListRow'+counter+'"></select></td><td vertical-align = "middle"><input type = "number" class = "form-control" name = "koefisien'+counter+'" step="0.0000000001"></td></tr>';
        $("#add_row_container_"+jenis+"_edit").before(html);
        
    }
</script>
<script>
    function load_delete_content(id_submit_formula){
        $("#id_formula_delete").val(id_submit_formula);
        $("#formula_desc_delete").html($("#formula_desc"+id_submit_formula).text());
    }
</script>