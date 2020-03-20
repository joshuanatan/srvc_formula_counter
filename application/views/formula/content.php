<div class = "col-lg-12">
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