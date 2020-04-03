<div class = "col-lg-12">
    <button type = "button" class = "btn btn-primary btn-sm" data-toggle = "modal" data-target = "#addProject">Add Project</button><br/><br/>
    <table class = "table table-bordered table-hover table-striped" data-plugin = "dataTable">
        <thead>
            <th>Project Name</th>
            <th>Project Address</th>
            <th>Target Date</th>
            <th>Status</th>
            <th>Last Modified</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($project); $a++):?>
            <tr>
                <td><?php echo $project[$a]["prj_name"];?></td>
                <td><?php echo $project[$a]["prj_addrs"];?></td>
                <td><?php echo $project[$a]["prj_dateline"];?></td>
                <td><?php echo $project[$a]["status_project"];?></td>
                <td><?php echo $project[$a]["project_last_modified"];?></td>
                <td>
                    <a href = "#" onclick = "load_edit_content(<?php echo $project[$a]['id_submit_project'];?>);" data-toggle = "modal" data-target = "#editProject" class = "btn btn-primary btn-sm">
                        <i class = "md-edit"></i>
                    </a>
                    <a href = "#" onclick = "load_delete_content(<?php echo $project[$a]['id_submit_project'];?>)" data-toggle = "modal" data-target = "#deleteProject" class = "btn btn-danger btn-sm">
                        <i class = "md-delete"></i>
                    </a>
                    <a href = "<?php echo base_url();?>project/rab/<?php echo $project[$a]["id_submit_project"];?>" data-toggle = "modal" class = "btn btn-success btn-sm">
                        <i class = "md-assignment"></i>
                    </a>
                </td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>

<div class = "modal fade" id = "addProject">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4>Add Project</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>project/register" method = "POST">
                    <div class = "form-group">
                        <h5>Project Name</h5>
                        <input type = "text" class = "form-control" name = "prj_name" required>
                    </div>
                    <div class = "form-group">
                        <h5>Project Address</h5>
                        <textarea class = "form-control" name = "prj_addrs" required></textarea>
                    </div>
                    <div class = "form-group">
                        <h5>Target Date</h5>
                        <input type = "date" class = "form-control" name = "prj_dateline" required>
                    </div>
                    <div class = "form-group">
                        <h5>Contact Person</h5>
                        <select class = "form-control" onchange = "activeAddCP()" id = "projectCP" name = "id_client">
                            <option selected disabled>Choose Contact Person</option>
                            <option value = "0">Add New Contact</option>
                            <?php for($a = 0; $a<count($cp); $a++):?>
                            <option value = "<?php echo $cp[$a]["id_submit_client"];?>"><?php echo $cp[$a]["clnt_name"];?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    
                    <div style = "display:none" id = "addCpContainer">
                        <br/>
                        <h4>Add Contact Person</h4>
                        <hr/>
                        <div class = "form-group">
                            <h5>Client Name</h5>
                            <input type = "text" class = "form-control" name = "clnt_name">
                        </div>
                        <div class = "form-group">
                            <h5>Client Phone</h5>
                            <input type = "text" class = "form-control" name = "clnt_phone">
                        </div>
                        <div class = "form-group">
                            <h5>Client Email</h5>
                            <input type = "email" class = "form-control" name = "clnt_email">
                        </div>
                    </div>
                    <div style = "display:none" id = "currentCpContainer">
                        <br/>
                        <h4>Contact Person Information</h4>
                        <hr/>
                        <table class = "table table-bordered table-striped table-hover">
                            <thead>
                                <th style = "width:50%">Attributes</th>
                                <th style = "width:50%">Values</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td id = "client_add"></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td id = "client_phone_add"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td id = "client_email_add"></td>
                                </tr>
                            </tbody>
                        </table>
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
<div class = "modal fade" id = "editProject">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4>Edit Project</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>project/update" method = "POST">
                    <input type = "hidden" name = "id_submit_project" id = "id_submit_project_edit">
                    <div class = "form-group">
                        <h5>Project Name</h5>
                        <input type = "text" class = "form-control" name = "prj_name" id = "prj_name_edit" required>
                    </div>
                    <div class = "form-group">
                        <h5>Project Address</h5>
                        <textarea class = "form-control" name = "prj_addrs" id ="prj_addrs_edit" required></textarea>
                    </div>
                    <div class = "form-group">
                        <h5>Target Date</h5>
                        <input type = "date" class = "form-control" name = "prj_dateline" id = "prj_dateline_edit" required>
                    </div>
                    <div class = "form-group">
                        <h5>Contact Person</h5>
                        <select class = "form-control" onchange = "activeAddCPEdit()" name = "id_client" id = "id_client_edit">
                            <option selected disabled>Choose Contact Person</option>
                            <option value = "0">Add New Contact</option>
                            <?php for($a = 0; $a<count($cp); $a++):?>
                            <option value = "<?php echo $cp[$a]["id_submit_client"];?>"><?php echo $cp[$a]["clnt_name"];?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    
                    <div style = "display:none" id = "addCpContainerEdit">
                        <br/>
                        <h4>Add Contact Person</h4>
                        <hr/>
                        <div class = "form-group">
                            <h5>Client Name</h5>
                            <input type = "text" class = "form-control" name = "clnt_name">
                        </div>
                        <div class = "form-group">
                            <h5>Client Phone</h5>
                            <input type = "text" class = "form-control" name = "clnt_phone">
                        </div>
                        <div class = "form-group">
                            <h5>Client Email</h5>
                            <input type = "email" class = "form-control" name = "clnt_email">
                        </div>
                    </div>
                    <div style = "display:none" id = "currentCpContainerEdit">
                        <br/>
                        <h4>Contact Person Information</h4>
                        <hr/>
                        <table class = "table table-bordered table-striped table-hover">
                            <thead>
                                <th style = "width:50%">Attributes</th>
                                <th style = "width:50%">Values</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td id = "client_add_edit"></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td id = "client_phone_add_edit"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td id = "client_email_add_edit"></td>
                                </tr>
                            </tbody>
                        </table>
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
<div class = "modal fade" id = "deleteProject">
    <div class = "modal-dialog modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4 class = "modal-title">Delete Project</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>project/delete" method = "POST">
                    <input type = "hidden" name = "id_project" value = "" id = "id_project_delete">
                    <h4 align = "center">Are you sure want to delete this project?</h4>
                    <table class = "table table-bordered table-striped table-hover">
                        <thead>
                            <th style = "width:50%">Attributes</th>
                            <th style = "width:50%">Values</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Project Name</td>
                                <td id = "project_name_delete"></td>
                            </tr>
                            <tr>
                                <td>Project Address</td>
                                <td id = "project_addrs_delete"></td>
                            </tr>
                            <tr>
                                <td>Project Dateline</td>
                                <td id = "project_dateline_delete"></td>
                            </tr>
                            <tr>
                                <td>Client Name</td>
                                <td id = "client_delete"></td>
                            </tr>
                            <tr>
                                <td>Client Phone</td>
                                <td id = "client_phone_delete"></td>
                            </tr>
                            <tr>
                                <td>Client Email</td>
                                <td id = "client_email_delete"></td>
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
function activeAddCP(){
    var id_cp = $("#projectCP").val();
    if(id_cp == "0"){
        $("#addCpContainer").css("display","block");
        $("#currentCpContainer").css("display","none");
    }
    else{
        $("#addCpContainer").css("display","none");
        $("#currentCpContainer").css("display","block");
        load_contact_info(id_cp);
    }
}
function activeAddCPEdit(){
    var id_cp = $("#id_client_edit").val();
    if(id_cp == "0"){
        $("#addCpContainerEdit").css("display","block");
        $("#currentCpContainerEdit").css("display","none");
    }
    else{
        $("#addCpContainerEdit").css("display","none");
        $("#currentCpContainerEdit").css("display","block");
        load_contact_info_edit(id_cp);
    }
}
function load_contact_info(id_contact){
    $.ajax({
        url:"<?php echo base_url();?>ws/contact/get_detail/"+id_contact,
        type:"GET",
        dataType:"JSON",
        success:function(respond){
            $("#client_add").html(respond["main"]["client_name"]);
            $("#client_phone_add").html(respond["main"]["phone"]);
            $("#client_email_add").html(respond["main"]["email"]);
        }
    });
}
function load_contact_info_edit(id_contact){
    $.ajax({
        url:"<?php echo base_url();?>ws/contact/get_detail/"+id_contact,
        type:"GET",
        dataType:"JSON",
        success:function(respond){
            $("#client_add_edit").html(respond["main"]["client_name"]);
            $("#client_phone_add_edit").html(respond["main"]["phone"]);
            $("#client_email_add_edit").html(respond["main"]["email"]);
        }
    });
}
</script>
<script>
function load_edit_content(id_submit_project){
    $.ajax({
        url:"<?php echo base_url();?>ws/project/get_project_detail/"+id_submit_project,
        dataType:"JSON",
        type:"GET",
        success:function(respond){
            
            $("#id_submit_project_edit").val("");
            $("#prj_name_edit").val("");
            $("#prj_addrs_edit").val("");
            $("#prj_dateline_edit").val("");
            $("#id_client_edit").val("");

            $("#id_submit_project_edit").val(id_submit_project);
            $("#prj_name_edit").val(respond["main"]["project_name"]);
            $("#prj_addrs_edit").val(respond["main"]["address"]);
            $("#prj_dateline_edit").val(respond["main"]["dateline"]);
            $("#id_client_edit").val(respond["main"]["id_client"]);
            activeAddCPEdit();
        }
    });
}
function load_delete_content(id_submit_project){
    $.ajax({
        url:"<?php echo base_url();?>ws/project/get_project_detail/"+id_submit_project,
        dataType:"JSON",
        type:"GET",
        success:function(respond){
            
            $("#project_name_delete").html("");
            $("#project_addrs_delete").html("");
            $("#project_dateline_delete").html("");
            $("#client_delete").html("");
            $("#client_phone_delete").html("");
            $("#client_email_delete").html("");

            $("#id_project_delete").val(id_submit_project);
            $("#project_name_delete").html(respond["main"]["project_name"]);
            $("#project_addrs_delete").html(respond["main"]["address"]);
            $("#project_dateline_delete").html(respond["main"]["dateline"]);
            $("#client_delete").html(respond["main"]["client_name"]);
            $("#client_phone_delete").html(respond["main"]["phone"]);
            $("#client_email_delete").html(respond["main"]["email"]);
        }
    });
}
</script>